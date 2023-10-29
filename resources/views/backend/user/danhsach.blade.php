@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách admin</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách admin</li>
        </ol>
        @if (session('mess'))
        <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng admin
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Tên đăng nhập</th>
                            <th>Avatar</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Nhóm người dùng</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($user as $us)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $us->name }}</td>
                            <td>{{ $us->username }}</td>
                            <td><img src="{{ asset('frontend/img/user/'.$us->image) }}" alt="" width="70"></td>
                            <td>{{ $us->email }}</td>
                            <td>{{$us->phone}}
                            <td>{{$us->user_group->name}}</td>
                            <td>
                                @if ($us->status==0)
                                <span class="badge bg-danger">Khóa</span>
                                @else
                                <span class="badge bg-success">Kích hoạt</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('user.show',$us->id)}}" class="btn btn-info">Xem chi tiết</a>
                                <a href="{{route('user.edit',$us->id)}}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('user.destroy', $us->id) }}" method="POST"
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
