@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách user</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách user</li>
        </ol>
        @if (session('mess'))
        <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng user
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Giới tính</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($customer as $cus)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $cus->name }}</td>
                            <td>{{ $cus->email }}</td>
                            <td>{{$cus->phone}}
                            <td>
                                @if ($cus->gender==0)
                                Nam
                                @elseif($cus->gender==1)
                                Nữ
                                @else
                                Giói tính khác
                                @endif
                            </td>
                            <td>
                                @if ($cus->status==0)
                                <span class="badge bg-danger">Khóa</span>
                                @else
                                <span class="badge bg-success">Kích hoạt</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('customer.show',$cus->id)}}" class="btn btn-info">Xem chi tiết</a>
                                <a href="{{route('customer.edit',$cus->id)}}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('customer.destroy', $cus->id) }}" method="POST"
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
