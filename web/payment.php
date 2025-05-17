<?php
require('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payment | Ninety6</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body {
      background-color: #f5f7fa;
    }
    .payment-card {
      background: #ffffff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .payment-card h2 {
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      color: #333;
    }
    .form-labe {
      font-weight: 500;
      color: #555;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 25px;
      padding: 10px 30px;
      font-weight: bold;
      transition: background-color 0.3s;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .form-control {
      border-radius: 10px;
    }
    .card-icons {
      margin-bottom: 15px;
    }
    .card-icons i {
      font-size: 2rem;
      margin-right: 10px;
      color: #444;
    }
    .form-select {
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="payment-card">

        <h2 class="text-center mb-4">Payment Information</h2>

        <!-- Card Icons -->
        <div class="text-center card-icons mb-4">
          <i class="fa-brands fa-cc-visa"></i>
          <i class="fa-brands fa-cc-mastercard"></i>
          <i class="fa-brands fa-cc-amex"></i>
          <i class="fa-brands fa-cc-paypal"></i>
        </div>

        <form action="payment_success.php" method="POST" class="row g-3">

          <div class="col-md-6">
            <label for="cardType" class="form-label">Card Type</label>
            <select class="form-select" id="cardType" name="card_type" required>
              <option value="">Select Card Type</option>
              <option value="visa">Visa</option>
              <option value="mastercard">MasterCard</option>
              <option value="amex">American Express</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="cardName" class="form-labe">Cardholder Name</label>
            <input type="text" class="form-control" id="cardName" name="card_name" required pattern="[A-Za-z\s]{2,}" title="Only letters and spaces allowed.">
          </div>

          <div class="col-md-8">
            <label for="cardNumber" class="form-labe">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" name="card_number" required maxlength="16" pattern="\d{16}" title="Enter a valid 16-digit card number">
          </div>

          <div class="col-md-4">
            <label for="cvv" class="form-labe">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv" required maxlength="4" pattern="\d{3,4}" title="3 or 4 digit CVV">
          </div>

          <div class="col-md-6">
  <label for="expiryDate" class="form-labe">Expiry Date (MM/YY)</label>
  <input type="text" class="form-control" id="expiryDate" name="expiry_date" maxlength="5" required pattern="\d{2}/\d{2}" title="Format should be MM/YY" placeholder="MM/YY">
</div>


          <div class="col-md-6">
            <label for="billingEmail" class="form-labe">Billing Email</label>
            <input type="email" class="form-control" id="billingEmail" name="billing_email" required>
          </div>

          <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary px-5">Pay Now</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>
<script>
document.getElementById('expiryDate').addEventListener('input', function(e) {
    var input = e.target.value.replace(/\D/g, '').substring(0, 4);
    if (input.length >= 3) {
        input = input.substring(0, 2) + '/' + input.substring(2, 4);
    }
    e.target.value = input;
});
</script>


<?php require('footer.php'); ?>

</body>
</html>
