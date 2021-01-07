@extends('layouts.dash-new')

@section('title', 'Transactions Detail')

@section('content_header')
<h1>Data Transaction</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <div class="card-header">
                    <!-- <h5>Roles List</h5> -->
                    <span></span>
                    <div class="card-header-right">
                        <a href="{{url('transactions')}}" class="btn btn-default btn-round"><i class="icofont icofont-ui-add" style="color: #fff;"></i> Back</a>
                        <a href="{{url('transactions/'.$row->id)}}" class="btn btn-warning btn-round"><i class="icofont icofont-ui-add" style="color: #fff;"></i> Edit</a>
                    </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-6" style="border-bottom: 2px solid rgba(0,0,0,.125);">
                        <div class="box box-info">
                        <!-- <div class="box-header">
                          <h3 class="box-title">Color &amp; Time Picker</h3>
                        </div> -->
                          <div class="box-body">
                            <div class="form-group">
                              <label>Kode Transaksi:</label>
                              <input type="hidden" name="" id="transCode" value="{{$row->transaction_code}}">
                              <h5>{{$row->transaction_code}} - 
                                <span class="label label-primary" style="isplay: inline;padding: .2em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;background-color: #f0ad4e;">
                                  {{GlobalHelper::wordingStatusTransaksi($row->status)}}
                                </span>
                              </h5>
                            </div>
                            <div class="form-group">
                              <label>Tipe Pembayaran:</label>
                              <h5>{{GlobalHelper::paymentName($row->payment_id)}}</h5>
                            </div>
                            <div class="bootstrap-timepicker">
                              <div class="form-group">
                                <label>Alamat Tujuan:</label>
                                <h5> {{empty($row->address)?'-':$row->address}} </h5>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="border-bottom: 2px solid rgba(0,0,0,.125);">
                        <div class="box box-info">
                          <!-- <div class="box-header">
                            <h3 class="box-title">Color &amp; Time Picker</h3>
                          </div> -->
                          <div class="box-body">
                            <div class="form-group">
                              <label>Action:</label>
                                  <p>
                                    @if($row->status!=0 and $row->status!=7 and $row->status!=10)
                                      @if(GlobalHelper::session()=='admin')
                                        @if($row->status==6)
                                          <a href="#actionStatus" data-id="9" id="actionStatus" class="btn btn-sm btn-outline-primary">Terima Komplain Diterima</a>
                                          <a href="#actionStatus" data-id="10" id="actionStatus" class="btn btn-sm btn-outline-primary">Tolak Komplain Diterima</a>
                                        @else
                                          @if($row->status==2)
                                            <a href="#actionStatus" data-id="3" id="actionStatus" class="btn btn-sm btn-outline-primary">Setujui Pembayaran</a>
                                          @endif
                                          <a href="#actionStatus" data-id="6" id="actionStatus" class="btn btn-sm btn-outline-primary">Di Terima</a>
                                          <a href="#actionStatus" data-id="0" id="actionStatus" class="btn btn-sm btn-outline-primary">Tolak</a>
                                          <a href="#actionStatus" data-id="7" id="actionStatus" class="btn btn-sm btn-outline-primary">Cancel</a>
                                        @endif
                                      @elseif(GlobalHelper::session()=='seller')
                                        @if($row->status <= 1)
                                          <a href="#actionStatus" data-id="0" id="actionStatus" class="btn btn-sm btn-outline-primary">Tolak</a>
                                        @endif
                                        @if($row->status==4 or $row->status==5)
                                          <a href="#actionStatus" data-id="4" id="actionStatus" class="btn btn-sm btn-outline-primary">Dibuat</a>
                                          <a href="#actionStatus" data-id="5" id="actionStatus" class="btn btn-sm btn-outline-primary">Di Kirim</a>
                                          <a href="#actionStatus" data-id="6" id="actionStatus" class="btn btn-sm btn-outline-primary">Di Terima</a>
                                        @else
                                          No Action
                                        @endif
                                      @elseif(GlobalHelper::session()=='produsen')
                                        <a href="#actionStatus" data-id="4" id="actionStatus" class="btn btn-sm btn-outline-primary">Pembuatan</a>
                                      @endif
                                    @else
                                      No Action
                                    @endif
                                  </p>
                            </div>
                            <div class="form-group">
                              <label>Tanggal Transaksi:</label>
                              <h5>{{$row->created_at}}</h5>
                            </div>
                            <div class="bootstrap-timepicker">
                              <div class="form-group">
                                <label>Note:</label>
                                <h5> 
                                  {{empty($row->note)?'-':$row->note}}
                                </h5>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="border-bottom: 2px solid rgba(0,0,0,.125);margin-top: 8px;">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Pengiriman</h3>
                          </div>
                          <table id="mytable" class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>Kurir Ekspedisi </th>
                                      <th>Service Ekspedisi</th>
                                      <th>Weight</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>{{strtoupper($row->courier)}}</td>
                                  <td>{{$row->courier_service}}</td>
                                  <td>{{$row->weight}}</td>
                                </tr>
                              </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 8px;">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Daftar Produk</h3>
                          </div>
                          <table id="mytable" class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>Nama Item </th>
                                      <th>Harga</th>
                                      <th>QTY</th>
                                      <th>Total Harga</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if(count($row->detail) > 0)
                                      <?php $totalPrice = 0; ?>
                                      @foreach($row->detail as $value)
                                          <?php $totalPrice+=$value->qty*$value->price; ?>
                                          <tr>
                                              <td>{{GlobalHelper::productName($value->product_id)}}</td>
                                              <td>{{GlobalHelper::idrFormat($value->price)}}</td>
                                              <td>{{$value->qty}}</td>
                                              <td>Rp. {{GlobalHelper::idrFormat($value->qty*$value->price)}}</td>
                                          </tr>
                                      @endforeach
                                  @else
                                          <tr>
                                              <td>-</td>
                                              <td>-</td>
                                              <td>-</td>
                                              <td>-</td>
                                          </tr>
                                  @endif
                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th colspan="3">Biaya Ongkir</th>
                                      <th>
                                          @if(!empty($row->shipping_fee))
                                              Rp. {{GlobalHelper::idrFormat($row->shipping_fee)}}
                                          @else
                                              Rp. 0
                                          @endif

                                      </th>
                                  </tr>
                                  <tr>
                                      <th colspan="3">Biaya Unik</th>
                                      <th>
                                          @if(!empty($row->unique_fee))
                                              Rp. {{GlobalHelper::idrFormat($row->unique_fee)}}
                                          @else
                                              Rp. 0
                                          @endif

                                      </th>
                                  </tr>
                                  <tr>
                                      <th colspan="3">Total Bayar</th>
                                      <th>
                                          @if(!empty($row->total_paid))
                                              Rp. {{
                                                    GlobalHelper::idrFormat(
                                                      $row->total_paid
                                                    )
                                                  }}
                                          @else
                                              0
                                          @endif

                                      </th>
                                  </tr>
                              </tfoot>
                          </table>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

</div>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="{{url('css/toastr/jquery.toast.css')}}">
@stop

@section('plugins.Datatables', true)
@section('js')
<script type="text/javascript" src="{{url('js/toastr/jquery.toast.js')}}"></script>
<script>
    $(function() {
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

        $('a[href="#actionStatus"]').click(function(){
          console.log('dsdsdsdsds')
          $.get("{!! url('transactions/changetrans-status') !!}", {
              status : $(this).attr('data-id'),
              code : $("#transCode").val()
          },
          function (data) {
              var id = "{{Request::segment(3)}}";
              window.location.href = "/transactions/detail/"+id;
          });
        });
    });
</script>
@stop