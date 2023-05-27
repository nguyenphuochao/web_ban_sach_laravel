@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container order">
    <h4>ĐẶT HÀNG</h4>
    @if (session('mess'))
    <div class="alert alert-success">{{ session('mess') }}</div>
    @endif
    <hr>
    <form action="{{ route('f.save_order') }}" method="post">
        @csrf
        @if (session('mess'))
        <div class="alert alert-{{session('type')}}">{{session('mess')}}</div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <h5>THÔNG TIN ĐƠN HÀNG</h5>
                <div class="form-group">
                    <label for=""><strong>Họ và tên: <span>(*)</span></strong></label>
                    <input type="text" placeholder="Họ và tên" class="form-control" name="order_name"
                        @if(Auth::guard('frontend')->user()) value="{{Auth::guard('frontend')->user()->name }}" @endif required >
                </div>
                <div class="form-group">
                    <label for=""><strong>Điện thoại: <span>(*)</span></strong></label>
                    <input type="text" placeholder="Số điện thoại" class="form-control" name="order_phone"
                        @if(Auth::guard('frontend')->user()) value="{{ Auth::guard('frontend')->user()->phone }}" @endif required>
                </div>
                <div class="form-group">
                    <label for=""><strong>Email: <span>(*)</span></strong></label>
                    <input type="text" placeholder="Email để nhận thông báo đơn hàng" class="form-control" name="email"
                        @if(Auth::guard('frontend')->user()) value=" {{ Auth::guard('frontend')->user()->email }}"
                    readonly @endif style="background-color:#c7bdbd" required>
                </div>

                <div class="form-group">
                    <label for=""><strong>Địa chỉ nhận: <span>(*)</span></strong></label>
                    <input type="text" placeholder="Địa chỉ nhận" class="form-control" name="order_address"@if(Auth::guard('frontend')->user())
                    value="{{Auth::guard('frontend')->user()->address }}" @endif required>
                </div>
                <div class="form-group">
                    <label for="province"><strong>Tỉnh/Thành: <span>(*)</span></strong></label>
                    <select name="province" id="province" class="form-control" required>
                        <option value="">Vui lòng chọn tỉnh/thành</option>
                        @foreach ($province as $pro)
                        <option value="{{$pro->province_id}}">{{$pro->name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for=""><strong>Quận/Huyện: <span>(*)</span></strong></label>
                    <select name="district" id="district" class="form-control" required>
                        <option value="" selected>Vui lòng chọn quận/huyện</option>
                        @foreach ($district as $dis)
                        <option value="{{$dis->district_id}}">{{$dis->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ward"><strong>Phường/Xã: <span>(*)</span></strong></label>
                    <select name="ward" id="ward" class="form-control" required>
                        <option value="">Vui lòng chọn phường/xã</option>
                        @foreach ($ward as $ward)
                        <option value="{{$ward->wards_id }}">{{$ward->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for=""><strong>Hình thức thanh toán: <span>(*)</span></strong></label>
                    <select id="" class="form-control" name="payment" required>
                        <option value="">Chọn hình thức</option>
                        <option value="0">Cod:Giao hàng nhận tiền</option>
                        <option value="1">Chuyển khoản</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for=""><strong>Ghi chú</strong></label>
                    <textarea name="notes" id="" cols="30" rows="5" class="form-control" placeholder="Ghi chú về đơn hàng"></textarea>
                </div>
                <div class="pt-3 text-end">
                    <button class="btn btn-danger btn-md w-25">ĐẶT HÀNG</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="discount">
                    <h5>Áp dụng mã giảm giá</h5>
                    <hr class="underline-hr">
                    <label for="">Nhập mã giảm giá tại đây:</label>
                    <input type="text" class="form-control">
                    <div class="text-end pt-2"><button class="btn btn-success">ÁP DỤNG</button></div>
                </div>
                @if (session('cart'))
                <div class="order-detail">
                    <h5>Chi tiết đơn</h5>
                    <hr class="underline-hr">
                    <div class="bg-order-detail p-3">
                        @php
                        $total = 0;
                        @endphp
                        @foreach ($cart as $item)
                        @php
                        $subtotal = $item['buyqty'] * $item['price'];
                        if ($item['price_discount'] != 0) {
                        $subtotal = $item['buyqty'] * $item['price_discount'];
                        }
                        $total += $subtotal;
                        @endphp
                        <div>
                            <div><b>{{ $item['name'] }}</b></div>
                            <div>Mã SP: {{ $item['sku'] }}</div>
                            <div>Số lượng: {{ $item['buyqty'] }}</div>
                            <div>Khối lượng: {{ $item['weight'] }} </div>
                            @if ($item['price_discount'] != 0)
                            <div class="text-end text-danger fs-5 fw-normal">{{ number_format($subtotal) }}
                                đ</div>
                            <hr>
                            @else
                            <div class="text-end text-danger fs-5 fw-normal">{{ number_format($subtotal) }}
                                đ
                            </div>
                            <hr>
                            @endif
                        </div>
                        @endforeach
                        {{-- input ẩn xử lí tiền --}}
                        <input type="hidden" name="total" value="{{ $total }}">
                        <div class="fs-5 text-end mb-2">Tổng tiền: {{ number_format($total) }} đ</div>
                        <div class="fs-5 text-end mb-2">Phí vận chuyển:
                            @if ($total < 350000) 20.000 đ @else 0 đ @endif </div>
                                <div class="fs-5 text-end mb-2">Thanh toán:
                                    @if($total<350000) <strong>{{ number_format($total +20000) }}
                                        đ</strong>
                                        @else
                                        <strong>{{ number_format($total) }}
                                            đ</strong>
                                        @endif
                                </div>
                                <div><a href="{{ route('f.cart') }}" class="btn btn-success w-100 btn-sm">CHỈNH SỬA ĐƠN
                                        HÀNG</a>
                                </div>
                        </div>
                    </div>
                    @else
                    <h4 class="text-danger">Giỏ hàng trống</h4>
                    <div><a href="{{ route('f.home') }}">Quay về tiếp tục mua hàng</a></div>
                    @endif
                </div>
            </div>
    </form>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
       $('#province').change(function(){
          var idProvince=$(this).val();
         $.get("ajax/district/"+idProvince,function(data){
            $('#district').html(data);
         });
       });
       $('#district').change(function(){
          var idDistrict=$(this).val();
         $.get("ajax/ward/"+idDistrict,function(data){
            $('#ward').html(data);
         });
       });
    });
</script>
@endsection
