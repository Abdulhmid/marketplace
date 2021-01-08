@extends('layouts.dash-new')

@section('title', 'Ajukan Pencarian Dana')

@section('content_header')
<h1>Pengajuan pencarian dana</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <!-- <div class="card-header"> -->
                    <!-- <h5>Roles List</h5> -->
              <!-- </div> -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <form action="{{ route('redeem.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{isset($row)?$row->id:''}}">
                        <div class="form-group">
                          <label for="name">Nama Pemohon</label>
                          <input type="text"  class="form-control" placeholder="Enter name" value="{{Auth::user()->name}}" readonly="">
                          <input type="hidden"  class="form-control" required="" name="user_id" aria-describedby="user_id" placeholder="Enter name" value="{{Auth::user()->id}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Nominal</label>
                          <input type="label" class="form-control" required="" name="nominal" aria-describedby="name" value="{{GlobalHelper::saldo()}}" placeholder="Enter label" readonly="">
                        </div>
                        <div class="form-group">
                          <label for="name">Nama Bank</label>
                          <input type="text" name="bank_name" class="form-control" placeholder="Nama bank" value="" required="">
                        </div>
                        <div class="form-group">
                          <label for="name">No Rekening</label>
                          <input type="text" name="rekening" class="form-control" placeholder="No Rekening" value="" required="">
                        </div>
                        <div class="form-group">
                          <label for="name">Atas Nama</label>
                          <input type="text" name="account_behalf" class="form-control" placeholder="Atas nama" value="" required="">
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" required="" name="description">
                            {{isset($row)?$row->description:'-'}}
                          </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{url('redeem')}}" class="edit btn btn-default">Back</a> 
                      </form>
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
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  $(function() {
    $("input[name=label]").keypress(function (evt) {
      
      var keycode = evt.charCode || evt.keyCode;
      if (keycode  == 32) { 
        return false;
      }
    });
  });
</script>
@stop