@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Trả lời liên hệ</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Trả lời liên hệ</li>
        </ol>
        <form action="{{route('contact.update',$contact->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input type="text" class="form-control" readonly value="{{$contact->fullname}}" style="background-color:rgb(233, 230, 230)">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" readonly value="{{$contact->email}}" style="background-color:rgb(233, 230, 230)">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" readonly value="{{$contact->address}}" style="background-color:rgb(233, 230, 230)">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input type="text" class="form-control" readonly value="{{$contact->title}}" style="background-color:rgb(233, 230, 230)">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea name="content" id="" cols="30" rows="10" class="form-control" readonly style="background-color:rgb(233, 230, 230)">{{$contact->content}}</textarea>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Trả lời</label>
                      <textarea name="reply" id="" cols="30" rows="10" class="form-control">{{$contact->reply}}</textarea>
                    </div>
                </div>
                <div class="col-md-10 mt-4">
                    <div class="form-group">
                        <label for="">Trạng thái</label><br>
                        <label for="hien"><input type="radio" name="status" value="1" @if($contact->status==1) {{"checked"}}  @endif>Duyệt</label>
                        <label for="an"><input type="radio" name="status" value="0" @if($contact->status==0) {{"checked"}}  @endif>Chưa duyệt</label>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary">GỬI</button>
                    <a href="{{route('contact.index')}}" class="btn btn-dark">Trở về</a>

                </div>
            </div>
        </form>
    </div>
</main>
@endsection
