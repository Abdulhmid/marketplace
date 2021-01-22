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

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Beri Tanggapan <label id="label-tanggap"></label> </h4>
            <input type="text" id="transCode">
          </div>
          <div class="modal-body">
            <label>Jawaban</label>
            <textarea class="form-control" id="response_complaint"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="store-response">Kirim Tanggapan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

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

        $('body').on('click', '.responseAction', function () {
     
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

        $('#myModal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var complaintTrans = $(e.relatedTarget).data('complaint-trans');
            var complaintId = $(e.relatedTarget).data('complaint-id');
            var complaintDesc = $(e.relatedTarget).data('complaint-desc');

            console.log(complaintDesc);
            //populate the textbox
            // $(e.currentTarget).find('input[name="bookId"]').val(bookId);
            $(e.currentTarget).find('#label-tanggap').html(complaintTrans);
            $('#transCode').val(complaintTrans);
        });

        $('body').on('click', '#store-response', function () {
            $.ajax({
                url: '{{url("complaint-response")}}',
                type: 'POST',
                data: {
                  _token: "{{ csrf_token() }}", 
                  response_complaint : $('#response_complaint').val(),
                  transaction_code : $('#transCode').val()
                },
                success: function (data){
                  $('#myModal').modal('hide');
                  $('#response_complaint').val('')
                  var oTable = $('#mytable').dataTable(); 
                      oTable.fnDraw(false);
                },
                error: function (xhr, textStatus, errorThrown) {
                  console.log("XHR",xhr);
                  console.log("status",textStatus);
                  console.log("Error in",errorThrown);
                }
            });
        });

    });
</script>
@stop