<div class="header">
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-5" id="menu_home" >
                <ul>
                    <li class="fw-bold"><a href="{{route('f.all_product')}}">Tất cả sản phẩm <i class="fa-solid fa-chevron-right"></i></a></li>
                    @foreach ($cate as $c)
                    @if ($c->parent_id == 0)
                    <li>
                        <a href="{{route('f.category',['id'=>$c->id])}}">{{ $c->name }}
                            @if (count($c->children) > 0)
                            &emsp;<i class="fa-solid fa-chevron-right"></i>
                            @endif
                        </a>
                        <ul id="menu-2">
                            @foreach ($c->children as $child)
                            <li><a href="{{route('f.category',['id'=>$child->id])}}">{{ $child->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    @endforeach

                </ul>
            </div>
            <div class="col-md-9 col-sm-12 col-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"
                    data-bs-intervel="1000">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="frontend/img/banner/banner_1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="frontend/img/banner/banner_2.jpg" class="d-block w-100" alt="...">
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- jquery menu home --}}
<script>
   $(document).ready(function () {
        $('.nav-bottom #menu_cate').click(function(){
            $('.header #menu_home').slideToggle();
        })
   });
</script>
