@extends('layouts.dash')

@section('title', 'Add Banners')

@section('content_header')
<h1>Add Banners</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <!-- <div class="card-header"> -->
                    <!-- <h5>Banners List</h5> -->
              <!-- </div> -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <form action="{{ route('banners.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{isset($row)?$row->id:''}}">
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" name="image" value="{{isset($row)?$row->image:''}}" />
                        </div>
                        <div class="form-group">
                          <label for="name">Name Banners</label>
                          <input type="name"  class="form-control" required="" name="name" aria-describedby="name" placeholder="Enter name" value="{{isset($row)?$row->name:''}}">
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
                        <a href="{{url('banners')}}" class="edit btn btn-default">Back</a> 
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
<link rel="stylesheet" type="text/css" href="{{url('css/ezdz/jquery.ezdz.css')}}">
<style type="text/css">
  .has-error .help-block {
    color: red;
  }
</style>
@stop

@section('js')
<script type="text/javascript" src="{{url('js/ezdz/ezdz.min.js')}}"></script>
<script>
  $(function() {
    $('[type="file"]').ezdz({
        validators: {
            maxSize: 1000000
        }
    });

    @if(isset($row))
        $('[type="file"]').ezdz('preview', "{!! asset($row->image) !!}");
    @endif

  });
</script>
@stop