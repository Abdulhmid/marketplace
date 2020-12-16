<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Produsen;
use App\Product_category;
use App\Product_variant;
use App\Product_types;
use DataTables;
use Redirect,Response;
use Auth;

class ProductsController extends Controller
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
            $data = Products::with('variant')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('total_price', function($row){
                            return \GlobalHelper::idrFormat($row->total_price);
                    })
                    ->editColumn('status', function($row){
                            $statusDisplay='Active';
                            if ($row->status == '0') {
                                $statusDisplay='Non Active';
                            }
                        
                            return $statusDisplay;
                    })
                    ->editColumn('variant', function($row){
                            $vD='';
                            foreach ($row->variant as $key => $value) {
                                $vD.='- <label class="label label-danger">'.$value->name.'</label><br/>';
                            }
                            return $vD;
                    })
                    ->editColumn('product_type_id', function($row){
                            return Product_types::where('id',$row
                                        ->product_type_id)
                                        ->first()
                                        ->name;
                    })
                    ->editColumn('created_at', function($row){
                            return $row->created_at->format('d/F/Y')
                                    .' by '.ucfirst($row->created_by);
                    })
                    ->editColumn('product_category_id', function($row){
                            return Product_category::where('id',$row
                                        ->product_category_id)
                                        ->first()
                                        ->name;
                    })
                    ->editColumn('updated_at', function($row){
                            return $row->updated_at->format('d/F/Y')
                                    .' by '.ucfirst($row->updated_by);
                    })
                    ->addColumn('action', function($row){

                           $editUrl = url('data-products/'.$row->id);
                           $btn = '<a href="'.$editUrl.'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-sm btn-outline-primary py-0">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-outline-danger py-0 deleteAction">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action','variant'])
                    ->make(true);
        }
      
        return view('modules.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(
        Product_category $categoryProducts,
        Product_types $categoryTypes,
        Produsen $produsen
    )
    {
        $categoryProducts = $categoryProducts->latest()->get();
        $categoryTypes = $categoryTypes->latest()->get();
        $produsen = $produsen->latest()->get();
        return view('modules.products.form',[
            'category' =>$categoryProducts,
            'types' =>$categoryTypes,
            'produsen' =>$produsen
        ]);
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

        $vN = $request['variant_name'];
        $vD = $request['variant_description'];
        $vS = $request['variant_stock'];

        if (isset($isEdit)) {
            $rulesData = $request->validate([
                'name' => 'required',
                'slug' => 'required',
                'short_desc' => 'required',
                'description' => 'required',
                'commission_price' => 'required',
                'produsen_price' => 'required',
                'product_category_id' => 'required',
                'produsen_id' => 'required',
                'status' => 'required',
                'product_type_id' => 'required'
            ]);

            if ($files = $request->file('image')) {
                $destinationPath = 'public/imagesProducts/'; // upload path
                $fileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $fileImage);
                $rulesData['image'] = "public/imagesProducts/"."$fileImage";
            }

            if ($files1 = $request->file('image_1')) {
                $destinationPath = 'public/imagesProducts/'; // upload path
                $fileImage1 = date('YmdHis') . "." . $files1->getClientOriginalExtension();
                $files1->move($destinationPath, $fileImage1);
                $rulesData['image_1'] = "public/imagesProducts/"."$fileImage1";
            }

            if ($files2 = $request->file('image_2')) {
                $destinationPath = 'public/imagesProducts/'; // upload path
                $fileImage2 = date('YmdHis') . "." . $files2->getClientOriginalExtension();
                $files2->move($destinationPath, $fileImage2);
                $rulesData['image_2'] = "public/imagesProducts/"."$fileImage2";
            }

            if ($files3 = $request->file('image_3')) {
                $destinationPath = 'public/imagesProducts/'; // upload path
                $fileImage3 = date('YmdHis') . "." . $files3->getClientOriginalExtension();
                $files3->move($destinationPath, $fileImage3);
                $rulesData['image_3'] = "public/imagesProducts/"."$fileImage3";
            }

            if ($files4 = $request->file('image_4')) {
                $destinationPath = 'public/imagesProducts/'; // upload path
                $fileImage4 = date('YmdHis') . "." . $files4->getClientOriginalExtension();
                $files4->move($destinationPath, $fileImage4);
                $rulesData['image_4'] = "public/imagesProducts/"."$fileImage4";
            }

            $rulesData['total_price'] = $request['produsen_price']+$request['commission_price'];
            $rulesData['updated_by'] = Auth::user()->id;
            $rulesData['updated_at'] = \Carbon\Carbon::now();
            Products::whereId($isEdit)->update($rulesData);

            // Update Varian product
            $varianData['product_id'] = $isEdit;
            $varianData['updated_by'] = Auth::user()->id;
            $varianData['updated_at'] = \Carbon\Carbon::now();
            $varianData['created_by']    = Auth::user()->id;
            $varianData['created_at']    = \Carbon\Carbon::now();

            Product_variant::where('product_id',$isEdit)->delete();
            for ($i=0; $i < count($vN) ; $i++) { 
                $varianData['name'] = $vN[$i];
                $varianData['description'] = $vD[$i];
                $varianData['stock'] = $vS[$i];
                Product_variant::create($varianData);
            }

            $this->meesage('message','Products updated successfully!');
            return redirect('data-products');
        }else{
            $rulesData = $request->validate([
                'name' => 'required',
                'slug' => 'required',
                'short_desc' => 'required',
                'description' => 'required',
                'produsen_price' => 'required',
                'commission_price' => 'required',
                'product_category_id' => 'required',
                'produsen_id' => 'required',
                'status' => 'required',
                'product_type_id' => 'required'
            ]);
        }

        $rulesData['updated_by'] = Auth::user()->id;
        $rulesData['updated_at'] = \Carbon\Carbon::now();
        $rulesData['created_by']    = Auth::user()->id;
        $rulesData['created_at']    = \Carbon\Carbon::now();


        if ($files = $request->file('image')) {
            $destinationPath = 'public/imagesProducts/'; // upload path
            $fileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $fileImage);
            $rulesData['image'] = "public/imagesProducts/"."$fileImage";
        }

        if ($files1 = $request->file('image_1')) {
            $destinationPath = 'public/imagesProducts/'; // upload path
            $fileImage1 = date('YmdHis') . "." . $files1->getClientOriginalExtension();
            $files1->move($destinationPath, $fileImage1);
            $rulesData['image_1'] = "public/imagesProducts/"."$fileImage1";
        }

        if ($files2 = $request->file('image_2')) {
            $destinationPath = 'public/imagesProducts/'; // upload path
            $fileImage2 = date('YmdHis') . "." . $files2->getClientOriginalExtension();
            $files2->move($destinationPath, $fileImage2);
            $rulesData['image_2'] = "public/imagesProducts/"."$fileImage2";
        }

        if ($files3 = $request->file('image_3')) {
            $destinationPath = 'public/imagesProducts/'; // upload path
            $fileImage3 = date('YmdHis') . "." . $files3->getClientOriginalExtension();
            $files3->move($destinationPath, $fileImage3);
            $rulesData['image_3'] = "public/imagesProducts/"."$fileImage3";
        }

        if ($files4 = $request->file('image_4')) {
            $destinationPath = 'public/imagesProducts/'; // upload path
            $fileImage4 = date('YmdHis') . "." . $files4->getClientOriginalExtension();
            $files4->move($destinationPath, $fileImage4);
            $rulesData['image_4'] = "public/imagesProducts/"."$fileImage4";
        }
        $rulesData['total_price'] = $request['produsen_price']+$request['commission_price'];


        $createProduct = Products::create($rulesData);

        // Store Varian product
        $varianData['product_id'] = $createProduct->id;
        $varianData['updated_by'] = Auth::user()->id;
        $varianData['updated_at'] = \Carbon\Carbon::now();
        $varianData['created_by']    = Auth::user()->id;
        $varianData['created_at']    = \Carbon\Carbon::now();

        for ($i=0; $i < count($vN) ; $i++) { 
            $varianData['name'] = $vN[$i];
            $varianData['description'] = $vD[$i];
            $varianData['stock'] = $vS[$i];
            Product_variant::create($varianData);
        }

        $this->meesage('message','Products created successfully!');
        return redirect('data-products');
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
        Product_category $categoryProducts,
        Product_types $categoryTypes,
        Produsen $produsen,
        Products $products,
        $id
    )
    {
        $categoryProducts = $categoryProducts->latest()->get();
        $categoryTypes = $categoryTypes->latest()->get();
        $produsen = $produsen->latest()->get();
        $row = $products->with('variant')->where('id', $id)->first();
        return view('modules.products.form',[
            'row' => $row,
            'category' =>$categoryProducts,
            'types' =>$categoryTypes,
            'produsen' =>$produsen
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
        Products $products, 
        Product_variant $product_variant,
        $id
    )
    {
        $product_variant->where('product_id',$id)->delete();
        $products->where('id', $id)->delete();

        $this->meesage('message','Products deleted successfully!');
        return redirect()->back();
    }

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}