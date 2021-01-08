<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mutation;
use DataTables;
use Redirect,Response;
use Auth;

class MutationController extends Controller
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
            $data = Mutation::select('*')
                    ->where('user_id',\Auth::user()->id)
                    ->orderBy('id','asc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row){
                            return $row->created_at->format('d/F/Y')
                                    .' by '.ucfirst($row->created_by);
                    })
                    ->editColumn('saldo', function($row){
                        return \GlobalHelper::idrFormat($row->saldo);
                    })
                    ->editColumn('debit', function($row){
                        return \GlobalHelper::idrFormat($row->debit);
                    })
                    ->editColumn('credit', function($row){
                        return \GlobalHelper::idrFormat($row->credit);
                    })
                    ->editColumn('updated_at', function($row){
                            return $row->updated_at->format('d/F/Y')
                                    .' by '.ucfirst($row->updated_by);
                    })
                    ->addColumn('action', function($row){

                           $editUrl = url('mutation/detail/'.$row->id);
                           $btn = '<a href="'.$editUrl.'" data-toggle="tooltip" data-original-title="detail" class="btn btn-sm btn-outline-primary py-0">Detail</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('modules.mutation.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(
        Request $request,
        Mutation $model,
        $id
    )
    {
        $row = $model->where('id', $id)->first();
        return view('modules.mutation.detail',[
            'row' => $row
        ]);
    }


    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
