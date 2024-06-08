<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yi Li Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <script src="jquery-3.7.1.min.js"></script>
</head>
<body>
<?php require_once('header.php'); ?>

<h1 class="deliveryTitle mt-4">Delivery Information</h1>
<div class="container emailPageTable">
    <form class="needs-validation" novalidate action="emailPage.php" method="post" id="checkoutForm">
        <div class="form-floating mb-4">
            <input class="form-control" id="nameInput" required name="name" placeholder="Name">
            <label for="nameInput">Name *</label>
            <div class="invalid-feedback">Name is required.</div>
        </div>
        <div class="row g-3">
            <div class="col-md">
                <div class="form-floating">
                    <input class="form-control" id="streetInput" required name="street" placeholder="Street">
                    <label for="streetInput">Street *</label>
                    <div class="invalid-feedback">Street is required.</div>
                </div>
            </div>

            <div class="col-md">
                <div class="form-floating">
                    <input class="form-control" id="cityInput" required name="city" placeholder="City">
                    <label for="cityInput">City/Suburb *</label>
                    <div class="invalid-feedback">City/Suburb is required.</div>
                </div>
            </div>

            <div class="col-md mb-4">
                <div class="form-floating">
                    <select class="form-select" id="stateInput" required name="state">
                        <option value="">Please select a state/territory</option>
                        <!-- State options -->
                        <option value="NSW">NSW</option>
                        <option value="VIC">VIC</option>
                        <option value="QLD">QLD</option>
                        <option value="WA">WA</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="ACT">ACT</option>
                        <option value="NT">NT</option>
                        <option value="Others">Others</option>
                    </select>
                    <label for="stateInput">State/Territory *</label>
                    <div class="invalid-feedback">Please select a state/territory.</div>
                </div>
            </div>
        </div>
        <div class="form-floating mb-4">
            <input type="tel" class="form-control" id="mobileInput" required pattern="\d{10}" name="mobile" placeholder="Mobile">
            <label for="mobileInput">Mobile Number *</label>
            <div class="invalid-feedback">Enter a 10-digit mobile number.</div>
        </div>
        <div class="form-floating mb-4">
            <input type="email" class="form-control" id="emailInput" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required name="email" placeholder="Email">
            <label for="emailInput">Email *</label>
            <div class="invalid-feedback">Please enter a valid email address.</div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <button class="btn btn-primary" type="submit">Submit Order</button>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('.needs-validation');
    form.addEventListener('submit', function(event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    });
  });
</script>
<script>
  function checkPlaceOrder(){
    $.get('validateCart.php', function(res) {
      if(res.length>0){
        let msg = 'Below items are beyond the stock, please adjust and try it again! \n';
        for (let i=0; i<res.length; i++){
          console.log(res[i]);
          msg = msg + res[i].product_name + ' ' + res[i].quantity;
        }
        alert(msg);
      }else{
        $('#checkoutForm').submit();
      }
    })
  }
</script>
</body>
</html>
