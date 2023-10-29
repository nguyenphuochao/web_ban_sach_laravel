<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.danhsach', compact(['category']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('parent_id', 0)->get();
        return view('backend.category.them', compact(['category']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->sumary = $request->sumary;
        $category->content = $request->content;
        // Xử lí ảnh
        $file = $request->file('image');
        $file->move(base_path('public/frontend/img/category'), $file->getClientOriginalName());
        $category->image = $request->file('image')->getClientOriginalName();

        $category->alias = $request->alias;
        $category->keyword = $request->keyword;
        $category->desc = $request->desc;
        $category->imgshare = $request->imgshare;
        $category->title = $request->title;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('category.index')->with(['mess' => 'Thêm danh mục thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cate_item = Category::find($id);
        $category = Category::all();
        return view('backend.category.chitiet', compact(['category', 'cate_item']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate_item = Category::find($id);
        $category = Category::all();
        return view('backend.category.sua', compact(['category', 'cate_item']));
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
        $category = Category::find($id);
        $category->name = $request->name;
        $category->sumary = $request->sumary;
        $category->content = $request->content;
        // Xử lí ảnh
        if ($request->file('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/frontend/img/category'), $file->getClientOriginalName());
            $category->image = $request->file('image')->getClientOriginalName();
        }
        $category->alias = $request->alias;
        $category->keyword = $request->keyword;
        $category->desc = $request->desc;
        $category->imgshare = $request->imgshare;
        $category->title = $request->title;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('category.index')->with(['mess' => 'Cập nhật danh mục thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back()->with(['mess' => 'Xóa thành công']);
    }
}