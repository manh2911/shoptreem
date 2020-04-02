<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    protected $table = 'detail_products';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function imageDetailProducts()
    {
        return $this->hasMany(ImageDetailProduct::class, 'detail_product_id', 'id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
