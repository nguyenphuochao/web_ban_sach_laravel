@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sửa danh mục tin tức</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('article_group.index')}}">Sửa danh mục tin tức</a></li>
            <li class="breadcrumb-item active">Sửa</li>
        </ol>
        <form action="{{route('article_group.update',$article_group->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tên bài viết</label>
                        <input type="text" class="form-control" name="name" required value="{{$article_group->name}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Danh mục cha</label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="0">Không có cha</option>
                            @foreach ($parent_id as $ar)
                            <option value="{{$ar->id}}"
                            @if ($article_group->parent_id==$ar->id)
                              {{"selected"}}
                            @endif
                            >{{$ar->name}}</option>a
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Hình</label>
                        <input type="file" class="form-control" name="image">
                        <img src="{{ asset('frontend/img/news',$article_group->image) }}" alt="" width="100">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Sumary</label>
                        <input type="text" class="form-control" name="sumary" required value="{{$article_group->sumary}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Alias</label>
                        <input type="text" class="form-control" name="alias" value="{{$article_group->alias}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Keyword</label>
                        <input type="text" class="form-control" name="keyword" value="{{$article_group->keyword}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Imgshare</label>
                        <input type="text" class="form-control" name="imgshare" value="{{$article_group->imgshare}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" value="{{$article_group->title}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea id="demo" class="ckeditor" name="content" required>{{$article_group->content}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Desc</label>
                        <textarea id="demo" class="ckeditor" name="desc">{{$article_group->desc}}</textarea>
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
                    <a href="{{route('article_group.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
