@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Cập nhật đơn hàng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Cập nhật đơn</li>
        </ol>
        <h5>Thông tin khách hàng</h5>
        <div class="row customer">
            <div class="col-md-3">
                <p>Thông tin người đặt hàng:</p>
                <p>Ngày đặt hàng:</p>
                <p>Số điện thoại:</p>
                <p>Địa chỉ:</p>
                <p>Email:</p>
                <p>Ghi chú:</p>
                <p>Phương thức thanh toán</p>
            </div>
            <div class="col-md-9">
                <p>{{$order->order_name}}</p>
                <p>{{$order->order_date}}</p>
                <p>{{$order->order_phone}}</p>
                <p>{{$order->order_address}},{{$order->province->name}},{{$order->district->name}},{{$order->ward->name}}</p>
                <p>{{$order->customer->email}}</p>
                <p>{{$order->notes==NULL?'Ko có ghi chú':$order->notes}}</p>
                <p>
                    {{$order->payment==0?'Nhận hàng đưa tiền':'Chuyển khoản'}}
                </p>
            </div>
        </div>
        <div class="product">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count=1;
                        $total=0;
                    @endphp
                    @foreach ($product as $pro)
                    @php
                        $sub=$pro->qty*$pro->price;
                        $total+=$sub;
                    @endphp
                        <tr>
                            <td>{{$count++}}</td>
                            <td>{{$pro->product->name}}</td>
                            <td>{{$pro->qty}}</td>
                            <td>{{number_format($pro->price)}}</td>
                            <td>{{number_format($sub)}} VNĐ</td>
                        </tr>
                    @endforeach

                </tbody>
                <tr>
                    <th colspan="4">Phí ship:</th>
                    <td>{{number_format($order->shipping)}} VNĐ</td>
                </tr>
                <tr>
                    <th colspan="4">Tổng tiền:</th>
                    <th class="text-danger">{{number_format($total+$order->shipping)}} VNĐ</th>
                </tr>
            </table>
        </div>
        <div class="status-order">
            <form action="{{route('order.update',$order->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="text-end">
                    <span>Trạng thái đơn hàng:</span>
                    <select name="order_status" id="" style="width:200px;height:33px;border-color:rgb(21, 22, 22)">
                        <option value="0" @if($order->order_status==0) {{"selected"}} @endif>Chờ xác nhận</option>
                        <option value="1" @if($order->order_status==1) {{"selected"}} @endif>Đang giao hàng</option>
                        <option value="2" @if($order->order_status==2) {{"selected"}} @endif>Đã nhận hàng</option>
                        <option value="3" @if($order->order_status==3) {{"selected"}} @endif>Đã hủy đơn</option>
                    </select>
                    <button class="btn btn-primary btn-md mb-1">Xử lý</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
