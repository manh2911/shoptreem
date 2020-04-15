@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h2 class="h3 mb-4 text-gray-800">Categories</h2>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="{{ route('admin.user.action') }}" method="post">
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
                            <button id="submit-action" class="btn btn-primary form-control-sm">
                                <span class="text btn-submit-action">Submit</span>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a style="float: right" class="btn btn-primary btn-circle .btn-sm" title="Add" href="{{ route('admin.user.create')}}">
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
                                <input class="form-check-input chk-table" type="checkbox" id="select-all-item">
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Update</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <input class="form-check-input chk-table select-one-item" type="checkbox" id="{{ $user->id }}">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <?php
                                    if ($user->role == \App\User::ROLE_ADMIN) echo 'ADMIN';
                                    if ($user->role == \App\User::ROLE_MANAGEMENT) echo 'MANAGEMENT';
                                    if ($user->role == \App\User::ROLE_CLIENT) echo 'CLIENT';
                                ?>
                            </td>
                            <td>{{ isset($user->updated_at) ? date("d/m/Y", strtotime($user->updated_at)) : '' }}</td>
                            <td>
                                <a href="{{ route('admin.user.show', $user->id) }}">
                                    <i class="fas fa-eye" title="Profile"></i>
                                </a>
                                <a href="{{ route('admin.user.edit', $user->id) }}">
                                    <i class="fas fa-tools" title="Edit"></i>
                                </a>
                                <a href="{{ route('admin.user.delete', $user->id) }}" onclick="return confirmDelete()">
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
@push('scripts')
    <script src="{{ asset('Admin/js/ste-user.js') }}"></script>
@endpush
