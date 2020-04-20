@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Edit Product</h1>
        <div class="card shadow mb-4 ">
            <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                {{ method_field('PATCH') }}
                <div class="row">
                    <div class="panel-body col-lg-8" style="padding-left: 24px">
                        <br>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <p>Name:</p>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control form-control-sm" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <p>Category:</p>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control form-control-sm select2" name="category_id" required>
                                    <option></option>
                                    @foreach($parents as $parent)
                                        <optgroup label="{{ $parent->name }}">
                                            <?php
                                            $categories = \App\Category::where('parent_id', $parent->id)->get();
                                            ?>
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}"
                                                    {{ (collect(old('category_id'))->contains($categorie->id)) ? 'selected':'' }}
                                                    {{ $categorie->id == $product->category_id ? 'selected':'' }}>
                                                    {{ $categorie->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <p>Brand:</p>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control form-control-sm select2" name="brand_id" required>
                                    <option></option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ (collect(old('brand_id'))->contains($brand->id)) ? 'selected':'' }}
                                            {{ $brand->id == $product->brand_id ? 'selected':'' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <p>Origin Price (vnd):</p>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control form-control-sm" name="origin_price" value="{{ old('origin_price', $product->origin_price) }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <p>Discount (%):</p>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control form-control-sm" name="discount" value="{{ old('discount', $product->discount) }}" min="0" step="1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <p>Quantity:</p>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control form-control-sm" name="quantity" value="{{ old('quantity', $product->quantity) }}" min="0" step="1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <p>Status:</p>
                            </div>
                            <div class="col-md-9">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="{{ \App\Helper\ServiceAction::STATUS_ACTIVE }}" checked>
                                        Active
                                    </label>&emsp;&emsp;
                                    <label>
                                        <input type="radio" name="status" value="{{ \App\Helper\ServiceAction::STATUS_INACTIVE }}"
                                        @if($product->status == \App\Helper\ServiceAction::STATUS_INACTIVE) checked @endif>
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <p>Description:</p>
                            </div>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" id="editor">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body col-lg-4 list-img">
                        <br>
                        <div class="form-group row">
                            <a class="btn btn-primary btn-circle .btn-sm btn-action-img" id="add-img" title="Add Image">
                                <i class="white-text fas fa-plus"></i>
                            </a>
                            <a class="btn btn-primary btn-circle .btn-sm" id="delete-img" title="Delete Image">
                                <i class="white-text fas fa-minus"></i>
                            </a>
                        </div>
                        <?php
                            $listImages = \App\ImageDetailProduct::where('product_id', $product->id)->get();
                        ?>
                        @if(!isset($listImages) || count($listImages) == 0)
                        <div class="show-image" id="img-pro-0">
                            <div class="form-group row">
                                <input type="file" class="form-control-sm input-img-pro" id="input-img-pro-0" name="image[]">
                            </div>
                            <div class="form-group row display-img">
                                <img class="size-img-pro" src="#" id="img-show-pro-0" alt="Image">
                            </div>
                        </div>
                        @else
                            @foreach($listImages as $key => $listImage)
                                <div class="show-image" id="img-pro-{{ $key }}">
                                    <div class="form-group row">
                                        <input type="file" class="form-control-sm input-img-pro" id="input-img-pro-{{ $key }}" name="image[]">
                                    </div>
                                    <div class="form-group row display-img">
                                        <img class="size-img-pro" src="{{ $listImage->image }}" id="img-show-pro-{{ $key }}" alt="Image">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <input type="hidden" value="" name="srcImages" id="src-images">
                <div class="form-group" style="padding-left: 12px">
                    <button class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        } );
    </script>
    <script>
        // $( document ).ready(function() {
        //     updateListSrc();
        // });


    </script>
@endpush
