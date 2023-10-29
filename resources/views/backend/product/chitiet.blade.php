@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Xem chi tiết - {{$product->name}}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('product.index')}}">Sản phẩm - {{$product->name}}</a></li>
            <li class="breadcrumb-item active">Xem chi tiết</li>
        </ol>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="category_id" id="" class="form-control">
                            <option value="">Vui lòng chọn danh mục</option>
                            @foreach($cate as $c)
                            <option value="{{$c->id}}"
                            @if ($product->category_id==$c->id)
                              {{"selected"}}
                            @endif
                                >{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nhà xuất bản</label>
                        <select name="supplier_id" id="" class="form-control">
                            <option value="">Vui lòng chọn nhà xuất bản</option>
                            @foreach($supplier as $s)
                            <option value="{{$s->id}}"
                                @if ($product->supplier_id==$s->id)
                                {{"selected"}}
                              @endif
                                >{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tác giả</label>
                        <select name="author_id" id="" class="form-control">
                            <option value="">Vui lòng chọn tác giả</option>
                            @foreach($author as $a)
                            <option value="{{$a->id}}"
                                @if ($product->author_id==$a->id)
                                {{"selected"}}
                              @endif
                                >{{$a->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Hình</label>
                        <input type="file" class="form-control" name="image">
                        <img src="{{ asset('frontend/img/'.$product->image) }}" alt="" width="100">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Số trang sách</label>
                        <input type="text" class="form-control" name="number_of_pages" value="{{$product->number_of_pages}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Sumary</label>
                        <input type="text" class="form-control" name="sumary" value="{{$product->sumary}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">sku</label>
                        <input type="text" class="form-control" name="sku" value="{{$product->sku}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Qty</label>
                        <input type="text" class="form-control" name="qty" value="{{$product->qty}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Discount</label>
                        <input type="text" class="form-control" name="discount" value="{{$product->discount}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Images</label>
                        <input type="file" class="form-control" name="images" value="{{$product->images}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Size</label>
                        <input type="text" class="form-control" name="size" value="{{$product->size}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Weight</label>
                        <input type="text" class="form-control" name="weight" value="{{$product->weight}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Alias</label>
                        <input type="text" class="form-control" name="alias" value="{{$product->alias}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Keyword</label>
                        <input type="text" class="form-control" name="keyword" value="{{$product->keyword}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Imgshare</label>
                        <input type="text" class="form-control" name="imgshare" value="{{$product->imgshare}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" value="{{$product->title}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea id="demo" class="ckeditor" name="content">{{$product->content}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Desc</label>
                        <textarea id="demo" class="ckeditor" name="desc">{{$product->desc}}</textarea>
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
                    <a href="{{route('product.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
