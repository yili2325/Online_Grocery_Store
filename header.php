<?php
$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
?>
<header class="shadow-lg p-3 rounded">
    <a href="index.php" class="text-decoration-none">
        <img class="logo " href="index.php" src="images/logo.png" alt="Yi Li's Grocery Online Shop"/>
        <span class="title fw-bold">Yi Li's Grocery Store</span>
    </a>
    <div class="searchbar">
        <form class="d-flex mb-0" action="/" role="search">
            <input class="form-control me-2" type="search" placeholder="Search products" name="keyword">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
    </div>
    <div class="d-block">
        <div class="dropdown">
            <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false"
                    data-bs-auto-close="outside">
                Shopping Cart <span class="badge text-bg-danger" id="cartCount"><?php echo count($cart) ?></span>
            </button>
            <form class="dropdown-menu dropdown-menu-end p-4" style="width: 600px">
                <?php
                if (count($cart) == 0) {
                    ?>
                    <h5 class="text-center text-secondary">Shopping cart is empty!</h5>
                    <?php
                }
                ?>
                <table class="table">
                    <tbody class="align-middle" id="cartBody">
                    <?php
                    $total = 0.0;
                    foreach ($cart as $row) {
                        $total += intval($row['quantity']) * floatval($row['unit_price'])
                        ?>
                        <tr>
                            <td>
                                <img src="/images/<?php echo $row['product_id'] ?>.png" class="card-img-top cartPic">
                            </td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td>$<?php echo $row['unit_price'] ?></td>
                            <td class="cartQuality">
                                <input type="number" class="form-control" min="1" max="in_stock" value="<?php echo $row['quantity'] ?>"
                                       onchange="updateShoppingCart('<?php echo $row['product_id'] ?>', this)">
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger" type="button"
                                        onclick="removeShoppingCart('<?php echo $row['product_id'] ?>', this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
                <p>Total Price: $<span id="totalPrice"><?php echo $total ?></span></p>
                <div class="text-center">
                    <button type="button" class="btn btn-danger" onclick="clearShoppingCart()">Clear All</button>
                    <?php
                    if(count($cart) != 0){
                        ?>
                        <button type="button" class="btn btn-primary ms-1" id="checkoutBtn"  onclick="handlePlaceOrder()">Place an Order</button>
                        <?php
                    }
                    ?>

                </div>
            </form>
        </div>
    </div>
    <script>
        function handlePlaceOrder(){
          $.get('validateCart.php', function(res){
            console.log(res);
            if(res.length>0){
              let msg = 'Below items are beyond the stock, please adjust and try it again! \n';
              for (let i=0; i<res.length; i++){
                console.log(res[i]);
                msg = msg + res[i].product_name + ' ' + res[i].quantity + '\n';
              }
              alert(msg);
            }else{
              window.location.href = './deliveryPage.php';
            }
          })
        }
        function checkPlaceOrder(){
          $.get('validateCart.php', function(res) {
            if(res.length>0){
              let msg = 'Below items are beyond the stock, please adjust and try it again! \n';
              for (let i=0; i<res.length; i++){
                console.log(res[i]);
                msg = msg + res[i].product_name + ' ' + res[i].quantity + '\n';
              }
              alert(msg);
            }else{
              window.location.href = './emailPage.php';
            }
          })
        }

      function updateShoppingCart(productId, input) {
        $.get(`/updateCart.php?product_id=${productId}&quantity=${input.value}`, function(res){
          $('#totalPrice').text(res);
        });
      }

      function removeShoppingCart(productId, btn) {
        let tr = btn.parentNode.parentNode;
        tr.parentNode.removeChild(tr);
        if($('#cartBody').children().length === 0){
          $('#checkoutBtn').hide();
        }
        $('#cartCount').text($('#cartBody').children().length);
        $.get(`/updateCart.php?product_id=${productId}&quantity=0`, function (res){
          $('#totalPrice').text(res);
        });
      }

      function clearShoppingCart() {
        $('#cartBody').html('');
        $('#checkoutBtn').hide();
        $('#cartCount').text(0);
        $.get(`/updateCart.php?product_id=all`);
        $('#totalPrice').text(0);
      }
    </script>
</header>
