<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    function product()
    {
        return $this->hasMany(Product::class, 'author_id', 'id');
    }
    use HasFactory;
}
