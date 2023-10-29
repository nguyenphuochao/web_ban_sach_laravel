<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fun extends Model
{
    protected $table = 'functions';
    // public function funcs($parent_id = 0)
    // {
    //     return $this->where(['status' => 1, 'parent_id', $parent_id])->get();
    // }

    // Kiểm tra xem dữ liệu bảng functions có nằm trong bảng roles hay ko
    public static function _listmenu($user_id, $parent_id = 0)
    {
        return self::where([
            'status' => 1,
            'parent_id' => $parent_id,
            'show_menu' => 1
        ])
            ->whereIn('id', Role::select('func_id')->where('user_id', $user_id))
            ->get();
    }

    use HasFactory;
}
