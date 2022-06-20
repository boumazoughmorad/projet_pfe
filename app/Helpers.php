<?php
function getPrice($priceInDecimals){
    $price= floatval($priceInDecimals);
    return number_format($priceInDecimals,2,',',' ').' dh';
}