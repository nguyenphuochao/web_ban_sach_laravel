<!DOCTYPE html>
<html lang="en">
{{-- start head --}}
@include('frontend.widgets.head')
{{-- end head --}}

<body>
    {{-- start nav --}}
    @include('frontend.widgets.nav')
    {{-- end nav --}}

    {{-- Sử dụng @yield() để thay đổi nội dung --}}
    @yield('content')
    {{-- end content --}}

    {{-- start footer --}}
    @include('frontend.widgets.footer')
    {{-- end footer --}}
</body>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/script.js') }}"></script>
@yield('script')

</html>
