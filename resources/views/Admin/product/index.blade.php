@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h2 class="h3 mb-4 text-gray-800">Products</h2>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="{{ route('admin.product.action') }}" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="arr_chk" id="arr_chk" value="">
                        <div class="col-md-3">
                            <select class="form-control form-control-sm" name="action" id="action">
                                <option value="0">Choose action</option>
                                <option value="{{ \App\Helper\ServiceAction::ACTION_DELETE }}">Delete</option>
                                <option value="{{ \App\Helper\ServiceAction::ACTION_ACTIVE }}">Active</option>
                                <option value="{{ \App\Helper\ServiceAction::ACTION_INACTIVE }}">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary form-control-sm">
                                <span class="text white-text">Submit</span>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a style="float: right" class="btn btn-primary btn-circle .btn-sm" title="Add" href="{{ route('admin.product.create')}}">
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
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Update</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <input class="form-check-input chk-table select-one-item" type="checkbox" id="{{ $product->id }}">
                                </td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category_id }}</td>
                                <td>{{ $product->origin_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ isset($product->updated_at) ? date("d/m/Y", strtotime($product->updated_at)) : '' }}</td>
                                <td>
                                    <a href="{{ route('admin.product.edit', $product->id) }}">
                                        <i class="fas fa-tools" title="Edit"></i>
                                    </a>
                                    <a href="{{ route('admin.product.delete', $product->id) }}" onclick="return confirmDelete()">
                                        <i class="fas fa-trash" title="Delete"></i>
                                    </a>
                                    @if($product->status == \App\Helper\ServiceAction::STATUS_ACTIVE)
                                        <a href="{{ route('admin.product.inactive', $product->id) }}" onclick="return confirmInactive()">
                                            <i class="fas fa-eye" title="Active"></i>
                                        </a>
                                    @elseif($product->status == \App\Helper\ServiceAction::STATUS_INACTIVE)
                                        <a href="{{ route('admin.product.active', $product->id) }}" onclick="return confirmActive()">
                                            <i class="fas fa-eye-slash" title="Inactive"></i>
                                        </a>
                                    @endif
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
