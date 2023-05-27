@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container edit-account">
    <h5>CHI TIẾT ĐƠN HÀNG</h5>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <div class="p-2" style="background-color:#00CC66">
                <div class="mb-3"><a href="{{route('f.account')}}" class="text-light">QUẢN LÍ ĐƠN HÀNG</a></div>
                <div><a href="{{route('f.editaccount')}}" class="text-light">QUẢN LÍ TÀI KHOẢN</a></div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="bank mb-5">
                <h6>THÔNG TIN CHUYỂN KHOẢN</h6>
                <div>Số tài khoản: <span class="fw-bold">0000905627984</span></div>
                <div>Tên chủ tài khoản: <span class="fw-bold">NGUYEN PHUOC HAO</span></div>
                <div>Ngân hàng quân đội MBBANK</div>
                <div>Nội dung chuyển khoản: Ghi rõ mã số đơn hàng</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h6>Thông tin đơn hàng</h6>
                    <div>Mã số đơn hàng: {{$order->code}}</div>
                    <div>Trạng thái đặt hàng:
                        @if ($order->order_status==0)
                        <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                        @elseif($order->order_status==1)
                        <span class="badge bg-primary">Đang giao hàng</span>
                        @elseif($order->order_status==1)
                        <span class="badge bg-success">Đã giao hàng</span>
                        @else
                        <span class="badge bg-danger">Đã hủy đơn</span>
                        @endif
                    </div>
                    <div>Ngày đặt hàng: {{$order->order_date}}</div>
                    <div>Ghi chú: {{$order->notes==NULL?'Không có ghi chú':$order->notes}}</div>
                    <div>Phương thức thanh toán: <span class="fw-bold">{{$order->payment==0?'Giao hàng nhận tiền':'Chuyển khoản'}}</span></div>
                </div>
                <div class="col-md-6">
                    <h6>Thông tin khách hàng</span></h6>
                    <div>Tên khách hàng: <span class="fw-bold">{{$order->order_name}}</div>
                    <div>Email: {{$order->customer->email}}</div>
                    <div>Điện thoại: {{$order->order_phone}}</div>
                    <div>Địa chỉ: {{$order->order_address}}, {{$order->province->name}}, {{$order->district->name}}, {{$order->ward->name}}</div>
                </div>
            </div>
            <div class="table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="60%">Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total=0;
                        @endphp
                        @foreach($order->order_detai as $item)
                        @php
                            $subtotal=$item->qty*$item->price;
                            $total+=$subtotal;
                        @endphp
                        <tr>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{number_format($subtotal)}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-end">Phí vận chuyển:</td>
                            <td>{{number_format($order->shipping)}} đ</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                            <td class="fw-bold">{{number_format($order->total)}} đ</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection
