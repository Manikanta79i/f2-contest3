<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="team-grid">
    <div class="container">
      <div class="intro">
        <h2 class="text-center">Restaurant</h2>
      </div>
      <div class="row">
        <div class="col-md-9">
          <div class="row" id="menu">
          </div>
        </div>
        <div class="col-md-3">
          <div id="order-summary">
            <h3>Your Order:</h3>
            <div id="order-summary-items"></div>
            <div id="order-summary-total"></div>
            <button id="take-order-btn" onclick="takeOrder79()">Take Order</button>
          </div>
<br><br>
      <h2 id="result"></h2>

        </div>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
