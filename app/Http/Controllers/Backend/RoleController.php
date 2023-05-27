<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Fun;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = User::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('backend.role.danhsach', compact(['role']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);

        $fun = Fun::where('parent_id', 0)->get();
        // Lấy ra thông tin function thuộc về user đó
        $funs = [];
        $role = Role::where('user_id', $user->id)->get();
        foreach ($role as $item) {
            array_push($funs, $item->func_id);
        }

        return view('backend.role.phanquyen', compact(['user', 'fun', 'funs']));
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
        $role = Role::where('user_id', $user->id);
        $role->delete();
        $funs = $request->funs;
        foreach ($funs as $item) {
            $role = new Role();
            $role->user_id = $user->id;
            $role->func_id = $item;
            $role->save();
        }
        return redirect()->back()->with(["mess" => "Cấp quyền thành công {$user->name}"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
