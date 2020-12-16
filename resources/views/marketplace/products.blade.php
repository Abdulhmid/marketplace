@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')

  <div class="ps-products-wrap pt-80 pb-80">
    <div class="ps-products" data-mh="product-listing">
      @if(count($products) > 0)
      <div class="ps-product-action">
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
                      <img src="{{url($value->image_1)}}" alt="">
                      <img src="{{url($value->image_2)}}" alt="">
                      <img src="{{url($value->image_3)}}" alt="">
                      <img src="{{url($value->image_4)}}" alt="">
                    </div>
                  </div>
                  <div class="ps-shoe__detail">
                    <a class="ps-shoe__name" href="#">{{$value->name}}</a>
                    <p class="ps-shoe__categories">
                      <a href="#">{{$value->category->name}}</a>
                    </p>
                      <span class="ps-shoe__price">
                        <del>{{GlobalHelper::ratePromo($value->total_price)}}</del> {{$value->total_price}}
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
              <li>
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
            <li>
              <a href="{{url('')}}">{{$value->name}}</a>
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
        $.ajax({
           type: "GET",
           url:"{{ url('api/v1/data/products') }}",
           cache: false,
           contentType: false,
           processData: false,
           success: function (data) {
              var dS ='';
              var loopPos = 0;
              $.each(data.data, function(k, v) {
                  if (loopPos==4) {
                    loopPos = 0;
                  }
                  if (loopPos==0) {
                    margin = "0px";
                  }else if(loopPos==1){
                    margin = "360px";
                  }else if(loopPos==2){
                    margin = "720px";
                  }else if(loopPos==3){
                    margin = "1080px";
                  }
                  var left = "left:"+margin; 
                  loopPos++;
                  dS +='<div class="grid-item kids">'+
                          '<div class="grid-item__content-wrapper">'+
                            '<div class="ps-shoe mb-30">'+
                              '<div class="ps-shoe__thumbnail">'+
                              '<a class="ps-shoe__favorite" href="#">'+
                                '<i class="ps-icon-heart"></i>'+
                              '</a>'+
                                '<img src="{{url("marketplace")}}/images/shoe/8.jpg" alt="">'+
                                '<a class="ps-shoe__overlay" href="product-detail.html"></a>'+
                              '</div>'+
                              '<div class="ps-shoe__content">'+
                                '<div class="ps-shoe__variants">'+
                                  '<div class="ps-shoe__variant normal">'+
                                  '<img src="{{url("marketplace")}}/images/shoe/2.jpg" alt="">'+
                                  '<img src="{{url("marketplace")}}/images/shoe/3.jpg" alt="">'+
                                  '<img src="{{url("marketplace")}}/images/shoe/4.jpg" alt="">'+
                                  '<img src="{{url("marketplace")}}/images/shoe/5.jpg" alt="">'+
                                  '</div>'+
                                  '<select class="ps-rating ps-shoe__rating">'+
                                    '<option value="1">1</option>'+
                                    '<option value="1">2</option>'+
                                    '<option value="1">3</option>'+
                                    '<option value="1">4</option>'+
                                    '<option value="2">5</option>'+
                                  '</select>'+
                                '</div>'+
                                '<div class="ps-shoe__detail">'+
                                  '<a class="ps-shoe__name" href="#">'+v.name+'</a>'+
                                  '<p class="ps-shoe__categories">'+
                                    '<a href="#">Men shoes</a>,'+
                                    '<a href="#"> Nike</a>,'+
                                    '<a href="#"> Jordan</a>'+
                                  '</p>'+
                                  '<span class="ps-shoe__price"> £ 120</span>'+
                                '</div>'+
                              '</div>'+
                            '</div>'+
                          '</div>'+
                        '</div>';
              });
              // var dS2 = '</div>';
              // $('.product-listing-data').html(dS);
           },
           error: function (xhr, textStatus, errorThrown) {
             console.log("XHR",xhr);
             console.log("status",textStatus);
             console.log("Error in",errorThrown);
           }
        });
      });
</script>
@stop