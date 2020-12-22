@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')

<div class="ps-content pt-80 pb-80">
  <div class="ps-container">
    <div class="col-md-12">
      <div id="Bill">
          <h3>Alamat Pengiriman</h3>
          <hr>
          <div class="form-group">
            <div class="col-md-6">
                <label>Email</label>
                <input class="form-control" name="email" id="email" type="text"/>
            </div>
            <div class="col-md-6">
                <label>Phone</label>
                <input class="form-control" name="phone" id="phone" type="text"/>
            </div>
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
            <div class="col-md-12">
              <label>Cara Pembayaran<span>*</span></label>
              <select class="form-control" id="payment" name="payment">
                  @foreach(GlobalHelper::payments() as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                  @endforeach                  
              </select>
            </div>
            <div class="col-md-12">
              <label>Address<span>*</span>
              </label>
              <textarea class="form-control" id="address" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
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
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
              <th></th>
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
              </h4>
              <h4>Nominal Unik Transaksi  
                <span style="float: right;" id="uniqeTrans"> - </span>
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

<style type="text/css">

</style>

@stop

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    // First Load
    if ("itemBuy" in localStorage) {
      var checkoutsData = JSON.parse(localStorage.getItem("itemBuy"));
    }else{
      var checkoutsData = JSON.parse("[]");
    }
    if (checkoutsData.length > 0) {
      var dTrow ='';
      var totalPrice = 0;
      var i = 0;
      $.each(checkoutsData, function(k, v) {
        totalPrice+=v.price*v.qty;
          dTrow = '<tr>'+
                    '<td>'+
                      '<a class="ps-product__preview" href="#">'+
                        '<img class="mr-15" width="40px" height="40px" src="'+v.image+'" alt="">'+ 
                          v.nameProduct+
                      '</a>'+
                    '</td>'+
                    '<td>'+idrFormat(v.price)+'</td>'+
                    '<td>'+
                      '<div class="form-group--number">'+
                        '<button class="minus"><span>-</span></button>'+
                        '<input class="form-control" type="text" value="'+v.qty+'">'+
                        '<button class="plus"><span>+</span></button>'+
                      '</div>'+
                    '</td>'+
                    '<td>'+idrFormat(v.price*v.qty)+'</td>'+
                    '<td>'+
                      '<div class="ps-remove"></div>'+
                    '</td>'+
                  '</tr>';
          $("#table-buy tbody").append(dTrow);
          i++;
      });  
      $('#totalPrice').html(idrFormat(totalPrice));
      $('#totalPriceSend').val(totalPrice);
      $('#itemPrice').html(idrFormat(totalPrice));
      $('#uniqeTrans').html(idrFormat(0));
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
          email : $('#email').val(),
          phone : $('#phone').val(),
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
                  .text("- Pilih Cities"));

                $.each(data.data, function (key, value) {
                    $('select#cities')
                            .append($("<option></option>")
                                    .attr("value", value.id)
                                    .text(value.name));
                });
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