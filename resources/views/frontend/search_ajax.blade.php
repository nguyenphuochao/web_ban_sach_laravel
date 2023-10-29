<ul>
    @foreach($products as $product)
    <li>
        <a style="color:black" href="{{route('f.detail',['id'=>$product->id])}}"><img src="{{ asset('frontend/img/'.$product->image) }}" alt="" width="50px">{{$product->name}} -
           <span class="text-danger">{{$product->discount==0 ? number_format($product->price) : number_format($product->price_discount)}} VNĐ</span>
        </a>
    </li>
    @endforeach
</ul>
