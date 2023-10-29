@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container product">
    <nav class="breadcrumb mb-0">
        <a class="breadcrumb-item" href="#">Nobita-Nhà sách</a>
        <span class="breadcrumb-item active" aria-current="page">{{$item_cate->name}}</span>
    </nav>
    <form action="" method="get" id="form_id">
        <div class="row">
            <div class="col-md-2">
                <ul class="p-0 category">
                    <div class="pb-3 bg-nobita">DANH MỤC</div>
                    @foreach ($category as $cate)
                    <li class="pt-3"><a href="{{$cate->id}}">{{$cate->name}}</a></li>
                    @endforeach

                </ul>
                <ul class="p-0 author">
                    <div class="pb-3 bg-nobita">TÁC GIẢ</div>
                    @foreach ($product_author as $pro)
                    <p><input type="checkbox" name="author[]" value="{{$pro->id}}"
                     @if (isset($_GET['author']) && in_array($pro->id,$product_author_check))
                        {{"checked"}}
                        @endif
                        >{{$pro->name}}</p>
                    @endforeach
                </ul>
                <ul class="p-0 supplier">
                    <div class="pb-3 bg-nobita">NHÀ XUẤT BẢN</div>
                    @foreach ($product_supplier as $pro)
                    <p><input type="checkbox" name="supplier[]" value="{{$pro->id}}"
                    @if (isset($_GET['supplier']) && in_array($pro->id,$product_supplier_check))
                        {{"checked"}}
                        @endif
                        >{{$pro->name}}</p>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-10">
                <h5>{{$item_cate->name}}</h5>
                <div class="text-end pb-5">Xem theo
                    <select name="xemtheo" id="order_id">
                        <option value="moitruoc" @if(isset($_GET['xemtheo']) && $_GET['xemtheo']=='moitruoc' )
                            {{"selected"}} @endif>Mới trước</option>
                        <option value="cutruoc" @if(isset($_GET['xemtheo']) && $_GET['xemtheo']=='cutruoc' )
                            {{"selected"}} @endif>Cũ trước</option>
                        <option value="giatangdan" @if(isset($_GET['xemtheo']) && $_GET['xemtheo']=='giatangdan' )
                            {{"selected"}} @endif>Giá tăng dần</option>
                        <option value="giagiamdan" @if(isset($_GET['xemtheo']) && $_GET['xemtheo']=='giagiamdan' )
                            {{"selected"}} @endif>Giá giảm dần</option>
                        <option value="xemnhieu" @if(isset($_GET['xemtheo']) && $_GET['xemtheo']=='xemnhieu' )
                            {{"selected"}} @endif>Xem nhiều</option>
                    </select>
                </div>
                <div class="row row-cols-2 row-cols-md-5">
                    @foreach($product as $item)
                    <div class="col cart">
                        <a href="{{route('f.detail',['id'=>$item->id])}}"><img
                                src="{{ asset('frontend/img/'.$item->image) }}" alt="" width="150" height="200"></a>
                        @if($item->discount!=0)
                        <span class="discount">-{{$item->discount}}%</span>
                        @endif
                        <div>{{$item->name}}</div>
                        <div><b>{{number_format($item->price-($item->price*$item->discount/100))}} đ</b></div>
                        @if($item->discount!=0)
                        <div><del>{{number_format($item->price)}} đ</del></div>
                        @endif
                    </div>
                    @endforeach
                </div>
                 {{-- Phân trang --}}
                 {{$product->links('pagination::bootstrap-4')}}

            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#order_id').change(function(){
            $('#form_id').submit();
        });
        $('.author').click(function(){
            $('#form_id').submit();
        });
        $('.supplier').click(function(){
            $('#form_id').submit();
        });
    });
</script>
@endsection
