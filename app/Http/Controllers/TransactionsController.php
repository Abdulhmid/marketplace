<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use App\Transactions_status;
use App\Product_variant;
use DataTables;
use Redirect,Response;
use Auth;

class TransactionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     * 0 = reject, 1 = waiting (Menunggu Pembayaran), 2 = paid (Menunggu Konfirmasi Pembayaran)
     * 3 = approve by admin
     * 4 = on proses pembuatan, 5 = on progres kirim 
     * 6 = diterima, 7 = cancel, 8 = komplain / refund
     * 9 = approve komplain, 10 = reject komplain
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $idWhereHas = Auth::user()->id;
            if (\GlobalHelper::session()=='seller') {
                 $data = Transactions::select('*')
                            ->whereHas('detail', function($q) use($idWhereHas){
                                $q->where('tj_transactions_detail.seller_id', $idWhereHas);
                            })
                            ->orderBy('id','asc')->get();
            }elseif (\GlobalHelper::session()=='produsen') {
                $data = Transactions::select('*')
                            ->whereHas('detail', function($q) use($idWhereHas){
                                $q->where('tj_transactions_detail.produsen_id', $idWhereHas);
                            })
                            ->orderBy('id','asc')->get();
            }else{
                $data = Transactions::select('*')->with('detail')
                            ->orderBy('id','asc')->get();
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row){
                            return $row->created_at->format('d/F/Y')
                                    .' by '.ucfirst($row->created_by);
                    })
                    ->editColumn('status', function($row){
                            if ($row->status == '0') {
                                $statusDisplay='Di Tolak';
                            }elseif ($row->status == '1') {
                                $statusDisplay='Menunggu Pembayaran';
                            }elseif ($row->status == '2') {
                                $statusDisplay='Terbayar';
                            }elseif ($row->status == '3') {
                                $statusDisplay='Disetujui';
                            }elseif ($row->status == '4') {
                                $statusDisplay='Proses Pembuatan';
                            }elseif ($row->status == '5') {
                                $statusDisplay='Proses Pengiriman';
                            }elseif ($row->status == '6') {
                                $statusDisplay='Barang Diterima';
                            }elseif ($row->status == '7') {
                                $statusDisplay='Dibatalkan';
                            }elseif ($row->status == '8') {
                                $statusDisplay='Komplain';
                            }elseif ($row->status == '9') {
                                $statusDisplay='Komplain Diterima';
                            }elseif ($row->status == '10') {
                                $statusDisplay='Komplain Ditolak';
                            }
                            return $statusDisplay;
                    })
                    ->editColumn('total_paid', function($row){
                        return \GlobalHelper::idrFormat($row->total_paid);
                    })
                    ->editColumn('updated_at', function($row){
                            return $row->updated_at->format('d/F/Y')
                                    .' by '.ucfirst($row->updated_by);
                    })
                    ->addColumn('product', function($row){
                            $listProd = '';
                            foreach ($row->detail as $key => $value) {
                                $listProd .= '- '.\GlobalHelper::productName($value->product_id).'<br/>';
                            }
                            return $listProd;
                    })
                    ->addColumn('action', function($row){

                           $editUrl = url('transactions/detail/'.$row->id);
                           $btn = '<a href="'.$editUrl.'" data-toggle="tooltip" data-original-title="detail" class="btn btn-sm btn-outline-primary py-0">Detail</a>';
                            return $btn;
                    })
                    ->rawColumns(['action','product'])
                    ->make(true);
        }
      
        return view('modules.transactions.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(
        Request $request,
        Transactions $model,
        $id
    )
    {
        $row = $model->with('detail')->where('id', $id)->first();
        return view('modules.transactions.detail',[
            'row' => $row
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Transactions $model,
        $id
    )
    {
        $row = $model->with('detail')->where('id', $id)->first();
        return view('modules.transactions.edit',[
            'row' => $row
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEdit(
        Transactions $model, 
        Request $request
    )
    {
        $rulesData['total_paid'] = $request['totalPrice'];
        $rulesData['note'] = $request['note'];
        $rulesData['updated_by'] = 1;
        $rulesData['updated_at'] = \Carbon\Carbon::now();
        $model->where('transaction_code',$request['transaction_code'])
            ->update($rulesData);

        return response()->json([
            'data'  => $request->all(),
            'response_code' => 200,
            'message' => 'Success'
        ], 200);
    }

    // Change status
    public function changeTransStatus(
        Transactions $model,
        Transactions_status $model_status,
        Product_variant $product_variant,
        Request $request
    )
    {
        $rowTrans = $model->where('transaction_code', $request['code']);
        $row = $rowTrans->update([
                        'status' => $request['status']
                    ]);

        // if ($request['status']==3) {
        //     $product_variant->where('product_id',$rowTrans->first()->product_id)
        //         ->update([

        //         ]);
        // }

        $model_status->create([
            'status' => $request['status'],
            'transaction_code' => $request['code'],
            'created_by' => \Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_by' => 0,
            'updated_at' => \Carbon\Carbon::now(),
        ]);



        return $row;
    }


    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
