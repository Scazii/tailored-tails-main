<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tailored Tails - Products</title>
    <link rel="icon" href="assets/logo.svg" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css"
    />
    <link rel="stylesheet" href="products.css" />
  </head>
  <body>
    <nav
      class="navbar navbar-expand-lg navbar-light bg-white border border-black"
    >
      <a class="navbar-brand"
        ><img
          src="
    assets/logo.svg"
          style="width: 50px; margin-left: 30px; margin-right: 10px"
        />Tailored Tails</a
      >
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        class="collapse navbar-collapse"
        id="navbarNavDropdown"
        style="justify-content: space-between"
      >
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/tailored-tails-main/UI/homepage.html"
              >Home <span class="sr-only">(current)</span></a
            >
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/tailored-tails-main/Shopping-Cart/productsPage.php">Shop</a>
          </li>
        </ul>
        <button class="button-dark logout-btn px-4">Logout</button>
      </div>
    </nav>
    <div class="container">
      <h2 style="margin-top: 50px">Our Products<br /></h2>
      <div
        class="row justify-content-center"
        id="wrapper"
        style="
          visibility: hidden;
          background-color: #f4f7f8;
          border-radius: 20px;
          margin-right: 20px;
        "
      >
      
        <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tailoredtailsusers";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) { die("Connection failed: " .
        $conn->connect_error); } // Retrieve all products from the database
        $query = "SELECT * FROM products"; $result = $conn->query($query); if
        ($result && $result->num_rows > 0) { while ($row =
        $result->fetch_assoc()) { echo "<div class='product-wrap'><div class='product-card'>"; echo "<img style='width:200px' src='" . $row['image_url'] . "' alt='" . $row['name'] .
          "'></div>"; echo "
          <p class='titleP'>" . $row['name'] . "</p>
          "; echo "
          <p class='description'>" . $row['description'] . "</p>
          "; echo "
          <p class='price'>" . $row['price'] . "₱</p>
          "; echo "
          <form action='cart.php' method='POST'>
            <button class='addToCart-btn' type='submit' name='add_to_cart' />
            Add to cart
            </button>
            <input type='hidden' name='product_id' value='" . $row['product_id'] . "' />
          </form>
          "; echo "
        </div>
        "; } } else { echo "No products found."; } $conn->close(); ?>
      <div class="row" style="margin-top: 50px; margin-bottom: 100px">
        <div class="col-md-4">
          <div class="form container-fluid">
            <div class="row">
              <label for="elPerPage">Elements Per Page:</label>
            </div>
            <div class="row">
              <div class="col-md-8">
                <input
                  class="form-control"
                  type="number"
                  style="width: 100%"
                  id="elPerPage"
                  value="5"
                />
              </div>
              <div class="col-md-2">
                <button
                  class="btn btn-primary"
                  style=""
                  id="set_elems_per_page"
                >
                  Set
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4" style="margin-top: 30px;">
          <h5>Current Settings:</h5>
          <p>Number of pages: <span id="number_of_pages"></span></p>
          <p style="margin-top: 0.2rem">
            Elements per page: <span id="elements_per_page"></span>
          </p>
        </div>
      </div>
    </div>
    <div class="footer">
      <div
        style="
          display: flex;
          justify-content: space-between;
          margin-left: 100px;
          margin-right: 100px;
          border-bottom: 1px solid black;
        "
      >
        <div>
          <h2 class="sub-title" style="padding-bottom: 100px">
            <img src="
      assets/logo.svg" style="width: 100px" /> <br />
            Stay Connected with<br />Tailored Tails Community<br />
          </h2>
        </div>
        <div
          style="
            margin-top: 100px;
            border-left: 1px solid black;
            padding-left: 100px;
          "
        >
          <h2 style="font-size: 35px; margin-bottom: 20px">Tailored Tails</h2>
          <p class="fpages">Overview</p>
          <p class="fpages">Cart</p>
          <p class="fpages">Contacts</p>
        </div>
      </div>
      <div
        style="
          display: flex;
          justify-content: space-between;
          margin-left: 100px;
          margin-right: 100px;
          margin-top: 40px;
        "
      >
        <p class="rights">@2023 Tailored Tails | All Rights Reserved</p>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/gh/yak0d3/senzill-pagination@1.1.3-beta/senzill-pagination.js"></script>
    <script>
      $(document).ready(function () {
        var _elPerPage = 5; //We are going to use this later to set the number of elements to display per page
        var number_of_pages = Math.ceil($("div").length / _elPerPage); //This is used just for this demo to calculate the number of pages
        function stats() {
          //This is used just for this demo to display the current settings
          if ($("#elPerPage").val() > 0) {
            _elPerPage = $("#elPerPage").val();
          }
          number_of_pages = Math.ceil($("div").length / _elPerPage);
          $("#number_of_pages").text(number_of_pages);
          $("#elements_per_page").text(_elPerPage);
        }
        var senzill = $("#wrapper").senzill(
          //Start a new senzill-pagination instance
          {
            elPerPage: _elPerPage, //Number of elements to display per page
          }
        );
        stats();
        $("#set_elems_per_page").on("click", function () {
          if ($("#elPerPage").val() > 0) {
            //Check if the input is bigger than 0
            _elPerPage = $("#elPerPage").val(); //Assign the new number of element per page to the _elPerPage variable
          }
          senzill.destroy(); //Destroy the senzill-pagination instance
          senzill = undefined;
          senzill = $("#wrapper").senzill(
            //Start a new senzill-pagination instance with the new number of elements per page
            {
              elPerPage: _elPerPage,
            }
          );
          stats();
        });
      });
    </script>
  </body>
</html>
