@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Thêm sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('product.index')}}">Sản phẩm</a></li>
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
        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="category_id" id="" class="form-control" value="{{old('category_id')}}" required>
                            <option value="">Vui lòng chọn danh mục</option>
                            @foreach($cate as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nhà xuất bản</label>
                        <select name="supplier_id" id="" class="form-control" value="{{old('supplier_id')}}" required>
                            <option value="">Vui lòng chọn nhà xuất bản</option>
                            @foreach($supplier as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tác giả</label>
                        <select name="author_id" id="" class="form-control" value="{{old('author_id')}}" required>
                            <option value="">Vui lòng chọn tác giả</option>
                            @foreach($author as $a)
                            <option value="{{$a->id}}">{{$a->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Hình</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Số trang sách</label>
                        <input type="number" class="form-control" name="number_of_pages"
                            value="{{old('number_of_pages')}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Sumary</label>
                        <input type="text" class="form-control" name="sumary" value="{{old('sumary')}}"
                            required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">sku</label>
                        <input type="text" class="form-control" name="sku" value="{{old('sku')}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Qty</label>
                        <input type="number" class="form-control" name="qty" value="{{old('qty')}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price" value="{{old('price')}}"
                            required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Discount</label>
                        <input type="number" class="form-control" name="discount" value="{{old('discount')}}"
                            placeholder="Nhập số 0 nếu không có giảm giá">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Images</label>
                        <input type="file" class="form-control" name="images">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Size</label>
                        <input type="text" class="form-control" value="{{old('size')}}" name="size">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Weight</label>
                        <input type="number" class="form-control" value="{{old('weight')}}" name="weight">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Alias</label>
                        <input type="text" class="form-control" value="{{old('alias')}}" name="alias">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Keyword</label>
                        <input type="text" class="form-control" value="{{old('keyword')}}" name="keyword">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Imgshare</label>
                        <input type="text" class="form-control" name="imgshare" value="{{old('imgshare')}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" value="{{old('title')}}" name="title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea id="demo" class="ckeditor" name="content">{{old('content')}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Desc</label>
                        <textarea id="demo" class="ckeditor"  name="desc">{{old('desc')}}</textarea>
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
                    <a href="{{route('product.index')}}" class="btn btn-warning">Quay về</a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
