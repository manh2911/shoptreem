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
    // plus or minus quantity in cart
    const PLUS = 1;
    const MINUS = 2;
    // delivery time
    const DURING_OFFICE_HOURS = 1;
    const OUT_OFFICE_HOURS = 2;
    //status order
    const ORDER_IN_PROCESS = 1;
    const ORDER_SUCCESS = 2;
    const ORDER_CANCEL = 3;

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

        return $price;
    }

    public static function getProductBySort($products, $countPage, $currentPage, $nextPage) {
        switch ($nextPage) {
            case 'previous':
                $page = $currentPage != 1 ? $currentPage - 1 : 1;
                break;
            case 'next':
                $page = $currentPage != $countPage ? $currentPage + 1 : $countPage;
                break;
            default:
                $page = $nextPage;
        }

        $listProductInPage = [];
        foreach ($products as $key => $product) {
            if ($key >=  ($page * 12 - 12) && $key <= $page * 12 - 1) {
                $listProductInPage[] = $product;
            }
        }

        return $data = [
            'listProductInPage' => $listProductInPage,
            'page' => $page
        ];
    }

    public static function showStatusOrder($status){
        switch ($status) {
            case ServiceAction::ORDER_CANCEL:
                return 'Cancel';
            case ServiceAction::ORDER_SUCCESS:
                return 'Success';
            default:
                return 'In Process';
        }
    }

}
