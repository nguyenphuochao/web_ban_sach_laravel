@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách danh mục</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách danh mục</li>
        </ol>
        @if (session('mess'))
        <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng danh mục
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên danh mục</th>
                            <th>Bản tóm tắt</th>
                            <th>Hình</th>
                            <th>Danh mục cha</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($category as $cate)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $cate->name }}</td>
                            <td>{{ $cate->sumary}}</td>
                            <td><img src="{{ asset('frontend/img/category/'.$cate->image)}}" alt="" width="100px"></td>
                            <td>
                                @if ($cate->parent_id==0)
                                    Không có cha
                                @else
                                    {{$cate->parent->name}}
                                @endif
                            </td>
                            <td>
                                <a href="{{route('category.show',$cate->id)}}" class="btn btn-info">Xem chi tiết</a>
                                <a href="{{route('category.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('category.destroy', $cate->id) }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Bạn chắc xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</main>
@endsection
