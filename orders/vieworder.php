<?php
session_start();
include('../connection/connect.php');
include('../functions/userfunctions.php');
include('../cart/validator.php');

if (isset($_GET['track_no'])) {
    $order_data = $_GET['track_no'];
    $user_id = $_SESSION['auth_user']['user_id'];
    $q = "SELECT o.*,u.* FROM orders o INNER JOIN users AS u ON o.user_id = u.user_id WHERE tracking_no = '$order_data' AND o.user_id = '$user_id'";
    $res = mysqli_query($conn, $q);

    if (mysqli_num_rows($res) < 0) {
?>
        <h4>Something Went Wrong</h4>
    <?php
        die();
    }
} else {
    ?>
    <h4>Something Went Wrong</h4>
<?php
    die();
}
$d = mysqli_fetch_array($res);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
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
    <title>Silverback | View Orders</title>
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
                        <a class="nav-link" href="../category/category.php">Shop</a>
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

    <section id="vieword" class="table section-p1">
        <div class="container">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: ' >';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px; font-weight: 700"><a href="./myorder.php" style="text-decoration: none">My Orders</a></li>
                        <li class="breadcrumb-item active">
                            <p style="white-space:nowrap;font-size: 20px;">View Order Details</p>
                        </li>
                    </ol>
                </nav>
                <div class="col-md-12">
                    <div class="shopping-cart">
                        <h6 style="font-size:30px; margin-right:55vh"><i class="fas fa-shopping-cart" style="color:darkgray"></i> Order Details </h6>
                        <hr style="width:160vh">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Delivery Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="fw-bold">Name</label>
                                            <div class="border p-1">
                                                <?= $d['fname']; ?> <?= $d['lname']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="fw-bold">Contact Number</label>
                                            <div class="border p-1">
                                                <?= $d['contactnum']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="fw-bold">Address</label>
                                            <div class="border p-1">
                                                <?= $d['address']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="fw-bold">City</label>
                                            <div class="border p-1">
                                                <?= $d['city']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="fw-bold">Region</label>
                                            <div class="border p-1">
                                                <?= $d['region']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="fw-bold">Zip Code</label>
                                            <div class="border p-1">
                                                <?= $d['zip']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="fw-bold">Tracking Number</label>
                                            <div class="border p-1">
                                                <?= $d['tracking_no']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product Details</h4>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION['auth_user']['user_id'];
                                $o_query = "SELECT o.order_id, o.tracking_no, o.user_id, oi.*,oi.oitem_qty AS order_qty,p.* FROM orders o INNER JOIN order_item oi ON o.order_id = oi.order_id INNER JOIN products p ON oi.prod_id = p.prod_id WHERE o.user_id = '$user_id' AND o.tracking_no = '$order_data' ";

                                $oq_run = mysqli_query($conn, $o_query);

                                if (mysqli_num_rows($oq_run) > 0) {

                                    foreach ($oq_run as $itemdt => $output) {
                                ?>
                                        <tr>
                                            <td class="align-middle">
                                                <img src="../admin/images/<?php echo $output['prod_image']; ?>" alt="<?php echo $output['prod_name']; ?>" style="width: 90px; height: 90px;">
                                            </td>
                                            <td class="align-middle">₱ <?php echo number_format($output['oitem_price'], 2) ?></td>
                                            <td class="align-middle"><?php echo $output['order_qty'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                } elseif (mysqli_num_rows($oq_run) < 0) {
                                    ?>
                                    <tr>
                                        <td colspan="5">No Item Ordered</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <h5>Total Price: <span class="float-end fw-bold">₱ <?= number_format($d['total_price'], 2); ?></span></h5>
                        <p class="p-1 mb-2">
                            <label for="">Payment Mode</label>
                            <span class="float-end"><?php echo $d['payment_mode']; ?></span>
                        </p>
                        <p class="p-1 mb-2">
                            <label for="">Status</label>
                            <?php
                            if ($d['order_status'] == 0) {
                                echo "";
                            } else if ($d['order_status'] == 1) {
                                echo "<span class='float-end fw-bold'><font color='#FF8300'>On Delivery</font></span>";
                            } else if ($d['order_status'] == 2) {
                                echo "<span class='float-end fw-bold'><font color='#116530'>Completed</font></span>";
                            }
                            ?>
                        </p>
                        <form action="../functions/status.php" method="POST">
                            <input type="hidden" name="track_no" value="<?php echo $d['tracking_no']; ?>">
                            <?php
                            if ($d['order_status'] == 0) {
                            ?>
                                <button type="submit" class="btn btn-danger mt-3 cancel_order" name="cancel_order" id="cancel_order" value=<?= $d['tracking_no']; ?>>Cancel Order</button>
                            <?php
                            } else if ($d['order_status'] == 1) {
                            ?>
                                <button type="submit" class="btn btn-success mt-3" name="item_receive" value="1">Item Receive</button>
                            <?php
                            }
                            ?>
                        </form>
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
                        <p>Silverback Gaming and Office Chairs Online Web Page Ⓒ 2022 - <?= date('Y') ?>. Allrights Reserved.</p>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="./script.js"></script>
    <!-- End Script Section-->

</body>

</html>