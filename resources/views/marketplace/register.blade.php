@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')
      <div class="ps-contact ps-contact--2 ps-section pb-80" style="margin-left: 25%;">
        <div class="ps-container">
          <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                  <div class="ps-section__header pt-50">
                    <h2 class="ps-section__title" data-mask="Contact">- Daftar - </h2>
                    <form class="ps-contact__form" action="do_action" method="post">
                      <div class="form-group">
                        <label>Email <sub>*</sub></label>
                        <input class="form-control" type="text" placeholder="Masukkan email">
                      </div>
                      <div class="form-group mb-25">
                        <label>Password <sub>*</sub></label>
                        <input class="form-control" type="password" placeholder="Masukkan password">
                      </div>
                      <div class="form-group">
                        <button class="ps-btn">Daftar<i class="ps-icon-next"></i></button>
                      </div>
                    </form>
                  </div>
                </div>
          </div>
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