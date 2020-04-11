@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Profile</h1>

        <div class="card shadow mb-4">
            <div class="panel-body col-lg-12">
                <br>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-4">
                        <img class="img-slide-category" src="{{ isset($user->image) ? $user->image : \App\User::DEFAULT_AVATAR }}" id="img-avatar" alt="Image">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-4">
                        <?php $role = $user->role == \App\User::ROLE_ADMIN ? 'Admin' : $role = $user->role == \App\User::ROLE_MANAGEMENT ? 'Management' : 'Client'?>
                        <p><b>Role:</b> {{ $role }}</p>
                        <p><b>Name:</b> {{ $user->name }}</p>
                        <p><b>Email:</b> {{ $user->email }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-4">
                        <button id="change_password" class="btn btn-sm btn-primary">Change Password</button>
                    </div>
                </div>
                <form action="{{ route('admin.user.changePassword', $user->id) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <div class="form-group row">
                        <div class="col-md-4 offset-md-4">
                            <input type="password" class="form-control-sm change_pass" name="new_password" value="" placeholder="New Password" hidden required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 offset-md-4">
                            <input type="password" class="form-control-sm change_pass" name="re_new_password" value="" placeholder="Re New Password" hidden required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 offset-md-4">
                            <button class="btn btn-sm btn-primary change_pass" hidden>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('Admin/js/ste-user.js') }}"></script>
@endpush
