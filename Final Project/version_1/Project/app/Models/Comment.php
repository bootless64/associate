<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'news_id', 'article_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function news(){
        return $this->belongsTo(News::class);
    }

    public function article(){
        return $this->belongsTo(Article::class);
    }
}
