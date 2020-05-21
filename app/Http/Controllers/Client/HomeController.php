<?php

namespace App\Http\Controllers\Client;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\ImageDetailProduct;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $parent_categories = Category::where('parent_id', '0')->get();
        $brands = Brand::orderBy('id')->limit(10)->get();

        return view('Client.page.index', compact('parent_categories', 'brands'));
    }

    public function category($id) {
        $currentCategory = Category::findOrFail($id);
        $parent_categories = Category::where('parent_id', '0')->get();

        if ($currentCategory->parent_id == 0) {
            $relateCategories = Category::where('parent_id', $id)->get();
            $idRelateCategories = array_map(function ($item) {
                return $item['id'];
            }, $relateCategories->toArray());
            $products = Product::whereIn('category_id', $idRelateCategories)->paginate(12);
        } else {
            $relateCategories = Category::where('parent_id', $currentCategory->parent_id)->whereNotIn('id', [$id])->get();
            $products = Product::where('category_id', $id)->paginate(12);
        }

        $brands = Brand::all();

        return view('Client.page.category', compact(
            'currentCategory',
            'parent_categories',
            'relateCategories',
            'products',
            'brands'
        ));
    }

    public function product($id){
        $product = Product::findOrFail($id);
        $currentCategory = $product->category;
        $parent_categories = Category::where('parent_id', '0')->get();
        $productImages = ImageDetailProduct::where('product_id', $id)->get();
        $relativeProducts = Product::where('category_id', $product->category_id)->orderBy('id', 'desc')->limit(6)->get();

        return view('Client.page.product', compact(
                'product',
                'currentCategory',
            'parent_categories',
            'productImages',
            'relativeProducts'
            ));
    }
}
