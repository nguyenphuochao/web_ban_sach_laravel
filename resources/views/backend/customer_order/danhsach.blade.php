@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách khách hàng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách khách hàng</li>
        </ol>
        @if (session('mess'))
        <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng khách hàng
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Phone</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($customer_order as $cus_order)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $cus_order->order_name }}</td>
                            <td>{{ $cus_order->customer->email }}</td>
                            <td>{{$cus_order->order_address}}
                            <td>{{ $cus_order->order_phone }}</td>
                            <td>
                                <a href="{{route('customer_order.edit',$cus_order->id)}}" class="btn btn-warning">Sửa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
