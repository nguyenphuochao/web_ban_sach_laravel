<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    public function index()
    {

        // Thống kê số lượng sản phẩm theo danh mục
        $thongke_cate = DB::table('products')->leftjoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as cate_name', DB::raw('COUNT(products.id) as SL'))->groupBy('categories.name')->get();

        // Thống kê theo trạng thái đơn hàng
        $thongke_order = DB::table('orders')->select('orders.order_status', DB::raw('COUNT(orders.order_status) as SL'))->groupBy('order_status')->get();

        // Đếm số lượng tất cả sản phẩm trong kho
        $product = Product::all();

        // Tính doanh thu order
        $count_order = 0;
        $order = Order::where('order_status', 2)->get();
        foreach ($order as $or) {
            $count_order += $or->total;
        }
        // Tính số lượng bình luận chưa duyệt
        $count_comment = 0;
        $comment = Comment::where('status', 0)->get();
        foreach ($comment as $cm) {
            $count_comment++;
        }
        // Số lượng user
        $count_user = 0;
        $user = Customer::all();
        foreach ($user as $user) {
            $count_user++;
        }
        $order_all = Order::orderBy('id', 'DESC')->get();
        return view('backend.home', compact(['thongke_cate', 'thongke_order', 'product', 'count_order', 'count_comment', 'count_user', 'order_all']));
    }
    public function login()
    {
        return view('backend.user.login');
    }
    public function post_login(Request $request)
    {

        $username = $request->username;
        $password = $request->password;
        //dd($request->password);
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            if (Auth::attempt(['username' => $username, 'password' => $password, 'status' => 1])) {

                return redirect()->route('b.home');
            } else {
                return redirect()->back()->with(['type' => 'danger', 'mess' => 'Tài khoản bị khóa']);
            }
        } else {
            return redirect()->back()->with(['type' => 'danger', 'mess' => 'Thông tin đăng nhập không chính xác']);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('b.login');
    }
    public function register()
    {
        return 'register';
    }
    public function _403()
    {
        return  "<h1>Trang 403.Bạn không có quyền truy cập trang này</h1>";
    }
}
