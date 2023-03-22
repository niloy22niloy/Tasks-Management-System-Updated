<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBasedProject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    function rel_to_category(){
        return $this->belongsTo(CategoryModel::class,'category_id');
    }

     function rel_to_user(){
        return $this->belongsTo(User::class,'added_by');
    }
}
