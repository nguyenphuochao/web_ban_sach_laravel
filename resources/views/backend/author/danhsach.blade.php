@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách tác giả</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách tác giả</li>
        </ol>
        @if (session('mess'))
        <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng tác giả
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên tác giả</th>
                            <th>Điện thoại</th>
                            <th>Hình</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Mô tả ngắn</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($author as $au)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $au->name }}</td>
                            <td>{{ $au->phone}}</td>
                            <td><img src="{{ asset('frontend/img/author/'.$au->avatar)}}" alt="" width="80"></td>
                            <td>{{$au->email}}</td>
                            <td>{{$au->address}}</td>
                            <td>{{$au->sumary}}</td>
                            <td>
                                <a href="{{route('author.show',$au->id)}}" class="btn btn-info">Xem chi tiết</a>
                                <a href="{{route('author.edit',$au->id)}}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('author.destroy', $au->id) }}" method="POST"
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
