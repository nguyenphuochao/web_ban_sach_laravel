@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách đơn hàng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách đơn hàng</li>
        </ol>
        @if (session('mess'))
        <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng đơn hàng
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($order as $or)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $or->code }}</td>
                            <td>{{$or->order_name}}</td>
                            <td>{{$or->customer->email}}</td>
                            <td>{{number_format($or->total)}}</td>
                            <td>
                                @if ($or->order_status==0)
                                <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                @elseif($or->order_status==1)
                                <span class="badge bg-primary">Đang giao hàng</span>
                                @elseif($or->order_status==2)
                                <span class="badge bg-success">Đã giao hàng</span>
                                @else
                                <span class="badge bg-danger">Đã hủy đơn</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{route('order.edit',$or->id)}}" class="btn btn-warning">Xem chi tiết/cập nhật</a>
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
