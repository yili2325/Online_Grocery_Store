<?php
session_start();
$shoppingCart = [];

if (isset($_SESSION['cart'])) {
    $shoppingCart = array_slice($_SESSION['cart'], 0);
}
$conn = new mysqli("localhost", "root", "", "assignment1");
for ($i = 0; $i < count($_SESSION['cart']); $i++) {
    $quantity = $_SESSION['cart'][$i]['quantity'];
    $id = $_SESSION['cart'][$i]['product_id'];
    $sql = "update products set in_stock = in_stock - $quantity where product_id = $id";
    $result = $conn->query($sql);
}
$conn->close();

$_SESSION['cart'] = [];
?>
<html>
<head>
    <title>Yi Li Grocery Store/detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <script src="jquery-3.7.1.min.js"></script>
</head>
<body>
<?php require_once('header.php'); ?>
<h4 class="text-center mt-4 mb-4">The following detail has been sent to your email: <?php echo $_POST['email'] ?></h4>
<div class="container d-flex ">
    <table class="table">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
        </tr>
        </thead>
        <tbody class="align-middle" id="cartBody">
        <?php
        $total = 0.0;
        foreach ($shoppingCart as $row) {
            $total += intval($row['quantity']) * floatval($row['unit_price'])
            ?>
            <tr>
                <td>
                    <img src="/images/<?php echo $row['product_id'] ?>.png" class="card-img-top cartPic">
                </td>
                <td><?php echo $row['product_name'] ?></td>
                <td>$<?php echo $row['unit_price'] ?></td>
                <td class="cartQuality">
                    <p class="text-left m-0"
                       onchange="updateShoppingCart('<?php echo $row['product_id'] ?>', this)"><?php echo $row['quantity'] ?></p>
                </td>
            </tr>
            <?php
        } ?>
        </tbody>
    </table>
</div>
<h4 class="text-center">Total Price: $<span id="totalPrice"><?php echo $total ?></span></h4>
<p></p>
<h5 class="text-center">Thanks for ordering!</h5>


</body>
</html>