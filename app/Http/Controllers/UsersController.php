<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Produsen;
use DataTables;
use Redirect,Response;
use Auth;

class UsersController extends Controller
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
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status', function($row){
                            $statusDisplay='Active';
                            if ($row->status == '0') {
                                $statusDisplay='Non Active';
                            }
                        
                            return $statusDisplay;
                    })
                    ->editColumn('image', function($row){
                            return \GlobalHelper::imageShow($row->image);
                    })
                    ->editColumn('role_id', function($row){
                            return Roles::where('id',$row->role_id)->first()->name;
                    })
                    ->editColumn('updated_at', function($row){
                            return $row->updated_at->format('d/F/Y')
                                    .' by '.ucfirst($row->updated_by);
                    })
                    ->addColumn('action', function($row){
                           $btnBlock = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Block" class="btn btn-sm btn-outline-warning py-0 blockAction">Block</a> ';
                           $btnOpen = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Aktifkan" class="btn btn-sm btn-outline-success py-0 activateAction">Aktfikan</a> ';
                           $editUrl = url('users/'.$row->id);
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
      
        return view('modules.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Roles $roles)
    {
        $roles = $roles->latest()->get();
        return view('modules.users.form',[
            'roles' =>$roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        Produsen $produsen,
        Request $request
    )
    {
        $isEdit = $request['id'];

        if (isset($isEdit)) {
            $rulesData = $request->validate([
                'name' => 'required',
                'username' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'role_id' => 'required',
                'status' => 'required',
                'address' => 'required',
                'password' => 'confirmed'
            ]);

            if(isset($request['password']) && $request['password'] != "")
                $rulesData['password'] = bcrypt($request['password']);
            else
                unset($rulesData['password']);

            if ($files = $request->file('image')) {
                $destinationPath = 'public/imagesProfile/'; // upload path
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $rulesData['image'] = "public/imagesProfile/"."$profileImage";
            }

            $rulesData['city_id'] = explode("-", $request['location'])[0];
            $rulesData['updated_by'] = Auth::user()->id;
            $rulesData['updated_at'] = \Carbon\Carbon::now();
            User::whereId($isEdit)->update($rulesData);
            $this->meesage('message','Users updated successfully!');
            return redirect('users');
        }else{
            $rulesData = $request->validate([
                'name' => 'required',
                'username' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'role_id' => 'required',
                'status' => 'required',
                'address' => 'required',
                'password' => 'required|confirmed'
            ]);
        }

        $rulesData['city_id'] = explode("-", $request['location'])[0];
        $rulesData['updated_by'] = Auth::user()->id;
        $rulesData['updated_at'] = \Carbon\Carbon::now();
        $rulesData['created_by']    = Auth::user()->id;
        $rulesData['created_at']    = \Carbon\Carbon::now();
        $rulesData['password']      = bcrypt($request->password);


        if ($files = $request->file('image')) {
            $destinationPath = 'public/imagesProfile/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $rulesData['image'] = "public/imagesProfile/"."$profileImage";
        }


        $dataUser = User::create($rulesData);
        if (\GlobalHelper::getLabelByRoleId($request['role_id'])=='produsen') {
            $produsen->create([
                'user_id' => $dataUser->id,
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'address' => $request['address'],
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        $this->meesage('message','Users created successfully!');
        return redirect('users');
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
    public function edit(Roles $roles, User $users,$id)
    {
        $roles = $roles->latest()->get();
        $row = $users->where('id', $id)->first();
        return view('modules.users.form',[
            'row' => $row,
            'roles' => $roles
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
    public function destroy(Request $request, User $users, $id)
    {
        $users->where('id', $id)->delete();
        $this->meesage('message','Roles deleted successfully!');
        return redirect()->back();
    }

    public function block(Request $request, $id)
    {
        $dataUser = User::where('id',$id);
        $dataUser->update(['status'=>0]);
        if (\GlobalHelper::getLabelByRoleId($dataUser->first()->role_id)=='produsen') {
            Produsen::where('user_id',$id)->update(['status'=>0]);
        }
        $this->meesage('message','User update successfully!');
        return redirect()->back();
    }

    public function activated(Request $request, $id)
    {
        $dataUser = User::where('id',$id);
        $dataUser->update(['status'=>1]);
        if (\GlobalHelper::getLabelByRoleId($dataUser->first()->role_id)=='produsen') {
            Produsen::where('user_id',$id)->update(['status'=>1]);
        }
        $this->meesage('message','User update successfully!');
        return redirect()->back();
    }

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
