<?php
session_start();
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
$pid = intval($_GET['product_id']);
$quantity = intval($_GET['quantity']);
$isFound = false;
for ($i=0; $i<count($_SESSION['cart']); $i++){
    if($_SESSION['cart'][$i]['product_id'] == $pid){
        $_SESSION['cart'][$i]['quantity'] += $quantity;
        $isFound = true;
    }
}

if(!$isFound){
    $conn = new mysqli("localhost", "root", "", "assignment1");
    $sql = "SELECT * FROM products where product_id =$pid";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        $row['quantity'] = $quantity;
        array_push($_SESSION['cart'], $row);
    }
    $conn->close();
}

header('Location: '.$_SERVER['HTTP_REFERER']);