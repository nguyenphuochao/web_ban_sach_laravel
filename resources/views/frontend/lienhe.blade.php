@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container contact">
    <nav class="breadcrumb mb-0">
        <a class="breadcrumb-item" href="#">Nobita-Nhà sách</a>
        <span class="breadcrumb-item active" aria-current="page">Liên hệ</span>
    </nav>
    <h2>Liên hệ</h2>
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.756437334395!2d106.68132261023571!3d10.753245289349879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ee1ff354f3f%3A0x18f40d9f2c7f8e18!2zVHJ1bmcgVMOibSBUaW4gSOG7jWMgLSDEkEggS2hvYSBI4buNYyBU4buxIE5oacOqbiAoQ1MyKQ!5e0!3m2!1svi!2s!4v1682063178526!5m2!1svi!2s"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    <div class="about-contact pt-5">
        <h4>NOBITA.VN</h4>
        <div>NOBITA.VN</div>
        <div>Địa chỉ:21-23 Đ. Nguyễn Biểu, Phường 1, Quận 5, Thành phố Hồ Chí Minh
            700000</div>
        <div>Tel : 0938 424 289</div>
    </div>
    <div class="contact-form pt-5">
        <h4>GỬI THÔNG TIN</h4>
        @if (session('alert'))
            <div class="alert alert-{{session('type')}}">{{session('alert')}}</div>
        @endif
        <form action="{{route('f.mail')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="fullname"><strong>Họ và tên(*)</strong></label>
                <input type="text" class="form-control" name="fullname" id="fullname" required>
            </div>
            <div class="form-group">
                <label for="email"><strong>Email(*)</strong></label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="address"><strong>Địa chỉ</strong></label>
                <input type="text" class="form-control" name="address" id="address" required>
            </div>
            <div class="form-group">
                <label for="title"><strong>Tiêu đề(*)</strong></label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="desc"><strong>Nội dung(*)</strong></label><br>
                <textarea name="content" id="" cols="150" rows="10" class="form-control" required></textarea>
            </div>
            <div class="pt-2">
                <button class="btn btn-success">GỬI</button>
            </div>
        </form>
    </div>
</div>
@endsection
