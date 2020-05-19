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
    const SORT_DISCOUNT = 6;

}
