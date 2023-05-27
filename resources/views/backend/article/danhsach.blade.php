@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách tin tức</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách tin tức</li>
        </ol>
        @if (session('mess'))
            <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng tin tức
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên bài viết</th>
                            <th>Hình</th>
                            <th>Mô tả ngắn</th>
                            <th>Danh mục bài viết</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($article as $ar)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $ar->name }}</td>
                            <td>
                                <img src="{{ asset('frontend/img/news/' . $ar->image) }}" alt="" width="100px">
                            </td>
                            <td>{{$ar->sumary}}</td>
                            <td>{{ $ar->article_group->name }}</td>

                            <td>
                                <a href="{{route('article.edit',$ar->id)}}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('article.destroy', $ar->id) }}" method="POST"
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
