@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h2 class="h3 mb-4 text-gray-800">Categories</h2>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="{{ route('admin.category.action') }}" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="arr_chk" id="arr_chk" value="">
                        <div class="col-md-3">
                            <select class="form-control form-control-sm" name="action" id="action">
                                <option value="0">Choose action</option>
                                <option value="{{ \App\Helper\ServiceAction::ACTION_DELETE }}">Delete</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary form-control-sm">
                                <span class="text white-text">Submit</span>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a style="float: right" class="btn btn-primary btn-circle .btn-sm" title="Add" href="{{ route('admin.category.create')}}">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>
                                <input class="form-check-input chk-table select-all-item" type="checkbox" id="select-all-item">
                            </th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Parent ID</th>
                            <th>Update</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <input class="form-check-input chk-table select-one-item" type="checkbox" id="{{ $category->id }}">
                                </td>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->parent_id }}</td>
                                <td>{{ isset($category->updated_at) ? date("d/m/Y", strtotime($category->updated_at)) : '' }}</td>
                                <td>
                                    <a href="{{ route('admin.category.edit', $category->id) }}">
                                        <i class="fas fa-tools" title="Edit"></i>
                                    </a>
                                    <a href="{{ route('admin.category.delete', $category->id) }}" onclick="return confirmDelete()">
                                        <i class="fas fa-trash" title="Delete"></i>
                                    </a>
{{--                                    <a href="#">--}}
{{--                                        <i class="fas fa-check-circle" title="Active"></i>--}}
{{--                                    </a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
