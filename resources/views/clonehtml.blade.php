<?php
//require "config.php";
//include 'db_connection.php';
//$conn = OpenCon();
include "simple_html_dom.php";
$url = 'http://www.lapdatkhuvuichoi.vn/';
$html = file_get_html($url);
foreach ($html->find(".level0 .menu-item a") as $key => $dom) {

    $linkProduct = $dom->href;
    $reverseLinkProduct = strrev($linkProduct);
    $reverseLinkProduct = trim($reverseLinkProduct, 'lmth.');
    $pos = strpos($reverseLinkProduct, '-');
    $len = strlen($reverseLinkProduct);
    $num = $len - $pos;
    $str = strrev($reverseLinkProduct);
    //id goc
    $stringId = substr($str, $num, $len);
    print_r($stringId);

    $title = html_entity_decode($dom->title, ENT_COMPAT | ENT_HTML401, 'UTF-8');
//    mysqli_set_charset($conn, "utf8");
//    $sql = "INSERT INTO categories (title, id_old)
//                VALUES ('$title', '$stringId')";
//    if ($conn->query($sql) === TRUE) {
//        echo 'ok';
//        echo '</br>';
//    } else {
//        echo 'xit';
//    }

}

//CloseCon($conn);
