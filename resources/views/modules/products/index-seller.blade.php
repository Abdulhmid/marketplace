@extends('layouts.dash-new')

@section('title', 'Data Products')

@section('content_header')
<h1>Master Data Products</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <div class="card-header">
                  <!-- <h5>Products List</h5> -->
                  <span></span>
                  <div class="card-header-right">
                      <a href="{{url('/home')}}" class="btn btn-default btn-round"><i class="icofont icofont-ui-add" style="color: #fff;"></i> Back</a>
                  </div>
              </div>
              <div class="card-body">
                <form action="#" id="formStore" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label>Pilih Produk</label>
                        <select class="form-control" id="products-list" name="product[]"  multiple="multiple">
                          @foreach(GlobalHelper::listProduct() as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <div>
                  <button type="submit" class="btn btn-default">Simpan</button>
                </div>
                </form>
              </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

</div>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="{{url('css/toastr/jquery.toast.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    /*background-color: #007bff;*/
    /*border-color: #006fe6;*/
    color: #000;
    padding: 0 10px;
    margin-top: .31rem;
}
</style>
@stop

@section('plugins.Datatables', true)
@section('js')
<script type="text/javascript" src="{{url('js/toastr/jquery.toast.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>

    $(function() {
        $("#products-list").val({!!$productSelected!!}).trigger("change");

        $('#products-list').select2({
          dropdownCssClass: "s2-mh-5",
          multiple: true
        }).on('change', function(e) {
          var data = $("#products-list option:selected").val();
          console.log(data);
        });

        $("#products-list").on("change", function () {
            console.log($(this).val());
        });

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

        $('#formStore').submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);

           $.ajax({
              type:'POST',
              url: '/store-product-seller',
             data: formData,
             contentType: false,
             processData: false,
             success: (response) => {
                console.log(response);
                $.toast({ 
                  text : "Data Produk Berhasil diperbaharui", 
                  showHideTransition : 'slide',  // It can be plain, fade or slide
                  bgColor : 'green',              // Background color for toast
                  textColor : 'white',            // text color
                  allowToastClose : false,       // Show the close button or not
                  hideAfter : 5000,
                  textAlign : 'left',          
                  position : 'top-right'       
                })
             },
             error: function(response){
                console.log(response);
             }
           });
        });

    });

</script>
@stop