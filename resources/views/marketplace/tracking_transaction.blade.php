@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')

<div class="ps-mission bg-cover" data-background="images/parallax/home-testimonial.jpg">
  <div class="ps-container">
    <h3>Riwayat Transaksi</h3>
    <h4> Kode Transaksi Anda <label style="font-style: italic">{{Request::segment(3)}}</label></h4>
    @if($status==5)
      <div class="col-md-12">
        <a href="#confirmAccept" class="btn btn-info">Konfirmasi Barang Diterima</a>
      </div>
      <div class="clearfix"></div>
      <br/>
    @endif
    <div class="col-md-12">
      <table id="mytable" class="table table-bordered table-hover" style="color: white;font-size: 19px;font-weight: bold;">
          <thead>
              <tr>
                  <th width="15%">Status</th>
                  <th width="15%">Time</th>
              </tr>
          </thead>
          <tbody>
              @foreach($data as $value )
                <tr align="left">
                  <td>{{GlobalHelper::wordingStatusTransaksi($value->status)}}</td>
                  <td>{{$value->created_at}}</td>
                </tr>
              @endforeach
          </tbody>
      </table>
    </div>
    <div class="clearfix"></div>
    @if($status==6)
      <a href="/transactions/complaint/FETQVVO" class="btn btn-info">Ajukan Komplain</a>
    @endif


  </div>
</div>
@stop
@section('css')
  <style type="text/css">
    .ps-mission {
        position: relative;
        z-index: 10;
        text-align: center;
        padding: 26px 0 217px;
    }
    .ps-mission h3 {
      margin-bottom: 30px;
      font-family: "Archivo Narrow", sans-serif;
      font-size: 36px;
      color: #ffffff;
      text-transform: uppercase;
    }

    .ps-mission h4 {
      margin-bottom: 30px;
      font-family: "Archivo Narrow", sans-serif;
      font-size: 21px;
      color: #ffffff;
      text-transform: uppercase;
    }

    .ps-mission h5 {
      margin-bottom: 30px;
      font-family: "Archivo Narrow", sans-serif;
      font-size: 17px;
      color: #ffffff;
      text-transform: uppercase;
    }
  </style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    new ClipboardJS('.btn');
    $('a[href="#confirmAccept"]').click(function(){
      if(confirm("Apakah anda yakin barang sudah diterima ?"))
      {
        var code = "{{Request::segment(3)}}";
        $.get("{!! url('/api/v1/data/confirm-accept') !!}", {
            code : "{{Request::segment(3)}}"
        },
        function (data) {
          $.toast({ 
            text : "Konfirmasi Barang diterima berhasil", 
            showHideTransition : 'slide',  // It can be plain, fade or slide
            bgColor : 'green',              // Background color for toast
            textColor : 'white',            // text color
            allowToastClose : false,       // Show the close button or not
            hideAfter : 5000,
            textAlign : 'left',          
            position : 'top-right'       
          })
          window.location.href = "/transactions/tracking/"+code;
        });
      }
    });
  });
</script>
@stop