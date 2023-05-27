@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container news">
    <nav class="breadcrumb mb-0">
        <a class="breadcrumb-item" href="{{route('f.home')}}">Nobita-Nhà sách</a>
        <span class="breadcrumb-item active" aria-current="page">Danh mục tin</span>
    </nav>
    <form action="" id="form_id">
        <div class="row">
            <div class="col-md-2">
                <ul class="p-0 category">
                    <div class="pb-3 bg-nobita">DANH MỤC TIN TỨC</div>
                    <li class="mt-1 fs-5"><a href="{{route('f.news')}}">Tất cả tin tức</a></li>
                    @foreach ( $new_group as $item)
                    <li class="mt-3"><a href="{{route('f.article_group',$item->id)}}">{{$item->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-10">
                <h5>BẢNG TIN</h5>
                <div class="text-end pb-5">Xem theo
                    <select name="news_order" id="news_order">
                        <option value="0" @if(isset($_GET['news_order']) && $_GET['news_order']==0) {{"selected"}} @endif>Mới trước</option>
                        <option value="1" @if(isset($_GET['news_order']) && $_GET['news_order']==1) {{"selected"}} @endif>Cũ trước</option>

                    </select>
                </div>
                <div class="row">
                    @foreach($news as $item)
                    <div class="col-md-3 mb-3">
                        <a href="{{route('f.news_detail',$item->id)}}"><img src="{{ asset('frontend/img/news/'.$item->image) }}" alt="" width="230"
                                height="120"></a>
                    </div>
                    <div class="col-md-9 mb-3">
                        <h5><a href="{{route('f.news_detail',$item->id)}}" class="text-success">{{$item->name}}</a></h5>
                        <p>{{$item->sumary}}</p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#news_order').change(function(){
            $('#form_id').submit();
        })
    });
</script>
@endsection
