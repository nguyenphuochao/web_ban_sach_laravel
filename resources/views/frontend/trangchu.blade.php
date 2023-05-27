@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-bottom')
@include('frontend.widgets.header')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="content-1 pb-5">
                    <div class="h6">
                        <h6>SÁCH MỚI</h6>
                    </div>
                    <div class="owl-carousel">
                        @foreach($list_product_new as $item)
                        <div class="discount">
                            <a href="chi-tiet-san-pham/{{$item->id}}"><img src="frontend/img/{{$item->image}}" alt=""
                                    width="150px" height="200px">
                                @if($item->discount!=0)
                                <span>{{$item->discount}}%</span>
                                @endif</a>
                            <div>{{$item->name}}</div>
                            <div><strong>{{number_format($item->price-($item->price*$item->discount/100))}} đ</strong>
                            </div>
                            @if ($item->discount!=0)
                            <div><del>{{number_format($item->price)}} đ</del></div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <script>
                        $(document).ready(function () {
                            $(".owl-carousel").owlCarousel({
                                items: 5,
                                autoplay: 10,
                                autoplaySpeed: 500,
                                responsiveClass: true,
                                responsive: {
                                    0: {
                                        items: 2,
                                        nav: true
                                    },
                                    600: {
                                        items: 3,
                                        nav: false
                                    },
                                    1000: {
                                        items: 5,
                                        nav: true,
                                        loop: false
                                    }
                                }

                            });
                        });
                    </script>
                </div>
                <div class="content-2 pb-5">
                    <div class="h6">
                        <h6>SÁCH GIẢM GIÁ</h6>
                    </div>
                    <div class="owl-carousel">
                        @foreach($list_product_discount as $item)
                        <div class="discount">
                            <a href="chi-tiet-san-pham/{{$item->id}}"><img src="frontend/img/{{$item->image}}" alt=""
                                    width="150px" height="200px"></a>
                            <span>{{$item->discount}}%</span>
                            <div>{{$item->name}}</div>
                            <div><strong>{{number_format($item->price-($item->price*$item->discount/100))}} đ</strong>
                            </div>
                            <div><del>{{number_format($item->price)}} đ</del></div>
                        </div>
                        @endforeach
                    </div>
                    <script>
                        $(document).ready(function () {
                            $(".owl-carousel").owlCarousel({
                                items: 5,
                                autoplay: 10,
                                autoplaySpeed: 500,
                                responsiveClass: true,
                                responsive: {
                                    0: {
                                        items: 2,
                                        nav: true
                                    },
                                    600: {
                                        items: 3,
                                        nav: false
                                    },
                                    1000: {
                                        items: 5,
                                        nav: true,
                                        loop: false
                                    }
                                }
                            });
                        });
                    </script>
                </div>
                <div class="content-3 pb-5">
                    <div class="h6">
                        <h6>SÁCH NHIỀU LƯỢT XEM</h6>
                    </div>
                    <div class="owl-carousel">
                        @foreach($list_product_view as $item)
                        <div class="discount">
                            <a href="chi-tiet-san-pham/{{$item->id}}"><img src="frontend/img/{{$item->image}}" alt=""
                                    width="150px" height="200px">
                                @if($item->discount!=0)
                                <span>{{$item->discount}}%</span>
                                @endif</a>
                            <div>{{$item->name}}</div>
                            <div><strong>{{number_format($item->price-($item->price*$item->discount/100))}} đ</strong>
                            </div>
                            @if ($item->discount!=0)
                            <div><del>{{number_format($item->price)}} đ</del></div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <script>
                        $(document).ready(function () {
                            $(".owl-carousel").owlCarousel({
                                items: 5,
                                autoplay: 10,
                                autoplaySpeed: 500,
                                responsiveClass: true,
                                responsive: {
                                    0: {
                                        items: 2,
                                        nav: true
                                    },
                                    600: {
                                        items: 3,
                                        nav: false
                                    },
                                    1000: {
                                        items: 5,
                                        nav: true,
                                        loop: false
                                    }
                                }
                            });
                        });
                    </script>
                </div>
                <div class="content-4 pb-5">
                    <div class="h6">
                        <h6>DANH MỤC</h6>
                    </div>
                    <div class="row row-cols-sm-2 row-cols-md-5 ">
                        @foreach ($list_cate as $item )
                        <div class="col">
                            <a href="danh-muc/{{$item->id}}"><img src="frontend/img/category/{{$item->image}}" alt=""
                                    width="120px" height="220px"></a>
                            <div><strong>{{$item->name}}</strong></div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="about mt-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Mua Sách Online Tại Nobita.Vn</h5>
                            <p>Ra đời từ năm 2011, đến nay Nobita.vn đã trở thành địa chỉ mua sách online quen thuộc của
                                hàng
                                ngàn độc giả trên cả nước. Với đầu sách phong phú, thuộc các thể loại: Văn học nước
                                ngoại,
                                Văn
                                học trong nước, Kinh tế, Kỹ năng sống, Thiếu nhi, Sách học ngoại ngữ, Sách chuyên
                                ngành,...
                                được
                                cập nhật liên tục từ các nhà xuất bản uy tín trong nước.</p>
                            <p>Ngoài ra, với hình thức Giao hàng thu tiền tận nơi và Đổi hàng trong vòng 7 ngày nếu sách
                                có
                                bất
                                kỳ lỗi nào trong quá trình in ấn sẽ giúp Quý khách yên tâm hơn khi mua sắm tại Nobita.vn
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
