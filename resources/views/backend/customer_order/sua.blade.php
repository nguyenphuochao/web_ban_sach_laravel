@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Cập nhật khách hàng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Cập nhật khách hàng</li>
        </ol>
        <form action="{{route('customer_order.update',$customer_order->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Tên khách hàng</label>
                        <input type="text" class="form-control" name="order_name" value="{{$customer_order->order_name}}">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Địa chỉ nhận</label>
                        <input type="text" class="form-control" name="order_address" value="{{$customer_order->order_address}}">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" class="form-control" name="order_phone" value="{{$customer_order->order_phone}}">
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary">CẬP NHẬT</button>
                    <a href="{{route('customer_order.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
