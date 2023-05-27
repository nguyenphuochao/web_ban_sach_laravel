@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container cart pt-4">
    <h4>GIỎ HÀNG</h4>
    <div>
        @if (session('mess'))
            <div class="text-{{session('type')}}">{{session('mess')}}</div>
        @endif
    </div>
    <hr>
    @if ($cart)
    <form action="{{ route('f.updatecart') }}" method="POST" id="form_id">
        @csrf
        @method('PUT')
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="10%">Sản phẩm</th>
                        <th width="50%">

                        </th>
                        <th width="5%">Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                    $total = 0;
                    @endphp
                    @foreach ($cart as $item)
                    <tr>
                        @php
                        $subtotal = $item['buyqty'] * $item['price_discount'];
                        if ($item['price_discount'] == 0) {
                        $subtotal = $item['buyqty'] * $item['price'];
                        }
                        $total += $subtotal;
                        @endphp
                        <td><img src="{{ asset('frontend/img/' . $item['image']) }}" alt="" width="80px">
                        </td>
                        <td>
                            <div class="fs-5">{{ $item['name'] }}</div>
                            <div>Mã SP: {{ $item['sku'] }} </div>
                            @if ($item['price_discount'] != 0)
                            <div class="text-danger fs-5 fw-bold">
                                {{ number_format($item['price_discount']) }} đ <span class="text-dark fs-6"><del>{{
                                        number_format($item['price']) }}</del>
                                    đ</span></div>
                            @else
                            <div class="text-danger fs-5 fw-bold">{{ number_format($item['price']) }} đ
                            </div>
                            @endif
                        </td>
                        <td>
                            <input type="number" id="buyqty" value="{{ $item['buyqty'] }}" name="cartqtybutton[{{ $item['id'] }}]">

                        </td>
                        <td class="fs-6">{{ number_format($subtotal) }} đ</td>
                        <td><a href="{{ route('f.deletecart', $item['id']) }}" onclick="return confirm('Bạn chắc xóa sản phẩm này?')"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-end">Tạm tính: <span class="fs-5 text-danger fw-bold">{{ number_format($total) }} đ</span>
        </div>
        <div class="text-end"><button class="btn btn-warning text-light btn-md w-25 mt-2" type="submit">CẬP NHẬT
                SẢN
                PHẨM</button></div>
        <div class="text-end"><a href="{{route('f.order')}}"><button class="btn btn-danger text-light btn-md w-25 mt-2" type="button">ĐẶT HÀNG</button></a></div>
        <div class="text-end"><a href="{{route('f.home')}}" class="btn btn-secondary text-black btn-md w-25 mt-2">CHỌN THÊM
                SẢN
                PHẨM</a></div>
        @else
        <h5>Giỏ hàng chưa có sản phẩm</h5>
        <div><a href="{{ route('f.home') }}">Quay về trang chủ mua sản phẩm đi nè</a></div>
        @endif
    </form>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('input[type=number]').change(function(){
            $('#form_id').submit();
        })
    });
</script>
@endsection
