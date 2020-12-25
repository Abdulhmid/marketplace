@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')

<div class="ps-content pt-80 pb-80">
  <div class="ps-container">
    @if(!isset(Auth::user()->role_id))
    <div class="col-md-12" style="">
        <center>
        <a href="/gologin" class="btn btn-default">Silahkan Login</a>
        </center>
      <hr>
    </div>
    @endif
    <div class="col-md-12">
      <div id="Bill">
          <h3>Alamat Pengiriman</h3>
          <hr>
          <div class="form-group">
            <div class="col-md-12">
                <label>Nama</label>
                <input class="form-control" name="name" id="name" type="text" value="{{AuthHelper::sessionData('name')}}" />
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input class="form-control" name="email" id="email" type="text" value="{{AuthHelper::sessionData('email')}}" />
            </div>
            <div class="col-md-6">
                <label>Phone</label>
                <input class="form-control" name="phone" id="phone" type="text" value="{{AuthHelper::sessionData('phone')}}" />
            </div>

            <div class="col-md-6">
                <label>Pilih Lokasi</label>
                <select class="form-control" required="" id="location" name="location">
                  <option value="">-- Pilih Lokasi --</option>
                  @foreach(RajaOngkir::cities() as $value)
                    <option value="{{ $value->city_id }}-{{ $value->province_id }}"
                      {{AuthHelper::sessionData('city_id') == $value->city_id  ? 'selected' : ''}}>
                      {{ $value->city_name }} - {{$value->province}}
                    </option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-6">
              <label>Cara Pembayaran<span>*</span></label>
              <select class="form-control" id="payment" name="payment">
                  @foreach(GlobalHelper::payments() as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                  @endforeach                  
              </select>
            </div>

            <div style="display: none;">
            <div class="col-md-3">
                <label>Provinsi</label>
                <select class="form-control" id="province">
                  <option value="">-- No Seleceted Province --</option>
                  @foreach(GlobalHelper::province() as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                  @endforeach                  
                </select>
            </div>
            <div class="col-md-3">
                <label>Kota</label>
                <select class="form-control" id="cities">
                  <option value="-">-</option>                  
                </select>
            </div>
            <div class="col-md-3">
                <label>Kecamatan</label>
                <select class="form-control" id="districts">
                  <option value="-">-</option>                  
                </select>
            </div>
            <div class="col-md-3">
                <label>Kelurahan</label>
                <select class="form-control" id="villages">
                  <option value="-">-</option>                  
                </select>
            </div>
            </div>

            <div class="col-md-12">
              <label>Address<span>*</span>
              </label>
              <textarea class="form-control" id="address" rows="5" placeholder="Notes about your order, e.g. special notes for delivery.">{{AuthHelper::sessionData('address')}}</textarea>
            </div>
          </div>
          <div class="clearfix"></div>
          <h3>Pilih Ekspedisi</h3>
          <hr>
          <div class="form-group">
            <div class="col-md-4">
                <label>Pilih Ekspedisi<span>*</span></label>
                <select class="form-control" id="courier" name="courier">
                    <option value="">-- Pilih Ekspedisi --</option>
                    @foreach(GlobalHelper::ekspedisi() as $value)
                      <option value="{{$value->label}}">{{$value->name}}</option>
                    @endforeach                  
                </select>
            </div>
            <div class="col-md-4">
                <label>Weight<span>(Gram)</span></label>
                <input type="number" min="0" id="weight" name="weight" class="form-control"  readonly>
            </div>
            <div class="col-md-4">
                <label>Pilih Service<span id="search-service">*</span></label>
                <select class="form-control" id="courier_service" name="courier_service">
                    <option value="">-- Pilih Service --</option>                  
                </select>
            </div>
          </div>
      </div>
      <div class="clearfix"></div>
      <div class="ps-cart-listing">
        <h3>Produk Dipesan</h3>
        <hr>
        <table class="table ps-cart__table" id="table-buy">
          <thead>
            <tr>
              <th>Products</th>
              <input type="hidden" id="locationProduct" value="">
              <th>Price</th>
              <th>Quantity</th>
              <th>Berat (Gram)</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        <div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Pesan<span>*</span>
              </label>
              <textarea class="form-control" rows="5" id="notes" placeholder="Notes about your order, e.g. special notes for delivery." id="note"></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="ps-cart__total">
              <h4>Biaya Ongkir 
                <span style="float: right;" id="ongkir"> - </span>
                <input type="hidden" name="shipping_fee" id="shipping_fee" value="">
              </h4>
              <h4>Nominal Unik Transaksi  
                <span style="float: right;" id="uniqeTrans"> - </span>
                <input type="hidden" name="unique_fee" id="unique_fee" value="{{$uniqueTrans}}">
              </h4>
              <h4>Price 
                <span style="float: right;" id="itemPrice"> - </span>
              </h4>
              <div class="clearfix"></div>
              <h3>Total Price : 
                <span style="float: right;" id="totalPrice"> - </span>
                <input type="hidden" id="totalPriceSend" value="">
              </h3>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="ps-cart__actions">
          <div class="ps-cart__promotion">
            <div class="form-group">
              <button class="ps-btn ps-btn--green" id="buy-action">Bayar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="clearfix"></div> -->
    </div>
    <div class="col-md-6">
      <div class="ps-checkout__billing">

      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>

@stop
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    height: 47px;
}
</style>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#location').select2();
    // First Load
    if ("itemBuy" in localStorage) {
      var checkoutsData = JSON.parse(localStorage.getItem("itemBuy"));
    }else{
      var checkoutsData = JSON.parse("[]");
    }
    if (checkoutsData.length > 0) {
      var locationArray =[];
      var dTrow ='';
      var totalPrice = 0;
      var totalWeight = 0;
      var i = 0;
      $.each(checkoutsData, function(k, v) {
        totalPrice+=v.price*v.qty;
        totalWeight+=v.weight*v.qty;
          dTrow = '<tr>'+
                    '<td>'+
                      '<a class="ps-product__preview" href="#">'+
                        '<img class="mr-15" width="40px" height="40px" src="'+v.image+'" alt="">'+ 
                          v.nameProduct+
                      '</a>'+
                    '</td>'+
                    '<td>'+idrFormat(v.price)+'</td>'+
                    '<td>'+
                      v.qty+
                    '</td>'+
                    '<td>'+v.weight*v.qty+'</td>'+
                    '<td>'+idrFormat(v.price*v.qty)+'</td>'+
                  '</tr>';
          $("#table-buy tbody").append(dTrow);
          locationArray.push(v.productLocation);
          i++;

      });  
      totalPriceNew = parseInt(totalPrice) + parseInt("{{$uniqueTrans}}");

      $('#totalPrice').html(idrFormat(totalPriceNew));
      $('#totalPriceSend').val(totalPriceNew);
      $('#locationProduct').val(locationArray);
      $('#weight').val(totalWeight);
      $('#itemPrice').html(idrFormat(totalPrice));
      $('#uniqeTrans').html("{{$uniqueTrans}}");
      $('#ongkir').html(idrFormat(0));
    }else{
      $("#table-buy tbody").append('<tr><td colspan="5"></td></tr>');
    }

    $('#buy-action').click(function(){
      $.ajax({
        url: '{{url("api/v1/data/buy")}}',
        type: 'POST',
        data: {
          _token: "{{ csrf_token() }}", 
          dataProduct : checkoutsData,
          customerId : 0,
          name : $('#name').val(),
          email : $('#email').val(),
          weight : $('#weight').val(),
          courier : $('#courier').val(),
          courier_service : $('#courier_service').val(),
          shipping_fee : $('#shipping_fee').val(),
          unique_fee : $('#unique_fee').val(),
          phone : $('#phone').val(),
          location : $('#location').val(),
          city : $('#city').val(),
          district : $('#district').val(),
          villages : $('#villages').val(),
          address : $('#address').val(),
          notes : $('#notes').val(),
          payment : $('#payment').val(),
          totalPrice : $('#totalPriceSend').val()
        },
        success: function (data){
            localStorage.removeItem('itemBuy');
            var buyFromCheck = localStorage.getItem("buyFromCheckout");
            if (buyFromCheck=="true") {
              localStorage.removeItem('checkouts');
            }
            window.location.href = "/products/transactions/success/"+data.data;
        },
        error: function (xhr, textStatus, errorThrown) {
          console.log("XHR",xhr);
          console.log("status",textStatus);
          console.log("Error in",errorThrown);
        }
      });
    }); 

    $("select#courier").change(function () {
      $.get("{!! url('/api/v1/data/cek-ongkir') !!}", {
              courier : $("select#courier").val(),
              origin : $("#locationProduct").val(),
              destination : $("select#location").val().split("-")[0],
              weight : $('#weight').val()
          },
          function (data) {
              $("select#courier_service").empty();
              $("select#courier_service").append($("<option value=''></option>")
                .attr("value", "")
                .text("- Pilih Service -"));

              $.each(data, function (key, value) {
                  console.log(value);
                  $.each(value, function (key2, value2) {
                    var valueStore = value2.cost[0].value+"|"+value2.description+"-"+value2.cost[0].etd+" hari";
                    $('select#courier_service')
                            .append($("<option></option>")
                                    .attr("value", valueStore)
                                    .text(value2.description+"-"+value2.cost[0].etd+" hari "+'( '+idrFormat(value2.cost[0].value)+' )'));
                  });
              });
          });
    });
    $("select#courier_service").change(function () {
      var ongkir = $("select#courier_service").val().split("|")[0];
      var totalPrice = parseInt(ongkir)+parseInt($('#totalPriceSend').val());
      $('#ongkir').html(idrFormat(ongkir));
      $('#totalPrice').html(idrFormat(totalPrice));
      $('#totalPriceSend').val(totalPrice);
    });

    // Province
    $("select#province").change(function () {
        $.get("{!! url('/api/v1/data/data-general') !!}", {
                province : $("select#province").val(),
                type : 'cities'
            },
            function (data) {
                $("select#cities").empty();
                $("select#cities").append($("<option value=''></option>")
                  .attr("value", "")
                  .text("Loading..."));

                $.each(data.data, function (key, value) {
                    $('select#cities')
                            .append($("<option></option>")
                                    .attr("value", value.id)
                                    .text(value.name));
                });
                $("select#cities").prepend($("<option value=''></option>")
                  .attr("value", "")
                  .text("-- Pilih Service --"));
            });
    });

    // Districts
    $("select#cities").change(function () {
        $.get("{!! url('/api/v1/data/data-general') !!}", {
                cities : $("select#cities").val(),
                type : 'districts'
            },
            function (data) {
                $("select#districts").empty();
                $("select#districts").append($("<option value=''></option>")
                  .attr("value", "")
                  .text("- Pilih Districts"));

                $.each(data.data, function (key, value) {
                    $('select#districts')
                            .append($("<option></option>")
                                    .attr("value", value.id)
                                    .text(value.name));
                });
            });
    })

    // Villages
    $("select#districts").change(function () {
        $.get("{!! url('/api/v1/data/data-general') !!}", {
                district: $("select#districts").val(),
                type: 'villages'
            },
            function (data) {
                $("select#villages").empty();
                $("select#villages").append($("<option value=''></option>")
                  .attr("value", "")
                  .text("- Pilih Villages"));

                $.each(data.data, function (key, value) {
                    $('select#villages')
                            .append($("<option></option>")
                                    .attr("value", value.id)
                                    .text(value.name));
                });
            });
    })

    function idrFormat(args) {
        "use strict";
        var total = (args/1000).toFixed(3);
        return total;
    }

  });
</script>
@stop