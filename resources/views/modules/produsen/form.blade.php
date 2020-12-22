@extends('layouts.dash-new')

@section('title', 'Add Produsen')

@section('content_header')
<h1>Add Produsen</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <!-- <div class="card-header"> -->
                    <!-- <h5>Produsen List</h5> -->
              <!-- </div> -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <form action="{{ route('produsen.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{isset($row)?$row->id:''}}">
                        <div class="form-group">
                          <label for="name">Name Produsen</label>
                          <input type="name"  class="form-control" required="" name="name" aria-describedby="name" placeholder="Enter name" value="{{isset($row)?$row->name:''}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Phone</label>
                          <input type="text" class="form-control" required="" name="phone" aria-describedby="name" value="{{isset($row)?$row->phone:''}}" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                          <label for="name">Email</label>
                          <input type="email" class="form-control" required="" name="email" aria-describedby="email" value="{{isset($row)?$row->email:''}}" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="description">Address</label>
                          <textarea class="form-control" required="" name="address">
                            {{isset($row)?$row->address:''}}
                          </textarea>
                        </div>
                        <div class="form-group">
                          <label for="tatus">Status</label> <br/>
                            <!-- Default inline 1-->
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input" 
                              id="defaultInline1" name="status" value="1"
                              {{ isset($row) ? ($row->status == 1 ? 'checked' : '') : 'checked' }}>
                              <label class="custom-control-label" for="defaultInline1">Aktif</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input" 
                              id="defaultInline2" name="status" value="0"
                              {{ isset($row) ? ($row->status == 0 ? 'checked' : '') : '' }}>
                              <label class="custom-control-label" for="defaultInline2">Non Aktif</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{url('produsen')}}" class="edit btn btn-default">Back</a> 
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
  });
</script>
@stop