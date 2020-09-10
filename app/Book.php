<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'author',
        'published_date',
        'category_id',
        'user_id',
    ];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
