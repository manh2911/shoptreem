<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    protected $fillable = ['name', 'color_code'];

    public function detailProducts()
    {
        return $this->hasMany(DetailProduct::class, 'color_id', 'id');
    }
}
