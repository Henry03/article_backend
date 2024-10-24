<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    public $primaryKey = 'article_id';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'body',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'article_id', 'article_id');
    }

    public function like_article()
    {
        return $this->hasMany(LikeArticle::class, 'article_id', 'article_id');
    }
}
