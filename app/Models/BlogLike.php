<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogLike extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'blog_id'];

    // Define a relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define a relationship to the Blog model
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
