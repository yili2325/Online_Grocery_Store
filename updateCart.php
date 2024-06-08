<?php
session_start();
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
$total=0.0;
if($_GET['product_id'] == "all"){
    $_SESSION['cart'] = [];
} else {
    $newCart = [];
    $pid = intval($_GET['product_id']);
    $quantity = intval($_GET['quantity']);
    for ($i=0; $i<count($_SESSION['cart']); $i++){
        if($_SESSION['cart'][$i]['product_id'] == $pid){
            if($quantity != 0) {
                $_SESSION['cart'][$i]['quantity'] = $quantity;
                array_push($newCart, $_SESSION['cart'][$i]);
            }
        } else {
            array_push($newCart, $_SESSION['cart'][$i]);
        }

    }
    $_SESSION['cart'] = $newCart;
}

for ($i=0; $i<count($_SESSION['cart']); $i++){
    $total += intval($_SESSION['cart'][$i]['quantity']) *  floatval($_SESSION['cart'][$i]['unit_price']);
}
echo $total;