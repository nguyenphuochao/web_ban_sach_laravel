@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Thêm admin</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('user.index')}}">Admin</a></li>
            <li class="breadcrumb-item active">Thêm</li>
        </ol>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Họ tên</label>
                        <input type="text" class="form-control" name="name" required value="{{old('name')}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="username" required value="{{old('username')}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nhóm quyền</label>
                        <select name="group_id" id="" class="form-control" required>
                            <option value="">Vui lòng chọn</option>
                            @foreach ($group_id as $g)
                            <option value="{{$g->id}}">{{$g->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" required value="{{old('email')}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" name="image" class="form-control">

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" class="form-control" name="password">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Trạng thái</label><br>
                        <label for="kichhoat">Kích hoạt:<input type="radio" name="status" checked id="kichhoat"
                                value="1"></label>
                        <label for="khoa">Khóa:<input type="radio" name="status" id="khoa" value="0"></label>

                    </div>
                </div>

                <div class="mt-2">
                    <button class="btn btn-primary">THÊM</button>
                    <a href="{{route('user.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
