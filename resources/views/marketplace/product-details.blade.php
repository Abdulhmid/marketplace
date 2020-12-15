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
          <div class="ps-product__preview">
            <div class="ps-product__variants">
              <div class="item">
                <img src="{{url($product->image)}}" alt=""></div>
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
          <p class="ps-product__category"><a href="#"> {{$product->category->name}}</a></p>
          <h3 class="ps-product__price">{{$product->price_sell}} <del>{{($product->price_sell)+5000}}</del></h3>
          <div class="ps-product__block ps-product__quickview">
            <h4>QUICK REVIEW</h4>
            <p>{{$product->description}}</p>
          </div>
          <div class="ps-product__block ps-product__size">
            <h4>CHOOSE VARIAN</h4>
            <select class="ps-select selectpicker">
              @foreach($product->variant as $vvarian)
                <option value="{{$vvarian->id}}">{{$vvarian->name}}</option>
              @endforeach
            </select>
            <div class="form-group">
              <input class="form-control" type="number" value="1">
            </div>
          </div>
          <div class="ps-product__shopping"><a class="ps-btn mb-10" href="cart.html">Add to cart<i class="ps-icon-next"></i></a>
            <div class="ps-product__actions"><a class="mr-10" href="whishlist.html"><i class="ps-icon-heart"></i></a><a href="#"><i class="ps-icon-share"></i></a></div>
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
        @foreach($products_top as $value)
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
                  <a class="ps-shoe__overlay" href="{url('product/detail/'.$value->slug)}}"></a>
              </div>
              <div class="ps-shoe__content">
                <div class="ps-shoe__variants">
                  <div class="ps-shoe__variant normal">
                    <img src="{{url($value->image_1)}}" alt="">
                    <img src="{{url($value->image_2)}}" alt="">
                    <img src="{{url($value->image_3)}}" alt="">
                    <img src="{{url($value->image_4)}}" alt="">
                  </div>
                </div>
                <div class="ps-shoe__detail">
                  <a class="ps-shoe__name" href="{{url('product/detail/'.$value->slug)}}">{{$value->name}}</a>
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
      });
</script>
@stop