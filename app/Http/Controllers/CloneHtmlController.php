<?php

namespace App\Http\Controllers;

use App\Brand;
use App\ImageDetailProduct;
use App\Product;
use Illuminate\Http\Request;

class CloneHtmlController extends Controller
{
    public $category_id = 19;

    public function clone() {
        $arr_brand_id = [];
        $brands = Brand::select('id')->get()->toArray();
        foreach ($brands as $brand){
            $arr_brand_id[] = $brand['id'];
        }

        include "simple_html_dom.php";
        $url = 'https://shoptretho.com.vn/danh-muc/xe-dap-tre-em';
        $html = file_get_html($url);
        foreach ($html->find(".product_child ") as $key => $dom) {

            $image = $dom->find(".pro_img a img");

            $name = $image[0]->alt;
            $name = html_entity_decode($name, ENT_COMPAT | ENT_HTML401, 'UTF-8');
            $slug = changeTitle($name);

            $quantity = 0;
            $price = $dom->find(".product_price .price_item");
            $priceText = $price[0]->text();
            $priceText = str_replace(".", "", $priceText);
            $price = str_replace("đ", "", $priceText);
            if ((float)$price == 0) {
                $origin_price = 50000;
            } else {
                $origin_price = $price;
                $quantity = 20;
            }

            $old_origin_price = 0;
            $discount = 0;
            $old_price = $dom->find(".product_price .old_price");
            if (count($old_price) != 0) {
                $old_priceText = $old_price[0]->text();
                $old_priceText = str_replace(".", "", $old_priceText);
                $old_origin_price = str_replace("đ", "", $old_priceText);

                $discount = (int)(($old_origin_price - $origin_price) * 100 / $old_origin_price);
            }


            $product = new Product();
            $product->name = $name;
            $product->slug = $slug;
            $product->category_id = $this->category_id;
            $product->brand_id =  $arr_brand_id[array_rand($arr_brand_id)];
            $product->user_id = 1;
            $product->description = '';
            $product->origin_price = $old_origin_price > $origin_price ? $old_origin_price : $origin_price;
            $product->discount = $discount;
            $product->status = 1;
            $product->quantity = $quantity;

            $product->code = '';
            $product->save();

            $product->update(['code' => 'STE-' . $product->id]);


            for ($i = 0; $i < 2; $i++){
                $linkImage = $image[0]->src;
                $linkImgTrue = explode('?', $linkImage)[0];
                $extentImg = substr($linkImgTrue, -4, 4);
                $nameImg = 'imageProduct' . $i . time() . $extentImg;
                $img = '../public/upload/image_product/' . $nameImg;
                copy($linkImgTrue, $img);

                $productImage_imageName = 'upload/image_product/' . $nameImg;
                $productImage = new ImageDetailProduct();
                $productImage->image = $productImage_imageName;
                $productImage->product_id = $product->id;
                $productImage->save();
            }

            echo $key ."|" .$origin_price."|" . $old_origin_price;
            echo "<br>";


            if ($key == 10) break;

        }
        echo "Done";
    }
}
