@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Edit Brand</h1>
        <div class="card shadow mb-4">
            <div class="panel-body col-lg-8">
                <form action="{{ route('admin.brand.update', $brand->id) }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <br>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Name:</p>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control form-control-sm"  name="name" value="{{ old('name', isset($brand->name) ? $brand->name : null) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Image:</p>
                        </div>
                        <div class="col-md-9">
                            <?php
                                $image = isset($brand->image) ? str_replace('upload/image_brand/', '', $brand->image) : null;
                            ?>
                            <input type="file" class="form-control-sm " id="input-img" name="image" value="{{ $image }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 offset-3">
                            <img class="img-slide-category" src="{{ isset($brand->image) ? $brand->image : null }}" id="img-show" alt="Image">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
@endpush
