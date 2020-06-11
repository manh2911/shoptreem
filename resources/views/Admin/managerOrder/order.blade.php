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
                            @if($order->status == \App\Helper\ServiceAction::ORDER_CANCEL)
                            <tr id="order-{{$order->id}}" style="background-color:  lightgray">
                            @elseif($order->status == \App\Helper\ServiceAction::ORDER_SUCCESS)
                            <tr id="order-{{$order->id}}" style="background-color: lightgreen">
                            @else
                            <tr id="order-{{$order->id}}">
                            @endif
                                <td>{{ $key+1 }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ number_format($order->total_price) . ' đ' }}</td>
                                <td id="status-{{$order->id}}">{{ \App\Helper\ServiceAction::showStatusOrder($order->status) }}</td>
                                <td>
                                    <button data-id="{{ $order->id }}" type="button" class="btn btn-success status-success"
                                            id="btn-success-{{$order->id}}"
                                            @if($order->status != \App\Helper\ServiceAction::ORDER_IN_PROCESS) disabled @endif>
                                        Success
                                    </button>
                                    <button data-id="{{ $order->id }}" type="button" class="btn btn-warning status-cancel"
                                            id="btn-cancel-{{$order->id}}"
                                            @if($order->status != \App\Helper\ServiceAction::ORDER_IN_PROCESS) disabled @endif>
                                        Cancel
                                    </button>
                                </td>
                                <td><button data-id="{{ $order->id }}" class="btn btn-info show-detail">Detail Order {{$order->id}}</button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @include('Admin.managerOrder.order_item')
@endsection
