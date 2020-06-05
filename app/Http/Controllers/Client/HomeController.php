<?php

namespace App\Http\Controllers\Client;

use App\Brand;
use App\Category;
use App\Helper\ServiceAction;
use App\Http\Controllers\Controller;
use App\ImageDetailProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

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

    public function sort(Request $request) {
        $sortByBrand = isset($request->sortByBrand) ? $request->sortByBrand : null;
        $sortByPrice = isset($request->sortByPrice) ? $request->sortByPrice : null;
        $sortByName = isset($request->sortByName) ? $request->sortByName : null;
        $idCurrentCategory = isset($request->idCurrentCategory) ? $request->idCurrentCategory : null;

        $currentCategory = Category::findOrFail($idCurrentCategory);
        $categories = [];
        if ($currentCategory->parent_id != 0) {
            $categories[] = $currentCategory->id;

        } else {
            $listCategories = Category::select('id')->where('parent_id', $idCurrentCategory)->get()->toArray();
            $categories = array_map(function ($item) {
                return $item['id'];
            }, $listCategories);
        }

        $query = DB::table('products')
            ->select('id', 'name', 'origin_price', 'discount')
            ->whereIn('category_id', $categories);

        if (isset($sortByBrand) && count($sortByBrand) > 0) {
            $query->whereIn('brand_id', $sortByBrand);
        }

        if (
            isset($sortByPrice) &&
            isset($sortByPrice['from']) && is_numeric($sortByPrice['from']) &&
            isset($sortByPrice['to']) && is_numeric($sortByPrice['to'])
        ) {
            $query->where('origin_price', '>=', $sortByPrice['from'])->where('origin_price', '<=', $sortByPrice['to']);
        }

        if (isset($sortByName)) {
            switch ($sortByName) {
                case ServiceAction::SORT_PRICE_ASC:
                    $query->orderBy('origin_price', 'asc');
                    break;
                case ServiceAction::SORT_PRICE_DESC:
                    $query->orderBy('origin_price', 'desc');
                    break;
                case ServiceAction::SORT_NAME_ASC:
                    $query->orderBy('name', 'asc');
                    break;
                case ServiceAction::SORT_NAME_DESC:
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('id', 'desc');
            }
        }

        $products = $query->get();
dd($products);
    }
}
