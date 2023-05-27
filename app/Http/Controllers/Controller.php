<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{

    // view share toàn cục
    public function __construct()
    {
        $cate = Category::all();
        view()->share('cate', $cate);
        //dd(Auth::guard('frontend')->user());
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
