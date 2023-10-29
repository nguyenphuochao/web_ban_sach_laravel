<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use App\Models\Article;
use App\Models\ArticleGroup;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Supplier;
use Carbon\Carbon;
use DateTime;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

class UserController extends Controller
{
    // Đỗ dữ liệu trang chủ
    public function index()
    {
        $list_cate = Category::paginate(10);
        $list_product_new = Product::orderBy('id', 'DESC')->get();
        $list_product_discount = Product::where('discount', '!=', '0')->orderBy('id', 'DESC')->get();
        $list_product_view = Product::orderBy('view', 'DESC')->get();
        return view('frontend.trangchu', [
            'list_cate' => $list_cate, 'list_product_new' => $list_product_new,
            'list_product_discount' => $list_product_discount,
            'list_product_view' => $list_product_view
        ]);
    }
    // Đọc chi tiết trang sản phẩm
    public function detail($id)
    {
        $comment = Comment::where('status', 1)->orderBy('id', 'DESC')->get();
        $get_item_product = Product::where('id', $id)->first();
        $get_same_author = Product::where('author_id', $get_item_product->author_id)->get();

        return view('frontend.chitiet', ['get_item_product' => $get_item_product, 'get_same_author' => $get_same_author, 'comment' => $comment]);
    }
    // Tự động thêm tăng view
    public function post_detail_view($id)
    {
        $get_item_product = Product::find($id);
        //dd($get_item_product);
        $get_item_product->view = $get_item_product->view + 1;
        $get_item_product->save();
        return back();
    }
    // Đọc danh sách sản phẩm theo danh mục
    public function category(Request $request, $id)
    {
        $category = Category::where('status', 1)->paginate(10);
        $mang = [];
        $item_cate = Category::find($id);
        $children = $item_cate->children;
        foreach ($children as $item) {
            $c = $item->id;
            array_push($mang, $c);
        }
        array_push($mang, $item_cate->id);
        $product = Product::whereIn('category_id', $mang)->get();


        // Lấy ra danh sách những tác giả thuộc về những product
        $author = [];
        foreach ($product as $pro) {
            array_push($author, $pro->author_id);
        }
        $product_author = Author::whereIn('id', $author)->get();
        //dd($product_author);
        // Lấy ra danh sách những nxb thuộc về những product
        $supplier = [];
        foreach ($product as $pro) {
            array_push($supplier, $pro->supplier_id);
        }
        $product_supplier = Supplier::whereIn('id', $supplier)->get();

        // sắp xếp
        $product_order = $request->xemtheo;
        switch ($product_order) {
            case 'moitruoc':
                $product = Product::whereIn('category_id', $mang)->orderBy('id', 'DESC')->paginate(20);
                break;
            case 'cutruoc':
                $product = Product::whereIn('category_id', $mang)->orderBy('id', 'ASC')->paginate(20);
                break;
            case 'giatangdan':
                $product = Product::whereIn('category_id', $mang)->orderBy('price_discount', 'ASC')->paginate(20);
                break;
            case 'giagiamdan':
                $product = Product::whereIn('category_id', $mang)->orderBy('price_discount', 'DESC')->paginate(20);
                break;
            case 'xemnhieu':
                $product = Product::whereIn('category_id', $mang)->orderBy('view', 'DESC')->paginate(20);
                break;
            default:
                $product = Product::whereIn('category_id', $mang)->orderBy('id', 'DESC')->paginate(20);
                break;
        }
        // Lọc theo tác giả
        $product_author_check = $request->author;
        if ($product_author_check) {
            $product = Product::whereIn('author_id', $product_author_check)->whereIn('category_id', $mang)->paginate(20);
        }
        // Lọc theo nhà xuất bản

        $product_supplier_check = $request->supplier;
        if ($product_supplier_check) {
            $product = Product::whereIn('supplier_id', $product_supplier_check)->whereIn('category_id', $mang)->paginate(20);
        }
        return view('frontend.product', ['product' => $product, 'category' => $category, 'item_cate' => $item_cate, 'product_author' => $product_author, 'product_supplier' => $product_supplier, 'product_author_check' => $product_author_check, 'product_supplier_check' => $product_supplier_check]);
    }
    // Đọc tất cả sản phẩm
    public function all_product(Request $request)
    {
        // sắp xếp
        $product = $request->xemtheo;
        switch ($product) {
            case 'moitruoc':
                $product = Product::orderBy('id', 'DESC')->where('status', 1)->paginate(20);
                break;
            case 'cutruoc':
                $product = Product::orderBy('id', 'ASC')->where('status', 1)->paginate(20);
                break;
            case 'giatangdan':
                $product = Product::orderBy('price_discount', 'ASC')->where('status', 1)->paginate(20);
                break;
            case 'giagiamdan':
                $product = Product::orderBy('price_discount', 'DESC')->where('status', 1)->paginate(20);
                break;
            case 'xemnhieu':
                $product = Product::orderBy('view', 'DESC')->where('status', 1)->paginate(20);
                break;
            default:
                $product = Product::orderBy('id', 'DESC')->where('status', 1)->paginate(20);
                break;
        }
        // Lọc theo tác giả
        $product_author = $request->author;
        if ($product_author) {
            $product = Product::whereIn('author_id', $product_author)->paginate(20);
        }
        // Lọc theo nhà xuất bản
        $product_supplier = $request->supplier;
        if ($product_supplier) {
            $product = Product::whereIn('supplier_id', $product_supplier)->paginate(20);
        }
        $author = Author::where('status', 1)->get();
        $supplier = Supplier::where('status', 1)->get();
        $category = Category::where('status', 1)->where('parent_id', 0)->paginate(10);
        return view('frontend.product-all', ['product' => $product, 'author' => $author, 'supplier' => $supplier, 'category' => $category, 'product_author' => $product_author, 'product_supplier' => $product_supplier]);
    }
    // Trang liên hệ
    public function contact()
    {
        return view('frontend.lienhe');
    }
    // Gửi mail trang liên hệ
    public function mail(Request $request)
    {
        $contact = new Contact();
        $contact->fullname = $request->fullname;
        $contact->email = $request->email;
        $contact->address = $request->address;
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->save();
        try {
            Mail::send('frontend.email.contact', [
                'name' => $request->fullname,
                'email' => $request->email,
                'address' => $request->address,
                'title' => $request->title,
                'desc' => $request->content
            ], function ($message) use ($request) {
                //$message->from('john@johndoe.com', 'John Doe');
                // $message->sender('john@johndoe.com', 'John Doe');
                $message->to($request->email, $request->fullname);
                //$message->cc('john@johndoe.com', 'John Doe');
                $message->bcc('nguyenphuochao456@gmail.com', 'Nguyễn Phước Hảo');
                // $message->replyTo('john@johndoe.com', 'John Doe');
                $message->subject($request->title);
                //$message->priority(3);
                //$message->attach('pathToFile');
                return redirect()->route('f.contact')->with(['alert' => 'Gửi thông tin thành công. Chúng tôi sẽ phản hồi bạn sớm nhất', 'type' => 'success']);
            });
        } catch (Throwable $e) {
            return redirect()->route('f.contact')->with(['alert' => $e->getMessage(), 'type' => 'danger']);
        }
    }
    // Trang view tin tức
    public function news(Request $request)
    {
        $new_group = ArticleGroup::where('status', 1)->get();
        $news =  $request->news_order;
        //dd($news);
        switch ($news) {
            case '0':
                $news = Article::where('status', 1)->orderBy('id', 'DESC')->paginate(5);
                break;
            case '1':
                $news = Article::where('status', 1)->orderBy('id', 'ASC')->paginate(5);
                break;
            default:
                $news = Article::where('status', 1)->orderBy('id', 'DESC')->paginate(5);
                break;
        }
        return view('frontend.tintuc', ['news' => $news, 'new_group' => $new_group]);
    }
    // Chi tiết tin tức
    public function news_detail($id)
    {
        $article = Article::where([['status', '=', 1], ['id', '=', $id]])->first();
        return view('frontend.chitiettintuc', ['article' => $article]);
    }
    // Danh mục tin tức
    public function article_group(Request $request, $id)
    {
        $new_group = ArticleGroup::where('status', 1)->get();
        $article_group = ArticleGroup::find($id);
        $news =  $request->news_order;
        switch ($news) {
            case '0':
                $news = Article::where('group_id', $article_group->id)->orderBy('id', 'DESC')->paginate(5);
                break;
            case '1':
                $news = Article::where('group_id', $article_group->id)->orderBy('id', 'ASC')->paginate(5);
                break;
            default:
                $news = Article::where('group_id', $article_group->id)->orderBy('id', 'DESC')->paginate(5);
                break;
        }
        return view('frontend.danh-mục-tin', ['new_group' => $new_group, 'news' => $news]);
    }
    // Trang về chúng tôi
    public function about()
    {
        return view('frontend.gioithieu');
    }
    // Trang đăng nhập
    public function login()
    {
        return view('frontend.dangnhap');
    }
    // Xử lí đăng nhập
    public function post_login(Request $request)
    {
        //Validate
        $acc = ['email' => $request->email, 'password' => $request->password];
        $status = ['email' => $request->email, 'password' => $request->password, 'status' => 1];
        if (Auth::guard('frontend')->attempt($acc)) {
            if (Auth::guard('frontend')->attempt($status)) {
                return redirect()->route('f.home');
            } else {
                return redirect()->route('f.login')->with(['type' => 'danger', 'alert' => 'Tài khoản bị khóa']);
            }
        } else {
            return redirect()->route('f.login')->with(['type' => 'danger', 'alert' => 'Thông tin đăng nhập không đúng']);
        }
    }
    // Đăng xuất tài khoản
    public function logout()
    {
        Auth::guard('frontend')->logout();
        return redirect()->route('f.login');
    }
    // Quản lí tài khoản/quản lí đơn hàng
    public function account()
    {
        $user = Auth::guard('frontend')->user();
        if (isset($user) && $user->status == 1) {
            $id = Auth::guard('frontend')->user()->id;
            $customer = Customer::where(['status' => 1, 'id' => $id])->first();
            return view('frontend.taikhoan', ['customer' => $customer]);
        } else {
            return redirect()->route('f.login');
        }
    }
    public function editAccount()
    {
        $user = Auth::guard('frontend')->user();
        if (isset($user) && $user->status == 1) {
            return view('frontend.sua-tai-khoan');
        } else {
            return redirect()->route('f.login');
        }
    }
    public function updateAccount(Request $request)
    {
        $user = Auth::guard('frontend')->user();
        if (isset($user) && $user->status == 1) {
            $id = Auth::guard('frontend')->user()->id;
            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->password = $request->password ? Hash::make($request->password) : $customer->password;
            $customer->phone = $request->phone;
            $customer->gender = $request->gender;
            $customer->save();
            return redirect()->back()->with(['mess' => 'Cập nhật tài khoản thành công']);
        } else {
            return redirect()->route('f.login');
        }
    }
    // Chi tiết đơn hàng
    public function detailOrder($id)
    {
        $user = Auth::guard('frontend')->user();
        if (isset($user) && $user->status == 1) {
            $order = Order::where('id', $id)->first();
            return view('frontend.chitietdonhang', ['order' => $order]);
        } else {
            return redirect()->route('f.login');
        }
    }
    // Trang view đăng kí
    public function register()
    {
        return view('frontend.dangky');
    }

