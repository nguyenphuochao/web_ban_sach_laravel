@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sửa danh mục</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('category.index')}}">Danh mục</a></li>
            <li class="breadcrumb-item active">Sửa</li>
        </ol>
        <form action="{{route('category.update',$cate_item->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="text" class="form-control" name="name" value="{{$cate_item->name}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Sumary</label>
                        <input type="text" class="form-control" name="sumary" value="{{$cate_item->sumary}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Hình</label>
                        <input type="file" class="form-control" name="image">
                        <img src="{{ asset('frontend/img/category/'.$cate_item->image) }}" alt="" width="100px">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Alias</label>
                        <input type="text" class="form-control" name="alias" value="{{$cate_item->alias}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Keyword</label>
                        <input type="text" class="form-control" name="keyword" value="{{$cate_item->keyword}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Imgshare</label>
                        <input type="text" class="form-control" name="imgshare" value="{{$cate_item->imgshare}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" value="{{$cate_item->title}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Parent</label>
                        <select name="parent_id" id="parent" class="form-control">
                            <option value="0">Không có cha</option>
                            @foreach ($category as $cate)
                            <option value="{{$cate->id}}" @if ($cate_item->parent_id==$cate->id)
                                {{"selected"}}
                                @endif
                                >{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea id="demo" class="ckeditor" name="content">{{$cate_item->content}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Desc</label>
                        <textarea id="demo" class="ckeditor" name="desc">{{$cate_item->desc}}</textarea>
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
                    <a href="{{route('category.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
