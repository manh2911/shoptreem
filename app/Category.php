<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'slug', 'parent_id', 'imageIcon', 'imageSlide'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
