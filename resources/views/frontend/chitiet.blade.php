@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container detail">
    <nav class="breadcrumb mb-0">
        <a class="breadcrumb-item" href="#">Nobita-Nhà sách</a>
        <a class="breadcrumb-item" href="#">{{ $get_item_product->category->name }}</a>
        <span class="breadcrumb-item active" aria-current="page">{{ $get_item_product->name }}</span>
    </nav>
    <div class="row">
        <div class="col-md-3">
            <img src="{{ asset('frontend/img/' . $get_item_product->image) }}" alt="{{ $get_item_product->image }}"
                width="100%">
        </div>
        <div class="col-md-5">
            <h5>{{ $get_item_product->name }}</h5>
            <div class="row">
                <div class="col-sm-6 pb-3">
                    <div><strong>Tác giả: </strong>{{ $get_item_product->author->name }}</div>
                </div>
                <div class="col-sm-6 pb-3">
                    <div><strong>Danh mục: </strong>{{ $get_item_product->category->name }}</div>
                </div>
                <div class="col-sm-6 pb-3">
                    <div><a href="#comment"><i class="fa-solid fa-pen"></i> Gửi nhận xét của bạn</a></div>
                </div>
                <div class="col-sm-6 pb-3">
                    <div><a href="#"><i class="fa-solid fa-star"></i> Thêm vào yêu thích</a></div>
                </div>
                <div class="col-sm-12 pb-2">
                    <div class="fs-2 fw-bold text-color">
                        {{ number_format($get_item_product->price - ($get_item_product->price *
                        $get_item_product->discount) / 100) }}
                    </div>
                </div>
                @if ($get_item_product->discount != 0)
                <div class="col-sm-4 pd-4">
                    <div>Giá bìa: {{ number_format($get_item_product->price) }} đ</div>
                </div>
                <div class="col-sm-8 pd-4">
                    <div>Tiết kiệm:
                        <strong>{{ number_format(($get_item_product->price * $get_item_product->discount) / 100) }}
                            đ (-{{ $get_item_product->discount }}%)</strong>
                    </div>
                </div>
                @endif
                <div class="col-sm-12 pt-3">
                    <div><i class="fa-solid fa-check"></i> Bọc Plastic theo yêu cầu</div>
                    <div><i class="fa-solid fa-check"></i> Hỗ trợ khách hàng 24/7</div>
                    <div><i class="fa-solid fa-check"></i> Giao hàng miễn phí toàn quốc đơn hàng <span class="fw-bold">
                            ≥350.000 đ</span></div>
                    <div><i class="fa-solid fa-check"></i> Đổi trả miễn phí sản phẩm trong <span class="fw-bold">7
                            ngày</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 margin-top">
            @if ($get_item_product->qty < 1) <div class="btn btn-danger">Sản phẩm tạm hết hàng</div>
        @else
        <a href="{{ route('f.addcart', $get_item_product->id) }}"><button class="btn btn-warning btn-lg w-50 color">Mua
                ngay</button></a>
        @endif
    </div>

    <div class="about-book pt-5">
        <h6>GIỚI THIỆU SÁCH</h6>
        <hr>
        <div class="row">
            <div class="col-md-11">
                <div id="content">{!! $get_item_product->content !!}</div>
                @if (strlen($get_item_product->content) > 400)
                <div id="show_content" class="text-center pt-2 fw-bold">Xem thêm nội dung <i
                        class="fa-solid fa-arrow-down"></i></div>
                <div id="hide_content" class="text-center pt-2 fw-bold">Thu gọn <i class="fa-solid fa-arrow-up"></i>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="info-detail pt-5">
        <form action="{{route('f.post_detail_view',$get_item_product->id)}}" onload="formLoad()" class="form_view" method="POST"
            id="form_view">
            @csrf()
            {{-- <button id="btn_view">View</button> --}}
        </form>
        <h6>THÔNG TIN CHI TIẾT</h6>
        <hr>
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <td width="30%">Tác giả</td>
                    <td width="70%" class="text-color">{{ $get_item_product->author->name }}</td>
                </tr>
                <tr>
                    <td width="30%">NXB</td>
                    <td width="70%" class="text-color">{{ $get_item_product->supplier->name }}</td>
                </tr>
                <tr>
                    <td width="30%">Kích thước</td>
                    <td width="70%">{{ $get_item_product->size }}</td>
                </tr>
                <tr>
                    <td width="30%">Trọng lượng</td>
                    <td width="70%">{{ $get_item_product->weight }}</td>
                </tr>
                <tr>
                    <td width="30%">Số trang</td>
                    <td width="70%">{{ $get_item_product->number_of_pages }}</td>
                </tr>
                <tr>
                    <td width="30%">Lượt xem</td>
                    <td width="70%" class="text-color">{{ $get_item_product->view }}</td>
                </tr>
                <tr>
                    <td width="30%">Ngày phát hành</td>
                    <td width="70%">{{ $get_item_product->created_at }}</td>
                </tr>
                <tr>
                    <td width="30%">Danh mục</td>
                    <td width="70%" class="text-color">{{ $get_item_product->category->name }}</td>
                </tr>
            </table>
        </div>
        <div class="mt-30">
            @if ($get_item_product->qty > 0)
            <a href="{{ route('f.addcart', $get_item_product->id) }}"><button class="btn btn-warning btn-lg color">Mua
                    ngay</button></a>
            @endif
        </div>
    </div>
    <div class="same-author pt-5">
        <h6>SÁCH CÙNG TÁC GIẢ</h6>
        <div class="row row-cols-2 row-cols-md-5">
            @foreach ($get_same_author as $item)
            <div class="col">
                <a href="{{ $item->id }}"> <img src="{{ asset('frontend/img/' . $item->image) }}"
                        alt="{{ $item->image }}" width="150" height="200"></a>
                @if ($get_item_product->id == $item->id)
                <div class="fs-6 fw-bold">(Sách bạn đang xem)</div>
                @endif
                <div>{{ $item->name }}</div>
                <div><strong>{{ number_format($item->price - ($item->price * $item->discount) / 100) }} đ
                        <span class="text-danger">
                            @if ($item->discount != 0)
                            (-{{ $item->discount }}%)
                            @endif
                        </span>
                    </strong></div>
                @if ($item->discount != 0)
                <div><del>{{ number_format($item->price) }} đ</del></div>
                @endif
            </div>
            @endforeach

        </div>
    </div>
    <div class="commment pt-5" id="comment">
        <h6>BÌNH LUẬN</h6>
        @if (Auth::guard('frontend')->user())
        <div>Bạn đang đăng nhập <a href="{{route('f.account')}}">{{ Auth::guard('frontend')->user()->name }}</a> | <a
                href="{{ route('f.logout') }}">Đăng xuất</a></div>
        <form action="#">
            <div class="form-group">
                <textarea name="desc" id="desc" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <div class="pt-2">
                <input type="hidden" id="customer_name" name="customer_name"
                    value="{{ Auth::guard('frontend')->user()->name }}">
                <input type="hidden" id="product_id" name="product_id" value="{{ $get_item_product->id }}">
                <button type="button" class="btn btn-success" id="btn_comment">Đăng bình luận</button>
            </div>
        </form>
        @else
        <div class="alert alert-danger">Vui lòng đăng nhập để bình luận <a href="{{route('f.login')}}">Đăng nhập</a>
        </div>
        @endif
        {{-- Session comment --}}
        <div id="_wait">

        </div>
        {{-- Hiển thị comment --}}
        <div class="show_comment" id="show_comment">
            <hr>
            @foreach ($comment as $cm)
            @if($cm->product_id==$get_item_product->id)
            <div class="mb-4">
                <span class="text-success fw-bold">{{ $cm->customer->name }}</span>
                <span> <i class="far fa-clock" aria-hidden="true"></i> {{ $cm->created_at }}</span>
                <div>{{ $cm->desc }}</div>
                @if ($cm->status==1)
                <div class="rep-comment" style="margin-left: 20px;background: #f1efef;padding: 5px;width: 50%;">
                    <div class="fw-bold">Amin</div>
                    <div>{!!$cm->reply!!}</div>
                </div>
                @endif
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
                // Sự hiện ẩn hiện nội dung chi tiết
                $('#show_content').click(function() {
                    $('#content').css('overflow', 'visible');
                    $('#content').css('height', 'auto');
                    $('#show_content').css('display', 'none');
                    $('#hide_content').css('display', 'block');
                });
                $('#hide_content').click(function() {
                    $('#content').css('overflow', 'hidden');
                    $('#content').css('height', '200px');
                    $('#show_content').css('display', 'block');
                    $('#hide_content').css('display', 'none');
                });
                $('#btn_comment').click(function(){
                    var date=new Date();
                    var desc=$('#desc').val();
                    var product=$('#product_id').val();
                    var name=$('#customer_name').val();
                    //console.log(product);
                    if(desc==''){
                        alert('Vui lòng điền nội dung vào');
                    }
                    if(desc.length<10){
                        alert('Nội dung phải trên 10 kí tự');
                    }
                    if(desc !='' && desc.length>10){
                        $.ajax({
                            url: "{{route('f.post_comment')}}",
                            method:"POST",
                            data:{
                                _token:'{{csrf_token()}}',
                                desc:desc,
                                product_id:product,
                                customer_name:name
                            },
                            success: function (d) {
                                var data=
                                    '<div class="mb-4" >'+
                                        '<span class="text-success fw-bold">'+name+'</span>'+
                                        '<span> <i class="far fa-clock" aria-hidden="true"></i>' +date+'</span>'+
                                        '<span class="text-warning"> <i class="fas fa-exclamation-circle"></i> Đang chờ phê'+
                                            ' duyệt</span>'+
                                        '<div>'+d.desc+'</div>'+
                                    '</div>';
                                 $('#_wait').append(data);
                                 $('#desc').val('')
                                //console.log(date);
                                //console.log(d)
                            },
                            error: function(d){
                                alert(d.responseJSON.message);
                            },
                        });
                    }
                });

            });
</script>
@endsection

