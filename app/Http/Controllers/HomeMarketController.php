<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\Sliders;
use App\Product_category;
use App\Product_types;
use App\Products;
use App\Banners;
use App\Produsen;
use App\Menus;
use App\Checkouts;
use App\Transactions;
use App\Transactions_status;
use Auth;

class HomeMarketController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function goLogin()
    {
        return view('marketplace.login',
            [
                'title'  => 'Login App'
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function goRegister()
    {
        return view('marketplace.register',
            [
                'title'  => 'Register App'
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
    	Request $request,
    	Sliders $slider,
    	Products $products,
        Banners $banners,
        Menus $menus,
    	Product_category $product_category

    )
    {
    	$slider = $slider->latest()->get();
        $banners = $banners->latest()->get();
    	$products = $products->with(['category','variant'])
                        ->where('status',1)
    					->latest();
    	$product_category = $product_category->latest()->get();
        $menus = $menus->orderBy('sort','asc')->get();

        return view('marketplace.main',
        	[
        		'menus' => $menus,
                'slider' => $slider,
                'banners' => $banners,
        		'products' => $products->paginate(16),
        		'products_top' => $products->paginate(5),
        		'category' => $product_category
        	]
    	);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products(
        Request $request,
        Sliders $slider,
        Products $products,
        Banners $banners,
        Menus $menus,
        Produsen $produsen,
        Product_category $product_category

    )
    {
        $slider = $slider->latest()->get();
        $banners = $banners->latest()->get();
        $produsen = $produsen->latest()->get();
        $products = $products->with(['category','variant'])
                        ->where('status',1);

        if (!empty($request['search'])) {
            $products = $products->with(['category','variant'])
                            ->where('status',1)
                            ->whereRaw('LOWER(name) LIKE ? ',[trim('%'.strtolower($request['search'])).'%']);
        }

        if (!empty($request['category'])) {
            $products = $products->whereIn('product_category_id',array_map('intval', explode(',', $request['category'])));
        }

        if (!empty($request['produsen'])) {
            $products = $products->whereIn('produsen_id',array_map('intval', explode(',', $request['produsen'])));
        }

        $product_category = $product_category->latest()->get();
        $menus = $menus->orderBy('sort','asc')->get();

        return view('marketplace.products',
            [
                'menus'     => $menus,
                'slider'    => $slider,
                'produsen'  => $produsen,
                'banners'   => $banners,
                'products'  => $products->latest()->paginate(10),
                'products_top'  => $products->paginate(5),
                'category'  => $product_category
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsDetail(
        Request $request,
        Sliders $slider,
        Products $products,
        Menus $menus,
        Produsen $produsen,
        Product_category $product_category,
        $slug

    )
    {
        $slider = $slider->latest()->get();
        $produsen = $produsen->latest()->get();
        $products = $products->with(['category','variant'])->latest();
        $product_category = $product_category->latest()->get();
        $menus = $menus->orderBy('sort','asc')->get();

        return view('marketplace.product-details',
            [
                'produsen'  => $produsen,
                'slider'    => $slider,
                'products_top'  => $products->paginate(5),
                'product'  => $products->where('slug',$slug)->first(),
                'category'  => $product_category,
                'menus'     => $menus,
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsCategory(
        Request $request,
        Products $products,
        Product_types $products_type,
        $slug
    )
    {
        $catId = $products_type->where('slug',$slug)->first()->id;
        $products = $products->with(['category','variant'])
                        ->where('product_type_id',$catId)
                        ->where('status',1);

        if (!empty($request['category'])) {
            $products = $products->whereIn('product_category_id',array_map('intval', explode(',', $request['category'])));
        }

        if (!empty($request['produsen'])) {
            $products = $products->whereIn('produsen_id',array_map('intval', explode(',', $request['produsen'])));
        }

        return view('marketplace.products-category',
            [
                'products'  => $products->paginate(16)
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(
        Request $request,
        Checkouts $checkouts
    )
    {
        $rowData['updated_by'] = 0;
        $rowData['updated_at'] = \Carbon\Carbon::now();
        $rowData['created_by'] = 0;
        $rowData['created_at'] = \Carbon\Carbon::now();
        $rowData['product_id'] = $request['idProduct'];
        $rowData['product_name']    = $request['nameProduct'];
        $rowData['varian_id']       = $request['variantId'];
        $rowData['varian_name']     = $request['variantName'];
        $rowData['note_items']      = $request['note'];
        $rowData['qty']             = $request['qty'];
        $rowData['total_price']     = $request['price'];
        $rowData['ip_or_mac_address'] = $request['ipAddress'];

        return $checkouts->create($rowData);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkoutData(
        Request $request,
        Checkouts $checkouts
    )
    {
        // return $request->all();
        if ($request['type']=='count') {
            $data = Checkouts::select(
                        'id','ip_or_mac_address','total_price','qty','note_items',
                        'varian_id','varian_name','product_id','product_name','status'
                    )->where('ip_or_mac_address',$request['ipAddress'])->count();
        }else{
            $data = Checkouts::select(
                        'id','ip_or_mac_address','total_price','qty','note_items',
                        'varian_id','varian_name','product_id','product_name','status'
                    )->where('ip_or_mac_address',$request['ipAddress'])->get();
        }
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionData(
        Request $request
    )
    {
        $uniqueTrans = \GlobalHelper::transUnique();
        return view('marketplace.buy',
            [
                'data'  => 'data',
                'uniqueTrans'  => $uniqueTrans
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionsOk(
        Request $request,
        $code
    )
    {
        $row = Transactions::where('transaction_code',$code)->first();
        return view('marketplace.transaction_success',
            [
                'data'  => $request->all(),
                'code'  => $code,
                'row'  => $row
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionsTracking(
        Request $request,
        Transactions $transactions,
        Transactions_status $trans_status,
        $code
    )
    {
        $data = $trans_status->where('transaction_code',$code)->get();
        $status = $transactions->where('transaction_code',$code)->first()->status;
        return view('marketplace.tracking_transaction',
            [
                'data'  => $data,
                'status'  => $status,
                'code'  => $code
            ]
        );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complaintTrans(
        Request $request,
        Transactions $model,
        $code
    )
    {
        // $status = $model->where('transaction_code',$code)
        //                 ->update([
        //                     'status' => 1,
        //                     'status' => 1
        //                 ]);
        return view('marketplace.complaint_transaction',
            [
                'code'  => $code
            ]
        );
    }

}
