<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Chức năng</div>

                @foreach ($menus as $menu)
                @if ($menu->active == 1)
                <a class="nav-link" href="{{ route('b.home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    {{ $menu->name }}
                </a>
                @else
                {{-- Quản lí tài khoản --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="{{ '#'.$menu->content }}" aria-expanded="false"
                    aria-controls="{{ $menu->content }}">
                    <div class="sb-nav-link-icon">{!!$menu->icon!!}</div>
                    {{ $menu->name }}
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="{{ $menu->content }}" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav" id="id_account">
                        @foreach (App\Models\Fun::_listmenu(Auth::user()->id, $menu->id) as $child)
                        {{-- Quản lí admin --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="{{ '#' . $child->content }}" aria-expanded="false"
                            aria-controls="{{ $child->content }}">
                            <div class="sb-nav-link-icon">{!!$child->icon!!}</div>
                            {{ $child->name }}
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="{{ $child->content }}" aria-labelledby="headingOne"
                            data-bs-parent="#id_account">
                            <nav class="sb-sidenav-menu-nested nav">
                                @foreach (App\Models\Fun::_listmenu(Auth::user()->id, $child->id) as $child_2)
                                <a class="nav-link" href="{{url($child_2->link)}}">{{ $child_2->name }}</a>
                                @endforeach
                            </nav>
                        </div>
                        @endforeach
                    </nav>
                </div>
                @endif
                @endforeach

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
