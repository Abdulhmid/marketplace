@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')

<div class="ps-mission bg-cover" data-background="images/parallax/home-testimonial.jpg">
  <div class="ps-container">
    <h3>Transaksi Anda Berhasil</h3>
    <h4> Kode Transaksi Anda <label style="font-style: italic">{{Request::segment(4)}}</label></h4>
    <button class="btn" data-clipboard-text="{{Request::segment(4)}}">
        Copy Kode Transaksi
    </button>
    <br/>
    <h5>Silahkan selesaikan pembayaran anda.</h5>
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
      <table id="mytable" class="table table-bordered table-hover" style="color: white;font-size: 19px;font-weight: bold;">
          <thead>
              <tr>
                  <th width="35%">Nama Bank</th>
                  <th width="70%">{{GlobalHelper::config('bank_name')}}</th>
              </tr>
              <tr>
                  <th width="35%">A.n</th>
                  <th width="70%">{{GlobalHelper::config('bank_pic')}}</th>
              </tr>
              <tr>
                  <th width="35%">No Rekening</th>
                  <th width="70%">{{GlobalHelper::config('bank_rek')}}</th>
              </tr>
              <tr>
                  <th width="35%">Total Bayar</th>
                  @if(isset($row))
                    <th width="70%">Rp {{GlobalHelper::idrFormat($row->total_paid)}}</th>
                  @else
                    <th width="70%">Rp {{GlobalHelper::idrFormat(0)}}</th>
                  @endif
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
    </div>
    <div class="col-md-4"></div>
    <div class="clearfix"></div>
  </div>
    <form id="myForm" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="code" id="code" value="{{Request::segment(4)}}">
      <div class="col-md-4"></div>
      <div class="col-md-4" style="color: white;">
        <label>Upload Bukti Pembayaran</label>
        <input type="file" id="file" name="image"
          style="margin: 0 auto;float: none;margin: 4px 125px auto;">
      </div>
      <div class="col-md-4"></div>
      <div class="clearfix"></div>
      <br>
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <button type="submit" id="uploadProof" class="btn btn-primary btn-lg">Proses</button>
      </div>
      <div class="col-md-4"></div>
    </form>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#myForm').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);

       $.ajax({
          type:'POST',
          url: '/api/v1/data/confirm',
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
             // console.log(response);
             window.location.href = "/transactions/tracking/"+$('#code').val();
           },
           error: function(response){
              console.log(response);
                $('#image-input-error').text(response.responseJSON.errors.file);
           }
       });
    });

  });
</script>
@stop