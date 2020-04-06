@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h2 class="h3 mb-4 text-gray-800">Categories</h2>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-3">
                        <select class="form-control form-control-sm">
                            <option value="0">Choose action</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-primary form-control-sm">
                            <span class="text">Submit</span>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a style="float: right" class="btn btn-primary btn-circle .btn-sm" title="Add" href="{{ route('admin.user.create')}}">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>
                                <input class="form-check-input chk-table" type="checkbox" id="select-all-item">
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Update</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <input class="form-check-input chk-table select-one-item" type="checkbox" id="">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->update }}</td>
                            <td>
                                <a href="#">
                                    <i class="fas fa-tools" title="Edit"></i>
                                </a>
                                <a href="#">
                                    <i class="fas fa-trash" title="Delete"></i>
                                </a>
{{--                                <a href="#">--}}
{{--                                    <i class="fas fa-check-circle" title="Active"></i>--}}
{{--                                </a>--}}
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
