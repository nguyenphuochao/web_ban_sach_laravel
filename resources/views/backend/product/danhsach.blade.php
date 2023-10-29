@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('b.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
        </ol>
        @if (session('mess'))
            <div class="alert alert-success">{{session('mess')}}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng sản phẩm
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>% giảm</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($product as $pro)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $pro->name }}</td>
                            <td>
                                <img src="{{ asset('frontend/img/' . $pro->image) }}" alt="" width="100px">
                            </td>
                            <td>{{ $pro->qty }}</td>
                            <td>
                                @if ($pro->discount == 0)
                                {{ number_format($pro->price) }}
                                @else
                                <div>{{ number_format($pro->price - ($pro->price * $pro->discount) / 100) }}</div>
                                <div><del>{{ number_format($pro->price) }}</del></div>
                                @endif

                            </td>
                            <td>
                                {{ $pro->discount }}%
                            </td>
                            <td>
                                <a href="{{route('product.show',$pro->id)}}" class="btn btn-info">Xem chi tiết</a>
                                <a href="{{route('product.edit',$pro->id)}}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('product.destroy', $pro->id) }}" method="POST"
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
