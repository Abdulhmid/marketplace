<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7"><![endif]-->
<!--[if IE 8]><html class="ie ie8"><![endif]-->
<!--[if IE 9]><html class="ie ie9"><![endif]-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://img.icons8.com/material/2x/maxcdn.png" rel="icon">
    <meta name="author" content="Nghia Minh Luong">
    <meta name="keywords" content="Default Description">
    <meta name="description" content="Default keyword">
    <title>Pomm Tijari</title>
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/ps-icon/style.css">
    <!-- CSS Library-->
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/Magnific-Popup/dist/magnific-popup.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/revolution/css/settings.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/revolution/css/layers.css">
    <link rel="stylesheet" href="{{url('marketplace')}}/plugins/revolution/css/navigation.css">
    <!-- Custom-->
    <link rel="stylesheet" href="{{url('marketplace')}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{url('css/toastr/jquery.toast.css')}}">
    <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->

    @yield('css')
  </head>
  <!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
  <!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
  <!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
  <body class="ps-loading">
    <div class="header--sidebar"></div>
    <input type="hidden" id="ip-address" value="">
    <header class="header">
      <div class="header__top">
        <div class="container-fluid">
          <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                  <p>Jl. Mangkubumi Yogyakarta -  Hotline: 804-377-3580 - 804-399-3580</p>
                </div>
                <!-- <div class="col-lg-3 ">
                  <div class="header__actions" style="float: left;">
                    <a href="#">Tracking</a>
                  </div>
                </div> -->
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                  <div class="header__actions">
                    <div class="btn-group ps-dropdown">
                      <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tracking
                        <i class="fa fa-angle-down"></i>
                      </a>
                      <ul class="dropdown-menu" style="height: 115px;width: 236px;padding: 6px;">
                        <div class="row">
                          <div class="form-group">
                            <div class="col-md-12">
                              <input type="text" class="form-control" id="tracking_code" placeholder="Tulis Kode Transaksi" name="">
                            </div>
                            <div class="clearfix"></div>
                            <br/>
                            <div class="col-md-12">
                              <div class="col text-center">
                                <button class="btn btn-primary" id="actionTrack">Tracking</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </ul>
                    </div>
                    @if(isset(Auth::user()->role_id))
                      @if(GlobalHelper::session(Auth::user()->role_id)=="customers")
                        <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}<i class="fa fa-angle-down"></i></a>
                          <ul class="dropdown-menu">
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a></li>
                          </ul>
                        </div>
                        <form id="logout-form" action="/logout" 
                            method="POST" style="display: none;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </form>
                      @else
                        <a href="{{url('/gologin')}}">Login & Regiser</a>
                      @endif
                    @else
                      <a href="{{url('/gologin')}}">Login & Regiser</a>
                    @endif
                  </div>
                </div>
          </div>
        </div>
      </div>
      <nav class="navigation">
        <div class="container-fluid">
          <div class="navigation__column left">
            <div class="header__logo">
              <a class="ps-logo" href="{{url('/')}}">
                <!-- <img src="{{url('marketplace')}}/images/logo.png" alt=""> -->
                <img src="{{url('/')}}/public/imagesGeneral/logo.png" alt="">
              </a>
            </div>
          </div>
          <div class="navigation__column center">
                <ul class="main-menu menu">
                  @foreach(GlobalHelper::productType() as $value)
                    <li class="menu-item">
                      <a href="{{url('products/'.$value->slug)}}">{{$value->name}}</a>
                    </li>
                  @endforeach
                </ul>
          </div>
          <div class="navigation__column right">
            <form class="ps-search--header" action="do_action" method="post">
              <input class="form-control" type="text" placeholder="Search Product…">
              <button><i class="ps-icon-search"></i></button>
            </form>
            @include('marketplace.partials.checkouts')
            <div class="menu-toggle"><span></span></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="header-services"">
      <div class="ps-services owl-slider" id="slideShowAdd" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1"  data-owl-duration="1000" data-owl-mousedrag="on">
        @foreach(GlobalHelper::sliders() as $value)
          <p class="ps-service">
            <strong>{{$value->name}}</strong>
          </p>
        @endforeach
      </div>
    </div>
    <main class="ps-main">

      @yield('content')

      <div class="ps-footer bg--cover" data-background="{{url('marketplace')}}/images/background/parallax.jpg">
        <div class="ps-footer__content">
          <div class="ps-container">
            <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--info">
                      <header>
                        <a class="ps-logo" href="index.html">
                          <img src="{{url('/')}}/public/imagesGeneral/logo.png" alt="">
                        </a>
                        <h3 class="ps-widget__title">Address Office 1</h3>
                      </header>
                      <footer>
                        {!!GlobalHelper::config('address_bottom')!!}
                      </footer>
                    </aside>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                      <header>
                        <h3 class="ps-widget__title">Get Help</h3>
                      </header>
                      <footer>
                        <ul class="ps-list--line">
                          @foreach(GlobalHelper::listMenu('bottom') as $value)
                            <li>
                              <a href="{{$value->url}}">{{$value->name}}</a>
                            </li>
                          @endforeach
                        </ul>
                      </footer>
                    </aside>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                      <header>
                        <h3 class="ps-widget__title">Products</h3>
                      </header>
                      <footer>
                        <ul class="ps-list--line">
                          @foreach(GlobalHelper::listMenu('top') as $value)
                            <li>
                              <a href="{{$value->url}}">{{$value->name}}</a>
                            </li>
                          @endforeach
                        </ul>
                      </footer>
                    </aside>
                  </div>
            </div>
          </div>
        </div>
        <div class="ps-footer__copyright">
          <div class="ps-container">
            <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <p>&copy; 
                      <a href="#" style="display: none;">POM M TIJARI</a> All rights Resevered.
                      <a href="#" style="display: none;"> Alena Studio
                      </a>
                    </p>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <ul class="ps-social">
                      <li>
                        <a href="{{GlobalHelper::config('fb')}}"><i class="fa fa-facebook"></i></a>
                      </li>
                      <li>
                        <a href="{{GlobalHelper::config('google')}}"><i class="fa fa-google-plus"></i></a>
                      </li>
                      <li>
                        <a href="{{GlobalHelper::config('tw')}}"><i class="fa fa-twitter"></i></a>
                      </li>
                      <li>
                        <a href="{{GlobalHelper::config('ig')}}"><i class="fa fa-instagram"></i></a>
                      </li>
                    </ul>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- JS Library-->
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/gmap3.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/imagesloaded.pkgd.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/slick/slick/slick.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/elevatezoom/jquery.elevatezoom.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript" src="{{url('marketplace')}}/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <!-- Custom scripts-->
    <script type="text/javascript" src="{{url('marketplace')}}/js/main.js"></script>
    <script type="text/javascript" src="{{url('js/toastr/jquery.toast.js')}}"></script>
    <script type="text/javascript">
    </script>


    <script type="text/javascript">
    $(document).ready(function(){
      // localStorage.clear();
      // localStorage.removeItem(key);
      @if(Session::has('message'))
          $.toast({ 
            text : "{!! Session::get('message') !!}", 
            showHideTransition : 'slide',  // It can be plain, fade or slide
            bgColor : 'green',              // Background color for toast
            textColor : 'white',            // text color
            allowToastClose : false,       // Show the close button or not
            hideAfter : 5000,
            textAlign : 'left',          
            position : 'top-right'       
          })
      @endif
      
      if ("checkouts" in localStorage) {
        var checkoutsData = JSON.parse(localStorage.getItem("checkouts"));
      }else{
        var checkoutsData = JSON.parse("[]");
      }
    
      $('#total-checkout').html(
        checkoutsData.length
      );

      updateCheckout(checkoutsData);

      $.getJSON("http://jsonip.com?callback=?", function (data) {
        $('#ip-address').val(data.ip);
      });

      function idrFormat(args) {
          "use strict";
          var total = (args/1000).toFixed(3);
          return total;
      }

      function updateCheckout(checkoutsData){
        "use strict";
        if (checkoutsData.length > 0) {
          var dTrow ='';
          var totalPrice = 0;
          var i = 0;
          $.each(checkoutsData, function(k, v) {
            totalPrice+=v.price*v.qty;
            dTrow ='<div class="ps-cart-item" id="ps-cart-item-id-'+i+'">'+
                      '<a class="ps-cart-item__close" data-value="'+i+'" data-currentprice="'+v.price*v.qty+'" href="#removeChart"></a>'+
                      '<div class="ps-cart-item__thumbnail">'+
                          '<a href="#"></a>'+
                          '<img src="'+v.image+'" alt="">'+
                      '</div>'+
                      '<div class="ps-cart-item__content">'+
                        '<a class="ps-cart-item__title" href="product-detail.html">'+
                          v.nameProduct+
                        '</a>'+
                        '<p>'+
                          '<span>Quantity:<i>'+v.qty+'</i></span>'+
                          '<span>Total:<i>'+idrFormat(v.price*v.qty)+'</i></span>'+
                        '</p>'+
                      '</div>'+
                    '</div>';
              $('#chart-data').append(dTrow);
              i++;
          });  
          $('#totalItem').html(checkoutsData.length);
          $('#totalItemField').val(checkoutsData.length);
          $('#totalItemPrice').html(idrFormat(totalPrice));
          $('#totalItemPriceField').val(totalPrice);
        }
      }

      // Function Delete 
      $( document ).on( "click", "a[href='#removeChart']", function( e ) {

        var index = $(this).data("value");
        var price = $(this).data("currentprice");

        $(this).closest(".ps-cart-item").remove();
        $('#ps-cart-item-id-'+index).remove();

        const checkoutsData = JSON.parse(localStorage.getItem("checkouts"));

        checkoutsData.splice(index, 1);
        var localDt = localStorage.setItem("checkouts", JSON.stringify(checkoutsData));

        var beforePrice = $('#totalItemPriceField').val();
        var newPrice = parseInt(beforePrice)-parseInt(price);

        console.log(checkoutsData);
        console.log(JSON.parse(localStorage.getItem("checkouts")).length);
        $('#total-checkout').html(JSON.parse(localStorage.getItem("checkouts")).length);
        $('#totalItem').html(JSON.parse(localStorage.getItem("checkouts")).length);
        $('#totalItemField').val(JSON.parse(localStorage.getItem("checkouts")).length);
        $('#totalItemPrice').html(idrFormat(newPrice));
        $('#totalItemPriceField').val(newPrice);

      });

      // Buy from Checkout
      $('a[href="#checkoutProses"]').click(function(){
        if ("checkouts" in localStorage) {
          var checkoutsData = JSON.parse(localStorage.getItem("checkouts"));
        }else{
          var checkoutsData = JSON.parse("[]");
        }
        if (checkoutsData.length > 0) {
          var itemBuy = JSON.parse(localStorage.getItem("checkouts"));  
          localStorage.setItem('buyFromCheckout','true');
          localStorage.setItem("itemBuy", JSON.stringify(itemBuy));
          window.location.href = "/products/data/transactions";
        }else{
          var itemBuy = JSON.parse("[]");
        }
      }); 

      // Buy from Checkout
      $('#actionTrack').click(function(){
        var transCode = $('#tracking_code').val();
        window.location.href = "/products/transactions/success/"+transCode;
      });


    });
    </script>
    @yield('js')

  </body>
</html>