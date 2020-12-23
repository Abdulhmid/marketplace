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
                        <!-- <a href="{{url('transactions/'.$row->id)}}" class="btn btn-warning btn-round"><i class="icofont icofont-ui-add" style="color: #fff;"></i> Edit</a> -->
                    </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-info">
                        <!-- <div class="box-header">
                          <h3 class="box-title">Color &amp; Time Picker</h3>
                        </div> -->
                        <div class="box-body">
                          <div class="form-group">
                            <label>Kode Transaksi:</label>
                            <h5>{{$row->transaction_code}}</h5>
                            <input type="hidden" value="{{$row->transaction_code}}" id="transCode">
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
                    <div class="col-md-6">
                        <div class="box box-info">
                        <!-- <div class="box-header">
                          <h3 class="box-title">Color &amp; Time Picker</h3>
                        </div> -->
                        <div class="box-body">
                          <div class="form-group">
                            <label>Action:</label>
                                <p>
                                    <button readonly="true" type="button" class="btn bg-maroon margin">Approve</button>
                                    <button readonly="true" type="button" class="btn bg-purple margin">Reject</button>
                                    <button readonly="true" type="button" class="btn bg-orange margin">Cancel</button>
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
                                <textarea class="form-control" name="note" id="note">{{$row->note}}</textarea>
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
                                            <input type="text" class="form-control" name="total_paid" id="total_paid" value="{{$row->total_paid+$row->unique_fee+
                                                      $row->shipping_fee}}">
                                        @else
                                            0
                                        @endif

                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="4">
                                        <button id="edit-action" class="btn btn-warning">Proses</button>
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

        $('#edit-action').click(function(){
            $.ajax({
                url: '{{url("transactions")}}',
                type: 'POST',
                data: {
                  _token: "{{ csrf_token() }}", 
                  note : $('#note').val(),
                  totalPrice : $('#total_paid').val(),
                  transaction_code : $('#transCode').val()
                },
                success: function (data){
                    window.location.href = "/transactions/detail/"+{{Request::segment(2)}};
                },
                error: function (xhr, textStatus, errorThrown) {
                  console.log("XHR",xhr);
                  console.log("status",textStatus);
                  console.log("Error in",errorThrown);
                }
            });
        });
    });
</script>
@stop