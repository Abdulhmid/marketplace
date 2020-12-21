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

                           $editUrl = url('roles/'.$row->id);
                           $btn = '<a href="'.$editUrl.'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-sm btn-outline-primary py-0">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-outline-danger py-0 deleteAction">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action','product'])
                    ->make(true);
        }
      
        return view('modules.transactions.index');
    }

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
