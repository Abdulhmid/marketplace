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
                <input class="form-control" type="text"/>
            </div>
            <div class="col-md-6">
                <label>Phone</label>
                <input class="form-control" type="text"/>
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
              <label>Address<span>*</span>
              </label>
              <textarea class="form-control" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
            </div>
          </div>
      </div>
      <div class="clearfix"></div>
      <div class="ps-cart-listing">
        <h3>Produk Dipesan</h3>
        <hr>
        <table class="table ps-cart__table">
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
            <tr>
              <td><a class="ps-product__preview" href="product-detail.html"><img class="mr-15" src="images/product/cart-preview/1.jpg" alt=""> air jordan One mid</a></td>
              <td>$150</td>
              <td>
                <div class="form-group--number">
                  <button class="minus"><span>-</span></button>
                  <input class="form-control" type="text" value="2">
                  <button class="plus"><span>+</span></button>
                </div>
              </td>
              <td>$300</td>
              <td>
                <div class="ps-remove"></div>
              </td>
            </tr>
            <tr>
              <td><a class="ps-product__preview" href="product-detail.html"><img class="mr-15" src="images/product/cart-preview/2.jpg" alt=""> The Crusty Croissant</a></td>
              <td>$150</td>
              <td>
                <div class="form-group--number">
                  <button class="minus"><span>-</span></button>
                  <input class="form-control" type="text" value="2">
                  <button class="plus"><span>+</span></button>
                </div>
              </td>
              <td>$300</td>
              <td>
                <div class="ps-remove"></div>
              </td>
            </tr>
            <tr>
              <td><a class="ps-product__preview" href="product-detail.html"><img class="mr-15" src="images/product/cart-preview/3.jpg" alt="">The Rolling Pin</a></td>
              <td>$150</td>
              <td>
                <div class="form-group--number">
                  <button class="minus"><span>-</span></button>
                  <input class="form-control" type="text" value="2">
                  <button class="plus"><span>+</span></button>
                </div>
              </td>
              <td>$300</td>
              <td>
                <div class="ps-remove"></div>
              </td>
            </tr>
          </tbody>
        </table>
        <div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Pesan<span>*</span>
              </label>
              <textarea class="form-control" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="ps-cart__total">
              <h4>Biaya Ongkir 
                <span style="float: right;"> Rp 10.000</span>
              </h4>
              <h4>Nominal Unik Transaksi  
                <span style="float: right;"> Rp 5.722</span>
              </h4>
              <h4>Price 
                <span style="float: right;"> Rp 15.000</span>
              </h4>
              <div class="clearfix"></div>
              <h3>Total Price : 
                <span style="float: right;"> Rp. 30.722</span>
              </h3>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="ps-cart__actions">
          <div class="ps-cart__promotion">
            <div class="form-group">
              <button class="ps-btn ps-btn--green">Buy</button>
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

  });
</script>
@stop