<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getcategoryStatusTextAttribute()
    {
        if($this->status==1){
            return "<badge class='badge badge-success'>Active</badge>";
        }else{
            return "<badge class='badge badge-danger'>Inactive</badge>";
        }
    }

    // Define the relationship to get the parent category (self-referencing)
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    // Optionally, define the relationship to get all child categories (in case you need it)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

}
