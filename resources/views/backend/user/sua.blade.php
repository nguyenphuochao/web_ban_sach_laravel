@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sửa admin</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('user.index')}}">Admin</a></li>
            <li class="breadcrumb-item active">Sửa</li>
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
        <form action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Họ tên</label>
                        <input type="text" class="form-control" name="name" required value="{{$user->name}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="username" readonly value="{{$user->username}}"
                             style="background-color: rgb(218, 208, 208)">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nhóm quyền</label>
                        <select name="group_id" id="" class="form-control" required>
                            <option value="">Vui lòng chọn</option>
                            @foreach ($group_id as $g)
                            <option value="{{$g->id}}" @if ($user->group_id==$g->id)
                                {{"selected"}}
                                @endif
                                >{{$g->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="{{$user->email}}" readonly
                            style="background-color: rgb(218, 208, 208)">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{ asset('frontend/img/user/'.$user->image) }}" alt="" width="100">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" class="form-control" name="password"
                            placeholder="Nhập vào nếu muốn đổi password">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Trạng thái</label><br>
                        <label for="kichhoat">Kích hoạt:<input type="radio" name="status" @if($user->status==1)
                            {{"checked"}} @endif id="kichhoat"
                            value="1"></label>
                        <label for="khoa">Khóa:<input type="radio" name="status" @if($user->status==0) {{"checked"}}
                            @endif id="khoa" value="0"></label>

                    </div>
                </div>

                <div class="mt-2">
                    <button class="btn btn-primary">Sửa</button>
                    <a href="{{route('user.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
