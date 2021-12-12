@extends('admin.layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create New Product</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.product.list') }}" >Back</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.product.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Name:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Price:</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" placeholder="Price">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Brand:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="brand_id">
                                    @foreach($brands as $item)
                                    <option value="{{$item->id}}" >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Images:</label>
                            <div class="col-sm-10">
                                <div class="row mb-2" id="uploadedImg">
                                    @if ( isset($images) && !empty($images) ) 
                                        @foreach( $images as $img )
                                            <img src="{{ asset('storage/uploads/products/'.$img->name) }}" class="col-3 img-thumb mb-2"  />
                                        @endforeach
                                    @endif
                                </div>
                                <div id="mulitplefileuploader" data-upload-url="{{ route('admin.product.uploadImgs', 0) }}" >Upload</div>

                                <div id="status"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Detail:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Detail"></textarea>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('headcss')
<link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">
@endpush

@section('scripts')
<script src="{{ asset('js/uploadfile.min.js') }}"></script>
<script>
$(document).ready(function() {
    var uploadUrl = $('#mulitplefileuploader').attr('data-upload-url');

    var settings = {
        url: uploadUrl,
        method: "POST",
        allowedTypes:"jpg,png,gif,doc,pdf,zip",
        fileName: "pdtImgs",
        formData: {'_token': appToken},
        multiple: true,
        onSuccess:function(files,data,xhr)
        {
            console.log(data);
            if ( data.error == 0 ) {
                $('#uploadedImg').html(data.html);
                swal({
                    text: "Upload is success!",
                    icon: "success",
                });
            } else {
                swal({
                    text: data.message,
                    icon: "error",
                });
            }            
            
        },
        onError: function(files,status,errMsg)
        {		
            $("#status").html("<font color='red'>Upload is Failed</font>");
        }
    }
    $("#mulitplefileuploader").uploadFile(settings);

});    
</script>   
@endsection
