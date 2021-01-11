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
                        <a href="{{url('data-products/create')}}" class="btn btn-info btn-round"><i class="icofont icofont-ui-add" style="color: #fff;"></i> Add Products</a>
                    </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="mytable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Variant</th>
                                    <th>Status</th>
                                    <th>Stok</th>
                                    <th>Updated</th>
                                    <th>Request</th>
                                    <th>Actions</th>
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
            ajax: "{{ route('data-products.index') }}",
            columns: [
                { data: 'image', name: 'image',
                    render: function( data, type, full, meta ) {
                        return "<img src=\"{{url('/')}}/" + data + "\" height=\"50\" class=\"thumbnail\"/>";
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'product_type_id', name: 'product_type_id'},
                {data: 'product_category_id', name: 'product_category_id'},
                {data: 'total_price', name: 'total_price'},
                {data: 'variant', name: 'variant'},
                {data: 'status', name: 'status'},
                {data: 'stock', name: 'status'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'request', name: 'request', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    $('body').on('click', '.deleteAction', function () {
 
        var id = $(this).data("id");
        if(confirm("Are You sure want to delete !"))
        {
          $.ajax({
              type: "get",
              url: "{{ url('data-products-delete') }}"+'/'+id,
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

    $('body').on('click', '.reqAtion', function () {
 
        var id = $(this).data("id");
        var req = $(this).data("req");
        if(confirm("Anda yakin mau update status ?"))
        {
          $.ajax({
              type: "get",
              url: "{{ url('data-products-req') }}"+'/'+req+'/'+id,
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