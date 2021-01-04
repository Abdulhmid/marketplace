@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')

<div class="test">
  <div class="container">
    <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
          </div>
    </div>
  </div>
</div>
<div class="ps-product--detail pt-60">
  <div class="ps-container">
    <div class="row">
      <div class="col-lg-10 col-md-12 col-lg-offset-1">
        <div class="ps-product__thumbnail">
          <div class="hidden-data">
            <input type="hidden" id="product-id" value="{{$product->id}}">
          </div>
          <div class="ps-product__preview">
            <div class="ps-product__variants">
              <div class="item">
                <img src="{{url($product->image)}}" alt="">
                <input type="hidden" id="imageProduct" value="{{url($product->image)}}">
              </div>
              <div class="item"><img src="{{url($product->image_1)}}" alt=""></div>
              <div class="item"><img src="{{url($product->image_2)}}" alt=""></div>
              <div class="item"><img src="{{url($product->image_3)}}" alt=""></div>
              <div class="item"><img src="{{url($product->image_4)}}" alt=""></div>
            </div>
              <!-- <a class="popup-youtube ps-product__video" href="http://www.youtube.com/watch?v=0O2aH4XLbto">
                <img src="{{url($product->image)}}" alt="">
                <i class="fa fa-play"></i>
              </a> -->
          </div>
          <div class="ps-product__image">
            <div class="item">
              <img class="zoom" src="{{url($product->image_1)}}" alt="" data-zoom-image="{{url($product->image_1)}}">
            </div>
            <div class="item">
              <img class="zoom" src="{{url($product->image_2)}}" alt="" data-zoom-image="{{url($product->image_2)}}">
            </div>
            <div class="item">
              <img class="zoom" src="{{url($product->image_3)}}" alt="" data-zoom-image="{{url($product->image_3)}}">
            </div>
          </div>
        </div>
        <div class="ps-product__thumbnail--mobile">
          <div class="ps-product__main-img">
            <img src="{{url($product->image_1)}}" alt=""></div>
          <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on">
            <img src="{{url($product->image_1)}}" alt="">
            <img src="{{url($product->image_2)}}" alt="">
            <img src="{{url($product->image_3)}}" alt="">
          </div>
        </div>
        <div class="ps-product__info">
          <h1>{{$product->name}}</h1>
          <input type="hidden" id="nameProduct" value="{{$product->name}}">
          <input type="hidden" id="productLocation" value="{{$product->city_id}}">
          <p class="ps-product__category">
            <a href="#">{{$product->category->name}}( Berat {{$product->weight}} Gram)</a>
            <input type="hidden" name="weight" id="weight" value="{{$product->weight}}">
          </p>
          <h3 class="ps-product__price">{{GlobalHelper::idrFormat($product->total_price)}} 
            <del>{{GlobalHelper::idrFormat(GlobalHelper::ratePromo($product->total_price))}}</del>
          </h3>
          <input type="hidden" id="price" value="{{$product->total_price}}">
          <div class="ps-product__block ps-product__quickview">
            <h4>QUICK REVIEW</h4>
            <p>{{$product->description}}</p>
          </div>
          <div class="ps-product__block ps-product__size">
            <h4>PILIH VARIAN</h4>
            <select class="ps-select selectpicker" id="variantId">
              @foreach($product->variant as $vvarian)
                <option value="{{$vvarian->id}}-{{$vvarian->name}}">
                  {{$vvarian->name}}
                </option>
              @endforeach
            </select>
            <div class="form-group">
              <input class="form-control" type="number" id="qty" name="qty" value="1">
            </div>
            <div class="form-group" style="display: none;">
              <label>Catatan Produk</label>
              <textarea class="form-control" id="note" value="-" name="note" style="width: 345px;">-
              </textarea>
            </div>
          </div>
          <div class="ps-product__block ps-product__size">
            <h4>PILIH PENJUAL</h4>
            <select class="ps-select selectpicker" id="sellerID">
              @foreach(GlobalHelper::seller($product->id) as $value)
                <option value="{{$value->product_id}}-{{$value->seller->name}}">
                  {{$value->seller->name}}
                </option>
              @endforeach
            </select>
            <div class="form-group" style="display: none;">
              <label>Catatan Produk</label>
              <textarea class="form-control" id="note" value="-" name="note" style="width: 345px;">-
              </textarea>
            </div>
          </div>
          <div class="ps-product__shopping">
            <a class="ps-btn mb-5" href="#checkout">+ Keranjang
              <i class="ps-icon-next"></i>
            </a>
            <a class="ps-btn mb-5" href="#buy">Beli
              <i class="ps-icon-next"></i>
            </a>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<div class="ps-section ps-section--top-sales ps-owl-root pt-40 pb-80">
  <div class="ps-container">
    <div class="ps-section__header mb-50">
      <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
              <h3 class="ps-section__title" data-mask="Related item">- YOU MIGHT ALSO LIKE</h3>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
              <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
            </div>
      </div>
    </div>
    <div class="ps-section__content">
      <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
        @foreach(GlobalHelper::productTop() as $value)
          <div class="ps-shoes--carousel">
            <div class="ps-shoe">
              <div class="ps-shoe__thumbnail">
                <div class="ps-badge">
                  <span>New</span>
                </div>
                <div class="ps-badge ps-badge--sale ps-badge--2nd">
                  <span>-35%</span>
                </div>
                  <a class="ps-shoe__favorite" href="#">
                    <i class="ps-icon-heart"></i>
                  </a>
                  <img src="{{url($value->image)}}" alt="">
                  <a class="ps-shoe__overlay" href="{{url('products/detail/'.$value->slug)}}"></a>
              </div>
              <div class="ps-shoe__content">
                <div class="ps-shoe__variants">
                  <div class="ps-shoe__variant normal">
                    <img src="{{url(GlobalHelper::imageShow($value->image_1))}}" alt="">
                    <img src="{{url(GlobalHelper::imageShow($value->image_2))}}" alt="">
                    <img src="{{url(GlobalHelper::imageShow($value->image_3))}}" alt="">
                    <img src="{{url(GlobalHelper::imageShow($value->image_4))}}" alt="">
                  </div>
                </div>
                <div class="ps-shoe__detail">
                  <a class="ps-shoe__name" href="{{url('products/detail/'.$value->slug)}}">{{$value->name}}</a>
                  <p class="ps-shoe__categories">
                    <a href="#">{{$value->category->name}}</a>
                  </p>
                  <span class="ps-shoe__price">
                    <del>{{($value->price_sell)+5000}}</del> {{$value->price_sell}}</span>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>


