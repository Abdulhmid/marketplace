@extends('layouts.dash-new')

@section('title', 'Add Menus')

@section('content_header')
<h1>Master Data Menus</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <div class="card-header">
                    <!-- <h5>Menus List</h5> -->
                    <span></span>
                    <div class="card-header-right">
                        <a href="{{url('menus/create')}}" class="btn btn-info btn-round"><i class="icofont icofont-ui-add" style="color: #fff;"></i> Add Menus</a>
                    </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="mytable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Sort</th>
                                    <th>Url</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                    <th>Updated</th>
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
            ajax: "{{ route('menus.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'sort', name: 'sort'},
                {data: 'url', name: 'url'},
                {data: 'position', name: 'position'},
                {data: 'status', name: 'status'},
                {data: 'description', name: 'description'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
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
              url: "{{ url('menus-delete') }}"+'/'+id,
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