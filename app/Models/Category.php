<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    // Đệ qui danh mục
    function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    use HasFactory;
}
