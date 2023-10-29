@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách nhà xuất bản</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách nhà xuất bản</li>
        </ol>
        @if (session('mess'))
        <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng nhà xuất bản
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên nhà xuất bản</th>
                            <th>Hình ảnh</th>
                            <th>Điện thoại</th>
                            <th>Email</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($supplier as $su)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $su->name }}</td>
                            <td><img src="{{ asset('frontend/img/supplier/'.$su->image)}}" alt="" width="100px"></td>
                            <td>{{$su->phone}}</td>
                            <td>{{$su->email}}</td>
                            <td>
                                <a href="{{route('supplier.show',$su->id)}}" class="btn btn-info">Xem chi tiết</a>
                                <a href="{{route('supplier.edit',$su->id)}}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('supplier.destroy', $su->id) }}" method="POST"
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
