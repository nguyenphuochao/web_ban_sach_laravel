<div class="nav-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-10" style="z-index: 999">
                <div id="menu">
                    <h6><i class="fa-solid fa-bars"></i> DANH MỤC SẢN PHẨM</h6>
                    <ul>
                        <li class="fw-bold"><a href="{{route('f.all_product')}}">Tất cả sản phẩm <i class="fa-solid fa-chevron-right"></i></a></li>
                        @foreach($cate as $c)
                        @if($c->parent_id==0)
                        <li>
                            <a href="{{route('f.category',['id'=>$c->id])}}">{{$c->name}}
                                @if (count($c->children) > 0)
                                &emsp;<i class="fa-solid fa-chevron-right"></i>
                                @endif
                            </a>
                            <ul id="menu-2">
                                @foreach($c->children as $child)
                                <li><a href="{{route('f.category',['id'=>$child->id])}}">{{$child->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div><strong><i class="fa-solid fa-phone"></i> Holine: </strong>058.4228.904</div>
            </div>
        </div>
    </div>
</div>
