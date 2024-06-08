<?php
session_start();
$conn = new mysqli("localhost", "root", "", "assignment1");
$product_id = $_GET['product_id'];
$sql = "SELECT * FROM products where product_id = $product_id";
$result = $conn->query($sql);
$conn->close();

?>
<html>
<head>
    <title>Yi Li Grocery Store/detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <script src="jquery-3.7.1.min.js"></script>
</head>
<body>
<?php require_once('header.php') ?>
<nav class="text-center">
    <div>
        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"" href="">Frozen</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/?keyword=Fish Fingers">Fish Fingers</a></li>
                <li><a class="dropdown-item" href="/?keyword=Hamburger Patties">Hamburger Patties</a></li>
                <li><a class="dropdown-item" href="/?keyword=Shelled Prawns">Shelled Prawns</a></li>
                <li><a class="dropdown-item" href="/?keyword=Tub Ice Cream">Tub Ice Cream</a></li>
            </ul>
        </div>

        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"" href="">Fresh</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/?keyword=Cheddar Cheese">Cheddar Cheese</a></li>
                <li><a class="dropdown-item" href="/?keyword=T Bone Steak">T Bone Steak</a></li>
                <li><a class="dropdown-item" href="/?keyword=Navel Oranges">Navel Oranges</a></li>
                <li><a class="dropdown-item" href="/?keyword=Bananas">Bananas</a></li>
                <li><a class="dropdown-item" href="/?keyword=Peaches">Peaches</a></li>
                <li><a class="dropdown-item" href="/?keyword=Grapes">Grapes</a></li>
                <li><a class="dropdown-item" href="/?keyword=Apples">Apples</a></li>
            </ul>
        </div>

        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"" href="">Beverage</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/?keyword=Earl Grey Tea Bags">Earl Grey Tea Bags</a></li>
                <li><a class="dropdown-item" href="/?keyword=Instant Coffee">Instant Coffee</a></li>
                <li><a class="dropdown-item" href="/?keyword=Chocolate Bar">Chocolate Bar</a></li>
            </ul>
        </div>

        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"" href="">Home</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/?keyword=Panadol">Panadol</a></li>
                <li><a class="dropdown-item" href="/?keyword=Bath Soap">Bath Soap</a></li>
                <li><a class="dropdown-item" href="/?keyword=Garbage Bags">Garbage Bags</a></li>
                <li><a class="dropdown-item" href="/?keyword=Washing Powder">Washing Powder</a></li>
                <li><a class="dropdown-item" href="/?keyword=Laundry Bleach">Laundry Bleach</a></li>
            </ul>
        </div>

        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"" href="">Pet-food</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/?keyword=Dry Dog Food">Dry Dog Food</a></li>
                <li><a class="dropdown-item" href="/?keyword=Bird Food">Bird Food</a></li>
                <li><a class="dropdown-item" href="/?keyword=Cat Food">Cat Food</a></li>
                <li><a class="dropdown-item" href="/?keyword=Fish Food">Fish Food</a></li>
            </ul>
        </div>
</nav>
<div class="container d-flex">
    <div class="flex-shrink-0 mt-6">
        <?php
        while ($row = $result->fetch_assoc()) {
        $inStock = $row["in_stock"];
        ?>
        <img src="/images/<?php echo $row['product_id']; ?>.png" class="card-img-top productDetailPic" alt="">
    </div>
    <form action="addToCart.php">
        <table class="table detailTable">
            <tbody>
            <tr>
                <th scope="row">ID</th>
                <td>
                    <input type="hidden" name="product_id" value=" <?php echo $row["product_id"] ?>">
                    <?php echo $row["product_id"] ?>
                </td>

            </tr>
            <tr>
                <th scope="row">Name</th>
                <td><?php echo $row["product_name"] ?></td>

            </tr>
            <tr>
                <th scope="row">Price</th>
                <td><?php echo $row["unit_price"] ?></td>

            </tr>
            <tr>
                <th scope="row">Size</th>
                <td colspan="2"><?php echo $row["unit_quantity"] ?></td>

            </tr>
            <tr>
                <th scope="row">Stock</th>
                <td colspan="2"><?php echo $row["in_stock"] ?></td>

            </tr>
            <tr>
                <th scope="row">Quantity</th>
                <td>
                    <input type="number" class="form-control" min="1" max="in_stock" value="1" name="quantity">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit"
                            class="btn btn-primary" <?php echo ($inStock > 0) ? 'btn-primary' : 'btn-secondary disabled'; ?>>
                        Add to cart
                    </button>
                </td>
            </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
