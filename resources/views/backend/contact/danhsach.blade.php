@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách liên hệ</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách liên hệ</li>
        </ol>
        @if (session('mess'))
        <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng liên hệ
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Tiêu đề</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($contact as $c)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{$c->fullname}}</td>
                            <td>{{$c->email}}</td>
                            <td>{{$c->address}}</td>
                            <td>{{$c->title}}</td>
                            <td>
                                @if ($c->status==1)
                                <span class="badge bg-success">Đã duyệt</span>
                                @else
                                <span class="badge bg-dark">Chờ duyệt</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('contact.edit',$c->id)}}" class="btn btn-warning">Cập nhật</a>
                                <form action="{{ route('contact.destroy', $c->id) }}" method="POST"
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
