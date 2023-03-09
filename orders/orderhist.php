<?php
session_start();
include('../connection/connect.php');
include('../functions/userfunctions.php');
include('../cart/validator.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="myorder.css" />
  <style>
    .section-p1 {
      padding: 120px 100px;
    }

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
  </style>
  <title>Silverback | My Orders</title>
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
          <li class="nav-item ms-auto me-md-4 pe-0">
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
                  <a class="dropdown-item" id="myord" href="./myorder.php"><i class="fas fa-shopping-bag"></i> My Order
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
                <!--<span class="position-absolute top-40 start-10 translate-middle badge bg-warning">-->
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



  <!-- Section Start -->
  <section id="cart" class="table section-p1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./myorder.php">My Order</a></li>
              <li class="breadcrumb-item active" aria-current="page">Order History</li>
            </ol>
          </nav>
          <div class="shopping-cart">
            <h6 style="font-size:30px; margin-right:55vh"><i class="fas fa-history" style="color:darkgray"></i> Order History</h6>
            <hr style="width:160vh">
          </div>
        </div>
        <div class="container " style="padding-left: 30px;">
          <div class="row">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tracking No</th>
                  <th>Subtotal</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $user_id = $_SESSION['auth_user']['user_id'];
                $order = getOrderStatus($user_id);
                $q = getNotIn();

                while ($res = mysqli_fetch_array($order)) {
                  if ($user_id == $res['user_id']) {
                ?>
                    <tr>
                      <td><?php echo $res['order_id']; ?></td>
                      <td><?php echo $res['tracking_no']; ?></td>
                      <td>₱ <?php echo number_format($res['total_price'], 2); ?></td>
                      <td><?php echo $res['order_date']; ?></td>
                      <td>
                        <?php
                        if ($res['order_status'] == 0) {
                          echo "<span class='fw-bold'><font color='#FF8300'>Pending</font></span>";
                        } else if ($res['order_status'] == 1) {
                          echo "<span class='fw-bold'><font color='#FF8300'>On Delivery</font></span>";
                        } else if ($res['order_status'] == 2) {
                          echo "<span class='fw-bold'><font color='#116530'>Completed</font></span>";
                        }
                        ?>
                      </td>
                    </tr>
                  <?php
                  } elseif ($user_id != $res['user_id'] && $q) {
                  ?>
                    <tr>
                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section End -->




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
  <!-- Footer End-->


  <!-- For Script Section-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script type="text/javascript" src="../assets/js/script.js"></script>
  <!-- End Script Section-->

  <!-- JS SCRIPT -->
  <script>
    <?php if (isset($_SESSION['message'])) {
    ?>
      alertify.set('notifier', 'position', 'top-center');
      alertify.success('<?= $_SESSION['message']; ?>');
    <?php
      unset($_SESSION['message']);
    }
    ?>
  </script>
  <!-- END -->
</body>

</html>