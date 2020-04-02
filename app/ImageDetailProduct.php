<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageDetailProduct extends Model
{
    protected $table = 'image_detail_products';

    public function detailProduct()
    {
        return $this->belongsTo(DetailProduct::class, 'detail_product_id', 'id');
    }
}
