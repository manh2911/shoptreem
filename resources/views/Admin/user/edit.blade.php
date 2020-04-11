@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Edit User</h1>

        <div class="card shadow mb-4">
            <div class="panel-body col-lg-8">
                <form action="{{ route('admin.user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <br>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Role:</p>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control form-control-sm" name="role" required>
                                <option value="{{ \App\User::ROLE_MANAGEMENT }}">MANAGEMENT</option>
                                <option value="{{ \App\User::ROLE_ADMIN }}" <?php echo $user->role == \App\User::ROLE_ADMIN ? 'selected' : '' ?>>ADMIN</option>
                                <option value="{{ \App\User::ROLE_CLIENT }}" <?php echo $user->role == \App\User::ROLE_CLIENT ? 'selected' : '' ?>>CLIENT</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Name:</p>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control form-control-sm"  name="name" value="{{ $user->name }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Email:</p>
                        </div>
                        <div class="col-md-9">
                            <input type="email" class="form-control form-control-sm"  name="email" value="{{ $user->email }}" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <p>Avatar:</p>
                        </div>
                        <div class="col-md-9">
                            <input type="file" class="form-control-sm" id="input-img-avatar" name="image" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 offset-3">
                            <img class="img-slide-category" src="{{ $user->image }}" id="img-avatar" alt="Image">
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('scripts')

@endpush
