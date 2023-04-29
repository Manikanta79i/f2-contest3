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

  <script>
    // Function to get menu from API
    function getMenu() {
      fetch("https://raw.githubusercontent.com/saksham-accio/f2_contest_3/main/food.json")
        .then((response) => response.json())
        .then((data) => {
          const menuDiv = document.getElementById("menu");

          data.forEach((item) => {
            menuDiv.innerHTML += `
            <div class="col-md-4 col-lg-3 item">
              
              <img src="${item.imgSrc}" alt="${item.name}" height="50" width="100">
             <h3>${item.name}</h3>
              <p>Price: ${item.price}</p>
              <button class="add-to-order-btn" onclick="addToOrder('${item.name}', ${item.price})">Add to Order</button>
            </div>
            `;
          });
        })
        .catch((error) => {
          console.error("Error fetching data from API:", error);
          const menuDiv = document.getElementById("menu");
          menuDiv.innerHTML = "Error fetching data from API";
        });
    }

    // On load of screen, get menu
    getMenu();

    // Function to add item to order
   function addToOrder(name, price) {
  const orderSummaryItemsDiv = document.getElementById("order-summary-items");
  const orderSummaryTotalDiv = document.getElementById("order-summary-total");

  let itemHtml = `<p>${name}: ${price}</p>`;
  orderSummaryItemsDiv.innerHTML += itemHtml;

  let currentTotal = parseFloat(orderSummaryTotalDiv.innerHTML.split(" ")[1]) || 0;
  let newTotal = currentTotal + price;
  orderSummaryTotalDiv.innerHTML = `<h3>Total: ${newTotal.toFixed(2)}</h3>`;
}
    // Function to take order (randomly adds 3 burgers to order)
function takeOrder() {
  const burgers = [
    { name: "Classic Burger", price: 10 },
    { name: "Cheeseburger", price: 12 },
    { name: "Bacon Cheeseburger", price: 14 },
    { name: "Veggie Burger", price: 10 },
    { name: "Mushroom Swiss Burger", price: 13 },
  ];

  const order = {
    burgers: [],
    total: 0,
  };

  for (let i = 0; i < 3; i++) {
    const burgerIndex = Math.floor(Math.random() * burgers.length);
    const burger = burgers[burgerIndex];
    order.burgers.push(burger);
    order.total += burger.price;
  }

  const orderSummary = getOrderSummary(order);
  const takeOrderButton = `
    <button class="btn btn-primary" onclick="takeOrder()">Take Order</button>
  `;
  let summaryHtml = ""; // initialize summaryHtml
  summaryHtml += takeOrderButton;

  const orderDiv = document.getElementById("order-summary");
  orderDiv.innerHTML = orderSummary + summaryHtml;
}

function getOrderSummary(order) {
  let summaryHtml = "<h2>Order Summary</h2>";
  let total = 0;
  for (let i = 0; i < order.burgers.length; i++) {
    const burger = order.burgers[i];
    summaryHtml += `<p>${burger.name} - $${burger.price}</p>`;
    total += burger.price;
  }
  summaryHtml += `<h3>Total: $${order.total}</h3>`;
  return summaryHtml;
}

function orderPrep() {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      const resultDiv = document.getElementById("result");
      resultDiv.innerHTML = "Order Status:True and Payment:False";
      resolve({ order_status: true, paid: false });
    }, 1500);
  });
}

function payOrder() {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      const resultDiv = document.getElementById("result");
      resultDiv.innerHTML = "Order Status:True and Payment:True";
      resolve({ order_status: true, paid: true });
    }, 1000);
  });
}
function thankyouFnc() {
  alert("Thank you for eating with us today!");
  location.reload();
}

function takeOrder() {
  orderPrep()
    .then((order) => {
      if (order.paid) {
        throw new Error("Order has already been paid");
      }
      return payOrder();
    })
    .then((order) => {
      if (!order.paid) {
        throw new Error("Payment has not been processed");
      }
      thankyouFnc();
    })
    .catch((error) => {
      console.error(error);
    });
}


function takeOrder79() {
  orderPrep()
    .then((result) => {
      console.log(result);
      return payOrder();
    })
    .then((result) => {
      console.log(result);
      thankyouFnc();
    })
    .catch((error) => console.log(error));
}

  </script>