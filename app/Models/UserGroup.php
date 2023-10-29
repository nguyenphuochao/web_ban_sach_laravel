<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'user_groups';
    function user()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }
    use HasFactory;
}
