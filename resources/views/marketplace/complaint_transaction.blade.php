@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')

<div class="ps-mission bg-cover" data-background="images/parallax/home-testimonial.jpg">
  <div class="ps-container">
    <h3>Riwayat Transaksi</h3>
    <h4> Kode Transaksi Anda <label style="font-style: italic">{{Request::segment(3)}}</label></h4>
   
    <br/>
    <div class="col-md-12">
      <form action="#" method="post" id="formComplaint">
        @csrf
        <input type="hidden" name="code" value="{{Request::segment(3)}}">
        <div class="form-group">
          <textarea class="form-control" name="complaint_description">Tulis Komplain anda disini</textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-info" type="submit">Kirim</button>
        </div>
      </form>
    </div>
    <div class="clearfix"></div>
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

    $('#formComplaint').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);

       $.ajax({
          type:'POST',
          url: '/api/v1/data/complaint',
         data: formData,
         contentType: false,
         processData: false,
         success: (response) => {
          console.log(response);
            $.toast({ 
              text : response.message, 
              showHideTransition : 'slide',  // It can be plain, fade or slide
              bgColor : 'green',              // Background color for toast
              textColor : 'white',            // text color
              allowToastClose : false,       // Show the close button or not
              hideAfter : 5000,
              textAlign : 'left',          
              position : 'top-right'       
            })
            window.location.href = "/transactions/tracking/"+"{{Request::segment(3)}}";
         },
         error: function(response){
            console.log(response);
         }
       });
    });
  });
</script>
@stop