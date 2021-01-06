<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mutation;
use App\Transactions;
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
                        ->where('status',8)
                        ->with(['detail'])
                        ->orderBy('id','asc')
                        ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('transaction_code', function($row){
                        $data = $row->transaction_code."<hr/>".$row->buyer_email."<hr/>".$row->total_paid;
                        return $data;
                    })
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
                                $statusDisplay='Menunggu Pengecekan';
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

                           $editUrl = url('data-products/'.$row->id);
 
                           $btn = '<a href="'.$editUrl.'" data-toggle="tooltip" data-original-title="Detail" class="btn btn-sm btn-outline-primary py-0">Detail</a>';
                           $btn = '<div class="clearfix"></div>'.$btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Approve" class="btn btn-sm btn-outline-success py-0 approveAction">Approve</a>';
                           $btn = '<div class="clearfix"></div>'.$btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Reject" class="btn btn-sm btn-outline-danger py-0 rejectAction">Reject</a>';
                            return $btn;
                    })
                    ->rawColumns(['action','product','transaction_code'])
                    ->make(true);
        }
      
        return view('modules.complaint.index');
    }


    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
