@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container order_finish">
    <div class="check"><i class="fa-solid fa-check"></i></div>
    <h3>ĐĂNG KÍ MUA HÀNG THÀNH CÔNG!</h3>
    <p class="fw-bold">Thông tin hóa đơn đã gửi vào email của bạn</p>
    <p>Cảm ơn bạn đã mua hàng tại Nobita.vn </p>
    <p>Bộ phận phụ trách sẽ chủ động liên hệ bạn trong thời gian sớm nhất có thể. Trong trường hợp cần gấp vui lòng gọi Holine:
        <span class="fw-bold text-danger">058.4228.904</span></p>
        <p>Chân thành cảm ơn</p>
    <div>
        <a href="{{route('f.home')}}" class="btn btn-success">VỀ TRANG CHỦ</a>
    </div>
</div>
@endsection
