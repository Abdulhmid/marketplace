@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')
<!-- <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100"> -->
<div class="ps-section--features-product ps-section masonry-root">
  <div class="ps-container">
    <div class="ps-section__header mb-50">
      <h3 class="ps-section__title" data-mask="features">- Features Products</h3>
      <ul class="ps-masonry__filter">
        <li class="current"><a href="#" data-filter="*">All <sup>8</sup> </a></li>
          @foreach($category as $value)
            <li>
              <a href="#" data-filter=".ct{{$value->id}}">{{$value->name}} <sup>1</sup></a>
            </li>
          @endforeach
          <!-- <li><a href="#" data-filter=".nike">Nike <sup>1</sup></a></li> -->
      </ul>
    </div>
    <div class="ps-section__content pb-50">
      <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30" data-radio="100%">
        <div class="ps-masonry">
          <div class="grid-sizer"></div>
          <div class="product-listing-data">
            @if(count($products) > 0)
              @foreach($products as $value)
              <div class="grid-item ct{{$value->category->id}}">
                <div class="grid-item__content-wrapper">
                  <div class="ps-shoe mb-30">
                    <div class="ps-shoe__thumbnail">
                      <a class="ps-shoe__favorite" href="{{url('products/detail/'.$value->slug)}}">
                        <i class="ps-icon-heart"></i>
                      </a>
                      <img src="{{$value->image}}" alt="">
                      <a class="ps-shoe__overlay" href="{{url('products/detail/'.$value->slug)}}"></a>
                    </div>
                    <div class="ps-shoe__content">
                      <div class="ps-shoe__variants">
                        <div class="ps-shoe__variant normal">
                          <img src="{{$value->image}}" alt="">
                          <img src="{{$value->image_1}}" alt="">
                          <img src="{{$value->image_2}}" alt="">
                          <img src="{{$value->image_3}}" alt="">
                          <img src="{{$value->image_4}}" alt="">
                        </div>
                        <!-- <select class="ps-rating ps-shoe__rating">
                          <option value="1">1</option>
                          <option value="1">2</option>
                          <option value="1">3</option>
                          <option value="1">4</option>
                          <option value="2">5</option>
                        </select> -->
                      </div>
                      <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">{{$value->name}}</a>
                        <p class="ps-shoe__categories"><a href="#">{{$value->category->name}}</a></p><span class="ps-shoe__price"> {{GlobalHelper::idrFormat($value->total_price)}}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            @else
              <div class="ps-section">
                <p style="text-align: left;margin-left: 23px;">No Product Available</p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div style="text-align: center;">
      {!! $products->links() !!}
    </div>
  </div>
</div>
<div class="ps-section--offer">
  @if(isset($banners))
    @foreach($banners as $value)
      <div class="ps-column">
        <a class="ps-offer" href="product-listing.html">
          <img src="{{$value->image}}" alt="">
        </a>
      </div>
    @endforeach
  @else
    <p>No Banner</p>
  @endif
</div>


<div class="ps-section ps-section--top-sales ps-owl-root pt-80 pb-80">
  <div class="ps-container">
    <div class="ps-section__header mb-50">
      <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
              <h3 class="ps-section__title" data-mask="BEST SALE">- Top Sales</h3>
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
                <div class="ps-badge"><span>New</span></div>
                  <a class="ps-shoe__favorite" href="{{url('#')}}">
                    <i class="ps-icon-heart"></i>
                  </a>
                  <img src="{{$value->image}}" alt="">
                  <a class="ps-shoe__overlay" href="product-detail.html"></a>
              </div>
              <div class="ps-shoe__content">
                <div class="ps-shoe__variants">
                  <div class="ps-shoe__variant normal">
                    <img src="{{$value->image}}" alt="">
                    <img src="{{$value->image_1}}" alt="">
                    <img src="{{$value->image_2}}" alt="">
                    <img src="{{$value->image_3}}" alt="">
                    <img src="{{$value->image_4}}" alt="">
                  </div>
                </div>
                <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{url('#')}}">{{$value->name}}</a>
                  <p class="ps-shoe__categories"><a href="#">{{$value->category->name}}</a></p><span class="ps-shoe__price"> {{$value->price_sell}}</span>
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