<?php
session_start();
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

$invalidItems = [];
for ($i=0; $i<count($_SESSION['cart']); $i++){
   if(intval($_SESSION['cart'][$i]['quantity']) > intval($_SESSION['cart'][$i]['in_stock'])){
       array_push($invalidItems, $_SESSION['cart'][$i]);
   }
}

header('Content-Type: application/json');
echo json_encode($invalidItems);
