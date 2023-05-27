<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    public static function _checkurl($user_id, $routename)
    {
        $allow = Fun::select('id')
            ->where([
                'status' => 1,
                'allow' => 1,
                'route_name' => $routename
            ])->first();
        if ($allow) {
            return true;
        }
        return self::select('func_id')
            ->where('user_id', $user_id)
            ->whereIn('func_id', Fun::select('id')->where(['status' => 1, 'route_name' => $routename])->get())->first();
    }
    use HasFactory;
}