<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleGroup;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::orderBy('id', 'DESC')->get();
        return view('backend.article.danhsach', compact(['article']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article_group = ArticleGroup::all();
        return view('backend.article.them', compact(['article_group']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->group_id = $request->group_id;
        $article->name = $request->name;
        if ($request->has('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/frontend/img/news'), $file->getClientOriginalName());
            $article->image = $request->file('image')->getClientOriginalName();
        }
        $article->sumary = $request->sumary;
        $article->content = $request->content;
        $article->alias = $request->alias;
        $article->keyword = $request->keyword;
        $article->desc = $request->desc;
        $article->imgshare = $request->imgshare;
        $article->title = $request->title;
        $article->status = $request->status;
        $article->save();
        return redirect()->route('article.index')->with(['mess' => 'Thêm bài viết mới thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article_group = ArticleGroup::all();
        $article = Article::find($id);
        return view('backend.article.sua', compact(['article_group', 'article']));
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
        $article = Article::find($id);
        $article->group_id = $request->group_id;
        $article->name = $request->name;
        if ($request->has('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/frontend/img/news'), $file->getClientOriginalName());
            $article->image = $request->file('image')->getClientOriginalName();
        }
        $article->sumary = $request->sumary;
        $article->content = $request->content;
        $article->alias = $request->alias;
        $article->keyword = $request->keyword;
        $article->desc = $request->desc;
        $article->imgshare = $request->imgshare;
        $article->title = $request->title;
        $article->status = $request->status;
        $article->save();
        return redirect()->route('article.index')->with(['mess' => 'Cập nhật bài viết mới thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('article.index')->with(['mess' => 'Xóa bài viết thành công']);
    }
}