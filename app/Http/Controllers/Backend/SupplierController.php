<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::orderBy('id', 'DESC')->get();
        return view('backend.supplier.danhsach', compact(['supplier']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.supplier.them');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;

        if ($request->has('image')) {
            $file_img = $request->file('image');
            $file_img->move(base_path('public/frontend/img/supplier'), $file_img->getClientOriginalName());
            $supplier->image = $request->file('image')->getClientOriginalName();
        }

        if ($request->has('logo')) {
            $file_logo = $request->file('logo');
            $file_logo->move(base_path('public/frontend/img/supplier'), $file_logo->getClientOriginalName());
            $supplier->logo = $request->file('logo')->getClientOriginalName();
        }

        $supplier->alias = $request->alias;
        $supplier->keyword = $request->keyword;
        $supplier->desc = $request->desc;
        $supplier->imgshare = $request->imgshare;
        $supplier->title = $request->title;
        $supplier->status = $request->status;
        $supplier->save();
        return redirect()->route('supplier.index')->with(['mess' => 'Thêm thành công nhà xuất bản']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('backend.supplier.chitiet', compact(['supplier']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('backend.supplier.sua', compact(['supplier']));
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
        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        if ($request->has('image')) {
            $file_img = $request->file('image');
            $file_img->move(base_path('public/frontend/img/supplier'), $file_img->getClientOriginalName());
            $supplier->image = $request->file('image')->getClientOriginalName();
        }
        if ($request->has('logo')) {
            $file_logo = $request->file('logo');
            $file_logo->move(base_path('public/frontend/img/supplier'), $file_logo->getClientOriginalName());
            $supplier->logo = $request->file('logo')->getClientOriginalName();
        }
        $supplier->alias = $request->alias;
        $supplier->keyword = $request->keyword;
        $supplier->desc = $request->desc;
        $supplier->imgshare = $request->imgshare;
        $supplier->title = $request->title;
        $supplier->status = $request->status;
        $supplier->save();
        return redirect()->route('supplier.index')->with(['mess' => 'Thêm thành công nhà xuất bản']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->back()->with(['mess' => 'Xóa thành công nhà xuất bản']);
    }
}
