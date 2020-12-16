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
use Auth;

class HomeMarketController extends Controller
{
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
                        ->latest();
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
        $products = $products->with(['category','variant'])
                        ->latest();
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
                        ->paginate(16);

        return view('marketplace.products',
            [
                'products'  => $products
            ]
        );
    }

}
