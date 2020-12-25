@extends('layouts.new-marketplace')

@section('title', 'Home')

@section('content')
      <div class="ps-contact ps-contact--2 ps-section pb-80" style="margin-left: 25%;">
        <div class="ps-container">
          <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                  <div class="ps-section__header pt-50">
                    <h2 class="ps-section__title" data-mask="Contact">- Daftar - </h2>
                    <form class="ps-contact__form" action="#" id="formReg" method="post">
                      @csrf
                      <div class="form-group">
                        <label>Nama <sub>*</sub></label>
                        <input class="form-control" type="text" id="name" required="" name="name" placeholder="Masukkan nama">
                      </div>
                      <div class="form-group">
                        <label>Email <sub>*</sub></label>
                        <input class="form-control" type="text" id="email" required="" name="email" placeholder="Masukkan email">
                      </div>
                      <div class="form-group">
                        <label>Phone <sub>*</sub></label>
                        <input class="form-control" type="text" id="phone" required="" name="phone" placeholder="Masukkan no hp">
                      </div>
                      <div class="form-group">
                        <label>Pilih Lokasi</label>
                        <select class="form-control" required="" id="location" name="location">
                          <option value="">-- Pilih Lokasi --</option>
                          @foreach(RajaOngkir::cities() as $value)
                            <option value="{{ $value->city_id }}-{{ $value->province_id }}">
                              {{ $value->city_name }} - {{$value->province}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group mb-25">
                        <label>Alamat</label>
                        <textarea class="form-control" required="" name="address"></textarea>
                      </div>
                      <div class="form-group mb-25">
                        <label>Password <sub>*</sub></label>
                        <input class="form-control" type="password" required="" name="password" id="password" placeholder="Masukkan password">
                      </div>
                      <div class="form-group mb-25">
                          <label for="confirm_password" >Confirm Password</label>
                          <input id="confirm_password" type="password" required="" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="ps-btn" id="register">Daftar<i class="ps-icon-next"></i></button>
                      </div>
                    </form>
                  </div>
                </div>
          </div>
        </div>
      </div>
@stop
@section('css')
  <link rel="stylesheet" href="{{url('/')}}/css/select2/select2.min.css">
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
<script src="{{url('/')}}/js/select2/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#location').select2();

    $('#password, #confirm_password').on('keyup', function () {
      if ($('#password').val() == $('#confirm_password').val()) {
        $('#password').css('border-color', 'green');
        $('#confirm_password').css('border-color', 'green');
      } else {
        $('#confirm_password').css('border-color', 'red');
        $('#password').css('border-color', 'red');
      }
    });

    $('#formReg').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);

       $.ajax({
          type:'POST',
          url: '/api/v1/data/actionRegister',
         data: formData,
         contentType: false,
         processData: false,
         success: (response) => {
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
            window.location.href = "/gologin";
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