    // Trang xử lí đăng kí
    public function post_register(Request $request)
    {
        // validate
        $request->validate([
            'email' => 'email|unique:customers',
            'password' => 'required|max:50|min:3',
            'repassword' => 'required|same:password|max:50,min:3'
        ], [
            'email.unique' => 'Email đã tồn tại',
            'password.max' => 'mật khẩu tối đa 50 kí tự',
            'password.min' => 'Mật khẩu tối thiểu 3 kí tự',
            'repassword.same' => 'Mật khẩu nhập lại chưa khớp',
            'repassword.required' => 'Chưa nhập lại password'
        ]);
        // Xử lí
        $customer = new Customer();
        $customer->name = $request->fullname;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->password = Hash::make($request->password);
        $customer->phone = $request->phone;
        $customer->gender = $request->gender;
        $customer->save();
        return redirect()->route('f.register')->with(['mess' => 'Đăng kí tài khoản thành công. Mời bạn đăng nhập']);
    }

    // Tìm kiếm theo tên sách, giá sách, tin tức
    public function search(Request $request)
    {
        $product = Product::where('status', 1)->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->key . '%')
                ->orWhere('price', $request->key);
        })->paginate(20);

        $news = Article::where('status', 1)->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->key . '%')
                ->orWhere('sumary', 'like', '%' . $request->key . '%')
                ->orWhere('content', 'like', '%' . $request->key . '%');
        })->paginate(20);
        return view('frontend.timkiem', ['product' => $product, 'news' => $news]);
    }
    // Ren pass
    public function renpass(Request $request)
    {
        $s = Hash::make(111);
        return $s;
    }
    public function post_comment(Request $request)
    {
        $comment = new Comment();
        $comment->product_id = $request->product_id;
        $comment->customer_id = Auth::guard('frontend')->user()->id;
        $comment->desc = $request->desc;
        $comment->save();
        return response()->json($comment, 200);
        //return redirect()->back()->with(['name' => Auth::guard('frontend')->user()->name, 'desc' => $request->desc, 'time' => Carbon::now('Asia/Ho_Chi_Minh')]);
    }
    public function search_ajax(Request $request){
       $search = $request->input('pattern');
       $products = Product::where('name','LIKE',"%$search%")->get();
       return view('frontend.search_ajax',['products'=>$products]);
    }
}
