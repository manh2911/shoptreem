<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'user_id',
        'description',
        'origin_price',
        'discount',
        'status',
        'quantity', 
        'code'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function imageDetailProduct()
    {
        return $this->hasMany(ImageDetailProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
