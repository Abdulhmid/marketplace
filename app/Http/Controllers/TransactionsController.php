<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transactions::select('*')->with(['detail'])->orderBy('id','asc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row){
                            return $row->created_at->format('d/F/Y')
                                    .' by '.ucfirst($row->created_by);
                    })
                    ->editColumn('status', function($row){
                            if ($row->status=1) {
                                return "On Progress";
                            } elseif ($row->status=0) {
                                return "Konfirmasi Pembayaran";
                            }
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

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
