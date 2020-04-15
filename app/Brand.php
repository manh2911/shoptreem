<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = ['name', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
