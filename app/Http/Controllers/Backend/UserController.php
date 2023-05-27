<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('id', 'DESC')->get();
        return view('backend.user.danhsach', compact(['user']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group_id = UserGroup::all();
        return view('backend.user.them', compact(['group_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => 'unique:users,username',
                'email' => 'unique:users,email',
                'password' => 'min:3|max:50'
            ],
            [
                'username.unique' => 'Tên đăng nhập đã có người sử dụng',
                'email.unique' => 'Email đã có người sử dụng',
                'password.min' => 'Mật khẩu phải trên 3 kí tự',
                'password.max' => 'Mật khẩu tối đa chỉ 50 kí tự'
            ]
        );
        $user = new User();
        $user->group_id = $request->group_id;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->email = $request->email;
        // xử lí ảnh
        if ($request->has('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/frontend/img/user'), $file->getClientOriginalName());
            $user->image = $request->file('image')->getClientOriginalName();
        }
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('user.index')->with(['mess' => 'Thêm mới thành công admin']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $group_id = UserGroup::all();
        return view('backend.user.chitiet', compact('user', 'group_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $group_id = UserGroup::all();
        return view('backend.user.sua', compact(['user', 'group_id']));
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

        $user = User::find($id);
        $user->group_id = $request->group_id;
        $user->name = $request->name;
        $user->username = $request->username;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->email = $request->email;
        // xử lí ảnh
        if ($request->has('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/frontend/img/user'), $file->getClientOriginalName());
            $user->image = $request->file('image')->getClientOriginalName();
        }
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('user.index')->with(['mess' => 'Cập nhật thành công admin']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with(['mess' => 'Xóa thành công admin']);
    }
}
