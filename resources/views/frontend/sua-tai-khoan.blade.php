@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container edit-account">
    <h5>QUẢN LÍ TÀI KHOẢN</h5>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <div class="p-2" style="background-color:#00CC66">
                <div class="mb-3"><a href="{{route('f.account')}}" class="text-light">QUẢN LÍ ĐƠN HÀNG</a></div>
                <div><a href="{{route('f.editaccount')}}" class="text-light">QUẢN LÍ TÀI KHOẢN</a></div>
            </div>
        </div>
        <div class="col-md-10">
            <form action="{{route('f.updateaccount')}}" method="post">
                @csrf
                @if (session('mess'))
                    <div class="alert alert-success">{{session('mess')}}</div>
                @endif
                <div class="form-group">
                    <label for="">Họ tên</label>
                    <input type="text" class="form-control" name="name" value="@if(Auth::guard('frontend')->user()) {{Auth::guard('frontend')->user()->name}} @endif">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" disabled value="@if(Auth::guard('frontend')->user()) {{Auth::guard('frontend')->user()->email}} @endif">
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="@if(Auth::guard('frontend')->user()) {{Auth::guard('frontend')->user()->address}} @endif">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="text" class="form-control" placeholder="Nhập vào nếu muốn thay đổi mật khẩu" name="password">
                </div>
                <div class="form-group">
                    <label for="phone">Điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="@if(Auth::guard('frontend')->user()) {{Auth::guard('frontend')->user()->phone}} @endif">
                </div>
                <div class="form-group">
                    <label for="gender">Giới tính</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="0" @if(Auth::guard('frontend')->user() && Auth::guard('frontend')->user()->gender==0) {{"selected"}} @endif>Nam</option>
                        <option value="1" @if(Auth::guard('frontend')->user() && Auth::guard('frontend')->user()->gender==1) {{"selected"}} @endif>Nữ</option>
                        <option value="2" @if(Auth::guard('frontend')->user() && Auth::guard('frontend')->user()->gender==2) {{"selected"}} @endif>Giới tính khác</option>
                    </select>
                </div>
                <div class="mt-2">
                    <button class="btn btn-success">CẬP NHẬT</button>
                    <a href="{{route('f.account')}}" class="btn btn-secondary">QUAY VỀ</a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
