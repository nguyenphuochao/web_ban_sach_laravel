<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Author::orderBy('id', 'DESC')->get();
        return view('backend.author.danhsach', compact(['author']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.author.them');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new Author();
        $author->name = $request->name;
        $author->phone = $request->phone;
        $avatar = $request->file('avatar');
        $avatar->move(base_path('public/frontend/img/author'), $avatar->getClientOriginalName());
        $author->avatar = $request->file('avatar')->getClientOriginalName();
        $author->address = $request->address;
        $author->email = $request->email;
        $author->sumary = $request->sumary;
        $author->status = $request->status;
        $author->save();
        return redirect()->route('author.index')->with(['mess' => 'Thêm thành công tác giả']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        return view('backend.author.chitiet', compact(['author']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
        return view('backend.author.sua', compact(['author']));
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
        $author = Author::find($id);
        $author->name = $request->name;
        $author->phone = $request->phone;
        if ($request->has('avatar')) {
            $avatar = $request->file('avatar');
            $avatar->move(base_path('public/frontend/img/author'), $avatar->getClientOriginalName());
            $author->avatar = $request->file('avatar')->getClientOriginalName();
        }
        $author->address = $request->address;
        $author->email = $request->email;
        $author->sumary = $request->sumary;
        $author->status = $request->status;
        $author->save();
        return redirect()->route('author.index')->with(['mess' => 'Sửa thành công tác giả']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();
        return redirect()->back()->with(['mess' => 'Xóa thành công tác giả']);
    }
}
