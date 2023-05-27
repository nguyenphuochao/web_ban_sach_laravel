@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container register">
    <nav class="breadcrumb mb-0">
        <a class="breadcrumb-item" href="#">Nobita-Nhà sách</a>
        <span class="breadcrumb-item active" aria-current="page">Đăng nhập</span>
    </nav>
    <h4>Đăng ký hoặc <span><a href="{{route('f.login')}}">Đăng nhập</a></span></h4>
    <form action="{{route('f.post_register')}}" method="post">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <h5>Đăng nhập bằng</h5>
                <a href=""><img src="{{ asset('frontend/img/fb_login.PNG') }}" alt="" width="180"></a>
            </div>
            <div class="col-md-8">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('mess'))
                    <div class="alert alert-success">{{session('mess')}}</div>
                @endif
                <h5>Thông Tin Đăng Ký</h5>
                <hr>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span>:</label>
                    <input type="email" name="email" id="email" class="form-control" required value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu <span class="text-danger">*</span>:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="repassword">Xác nhận mật khẩu <span class="text-danger">*</span>:</label>
                    <input type="password" name="repassword" id="repassword" class="form-control" required>
                </div>
                <h5 class="pt-3">Thông tin Cá Nhân</h5>
                <hr>
                <div class="form-group">
                    <label for="fullname">Họ và tên <span class="text-danger">*</span>:</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" required
                        value="{{old('fullname')}}">
                </div>
                <div class="form-group">
                    <label for="gender">Giới tính <span class="text-danger"></span>:</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="0">Nam</option>
                        <option value="1">Nữ</option>
                        <option value="2">Giới tính khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Điện thoại <span class="text-danger">*</span>:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone')}}">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" name="address" id="address" class="form-control" required
                        value="{{old('address')}}">
                </div>
                <div class="pt-2">
                    <button class="btn btn-success">Đăng ký</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
