@extends('frontend.layout')
@section('content')
@include('frontend.widgets.nav-hover')
<div class="container mt-2">
    {!!$article->content!!}
    <div class="text-center mt-2">
        <a href="{{route('f.home')}}" class="btn btn-success">Quay về mua hàng</a>
    </div>
</div>
@endsection
