<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LikeArticle extends Model
{
    use HasFactory, SoftDeletes;

    public $primaryKey = 'like_id';
    protected $fillable = ['user_id', 'article_id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'article_id');
    }
}
