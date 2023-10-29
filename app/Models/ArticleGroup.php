<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleGroup extends Model
{
    protected $table = 'article_groups';
    function article()
    {
        return $this->hasMany(Article::class, 'group_id', 'id');
    }
    use HasFactory;
}