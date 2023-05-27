<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    function article_group()
    {
        return $this->belongsTo(ArticleGroup::class, 'group_id', 'id');
    }
    use HasFactory;
}