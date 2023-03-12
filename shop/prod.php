<?php
session_start();
include('../connection/connect.php');
include('../functions/userfunctions.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
  <link rel="stylesheet" type="text/css" href="prod.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
  <script type="text/javascript" charset="utf-8" src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <style>
    .badge {
      height: 16px;
      width: 18px;
      margin-left: 0.6vh;
      margin-top: 0.4vh;
      border-radius: 50px;
    }

    .badge1 {
      height: 16px;
      width: 30px;
      margin-left: 3.4vh;
      margin-top: 1.8vh;
      border-radius: 50px;
    }

    .cart_num {
      position: absolute;
      margin-top: -0.5vh;
      margin-left: -0.6vh;
      font-size: 15px;
      font-weight: 700;
      color: black;
    }

    .oi_num {
      position: absolute;
      margin-top: -0.5vh;
      margin-left: 1.5vh;
      font-size: 15px;
      font-weight: 700;
      color: black;
    }

    .small-img-group {
      display: flex;
      justify-content: space-between;
    }

    .small-img-col {
      flex-basis: 24%;
      cursor: pointer;
    }
  </style>
  <title>Silverback | Purchase Item </title>
</head>

<body>
  <!-- Panimula -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-md-3 fixed-top">
    <div class="container">
      <img src="../logos/alogo.png" style="position:absolute; height:auto; left:0px; width:150px;margin-top: 9px;">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-left: auto;">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item ms-auto me-md-3 pe-0">
            <a class="nav-link" aria-current="page" href="../index.php">Home</a>
          </li>
          <li class="nav-item ms-auto me-md-3 pe-1">
            <a class="nav-link active" href="../category/category.php">Shop</a>
          </li>
          <li class="nav-item ms-auto me-md-3 pe-1">
            <a class="nav-link" href="../about/about.php">About</a>
          </li>
          <li class="nav-item ms-auto me-md-3 pe-1">
            <a class="nav-link" href="#contact">Contact Us</a>
          </li>
          <?php
          if (isset($_SESSION['auth_user']['user_id'])) {
          ?>
            <li>
              <a class="nav-link ms-auto ps-4 pe-1" href="../cart/mycart.php"><i class="fas fa-shopping-cart fa-lg"></i>
                <!--<span class="position-absolute top-40 start-10 translate-middle badge bg-warning">-->
                <?php
                global $conn;
                $user_id = $_SESSION['auth_user']['user_id'];
                $query = "SELECT * FROM `cart` WHERE user_id = $user_id";
                $query_run = mysqli_query($conn, $query);
                $arr = mysqli_num_rows($query_run);

                if (empty($arr)) {
                  echo "";
                } else {
                  echo "<span class='position-absolute top-40 start-10 translate-middle badge bg-warning'><span class='cart_num' id='carti'>" . $arr . "</span></span>";
                }
                ?>
              </a>
            </li>
            <ul class="navbar-nav ms-auto me-md-3 ps-3 pe-3">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-lg"> <?= $_SESSION['auth_user']['username'] ?> </i></a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-xl-end" aria-labelledby="navbarDarkDropdownMenuLink">
                  <h6 class="dropdown-header">Menu</h6>
                  <a class="dropdown-item" id="myord" href="../orders/myorder.php"><i class="fas fa-shopping-bag"></i> My Order
                    <?php
                    global $conn;
                    $user_id = $_SESSION['auth_user']['user_id'];
                    $query = "SELECT * FROM `orders` WHERE user_id = '$user_id' AND order_status = '0' OR order_status = '1' AND user_id = '$user_id' AND order_status1 = '0'";
                    $query_run = mysqli_query($conn, $query);
                    $arr = mysqli_num_rows($query_run);

                    if (empty($arr)) {
                      echo "";
                    } else {
                      echo "<span class='position-absolute top-40 start-10 translate-middle badge1 bg-warning'><span class='oi_num' id='ordi'>" . $arr . "</span></span>";
                    }
                    ?>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" id="log-out" href="../users/logout.php"><i class="fas fa-sign-out-alt"></i> Log-out</a>
                </ul>
              </li>
            </ul>
          <?php
          } else {
          ?>
            <li>
              <a class="nav-link ms-auto ps-4 pe-1" href="../cart/mycart.php"><i class="fas fa-shopping-cart fa-lg"></i>
              </a>
            </li>
            <ul class="navbar-nav ms-auto ps-4 pe-3">
              <a class="nav-link " href="../users/login.php" onclick="window.location.href='../users/login.php';" id="navbarDarkDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user"></i> Login/Register</a>
            </ul>
          <?php
          }
          ?>
      </div>
    </div>
  </nav>
  <!-- Huli ng Panimula-->
  <?php
  if (isset($_GET['view_product'])) {
    $prod_index = $_GET['view_product'];
    $cat_prod = $_GET['cat_prod'];

    $product_data = getProdIndexName("products", $prod_index);
    $product = mysqli_fetch_array($product_data);
    $cat_index = getIndexName("category", $cat_prod);
    $cat_name = mysqli_fetch_array($cat_index);

    if ($product['prod_qty'] > 0) {
  ?>
      <div id="prods">
        <div class="bg-light py-4">
          <div class="container product_data p-5">
            <div class="my-5 py-1 pb-0">
              <nav style="--bs-breadcrumb-divider: ' >';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item" style="font-size: 20px; font-weight: 700"><a href="../shop/shop.php?category=<?= $cat_name['cat_index'] ?>"><?= $cat_name['cat_name'] ?></a></li>
                  <li class="breadcrumb-item active">
                    <p style="white-space:nowrap;font-size: 20px;"><?= $product['prod_name'] ?></p>
                  </li>
                </ol>
              </nav>
            </div>
            <div class="row mt-5">
              <div class="col-md-4">
                <div class="card shadow">
                  <img src="../admin/images/<?= $product['prod_image']; ?>" id="Mainimg" alt=" Product Image" style="width:90%; height:90%">
                </div>
                <div class="small-img-group">
                  <div class="small-img-col">
                    <img src="../admin/images/<?= $product['prod_img1']; ?>" alt=" Product Image1" width="100%" class="sm-image" alt="" />
                  </div>
                  <div class="small-img-col">
                    <img src="../admin/images/<?= $product['prod_img2']; ?>" alt=" Product Image2" width="100%" class="sm-image" alt="" />
                  </div>
                  <div class="small-img-col">
                    <img src="../admin/images/<?= $product['prod_img3']; ?>" alt=" Product Image3" width="100%" class="sm-image" alt="" />
                  </div>
                </div>
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h4 class="fw-bold"><?= $product['prod_name']; ?>
                    <span class="text-danger">
                      <?php if ($product['prod_trending']) {
                        echo "Best Selling";
                      }; ?></span>
                  </h4>
                  <hr>
                  <h4>Specification</h4><?= $product['prod_description']; ?>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <h5><span>Price: ₱ <?= number_format($product['prod_price'], 2) ?></span></h5>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <p class="pqty" style="color:gray; font-weight: 600;" value="<?= $product['prod_qty'] ?>"><small>Available Stock: <?= $product['prod_qty'] ?></small></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group mb-3" style="width: 140px;">
                        <button class="input-group-text decrement-btn">-</button>
                        <input type="text" class="form-control text-center qty-input bg-white" value="1" disabled>
                        <button class="input-group-text increment-btn">+</button>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-md-6">
                      <button class="btn btn-success px-3 addToCart" id="cartinc" type="submit" value="<?= $product['prod_id'] ?>"><i class='fas fa-shopping-cart'></i> Add to Cart</button>
                    </div>
                    <!--<div class="col-md-6">
                        <button class="btn btn-danger px-4"><i class="fas fa-times-circle"></i> Cancel</button>
                      </div>-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
    } elseif ($product['prod_qty'] == 0) {
      ?>
        <div class="bg-light py-4">
          <div class="container product_data p-5">
            <div class="my-5 py-1 pb-0">
              <nav style="--bs-breadcrumb-divider: ' >';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item" style="font-size: 20px; font-weight: 700"><a href="../category/category.php">Categories</a></li>
                  <li class="breadcrumb-item active">
                    <p style="white-space:nowrap;font-size: 20px;"><?= $product['prod_name'] ?></p>
                  </li>
                </ol>
              </nav>
            </div>
            <div class="row mt-5">
              <div class="col-md-4">
                <div class="card shadow">
                  <img src="../admin/images/<?= $product['prod_image']; ?>" alt=" Product Image" style="width:90%; height:90%">
                </div>
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h4 class="fw-bold"><?= $product['prod_name']; ?>
                    <span class="text-danger">
                      <?php if ($product['prod_trending']) {
                        echo "Best Selling";
                      }; ?></span>
                  </h4>
                  <hr>
                  <h4>Specification</h4><?= $product['prod_description']; ?>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Price: ₱ <?= number_format($product['prod_price'], 2) ?></h5>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <p style="color:gray; font-weight: 600;"><small>Out of Stock</small></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group mb-3" style="width: 140px;">
                        <button class="input-group-text decrement-btn">-</button>
                        <input type="text" class="form-control text-center qty-input bg-white" value="1" disabled>
                        <button class="input-group-text increment-btn">+</button>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-md-6">
                      <button class="btn btn-success px-3 addToCart" disabled="disabled" value="<?= $product['prod_id'] ?>"><i class='fas fa-shopping-cart'></i> Out of Stock</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php
    } else {
      echo "Product not existed";
    }
  } else {
    echo "Something went wrong";
  }
    ?>

    <!-- Footer-->
    <footer class="mt-5 py-5">
      <div class="row container mx-auto mt-5">
        <div class="footer-one col-lg-3 col-md-6 col-12">
          <img src="../logos/alogo.png" alt="" style="width:140px; height:auto">
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-12">
          <h5 class="pb-2">Section</h5>
          <ul class="text-uppercase list-unstyled">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../category/category.php">Shop</a></li>
            <li><a href="../about/about.php">About</a></li>
            <li><a href="#contact">Contact Us</a></li>

          </ul>
        </div>
        <div id="contact" class="footer-one col-lg-3 col-md-6 col-12">
          <h5 class="pb-2">Location</h5>
          <div>
            <h6 class="text-uppercase">Location Address</h6>
            <p>149 Makabud Street Amparo Village Caloocan city</p>
          </div>
        </div>
        <div class="sc footer-one col-lg-3 col-md-6 col-12">
          <h5 class="pb-2">Social Media Pages</h5>
          <div class="row">
            <a href="https://www.facebook.com/silverbackphmh" target="_blank"><i class="fab fa-facebook"></i></a><br>
            <a href="https://www.instagram.com/silverbackph/" target="_blank"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <div class="copyright mt-5 text-nowrap">
          <div class="row container mx-auto">
            <div class="col-lg-3 col-md-6 col-12">
              <p>Silverback Gaming and Office Chairs Online Web Page Ⓒ 2022 - <?= date('Y') ?>. Allright Reserved.</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
      </div>
      <!-- Footer End-->




      <!-- For Script Section-->
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script type="text/javascript" src="../assets/js/script.js"></script>

      <script type="text/javascript">
        var Main = document.getElementById('Mainimg');
        var Second = document.getElementsByClassName('sm-image');

        Second[0].onclick = function() {
          Main.src = Second[0].src;
        }
        Second[1].onclick = function() {
          Main.src = Second[1].src;
        }
        Second[2].onclick = function() {
          Main.src = Second[2].src;
        }
        Second[3].onclick = function() {
          Main.src = Second[3].src;
        }
      </script>
      <!-- End Script Section-->
</body>

</html>