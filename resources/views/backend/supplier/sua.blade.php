@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sửa nhà xuất bản</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('supplier.index')}}">Nhà xuất bản</a></li>
            <li class="breadcrumb-item active">Sửa</li>
        </ol>
        <form action="{{route('supplier.update',$supplier->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tên nhà xuất bản</label>
                        <input type="text" class="form-control" name="name" value="{{$supplier->name}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Điện thoại</label>
                        <input type="text" class="form-control" name="phone" value="{{$supplier->phone}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="{{$supplier->email}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control" name="image" >
                        <img src="{{ asset('frontend/img/supplier/'.$supplier->image) }}" alt="" width="100">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Logo</label>
                        <input type="file" class="form-control" name="logo">
                        <img src="{{ asset('frontend/img/supplier/'.$supplier->logo) }}" alt="" width="100">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Alias</label>
                        <input type="text" class="form-control" name="alias" value="{{$supplier->alias}}">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Keyword</label>
                        <input type="text" class="form-control" name="keyword" value="{{$supplier->keyword}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Imgshare</label>
                        <input type="text" class="form-control" name="imgshare" value="{{$supplier->imgshare}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" value="{{$supplier->title}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Desc</label>
                        <textarea id="demo" class="ckeditor" name="desc">{{$supplier->desc}}</textarea>
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
                    <button class="btn btn-primary">SỬA</button>
                    <a href="{{route('supplier.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
