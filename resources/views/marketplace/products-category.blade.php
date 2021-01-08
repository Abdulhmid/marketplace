@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')

  <div class="ps-products-wrap pt-80 pb-80">
    <div class="ps-products" data-mh="product-listing">
      @if(count($products) > 0)
      <div class="ps-product-action" style="display: none;">
        <div class="ps-product__filter">
          <select class="ps-select selectpicker">
            <option value="1">Shortby</option>
            <option value="2">Name</option>
            <option value="3">Price (Low to High)</option>
            <option value="3">Price (High to Low)</option>
          </select>
        </div>
        <div class="ps-pagination">
          <!-- {{ $products->links() }} -->
          <!-- <ul class="pagination">
            <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">...</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
          </ul> -->
        </div>
      </div>
      @endif
      <div class="ps-product__columns">
        @if(count($products) > 0)
          @foreach($products as $value)
            <div class="ps-product__column">
              <div class="ps-shoe mb-30">
                <div class="ps-shoe__thumbnail">
                  <div class="ps-badge"><span>New</span></div>
                  <div class="ps-badge ps-badge--sale ps-badge--2nd">
                    <span>-35%</span>
                  </div>
                    <a class="ps-shoe__favorite" href="{{url('products/detail/'.$value->slug)}}">
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
                    <a class="ps-shoe__name" href="#">{{$value->name}}</a>
                    <p class="ps-shoe__categories">
                      <a href="#">{{$value->category->name}}</a>
                    </p>
                      <span class="ps-shoe__price">
                        <del>{{GlobalHelper::idrFormat(GlobalHelper::ratePromo($value->total_price))}}</del> {{GlobalHelper::idrFormat($value->total_price)}}
                      </span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <p style="margin-left: 17px;">Tidak ada product yang tersedia</p>
        @endif
      </div>
    </div>
    <div class="ps-sidebar" data-mh="product-listing">
      <aside class="ps-widget--sidebar ps-widget--category">
        <div class="ps-widget__header">
          <h3>Category</h3>
        </div>
        <div class="ps-widget__content">
          <ul class="ps-list--checked">
            @foreach(GlobalHelper::productCategories() as $value)
              <!-- <li class="current"> -->
              <li data-value="{{$value->id}}" id="catSelect" class="cat-{{$value->id}}">
                <a href="{{url('#')}}">{{$value->name}}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </aside>

      <aside class="ps-widget--sidebar ps-widget--category">
        <div class="ps-widget__header">
          <h3>Produsen</h3>
        </div>
        <div class="ps-widget__content">
          <ul class="ps-list--checked">
            <!-- <li class="current"> -->
            @foreach(GlobalHelper::produsen() as $value)
            <li data-value="{{$value->id}}" id="prodSelect" class="produsen-{{$value->id}}" >
              <a href="{{url('#')}}">{{$value->name}}</a>
            </li>
            @endforeach
          </ul>
        </div>
      </aside>
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

        if ("filterCatProductByCat" in localStorage) {
          var filterCatProductByCat = JSON.parse(localStorage.getItem("filterCatProductByCat"));  
        }else{
          var filterCatProductByCat = JSON.parse("[]");
        }

        $.each(filterCatProductByCat , function(index, val) { 
          $('.cat-'+val).addClass('current');
        });

        if ("filterProdusenProductByCat" in localStorage) {
          var filterProdusenProductByCat = JSON.parse(localStorage.getItem("filterProdusenProductByCat"));  
        }else{
          var filterProdusenProductByCat = JSON.parse("[]");
        }

        $.each(filterProdusenProductByCat , function(index, val) { 
          $('.produsen-'+val).addClass('current');
        });

        $( document ).on( "click", "#catSelect", function( e ) {
          if ($(this).hasClass('current')) {
            filterCatProductByCat.splice( $.inArray($(this).attr("data-value"), filterCatProductByCat), 1 );
            localStorage.setItem("filterCatProductByCat", JSON.stringify(filterCatProductByCat));
          }else{
            filterCatProductByCat.push($(this).attr("data-value"));
            localStorage.setItem("filterCatProductByCat", JSON.stringify(filterCatProductByCat));
          }
          var segment2="{{Request::segment(2)}}";
          window.location.href = "/products/"+segment2+"?category="+filterCatProductByCat+"&produsen="+filterProdusenProductByCat;
        });

        $( document ).on( "click", "#prodSelect", function( e ) {
          if ($(this).hasClass('current')) {
            filterProdusenProductByCat.splice( $.inArray($(this).attr("data-value"), filterProdusenProductByCat), 1 );
            localStorage.setItem("filterProdusenProductByCat", JSON.stringify(filterProdusenProductByCat));
          }else{
            filterProdusenProductByCat.push($(this).attr("data-value"));
            localStorage.setItem("filterProdusenProductByCat", JSON.stringify(filterProdusenProductByCat));
          }
          var segment2="{{Request::segment(2)}}";
          window.location.href = "/products/"+segment2+"?category="+filterCatProductByCat+"&produsen="+filterProdusenProductByCat;
        });

      });
</script>
@stop