@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container account">
    <h5>QUẢN LÍ ĐƠN HÀNG</h5>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <div class="p-2" style="background-color:#00CC66">
                <div class="mb-3"><a href="" class="text-light">QUẢN LÍ ĐƠN HÀNG</a></div>
                <div><a href="{{route('f.editaccount')}}" class="text-light">QUẢN LÍ TÀI KHOẢN</a></div>
            </div>
        </div>
        <div class="col-md-10">
            <div>DANH SÁCH ĐƠN HÀNG</div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Người đặt</th>
                        <th>Số điện thoại</th>
                        <th>Tổng cộng</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết đơn</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    @php
                    $count=1;
                    @endphp
                    @foreach($customer->order as $item)
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->order_name}}</td>
                        <td>{{$item->order_phone}}</td>
                        <td>{{number_format($item->total)}} đ</td>
                        <td>
                            @if ($item->order_status==0)
                            <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                            @elseif($item->order_status==1)
                            <span class="badge bg-primary">Đang giao hàng</span>
                            @elseif($item->order_status==1)
                            <span class="badge bg-success">Đã giao hàng</span>
                            @else
                            <span class="badge bg-danger">Đã hủy đơn</span>
                            @endif
                        </td>
                        <td><a href="{{route('f.detail_order',$item->id)}}">Xem <i class="fa-solid fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
