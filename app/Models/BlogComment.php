<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'comment','blog_id','status']; 

    public function getcommentStatusTextAttribute()
    {
        if($this->status==1){
            return "<badge class='badge badge-success'>Active</badge>";
        }else{
            return "<badge class='badge badge-danger'>Inactive</badge>";
        }
    }
}
