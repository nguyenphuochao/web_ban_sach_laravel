<nav>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2">
                <h2 class="pt-2"><a href="{{ route('f.home') }}">LOGO</a></h2>
            </div>
            <div class="col-md-4" style="position: relative">
                <form action="{{ route('f.search') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control key" placeholder="Nhập để tìm tên sản phẩm, giá, tin tức"
                            name="key" value="{{request()->has('key') ? request()->input('key') : ''}}">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <div class="search-result" id="search-result" style="position: absolute;top:100%;left:10px;background-color:#EFEFEF;color:black;width:95%;z-index:999">

                    </div>
                </form>

            </div>
            @if (Auth::guard('frontend')->user())
                <div class="col-2">
                    <a href="{{route('f.account')}}">Xin chào <span
                            class="text-danger">{{ Auth::guard('frontend')->user()->name }}</span></a>
                    <a href="{{ route('f.logout') }}" class="text-dark">Đăng xuất</a>
                </div>
            @else
                <div class="col">
                    <a href="{{ route('f.login') }}">Tài khoản</a>
                </div>
            @endif
            <div class="col">
                <a href="{{ route('f.cart') }}"> Giỏ hàng
                    @if (session('cart'))
                        @php
                            $count = 0;
                        @endphp
                        @foreach (session('cart') as $item)
                            <?php $count += $item['buyqty']; ?>
                        @endforeach
                        <?php
                        echo "(".$count.")";
                        ?>
                    @else
                        (Trống)
                    @endif
                </a>
            </div>
            <div class="col">
                <a href="{{ route('f.contact') }}">Liên hệ</a>
            </div>
            <div class="col">
                <a href="{{ route('f.about') }}">Về nobita</a>
            </div>
            <div class="col">
                <a href="{{ route('f.news') }}">Blog</a>
            </div>
            <div class="col">
                <a href="{{route('b.home')}}">Admin</a>
            </div>

        </div>
    </div>
</nav>

