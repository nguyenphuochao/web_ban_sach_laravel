@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Xem chi tiết - {{$customer->name}}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('customer.index')}}">User-{{$customer->name}}</a></li>
            <li class="breadcrumb-item active">Xem chi tiết</li>
        </ol>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Họ tên</label>
                        <input type="text" class="form-control" name="name" value="{{$customer->name}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="{{$customer->email}}" readonly style="background-color: rgb(179, 174, 174)">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" value="{{$customer->address}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$customer->phone}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Giới tính</label>
                        <select name="gender" id="" class="form-control">
                            <option value="">Vui lòng chọn</option>
                            <option value="0" @if($customer->gender==0) {{"selected"}} @endif>Nam</option>
                            <option value="1" @if($customer->gender==1) {{"selected"}} @endif>Nữ</option>
                            <option value="2" @if($customer->gender==2) {{"selected"}} @endif>Giới tính khác</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Trạng thái</label><br>
                        <label for="kichhoat">Kích hoạt:<input type="radio" name="status" @if($customer->status==1) checked @endif  id="kichhoat" value="1"></label>
                        <label for="khoa">Khóa:<input type="radio" name="status" id="khoa" @if($customer->status==0) checked @endif value="0"></label>

                    </div>
                </div>

                <div class="mt-2">
                    <a href="{{route('customer.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
