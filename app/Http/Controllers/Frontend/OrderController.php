<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ward;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Throwable;

class OrderController extends Controller
{
    public function index()
    {
        if (session('cart')) {
            $cart = session('cart');
            $province = Province::all();
            $district = District::all();
            $ward = Ward::all();
            return view('frontend.dathang', ['cart' => $cart, 'province' => $province, 'district' => $district, 'ward' => $ward]);
        } else {
            return redirect()->route('f.home');
        }
    }
    public function order(Request $request)
    {
        // Validate ở đây

        // Check nếu customer đã đăng nhập thì sẽ không lưu thông tin vào bảng customer nữa
        if (Auth::guard('frontend')->user()) {
            // Xử lí lưu dữ liệu bảng order
            $order = new Order();
            $order->customer_id = Auth::guard('frontend')->user()->id;
            $order->code = rand(11111111, 99999999);
            $order->order_date = Carbon::now(); //lấy ngày tháng hiện tại của laravel
            $order->order_name = $request->order_name;
            $order->order_phone = $request->order_phone;
            $order->order_address = $request->order_address;
            $order->province_id = $request->province;
            $order->district_id = $request->district;
            $order->ward_id = $request->ward;

            $order->subtotal = $request->total;
            $order->shipping = $order->subtotal < 350000 ? 20000 : 0;

            $order->total = $order->subtotal + $order->shipping;
            $order->order_status = 0;
            $order->payment = $request->payment;
            $order->notes = $request->notes;
            $order->save();
            // Xử lí lưu dữ liệu bảng order detail
            foreach (session('cart') as $item) {
                // Xử lí giảm giá
                $price = $item['price_discount'];
                if ($item['price_discount'] == 0)
                    $price = $item['price'];
                // lưu thông tin vào bảng orderDetail
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $item['id'];
                $order_detail->qty = $item['buyqty'];
                $order_detail->price = $price;
                $order_detail->save();
                // Trừ số lượng tồn kho trong bảng product
                $product = Product::find($item['id']);
                $product->qty = $product->qty - $item['buyqty'];
                $product->save();
            }
        }
        // Gửi mail đơn hàng
        try {
            Mail::send('frontend.email.order', ['name' => $request->order_name, 'email' => $request->email, 'phone' => $request->order_phone, 'address' => $request->order_address], function ($message) use ($request) {
                //$message->from('john@johndoe.com', 'John Doe');
                //$message->sender('john@johndoe.com', 'John Doe');
                $message->to($request->email, $request->order_name);
                //$message->cc('john@johndoe.com', 'John Doe');
                $message->bcc('nguyenphuochao456@gmail.com', 'Hao Nguyen');
                //$message->replyTo('john@johndoe.com', 'John Doe');
                $message->subject('Thông tin hóa đơn mua hàng');
                //$message->priority(3);
                //$message->attach('pathToFile');
            });
        } catch (\Throwable $e) {
            return redirect()->back()->with(['mess' => $e->getMessage(), 'type' => 'danger']);
        }
        //hủy giỏ hàng khi đã mua xong
        session()->forget('cart');
        return redirect()->route('f.order_finish');
    }
    public function order_finish()
    {
        return view('frontend.dat-hang-thanh-cong');
    }
}
