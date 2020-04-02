<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    public function detailProducts()
    {
        return $this->hasMany(DetailProduct::class, 'size_id', 'id');
    }
}
