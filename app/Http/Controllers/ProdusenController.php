<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produsen;
use App\User;
use App\Roles;
use DataTables;
use Redirect,Response;
use Auth;

class ProdusenController extends Controller
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
            $data = Produsen::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status', function($row){
                            $statusDisplay='Active';
                            if ($row->status == '0') {
                                $statusDisplay='Non Active';
                            }
                        
                            return $statusDisplay;
                    })
                    ->editColumn('created_at', function($row){
                            return $row->created_at->format('d/F/Y')
                                    .' by '.ucfirst($row->created_by);
                    })
                    // ->editColumn('updated_at', function($row){
                    //         return $row->updated_at->format('d/F/Y')
                    //                 .' by '.ucfirst($row->updated_by);
                    // })
                    ->addColumn('action', function($row){

                           $editUrl = url('produsen/'.$row->id);
                           $btnBlock = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Block" class="btn btn-sm btn-outline-warning py-0 blockAction">Block</a> ';
                           $btnOpen = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Aktifkan" class="btn btn-sm btn-outline-success py-0 activateAction">Aktfikan</a> ';
                           $btn = '<a href="'.$editUrl.'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-sm btn-outline-primary py-0">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-outline-danger py-0 deleteAction">Delete</a>';
                            if ($row->status==1) {
                                return $btnBlock.$btn;
                            }else{
                                return $btnOpen.$btn;
                            }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('modules.produsen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.produsen.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        User $user,
        Roles $roles,
        Request $request
    )
    {
        $isEdit = $request['id'];

        $rulesData = $request->validate([
          'name' => 'required',
          'phone' => 'required',
          'email' => 'required',
          'address' => 'required',
          'status' => 'required'
        ]);

        if (isset($isEdit)) {
            $rulesData['updated_by'] = Auth::user()->id;
            $rulesData['updated_at'] = \Carbon\Carbon::now();
            Produsen::whereId($isEdit)->update($rulesData);
            $this->meesage('message','Produsen updated successfully!');
            return redirect('produsen');
        }

        $userData = $user->create([
            'name' => $request->name,
            'username' => $request->email,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $roles->where('label','produsen')->first()->id,
            'status' => 1,
            'address' => $request->address,
            'password' => bcrypt($request->email)
        ]);

        Produsen::create([
            'user_id' => $userData->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status,
            'created_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_by' => Auth::user()->id,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        $this->meesage('message','Produsen created successfully!');
        return redirect('produsen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produsen $produsen,$id)
    {
        $row = $produsen->where('id', $id)->first();
        return view('modules.produsen.form',[
            'row' => $row
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Produsen $produsen, $id)
    {
        $produsen->where('id', $id)->delete();
        $this->meesage('message','Produsen deleted successfully!');
        return redirect()->back();
    }

    public function block(Request $request, Produsen $produsen, $id)
    {
        $dataProdusen = $produsen->where('id', $id);
        $dataProdusen->update([
                'status' =>0
            ]);
        User::where('id',$dataProdusen->first()->user_id)
            ->update(['status'=>0]);
        $this->meesage('message','Produsen update successfully!');
        return redirect()->back();
    }

    public function activated(Request $request, Produsen $produsen, $id)
    {
        $dataProdusen = $produsen->where('id', $id);
        $dataProdusen->update([
                'status' =>1
            ]);
        User::where('id',$dataProdusen->first()->user_id)
            ->update(['status'=>1]);
        $this->meesage('message','Produsen update successfully!');
        return redirect()->back();
    }

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
