@extends('layouts.dash')

@section('title', 'Add Configurations')

@section('content_header')
<h1>Add Configurations</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <!-- <div class="card-header"> -->
                    <!-- <h5>Configurations List</h5> -->
              <!-- </div> -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <form action="{{ route('configurations.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{isset($row)?$row->id:''}}">
                        <div class="form-group">
                          <label for="key">Key Configurations</label>
                          <input type="key"  class="form-control" required="" name="key" aria-describedby="name" placeholder="Enter Key" value="{{isset($row)?$row->key:''}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Values</label>
                          <textarea class="form-control" required="" rows="7" name="value">
                            {{isset($row)?$row->value:''}}
                          </textarea>
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
                        <a href="{{url('configurations')}}" class="edit btn btn-default">Back</a> 
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