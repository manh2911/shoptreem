@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <h2 class="h3 mb-4 text-gray-800">Orders</h2>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Total Price</th>
                            <th>Status Now</th>
                            <th>Change Status</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key => $order)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ number_format($order->total_price) . ' đ' }}</td>
                                <td>In Process</td>
                                <td>
                                    <button type="button" class="btn btn-success">Success</button>
                                    <button type="button" class="btn btn-warning">Cancel</button>
                                </td>
                                <td><i class="fa fa-arrow-right" aria-hidden="true"></i></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
