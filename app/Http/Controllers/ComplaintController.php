<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mutation;
use App\Transactions;
use App\Transactions_status;
use DataTables;
use Redirect,Response;
use Auth;

class ComplaintController extends Controller
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
            $data = Transactions::select('*')
                        ->whereHas('status', function($q) {
                            $q->whereIn('status', [8]);
                        })
                        ->with(['detail'])
                        ->orderBy('id','asc')
                        ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('transaction_code', function($row){
                        $data = $row->transaction_code." / ".$row->buyer_email."<hr/>".
                                "Total Bayar : Rp. ".\GlobalHelper::idrFormat($row->total_paid);
                        return $data;
                    })
                    ->editColumn('created_at', function($row){
                            return $row->created_at->format('d/F/Y')
                                    .' by '.ucfirst($row->created_by);
                    })
                    ->editColumn('status', function($row){
                        return \GlobalHelper::wordingStatusTransaksi($row->status);
                    })
                    ->editColumn('total_paid', function($row){
                        return \GlobalHelper::idrFormat($row->total_paid);
                    })
                    ->editColumn('updated_at', function($row){
                            return $row->updated_at->format('d/F/Y')
                                    .' by '.ucfirst($row->updated_by);
                    })
                    ->editColumn('complaint_description', function($row){
                            if (empty($row->response_complaint)) {
                                $resComp = '-';
                            }else{
                                $resComp = $row->response_complaint;
                            }
                            return $row->complaint_description."<hr><br/>". "Tanggapan : <br/>".$resComp;
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
 
                           $btn = '<a href="'.$editUrl.'" data-toggle="tooltip" data-original-title="Detail" class="btn btn-sm btn-outline-primary py-0">Detail</a>';

                           if ($row->status == 8) {

                               $btn = '<div class="clearfix"></div>'.$btn.' <a href="#myModal" class="btn btn-sm btn-outline-info py-0" data-complaint-id="'.$row->id.'" data-complaint-trans="'.$row->transaction_code.'" data-complaint-desc="'.$row->complaint_description.'" data-toggle="modal" data-target="#myModal">Response</a> ';
                               $btn = '<div class="clearfix"></div>'.$btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-status="9"  data-id="'.$row->transaction_code.'" data-original-title="Approve" class="btn btn-sm btn-outline-success py-0 approveAction">Approve</a>';
                               $btn = '<div class="clearfix"></div>'.$btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-status="10"  data-id="'.$row->transaction_code.'" data-original-title="Reject" class="btn btn-sm btn-outline-danger py-0 rejectAction">Reject</a>';
                           }

                           return $btn;
                    })
                    ->rawColumns(['action','product','transaction_code','complaint_description'])
                    ->make(true);
        }
      
        return view('modules.complaint.index');
    }

    /**
     * Change status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeresponse(
        Transactions $model, 
        Request $request
    )
    {
        $rulesData['response_complaint'] = $request['response_complaint'];
        $rulesData['updated_at'] = \Carbon\Carbon::now();
        $model->where('transaction_code',$request['transaction_code'])
            ->update($rulesData);

        return response()->json([
            'data'  => $request->all(),
            'response_code' => 200,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Change status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complaintChange(
        Request $request, 
        Transactions $model,
        Transactions_status $model_status, 
        $code,
        $status
    )
    {
        $model->where('transaction_code',$code)->update([
            'status' => $status
        ]);

        $createdById = Auth::user()->id;
        $model_status->create([
            'status' => $status,
            'transaction_code' => $code,
            'created_by' => $createdById,
            'created_at' => \Carbon\Carbon::now(),
            'updated_by' => 0,
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        
        return "Ok";
    }


    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
