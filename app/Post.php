<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'category_id', 'images','auther'];


    protected $casts = [
        'images'  =>  'array'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
