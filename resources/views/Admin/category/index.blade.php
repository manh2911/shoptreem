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
                        <a style="float: right" class="btn btn-primary btn-circle .btn-sm" title="Add" href="{{ route('admin.category.create')}}">
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
                                <input class="form-check-input" type="checkbox" id="select-all-item">
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Update</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" id="">
                            </td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
