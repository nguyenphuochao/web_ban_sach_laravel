@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách phân quyền</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách phân quyền</li>
        </ol>
        @if (session('mess'))
        <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng phân quyền
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Avatar</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Nhóm người dùng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($role as $r)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $r->name }}</td>
                            <td><img src="{{ asset('frontend/img/user/'.$r->image) }}" alt="" width="70"></td>
                            <td>{{ $r->email }}</td>
                            <td>{{$r->phone}}
                            <td>{{$r->user_group->name}}</td>
                            <td>
                                <a href="{{route('role.edit',$r->id)}}" class="btn btn-warning">Phân quyền</a>
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
