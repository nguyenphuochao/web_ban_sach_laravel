@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Trả lời bình luận</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Trả lời bình luận</li>
        </ol>
        <form action="{{route('comment.update',$comment->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" readonly value="{{$comment->product->name}}" style="background-color:rgb(233, 230, 230)">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Tên khách hàng</label>
                        <input type="text" class="form-control" readonly value="{{$comment->customer->name}}" style="background-color:rgb(233, 230, 230)">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" readonly value="{{$comment->customer->email}}" style="background-color:rgb(233, 230, 230)">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Nội dung khách hàng</label>
                        <textarea name="" id="" cols="30" rows="10" class="form-control" readonly style="background-color:rgb(233, 230, 230)">{{$comment->desc}}</textarea>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Trả lời</label>
                        <textarea name="reply" class="ckeditor">{{$comment->reply}}</textarea>
                    </div>
                </div>
                <div class="col-md-10 mt-4">
                    <div class="form-group">
                        <label for="">Trạng thái</label><br>
                        <label for="hien"><input type="radio" name="status" value="1" @if($comment->status==1) {{"checked"}}  @endif>Hiện</label>
                        <label for="an"><input type="radio" name="status" value="0" @if($comment->status==0) {{"checked"}}  @endif>Ẩn</label>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary">GỬI</button>
                    <a href="{{route('comment.index')}}" class="btn btn-dark">Trở về</a>

                </div>
            </div>
        </form>
    </div>
</main>
@endsection
