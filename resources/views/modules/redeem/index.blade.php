@extends('layouts.dash-new')

@section('title', 'Pencairan Dana')

@section('content_header')
<h1>Pencarian Dana</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <div class="card-header">
                    <!-- <h5>Roles List</h5> -->
                    <span></span>
                    @if(GlobalHelper::session()!='admin')
                    <div class="card-header-right">
                        <a href="{{url('redeem/create')}}" class="btn btn-info btn-round"><i class="icofont icofont-ui-add" style="color: #fff;"></i> Ajukan Pencairan</a>
                    </div>
                    @endif
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="mytable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Request By</th>
                                    <th>Nominal</th>
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
            ajax: "{{ route('redeem.index') }}",
            columns: [
                {data: 'user_id', name: 'user_id'},
                {data: 'nominal', name: 'nominal'},
                {data: 'status', name: 'status'},
                {data: 'description', name: 'description'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    $('body').on('click', '.approveAction', function () {
 
        var id = $(this).data("id");
        var status = $(this).data("status");
        if(confirm("Pengajuan akan disetujui ?"))
        {
          $.ajax({
              type: "get",
              url: "{{ url('redeem-change') }}"+'/'+id+'/'+status,
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

    $('body').on('click', '.rejectAction', function () {
 
        var id = $(this).data("id");
        var status = $(this).data("status");
        if(confirm("Pengajuan akan ditolak ?"))
        {
          $.ajax({
              type: "get",
              url: "{{ url('redeem-change') }}"+'/'+id+'/'+status,
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