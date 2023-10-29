@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container search mt-4">
    <div class="row">
        <div class="col-md-9">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Sản phẩm</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Tin tức</button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    @if ($_GET['key']=='')
                    <div class="text-end">Tìm từ khóa <b>" "</b> được 0 kết quả</div>
                    @else
                    <div class="text-end">Tìm từ khóa <strong>{{ $_GET['key'] }}</strong> được
                        <b>{{ count($product) }}</b>
                        kết quả
                    </div>
                    <div class="row">
                        @foreach ($product as $item)
                        <div class="col-md-3 mb-2" id="discount">
                            <a href="chi-tiet-san-pham/{{$item->id}}"><img src="{{ asset('frontend/img/' . $item->image) }}" alt="" width="160px" height="200px"></a>
                            @if ($item->discount != 0)
                            <span>-{{ $item->discount }}%</span>
                            @endif
                            <div>{{ $item->name }}</div>
                            <div><strong>{{ number_format($item->price - ($item->price * $item->discount) / 100) }}
                                    đ</strong>
                            </div>
                            @if ($item->discount != 0)
                            <div><del>{{ number_format($item->price) }}</del> đ</div>
                            @endif

                        </div>
                        @endforeach
                    </div>
                    {{-- Phân trang --}}
                    {{ $product->links('pagination::bootstrap-4') }}
                    @endif
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @if($_GET['key']=='')
                    <div class="text-end">Tìm từ khóa <strong>" "</strong> được 0 kết quả</div>
                    @else
                    <div class="text-end">Tìm từ khóa <strong>{{ $_GET['key'] }}</strong> được
                        <b>{{ count($news) }}</b>
                        kết quả
                    </div>
                    <div class="row">
                        @foreach ($news as $item)
                        <div class="col-md-3 mb-3">
                            <a href="#"><img src="{{ asset('frontend/img/news/' . $item->image) }}" alt="" width="230"
                                    height="120"></a>
                        </div>
                        <div class="col-md-9 mb-3">
                            <h5><a href="#" class="text-success">{{ $item->name }}</a></h5>
                            <p>{{ $item->content }}</p>
                        </div>
                        @endforeach
                    </div>
                    {{ $news->links() }}
                    @endif
                    {{-- Phân trang --}}

                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>
@endsection
