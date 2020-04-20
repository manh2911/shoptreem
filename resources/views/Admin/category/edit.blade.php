@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Edit Category</h1>
        <div class="card shadow mb-4">
            <div class="panel-body col-lg-8">
                <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <br>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Parent Category:</p>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control form-control-sm select2" name="parent_id" required>
                                <option value="0">Choose parent category</option>
                                @foreach($parents as $parent)
                                    <option
                                        value="{{ $parent->id }}"
                                        {{ (collect(old('parent_id'))->contains($parent->id)) ? 'selected':'' }}
                                        {{ $parent->id == $category->parent_id ? 'selected':'' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Name:</p>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control form-control-sm"  name="name" value="{{ old('name', isset($category->name) ? $category->name : null) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Image Icon:</p>
                        </div>
                        <div class="col-md-9">
                            <input type="file" class="form-control-sm" id="input-img-icon" name="imageIcon" value="{{ isset($category->imageIcon) ? $category->imageIcon : null }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 offset-3">
                            <img class="img-icon-category" src="{{ isset($category->imageIcon) ? $category->imageIcon : null }}" id="img-icon" alt="Image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Image Slide:</p>
                        </div>
                        <div class="col-md-9">
                            <input type="file" class="form-control-sm " id="input-img-slide" name="imageSlide" value="{{ isset($category->imageSlide) ? $category->imageSlide : null }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 offset-3">
                            <img class="img-slide-category" src="{{ isset($category->imageSlide) ? $category->imageSlide : null }}" id="img-slide" alt="Image">
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
