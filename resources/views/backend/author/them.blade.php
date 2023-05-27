@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Thêm tác giả</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('category.index')}}">Tác giả</a></li>
            <li class="breadcrumb-item active">Thêm</li>
        </ol>
        <form action="{{route('author.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Tên tác giả</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Điện thoại</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Avatar</label>
                        <input type="file" class="form-control" name="avatar" required>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Sumary</label>
                        <input type="text" class="form-control" name="sumary" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label><br>
                        <label for="hien" class="mt-2">Hiện</label>
                        <input type="radio" id="hien" value="1" name="status" checked>
                        <label for="an">Ẩn</label>
                        <input type="radio" id="an" value="0" name="status">
                    </div>
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary">THÊM</button>
                    <a href="{{route('author.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
