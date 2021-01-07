@extends('layouts.dash-new')

@section('title', 'Transactions')

@section('content_header')
<h1>Data Complaint</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <div class="card-header">
                    <!-- <h5>Roles List</h5> -->
                    <span></span>
                    <div class="card-header-right">
                        <h5>Total Komplain Masuk : 10</h5>
                    </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="mytable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="20%">Transaction Code</th>
                                    <th width="20%">Produk</th>
                                    <th width="10%">Status</th>
                                    <th width="30%">Ket Komplain</th>
                                    <th>Created</th>
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
            ajax: "{{ route('complaint.index') }}",
            columns: [
                {data: 'transaction_code', name: 'transaction_code'},
                // {data: 'buyer_email', name: 'buyer_email'},
                // {data: 'total_paid', name: 'total_paid'},
                {data: 'product', name: 'product'},
                {data: 'status', name: 'status'},
                {data: 'complaint_description', name: 'complaint_description'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('body').on('click', '.approveAction', function () {
     
            var code = $(this).data("id");
            var status = $(this).data("status");
            if(confirm("Apakah anda yakin mau menolak Komplain ini "))
            {
              $.ajax({
                  type: "get",
                  url: "{{ url('complaint-change-status') }}"+'/'+code+"/"+status,
                  success: function (data) {
                    console.log(data);
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
     
            var code = $(this).data("id");
            var status = $(this).data("status");
            if(confirm("Apakah anda yakin mau menolak Komplain ini "))
            {
              $.ajax({
                  type: "get",
                  url: "{{ url('complaint-change-status') }}"+'/'+code+"/"+status,
                  success: function (data) {
                    console.log(data);
                      var oTable = $('#mytable').dataTable(); 
                      oTable.fnDraw(false);
                  },
                  error: function (data) {
                      console.log('Error:', data);
                  }
              });
           }
        });  
    });
</script>
@stop