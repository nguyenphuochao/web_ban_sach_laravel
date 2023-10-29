@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container login">
    <nav class="breadcrumb mb-0">
        <a class="breadcrumb-item" href="#">Nobita-Nhà sách</a>
        <span class="breadcrumb-item active" aria-current="page">Đăng nhập</span>
    </nav>
    <h4>Đăng nhập hoặc <span><a href="{{route('f.register')}}">Đăng kí</a></span></h4>
    <form action="{{route('f.post_login')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <h5>Đăng nhập bằng</h5>
                <a href=""><img src="{{ asset('frontend/img/fb_login.PNG') }}" alt="" width="180"></a>
            </div>
            <div class="col-md-8">
                <h5>Đăng nhập bằng tài khoản Nobita</h5>
                @if (session('alert'))
                    <div class="alert alert-{{session('type')}}" role="alert">
                        <strong>{{session('alert')}}</strong>
                    </div>

                @endif
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span>:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email tài khoản">
                </div>
                <div class="form-group">
                    <label for="password">Password <span class="text-danger">*</span>:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu">
                </div>
                <div><a href="">Quên mật khẩu</a></div>
                <div class="row pt-2">
                    <div class="col-md-4">
                        <button class="bg-nobita text-light fw-bold p-2 w-50">Đăng nhập</button>
                    </div>
                    <div class="col-md-8">
                        <a href="{{route('f.register')}}">Tạo tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
