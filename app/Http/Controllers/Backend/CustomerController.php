<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::orderBy('id', 'DESC')->get();
        return view('backend.customer.danhsach', compact(['customer']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.them');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate(
            [
                'email' => 'unique:customers,email',
                'password' => 'min:3|max:50'
            ],
            [
                'email.unique' => 'Email đã có người sử dụng',
                'password.min' => 'Mật khẩu phải trên 3 kí tự',
                'password.max' => 'Mật khẩu tối đa chỉ 50 kí tự'
            ]
        );
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->password = Hash::make($request->password);
        $customer->phone = $request->phone;
        $customer->gender = $request->gender;
        $customer->status = $request->status;
        $customer->save();
        return redirect()->route('customer.index')->with(['mess' => 'Thêm thành công user']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('backend.customer.chitiet', compact(['customer']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('backend.customer.sua', compact(['customer']));
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
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->password = $request->password ? Hash::make($request->password) : $customer->password;
        $customer->phone = $request->phone;
        $customer->gender = $request->gender;
        $customer->status = $request->status;
        $customer->save();
        return redirect()->route('customer.index')->with(['mess' => 'Cập nhật user thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return back()->with(['mess' => 'Xóa thành công']);
    }
}
