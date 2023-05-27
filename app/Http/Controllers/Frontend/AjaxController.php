<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // Xử lí ajax onchange district
    public function getDistrict($idProvince)
    {
        $district = District::where('province_id', $idProvince)->get();
        foreach ($district as $dis) {
            echo "<option value='" . $dis->district_id  . "'>" . $dis->name . "</option>";
        }
    }
    // Xử lí ajax onchange wards
    public function getWard($idDistrict)
    {
        $ward = Ward::where('district_id', $idDistrict)->get();
        foreach ($ward as $w) {
            echo "<option value='" . $w->wards_id  . "'>" . $w->name . "</option>";
        }
    }
    public function index()
    {
        $cus = Customer::orderBy('id', 'DESC')->get();
        return response()->json($cus, 200);
    }
    public function demo()
    {
        return view('ajax');
    }
    public function post_demo(Request $request)
    {
        $cus = Customer::create($request->all());
        return response()->json($cus, 200);
    }
    public function del($id)
    {
        $cus = Customer::find($id);
        $cus->delete();
        return response()->json($cus, 200);
    }
}
