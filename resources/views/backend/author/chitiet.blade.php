@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Xem chi tiết - {{$author->name}}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('category.index')}}">Tác giả - {{$author->name}}</a></li>
            <li class="breadcrumb-item active">Xem chi tiết</li>
        </ol>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Tên tác giả</label>
                        <input type="text" class="form-control" name="name" value="{{$author->name}}">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Điện thoại</label>
                        <input type="text" class="form-control" name="phone" value="{{$author->phone}}">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Avatar</label>
                        <input type="file" class="form-control" name="avatar">
                        <img src="{{ asset('frontend/img/author/'.$author->avatar) }}" alt="" width="100">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" value="{{$author->address}}">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="{{$author->email}}">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Sumary</label>
                        <input type="text" class="form-control" name="sumary" value="{{$author->sumary}}" required>
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
                    <a href="{{route('author.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
