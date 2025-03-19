<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function getblogStatusTextAttribute()
    {
        if($this->status==1){
            return "<badge class='badge badge-success'>Active</badge>";
        }else{
            return "<badge class='badge badge-danger'>Inactive</badge>";
        }
    }

    public function blogAttachments()
    {
        return $this->hasMany(BlogAttachment::class,'blog_id');
    }
    public function blogAttachment()
    {
        return $this->hasOne(BlogAttachment::class,'blog_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function blogTag()
    {
        return $this->hasMany(BlogTag::class,'blog_id');
    }
    public function tags()
{
    return $this->belongsToMany(BlogTag::class);
}

public function comments()
{
    return $this->hasMany(BlogComment::class,'blog_id','id');
}
public function comment()
{
    return $this->hasOne(BlogComment::class,'blog_id','id');
}

public function bloglikes()
{
    return $this->hasMany(Bloglike::class, 'blog_id');  // 'blog_id' should be the foreign key in the Bloglike table
}

}
