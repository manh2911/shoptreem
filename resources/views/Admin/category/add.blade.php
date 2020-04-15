@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Add Category</h1>
        <div class="card shadow mb-4">
            <div class="panel-body col-lg-8">
                <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Parent Category:</p>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control form-control-sm" name="parent_id" required>
                                <option value="0">Choose parent category</option>
                                <?php cate_parent($parents) ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Name:</p>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control form-control-sm"  name="name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Image Icon:</p>
                        </div>
                        <div class="col-md-9">
                            <input type="file" class="form-control-sm" id="input-img-icon" name="imageIcon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 offset-3">
                            <img class="img-icon-category" src="#" id="img-icon" alt="Image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Image Slide:</p>
                        </div>
                        <div class="col-md-9">
                            <input type="file" class="form-control-sm " id="input-img-slide" name="imageSlide">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 offset-3">
                            <img class="img-slide-category" src="#" id="img-slide" alt="Image">
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
