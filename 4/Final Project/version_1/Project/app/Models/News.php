<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'slider_images', 'user_id'];

    protected $casts = [
        'slider_images' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function approvedComments(){
        return $this->hasMany(Comment::class)->where('status', 'approved');
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }
}
