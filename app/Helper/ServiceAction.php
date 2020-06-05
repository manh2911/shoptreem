<?php


namespace App\Helper;


class ServiceAction
{
    //action admin
    const ACTION_DELETE = 1;
    const ACTION_ACTIVE = 2;
    const ACTION_INACTIVE = 3;
    // status
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    //color
    const COLOR_CATEGORIES = ['#d4595e', '#2e4893', '#258905', '#ff205f', '#0084cc', '#17b4bb', '#155970', '#9f005d'];
    //sort
    const SORT_RANDOM = 1;
    const SORT_PRICE_ASC = 2;
    const SORT_PRICE_DESC = 3;
    const SORT_NAME_ASC = 4;
    const SORT_NAME_DESC = 5;

    public static function showPrice($origin_price, $discount) {
        $priceShow = ServiceAction::calculatorPrice($origin_price, $discount);

        return number_format($priceShow);
    }

    public static function showDiscount($origin_price, $discount) {
        $discountShow = ($origin_price - ServiceAction::calculatorPrice($origin_price, $discount)) /1000;

        return number_format($discountShow);
    }

    public static function calculatorPrice($origin_price, $discount) {
        $price = $origin_price - ($origin_price * $discount / 100);

        return round($price/1000)* 1000;
    }

}
