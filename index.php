<?php
session_start();
$conn = new mysqli("localhost", "root", "", "assignment1");
$sql = "SELECT * FROM products";
if (isset($_GET['category'])) {
    $from = intval($_GET['category']);
    $to = $from + 1000;
    $sql .= " where product_id >= $from and product_id < $to";
}
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $sql .= " where product_name LIKE '%$keyword%'";
}
$result = $conn->query($sql);
$conn->close();
?>
<html>
<head>
    <title>Yi Li Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <script src="jquery-3.7.1.min.js"></script>
</head>
<body>
<?php require_once('header.php') ?>
<nav class="text-center">
    <div>
        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark" href="?category=1000">Frozen</a>
            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?keyword=Fish Fingers">Fish Fingers</a></li>
                <li><a class="dropdown-item" href="?keyword=Hamburger Patties">Hamburger Patties</a></li>
                <li><a class="dropdown-item" href="?keyword=Shelled Prawns">Shelled Prawns</a></li>
                <li><a class="dropdown-item" href="?keyword=Tub Ice Cream">Tub Ice Cream</a></li>
            </ul>
        </div>

        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark" href="?category=3000">Fresh</a>
            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?keyword=Cheddar Cheese">Cheddar Cheese</a></li>
                <li><a class="dropdown-item" href="?keyword=T Bone Steak">T Bone Steak</a></li>
                <li><a class="dropdown-item" href="?keyword=Navel Oranges">Navel Oranges</a></li>
                <li><a class="dropdown-item" href="?keyword=Bananas">Bananas</a></li>
                <li><a class="dropdown-item" href="?keyword=Peaches">Peaches</a></li>
                <li><a class="dropdown-item" href="?keyword=Grapes">Grapes</a></li>
                <li><a class="dropdown-item" href="?keyword=Apples">Apples</a></li>
            </ul>
        </div>

        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark" href="?category=4000">Beverage</a>
            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?keyword=Earl Grey Tea Bags">Earl Grey Tea Bags</a></li>
                <li><a class="dropdown-item" href="?keyword=Instant Coffee">Instant Coffee</a></li>
                <li><a class="dropdown-item" href="?keyword=Chocolate Bar">Chocolate Bar</a></li>
            </ul>
        </div>

        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark" href="?category=2000">Home</a>
            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?keyword=Panadol">Panadol</a></li>
                <li><a class="dropdown-item" href="?keyword=Bath Soap">Bath Soap</a></li>
                <li><a class="dropdown-item" href="?keyword=Garbage Bags">Garbage Bags</a></li>
                <li><a class="dropdown-item" href="?keyword=Washing Powder">Washing Powder</a></li>
                <li><a class="dropdown-item" href="?keyword=Laundry Bleach">Laundry Bleach</a></li>
            </ul>
        </div>

        <div class="btn-group dropdown-center m-4">
            <a type="button" class="btn btn-dark" href="?category=5000">Pet-food</a>
            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?keyword=Dry Dog Food">Dry Dog Food</a></li>
                <li><a class="dropdown-item" href="?keyword=Bird Food">Bird Food</a></li>
                <li><a class="dropdown-item" href="?keyword=Cat Food">Cat Food</a></li>
                <li><a class="dropdown-item" href="?keyword=Fish Food">Fish Food</a></li>
            </ul>
        </div>
</nav>
<div class="mainPart">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        while ($row = $result->fetch_assoc()) {
            $inStock = $row["in_stock"];
            ?>
            <div class="col">
                <div class="card text-end">
                    <a href="productDetail.php?product_id=<?php echo $row["product_id"] ?>" class="picCenter">
                        <img src="/images/<?php echo $row['product_id']; ?>.png" class="card-img-top productPic" alt="">
                    </a>
                    <div class="card-body">
                        <div class="row">
                            <p class="card-text">
                                <span class="price">$<?php echo $row["unit_price"] ?></span><span
                                        class="quantity">/<?php echo $row["unit_quantity"] ?></span>
                            </p>
                            <h5 class="card-title titlePosition"
                                style="text-align: left"><?php echo $row["product_name"] ?></h5>
                        </div>
                        <a href="<?php echo ($inStock > 0) ? "/addToCart.php?product_id=" . $row["product_id"] . "&quantity=1" : "#"; ?>"
                           class="btn <?php echo ($inStock > 0) ? 'btn-primary' : 'btn-secondary disabled'; ?> buttonPosition">
                            Add to cart
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>
</html>
