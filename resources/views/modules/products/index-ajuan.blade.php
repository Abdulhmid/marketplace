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
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="mytable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Produsen</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                    <th>Request</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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

        var table = $('#mytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('data-products.sales') }}",
            columns: [
                {data: 'produsen', name: 'produsen'},
                {data: 'product', name: 'product'},
                {data: 'status', name: 'status'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'request', name: 'request', orderable: false, searchable: false},
            ]
        });
    });


    $('body').on('click', '.reqAction', function () {
 
        var id = $(this).data("id");
        var req = $(this).data("req");
        if(confirm("Anda yakin mau update status ?"))
        {
          $.ajax({
              type: "get",
              url: "{{ url('data-products-req-sales') }}"+'/'+req+'/'+id,
              success: function (data) {
              var oTable = $('#mytable').dataTable(); 
              oTable.fnDraw(false);
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
       }
    }); 
</script>
@stop