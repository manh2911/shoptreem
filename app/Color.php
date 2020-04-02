<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    public function detailProducts()
    {
        return $this->hasMany(DetailProduct::class, 'color_id', 'id');
    }
}
