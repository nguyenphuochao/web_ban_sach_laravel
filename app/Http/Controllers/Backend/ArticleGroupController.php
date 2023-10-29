<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ArticleGroup;
use Illuminate\Http\Request;

class ArticleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article_group = ArticleGroup::orderBy('id', 'DESC')->get();
        return view('backend.article_group.danhsach', compact(['article_group']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article_group = ArticleGroup::where('parent_id', 0)->get();
        return view('backend.article_group.them', compact(['article_group']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article_group = new ArticleGroup();
        $article_group->name = $request->name;
        $article_group->sumary = $request->sumary;
        $article_group->content = $request->content;
        if ($request->has('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/frontend/img/news'), $file->getClientOriginalName());
            $article_group->image = $request->file('image')->getClientOriginalName();
        }
        $article_group->parent_id = $request->parent_id;
        $article_group->alias = $request->alias;
        $article_group->keyword = $request->keyword;
        $article_group->desc = $request->desc;
        $article_group->imgshare = $request->imgshare;
        $article_group->title = $request->title;
        $article_group->status = $request->status;
        $article_group->save();
        return redirect()->route('article_group.index')->with(['mess' => 'Thêm mới danh mục tin tức thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article_group = ArticleGroup::find($id);
        $parent_id = ArticleGroup::where('parent_id', 0)->get();
        return view('backend.article_group.sua', compact(['article_group', 'parent_id']));
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
        $article_group = ArticleGroup::find($id);
        $article_group->name = $request->name;
        $article_group->sumary = $request->sumary;
        $article_group->content = $request->content;
        if ($request->has('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/frontend/img/news'), $file->getClientOriginalName());
            $article_group->image = $request->file('image')->getClientOriginalName();
        }
        $article_group->parent_id = $request->parent_id;
        $article_group->alias = $request->alias;
        $article_group->keyword = $request->keyword;
        $article_group->desc = $request->desc;
        $article_group->imgshare = $request->imgshare;
        $article_group->title = $request->title;
        $article_group->status = $request->status;
        $article_group->save();
        return redirect()->route('article_group.index')->with(['mess' => 'Cập nhật danh mục tin tức thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article_group = ArticleGroup::find($id);
        $article_group->delete();
        return back()->with(['mess' => 'Xóa danh mục tin tức thành công']);
    }
}