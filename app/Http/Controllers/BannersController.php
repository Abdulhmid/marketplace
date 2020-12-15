<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banners;
use DataTables;
use Redirect,Response;
use Auth;

class BannersController extends Controller
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
            $data = Banners::latest()->get();
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
                    ->editColumn('updated_at', function($row){
                            return $row->updated_at->format('d/F/Y')
                                    .' by '.ucfirst($row->updated_by);
                    })
                    ->addColumn('action', function($row){

                           $editUrl = url('banners/'.$row->id);
                           $btn = '<a href="'.$editUrl.'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-sm btn-outline-primary py-0">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-outline-danger py-0 deleteAction">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('modules.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.banners.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isEdit = $request['id'];

        $rulesData = $request->validate([
          'name' => 'required',
          'description' => 'required',
          'status' => 'required'
        ]);

        if (isset($isEdit)) {
            if ($files = $request->file('image')) {
                $destinationPath = 'public/imagesBanners/'; // upload path
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $rulesData['image'] = "public/imagesBanners/"."$profileImage";
            }

            $rulesData['updated_by'] = Auth::user()->id;
            $rulesData['updated_at'] = \Carbon\Carbon::now();
            Banners::whereId($isEdit)->update($rulesData);
            $this->meesage('message','Banners updated successfully!');
            return redirect('banners');
        }

        $rulesData['status'] = $request->status;
        $rulesData['description'] = $request->description;
        $rulesData['name'] = $request->name;
        $rulesData['updated_by'] = Auth::user()->id;
        $rulesData['updated_at'] = \Carbon\Carbon::now();
        $rulesData['created_by']    = Auth::user()->id;
        $rulesData['created_at']    = \Carbon\Carbon::now();

        if ($files = $request->file('image')) {
            $destinationPath = 'public/imagesBanners/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $rulesData['image'] = "public/imagesBanners/"."$profileImage";
        }


        Banners::create($rulesData);

        $this->meesage('message','Banners created successfully!');
        return redirect('banners');
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
    public function edit(
        Banners $model,
        $id
    )
    {
        $row = $model->where('id', $id)->first();
        return view('modules.banners.form',[
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
    public function destroy(
        Request $request, 
        Banners $model, 
        $id
    )
    {
        $model->where('id', $id)->delete();
        $this->meesage('message','Banners deleted successfully!');
        return redirect()->back();
    }

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
