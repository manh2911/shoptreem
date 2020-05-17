<?php

namespace App\Http\Controllers\Client;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $parent_categories = Category::where('parent_id', '0')->get();
        $products = Product::all();
        $brands = Brand::orderBy('id')->limit(10)->get();

        return view('Client.layout.index', compact('parent_categories', 'brands'));
    }
}