@stop
@section('css')

<style type="text/css">
  .ps-pagination .pagination li {
      display: inline-block;
      margin-right: 15px;
      text-align: center;
  }
  .ps-pagination .pagination li > a {
      padding: 0 17px;
      position: relative;
      display: inline-block;
      z-index: 30;
      font-family: "Montserrat", sans-serif;
      font-size: 16px;
      color: #313131;
      line-height: 50px;
      -webkit-border-radius: 0;
      -moz-border-radius: 0;
      -ms-border-radius: 0;
      border-radius: 0;
      border: none;
      background-color: transparent !important;
  }
</style>

@stop

@section('js')
<script type="text/javascript">
  $(document).ready(function(){

    if ("checkouts" in localStorage) {
      var checkouts = JSON.parse(localStorage.getItem("checkouts"));  
    }else{
      var checkouts = JSON.parse("[]");
    }

    if ("itemCheckouts" in localStorage) {
      var itemCheckouts = JSON.parse(localStorage.getItem("itemCheckouts"));  
    }else{
      var itemCheckouts = JSON.parse("[]");
    }

    $('a[href="#checkout"]').click(function(){
      checkouts.push({
        idProduct: $('#product-id').val(),
        productLocation: $('#productLocation').val(),
        nameProduct: $('#nameProduct').val(),
        price: $('#price').val(),
        weight: $('#weight').val(),
        qty: $('#qty').val(),
        variantId: $('#variantId').val().split("-")[0],
        variantName: $('#variantId').val().split("-")[1],
        note: $('#note').val(),
        ipAddress: $('#ip-address').val(),
        image: $('#imageProduct').val(),
        seller: $('#sellerID').val()
      });
      localStorage.setItem("checkouts", JSON.stringify(checkouts));

      // setArrayId
      // itemCheckouts.push(idProduct);
      localStorage.setItem("itemCheckouts", JSON.stringify(checkouts));

      $('#total-checkout').html(
        checkouts.length
      );
      updateCheckout(checkouts)

    }); 

    $('a[href="#buy"]').click(function(){
      if ("itemBuy" in localStorage) {
        var itemBuy = JSON.parse(localStorage.getItem("itemBuy"));  
      }else{
        var itemBuy = JSON.parse("[]");
      }
      itemBuy.push({
        idProduct: $('#product-id').val(),
        nameProduct: $('#nameProduct').val(),
        productLocation: $('#productLocation').val(),
        price: $('#price').val(),
        weight: $('#weight').val(),
        qty: $('#qty').val(),
        variantId: $('#variantId').val().split("-")[0],
        variantName: $('#variantId').val().split("-")[1],
        note: $('#note').val(),
        ipAddress: $( '#ip-address').val(),
        image: $('#imageProduct').val(),
        seller: $('#sellerID').val()
      });
      localStorage.setItem("itemBuy", JSON.stringify(itemBuy));
      window.location.href = "/products/data/transactions";

      
    }); 

    function idrFormat(args) {
        "use strict";
        var total = (args/1000).toFixed(3);
        return total;
    }

    // Update checkout
    function updateCheckout(checkouts){
      var totalPrice = 0;
      var idKey = checkouts.length - 1;
      var plusPrice = checkouts[checkouts.length-1]['price']*checkouts[checkouts.length-1]['qty'];
      dTrow ='<div class="ps-cart-item" id="ps-cart-item-id-'+idKey+'">'+
                '<a class="ps-cart-item__close" data-value="'+idKey+'" data-currentprice="'+plusPrice+'" href="#removeChart"></a>'+
                '<div class="ps-cart-item__thumbnail">'+
                    '<a href="#"></a>'+
                    '<img src="'+checkouts[checkouts.length-1]['image']+'" alt="">'+
                '</div>'+
                '<div class="ps-cart-item__content">'+
                  '<a class="ps-cart-item__title" href="product-detail.html">'+
                    checkouts[checkouts.length-1]['nameProduct']+
                  '</a>'+
                  '<p>'+
                    '<span>Quantity:<i>'+checkouts[checkouts.length-1]['qty']+'</i></span>'+
                    '<span>Total:<i>'+idrFormat(checkouts[checkouts.length-1]['price']*checkouts[checkouts.length-1]['qty'])+'</i></span>'+
                  '</p>'+
                '</div>'+
              '</div>';
      $('#chart-data').append(dTrow);

      var beforePrice = $('#totalItemPriceField').val();
      var totalPrice=parseInt(beforePrice)+parseInt(plusPrice);

      var totalItem =parseInt($('#totalItemField').val())+1;

      $('#totalItem').html(totalItem);
      $('#totalItemPrice').html(idrFormat(totalPrice));

      $('#totalItemField').val(totalItem);
      $('#totalItemPriceField').val(totalPrice);
     
    }
  });
</script>
@stop