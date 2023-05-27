<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart');
        return view('frontend.giohang', ['cart' => $cart]);
    }
    public function addToCart(Request $request, $id)
    {
        if ($id < 1 || !is_numeric($id))
            return redirect()->route('f.home');
        $product = Product::where(['status' => 1, 'id' => $id])->first();
        //dd($product);
        if (!$product)
            return redirect()->route('f.home');
        if (!$product->qty)
            return redirect()->route('f.home');

        $cart = session('cart');
        if (isset($cart[$product->id])) {
            // đã có sản phẩm này
            $cart[$product->id]['buyqty']++;
        } else {
            // Xử lí giảm giá
            if ($product->discount != 0)
                $price_discount = $product->price - ($product->price * $product->discount / 100);
            else
                $price_discount = 0;
            // chưa có
            $cart[$product->id] =
                [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'sku' => $product->sku,
                    'weight' => $product->weight,
                    'qty' => $product->qty,
                    'buyqty' => 1,
                    'price_discount' => $price_discount,
                    'price' => $product->price
                ];
        }
        session(['cart' => $cart]);
        //dd($cart);
        return redirect()->route('f.cart');
    }
    public function delCart(Request $request, $id)
    {
        $cart = session('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return redirect()->route('f.cart');
    }
    public function updateCart(Request $request)
    {
        $cart = session('cart');
        if ($cart && $request->cartqtybutton) {
            foreach ($request->cartqtybutton as $id => $qty) {
                if ($qty <= $cart[$id]['qty'])
                    $cart[$id]['buyqty'] = $qty;
                else
                    return redirect()->route('f.cart')->with(['type' => 'danger', 'mess' => 'Số lượng trong kho không đủ']);
                if ($qty < 1)
                    return redirect()->route('f.cart')->with(['type' => 'danger', 'mess' => 'Số lượng phải lớn hơn 0']);
            }
            session(['cart' => $cart]);
            return redirect()->route('f.cart');
            //return response()->json(session('cart'), 200);
        }
        return redirect()->route('f.cart');
    }
}