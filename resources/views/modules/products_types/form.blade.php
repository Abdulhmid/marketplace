@extends('layouts.dash-new')

@section('title', 'Add Products Types')

@section('content_header')
<h1>Add Products Types</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <!-- <div class="card-header"> -->
                    <!-- <h5>Products Types List</h5> -->
              <!-- </div> -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <form action="{{ route('products-types.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{isset($row)?$row->id:''}}">
                        <div class="form-group">
                          <label for="name">Name Products Types</label>
                          <input type="name"  class="form-control" required="" name="name" aria-describedby="name" placeholder="Enter name" value="{{isset($row)?$row->name:''}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Slug</label>
                          <input type="text" readonly="true" id="slug"  class="form-control" required="" name="slug" aria-describedby="slug" placeholder="Enter slug" value="{{isset($row)?$row->slug:''}}">
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" required="" name="description">
                            {{isset($row)?$row->description:''}}
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
                        <a href="{{url('products-types')}}" class="edit btn btn-default">Back</a> 
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

    $("input[name=name]").on("keyup change", function(e) {
        var value = $(this).val().replace(/\s+/g, '-').toLowerCase();
        $("input[name=slug]").val(value);
    })

  });
</script>
@stop