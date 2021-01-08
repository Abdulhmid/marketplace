@extends('layouts.dash-new')

@section('title', 'Add Products')

@section('content_header')
<h1>Add Products</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary">
            <div class="">
              <!-- <div class="card-header"> -->
                    <!-- <h5>Products List</h5> -->
              <!-- </div> -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <form action="{{ route('data-products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{isset($row)?$row->id:''}}">
                        <div class="col-md-3">
                          <div class="form-group">
                              <label>Upload Image Products</label>
                              <input type="file" name="image" value="{{isset($row)?$row->image:''}}" />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label>Image Left</label>
                                <input type="file" name="image_1" value="{{isset($row)?$row->image_1:''}}" />
                            </div>            
                          </div>  
                          <div class="col-md-3">
                            <div class="form-group">
                                <label>Image Right</label>
                                <input type="file" name="image_2" value="{{isset($row)?$row->image_2:''}}" />
                            </div>            
                          </div>  
                          <div class="col-md-3">
                            <div class="form-group">
                                <label>Image Front</label>
                                <input type="file" name="image_3" value="{{isset($row)?$row->image_3:''}}" />
                            </div>            
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                                <label>Image Back</label>
                                <input type="file" name="image_4" value="{{isset($row)?$row->image_4:''}}" />
                            </div>            
                          </div>  
                        </div>

                        <div class="form-group">
                          <label for="name">Name Item</label>
                          <input type="text"  class="form-control" required="" name="name" aria-describedby="name" placeholder="Enter name" value="{{isset($row)?$row->name:''}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Slug</label>
                          <input type="text" readonly="true" id="slug"  class="form-control" required="" name="slug" aria-describedby="slug" placeholder="Enter slug" value="{{isset($row)?$row->slug:''}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Location</label>
                          <select class="form-control" required="" id="location" name="location">
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach(RajaOngkir::cities() as $value)
                              <option value="{{ $value->city_id }}-{{ $value->province_id }}" {{isset($row) ? $value->city_id == $row->city_id ? 'selected' : '' : ''}}>{{ $value->city_name }} - {{$value->province}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="name">Type</label>
                          <select class="form-control" required="" name="product_type_id">
                            @foreach($types as $key => $value)
                              <option value="{{ $value->id }}" {{isset($row) ? $value->id == $row->product_type_id ? 'selected' : '' : ''}}>{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="name">Category</label>
                          <select class="form-control" required="" name="product_category_id">
                            @foreach($category as $key => $value)
                              <option value="{{ $value->id }}" {{isset($row) ? $value->id == $row->product_category_id ? 'selected' : '' : ''}}>{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="name">Harga Produsen</label>
                          <input type="number" min="1" class="form-control" required="" name="produsen_price" aria-describedby="produsen_price" value="{{isset($row)?$row->produsen_price:''}}" placeholder="Enter Podusen Price">
                        </div>
                        <div class="form-group">
                          <label for="name">Komisi</label>
                          <input type="number" min="1" class="form-control" required="" name="commission_price" aria-describedby="commission_price" value="{{isset($row)?$row->commission_price:''}}" placeholder="Masukkan Harga Komisi">
                        </div>

                        <div class="form-group">
                          <label for="name">Berat (Gram)</label>
                          <input type="number" min="1" class="form-control" required="" name="weight" aria-describedby="weight" value="{{isset($row)?$row->weight:''}}" placeholder="Masukkan Berat Barang (Gram)">
                        </div>
                        
                        <div class="form-group">
                          <label for="short_desc">Short Description</label>
                          <textarea class="form-control" required="" name="short_desc">
                            {{isset($row)?$row->short_desc:''}}
                          </textarea>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" required="" name="description">
                            {{isset($row)?$row->description:''}}
                          </textarea>
                        </div>

                        <div class="form-group">
                          <label for="name">Produsen</label>
                          <select class="form-control" required="" name="produsen_id">
                            @foreach($produsen as $key => $value)
                              <option value="{{ $value->id }}-{{$value->user_id}}" {{isset($row) ? $value->id == $row->produsen_id ? 'selected' : '' : ''}}>{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group" style="display: none;">
                          <label for="tatus">Status</label> <br/>
                            <!-- Default inline 1-->
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input" 
                              id="defaultInline1" name="status" value="1"
                              {{ isset($row) ? ($row->status == 1 ? 'checked' : '') : '' }}>
                              <label class="custom-control-label" for="defaultInline1">Aktif</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input" 
                              id="defaultInline2" name="status" value="0"
                              {{ isset($row) ? ($row->status == 0 ? 'checked' : '') : 'checked' }}>
                              <label class="custom-control-label" for="defaultInline2">Non Aktif</label>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="variant">Variant</label>
                          <div class="row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="variant_name"  aria-describedby="varian name" value="" placeholder="Enter Variant Name">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="variant_description" aria-describedby="varian description" value="" placeholder="Enter Variant Description">
                            </div>
                            <div class="col-sm-2">
                                <input type="number" min="0" class="form-control" id="variant_stock" aria-describedby="varian stock" value="0" placeholder="Enter Variant Stock">
                            </div>
                            <div class="col-sm-2"><button type="button" class="btn btn-default" id="button-add-var"><i class="fa fa-plus">Add</i></button></div>
                          </div>
                        </div>
                        <table id="variant-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Desc</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($row))
                                  @foreach($row->variant as $value)
                                    <tr>
                                      <td>
                                        <input type="hidden" required="" value="{{$value->name}}" name="variant_name[]">
                                        {{$value->name}}
                                      </td>
                                      <td>
                                        <input type="hidden" required="" value="{{$value->description}}" name="variant_description[]">
                                        {{$value->description}}
                                      </td>
                                      <td>
                                        <input type="hidden" required="" value="{{$value->stock}}" name="variant_stock[]">
                                        {{$value->stock}}
                                      </td>
                                      <td><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" id="del-var" title="Delete"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                  @endforeach
                                @else
                                  <!-- <tr>
                                    <td colspan="3">Please Add Variant</td>
                                  </tr> -->
                                @endif
                            </tbody>
                        </table>
                        <div class="form-group">

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{url('data-products')}}" class="edit btn btn-default">Back</a> 
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
  .has-error .help-block {
    color: red;
  }
</style>
@stop

@section('js')
<script type="text/javascript" src="{{url('js/ezdz/ezdz.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
  $(function() {
    $('#location').select2();
    $('[type="file"]').ezdz({
        validators: {
            maxSize: 1000000
        },
        classes: {
        }
    });

    $("input[name=name]").on("keyup change", function(e) {
        var value = $(this).val().replace(/\s+/g, '-').toLowerCase();
        $("input[name=slug]").val(value);
    })

    $("#button-add-var").click(function(){
      var nv = $('#variant_name').val();
      var nd = $('#variant_description').val();
      var ns = $('#variant_stock').val();
      $('#variant-table').append('<tr>'+
        '<td><input type="hidden" required="" value="'+nv+'" name="variant_name[]">'+nv+'</td>'+
        '<td><input type="hidden" required="" value="'+nd+'" name="variant_description[]">'+nd+'</td>'+
        '<td><input class="form-control" type="text" value="'+ns+'" name="variant_stock[]"></td>'+
        '<td><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" id="del-var" title="Delete"><i class="fa fa-trash"></i></button></td>'+
        '</tr>');
      $('#variant_name').val('');
      $('#variant_description').val('');
      $('#variant_stock').val('');
    });

    @if(isset($row))
        $('[name="image"]').ezdz('preview', "{!! asset($row->image) !!}");
        $('[name="image_1"]').ezdz('preview', "{!! asset($row->image_1) !!}");
        $('[name="image_2"]').ezdz('preview', "{!! asset($row->image_2) !!}");
        $('[name="image_3"]').ezdz('preview', "{!! asset($row->image_3) !!}");
        $('[name="image_4"]').ezdz('preview', "{!! asset($row->image_4) !!}");
    @endif

  });

  $(document).on('click','#del-var',function(){
      $($(this).closest("tr")).remove()
  });

</script>
@stop