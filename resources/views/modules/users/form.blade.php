@extends('layouts.dash')

@section('title', 'Add Users')

@section('content_header')
<h1>Add Users</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <!-- <div class="card-header"> -->
                    <!-- <h5>Users List</h5> -->
              <!-- </div> -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{isset($row)?$row->id:''}}">
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" name="image" value="{{isset($row)?$row->image:''}}" />
                        </div>
                        <div class="form-group">
                          <label for="name">Name User</label>
                          <input type="name"  class="form-control" required="" name="name" aria-describedby="name" placeholder="Enter name" value="{{isset($row)?$row->name:''}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Username</label>
                          <input type="label" class="form-control" required="" name="username" aria-describedby="name" value="{{isset($row)?$row->username:''}}" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                          <label for="name">Email</label>
                          <input type="email" class="form-control" required="" name="email" aria-describedby="email" value="{{isset($row)?$row->email:''}}" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                          <label for="name">Role</label>
                          <select class="form-control" required="" name="role_id">
                            @foreach($roles as $key => $value)
                              <option value="{{ $value->id }}" {{isset($row) ? $value->id == $row->role_id ? 'selected' : '' : ''}}>{{ $value->name }}</option>
                            @endforeach
                          </select>
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
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" >Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{url('users')}}" class="edit btn btn-default">Back</a> 
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
            // maxWidth: 600,
            // maxHeight: 400,
            maxSize: 1000000
        },
        classes: {
          // main:   'ezdz-dropzone',
          // enter:  'ezdz-enter',
          // reject: 'ezdz-reject',
          // accept: 'ezdz-accept',
          // focus:  'ezdz-focus'
        }
    });

    @if(isset($row))
        $('[type="file"]').ezdz('preview', "{!! asset($row->image) !!}");
    @endif


    $("input[name=username]").keypress(function (evt) {
      
      var keycode = evt.charCode || evt.keyCode;
      if (keycode  == 32) { 
        return false;
      }
    });
  });
</script>
@stop