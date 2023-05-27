<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function log()
    {
        return view('backend.setting.log');
    }

    public function cauhinh()
    {
        return view('backend.setting.cauhinh');
    }
}
