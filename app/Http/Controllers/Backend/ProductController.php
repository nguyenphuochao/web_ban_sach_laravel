<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('id', 'DESC')->get();
        return view('backend.product.danhsach', ['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Category::all();
        $author = Author::all();
        $supplier = Supplier::all();
        return view('backend.product.them', ['cate' => $cate, 'author' => $author, 'supplier' => $supplier]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'unique:products,name',
            'sku' => 'unique:products,sku',
            'discount' => 'required|numeric|gt:-1',
        ], [
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'sku.unique' => 'Mã sản phẩm bị trùng',
            'discount.required' => 'Vui lòng nhập giá giảm',
            'discount.numeric' => 'Giá phải là số',
            'discount.gt' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0'
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->category_id  = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->author_id = $request->author_id;
        // Hình
        $file = $request->file('image');
        $file->move(base_path('public/frontend/img'), $file->getClientOriginalName());
        $product->image = $request->file('image')->getClientOriginalName();

        $product->number_of_pages = $request->number_of_pages;
        $product->sumary = $request->sumary;
        $product->content = $request->content;
        $product->sku = $request->sku;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->price_discount = $product->price - ($product->price * $product->discount / 100);
        $product->images = $request->images;
        $product->size = $request->size;
        $product->weight = $request->weight;
        $product->alias = $request->alias;
        $product->keyword = $request->keyword;
        $product->desc = $request->desc;
        $product->imgshare = $request->imgshare;
        $product->title = $request->title;
        $product->status = $request->status;
        $product->save();
        return redirect()->route('product.index')->with(['mess' => 'Thêm sản phẩm thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $supplier = Supplier::all();
        $category = Category::all();
        $author = Author::all();
        return view('backend.product.chitiet', ['supplier' => $supplier, 'product' => $product, 'category' => $category, 'author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $supplier = Supplier::all();
        $category = Category::all();
        $author = Author::all();
        return view('backend.product.sua', ['supplier' => $supplier, 'product' => $product, 'category' => $category, 'author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // validate
        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id  = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->author_id = $request->author_id;
        // Hình
        if ($request->file('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/frontend/img'), $file->getClientOriginalName());
            $product->image = $request->file('image')->getClientOriginalName();
        }

        $product->number_of_pages = $request->number_of_pages;
        $product->sumary = $request->sumary;
        $product->content = $request->content;
        $product->sku = $request->sku;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->price_discount = $product->price - ($product->price * $product->discount / 100);
        $product->images = $request->images;
        $product->size = $request->size;
        $product->weight = $request->weight;
        $product->alias = $request->alias;
        $product->keyword = $request->keyword;
        $product->desc = $request->desc;
        $product->imgshare = $request->imgshare;
        $product->title = $request->title;
        $product->status = $request->status;
        $product->save();
        return redirect()->route('product.index')->with(['mess' => 'Cập nhật sản phẩm thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return back()->with(['mess' => 'Xóa thành công']);
    }
}
