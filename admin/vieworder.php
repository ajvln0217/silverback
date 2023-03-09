<?php
session_start();
include('./admin.php');


if (isset($_GET['track_no'])) {
    $order_data = $_GET['track_no'];
    $q = "SELECT o.*,o.order_status AS stat, o.order_status1 AS stat1, o.total_price AS totalp, o.user_id, u.*,u.user_id FROM orders AS o INNER JOIN users u ON o.user_id = u.user_id WHERE tracking_no = '$order_data'";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="home.css" />
    <style>
        .section-p1 {
            padding: 120px 100px;
        }

        .card1 {
            z-index: 1;
            background: #ffff;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            margin-top: 50px;
            margin-left: 15%;
        }

        .card1 .table .thead .tr {
            position: fixed;
            height: calc(100% - 9%);
            width: calc(100% - 9%);
        }
    </style>
    <title>Transactions - View Orders</title>
</head>

<body>
    <!-- Panimula -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample"><span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
            </button>
            <div class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold">
                <a style="color:#CECECE;font-size: 25px;;font-weight: 900;margin-left:40px">Silver</a><a style="color:#FFE15D;font-size: 25px;;font-weight: 900">back</a><a href="#" style="color:white;margin-left:55rem"></a>
            </div>
        </div>
    </nav>
    <!-- Huli ng Panimula-->



    <!-- Sidebar -->
    <div style="background: rgba( 70, 70, 70, 0.85 );
    backdrop-filter: blur( 15px );
    -webkit-backdrop-filter: blur( 15px ); top:64px" class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="sidebar">
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                    <br><br>
                    <div class="uprofile">
                        <?php
                        $profile = getProfile();
                        if (mysqli_num_rows($profile) > 0) {
                            foreach ($profile as $dp => $pro) {
                        ?>
                                <center class="profile">
                                    <img src='./profile/<?php echo $pro['image'] ?>' style="width:100px;height:100px;border-radius: 50%" />
                                    <p style="color: #bbb;font-weight: 700;margin-top:20px;margin-bottom: 10px"><?php echo $pro['fname'] ?> <?php echo $pro['lname'] ?></p>
                                    </p>
                                </center>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <li class="my-0">
                        <hr class="dropdown-divider bg-light" />
                    </li>
                    <li>
                        <a style="color: #fff;padding: 20px 20px;" href="./home.php" class="nav-link px-3 active">
                            <span class="me-2"><i class="fa-sharp fa-solid fa-chart-line"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a style="color: #fff;padding: 20px 20px;" class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#reports"><span class="me-2"><i class="fa-solid fa-chart-simple"></i></span>
                            <span>Reports</span>
                            <span class="ms-auto">
                                <span class="right-icon">
                                    <i class="fa-solid fa-chevron-right drop-down"></i>
                                </span>
                            </span>
                        </a>
                        <div class="collapse" id="reports">
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a style="color: #fff;" href="./report/salesreport.php" class="nav-link px-3">
                                        <span class="me-2"><i class="fa-solid fa-chart-pie"></i></span>
                                        <span>Sales Report</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a style="color: #fff;padding: 20px 20px;" class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#inventory"><span class="me-2"><i class="fa-sharp fa-solid fa-warehouse"></i></span>
                            <span>Inventory</span>
                            <span class="ms-auto">
                                <span class="right-icon">
                                    <i class="fa-solid fa-chevron-right drop-down"></i>
                                </span>
                            </span>
                        </a>
                        <div class="collapse" id="inventory">
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a style="color: #fff;" href="./category/category.php" class="nav-link px-3">
                                        <span class="me-2"><i class="fa-solid fa-tag"></i></span>
                                        <span>Category</span>
                                    </a>
                                    <a style="color: #fff;" href="./product/product.php" class="nav-link px-3">
                                        <span class="me-2"><i class="fa-solid fa-boxes-stacked"></i></span>
                                        <span>Product</span>
                                    </a>
                                    <!--<a style="color: #fff;" href="#" class="nav-link px-3">
                                        <span class="me-2"><i class="fa-solid fa-truck-ramp-box"></i></span>
                                        <span>Returned Product</span>
                                    </a>-->
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a style="color: #fff;padding: 20px 20px;" class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#user"><span class="me-2"><i class="fa-sharp fa-solid fa-users"></i></span>
                            <span>Users</span>
                            <span class="ms-auto">
                                <span class="right-icon">
                                    <i class="fa-solid fa-chevron-right drop-down"></i>
                                </span>
                            </span>
                        </a>
                        <div class="collapse" id="user">
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a style="color: #fff;" href="./users/users.php" class="nav-link px-3">
                                        <span class="me-2"><i class="fa-solid fa-users-gear"></i></span>
                                        <span> Manage Users </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a style="color: #FFE15D;padding: 20px 20px;" class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#transaction"><span class="me-2"><i class="fa-sharp fa-solid fa-receipt"></i></span>
                            <span>Transaction</span>
                            <span class="ms-auto">
                                <span class="right-icon">
                                    <i class="fa-solid fa-chevron-right drop-down"></i>
                                </span>
                            </span>
                        </a>
                        <div class="collapse" id="transaction">
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a style="color: #FFE15D;" href="./transaction.php" class="nav-link px-3">
                                        <span class="me-2"><i class="fa-sharp fa-solid fa-clipboard"></i></span>
                                        <span>Customer Orders</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="my-0">
                        <hr class="dropdown-divider bg-light" />
                    </li>
                    <li>
                        <a style="color: #fff;padding: 20px 20px;" href="./logout.php" class="nav-link px-3">
                            <span class="me-2"><i class="fa-sharp fa-solid fa-right-from-bracket"></i></span>
                            <span>Log-out</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- END -->

    <!-- Section Start -->

    <div class="container">
        <div class="row">
            <div class="col-md-12 py-md-5 mx-md-5">
                <div class="card1 shadow">
                    <div class="card-header">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./transaction.php">Customer Orders</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Order Details</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 float-end">
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
                                    $o_query = "SELECT o.order_id, o.tracking_no, o.user_id, oi.*,oi.oitem_qty AS order_qty,p.*,p.prod_image AS prod_image,u.*,u.user_id FROM orders o INNER JOIN users AS u ON o.user_id = u.user_id INNER JOIN order_item oi ON o.order_id = oi.order_id INNER JOIN products p ON oi.prod_id = p.prod_id WHERE o.tracking_no = '$order_data' ";

                                    $oq_run = mysqli_query($conn, $o_query);

                                    if (mysqli_num_rows($oq_run) > 0) {

                                        foreach ($oq_run as $itemdt => $output) {
                                    ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <img src="./images/<?php echo $output['prod_image']; ?>" alt="<?php echo $output['prod_name']; ?>" style="width: 90px; height: 90px;">
                                                </td>
                                                <td class="align-middle">₱ <?php echo number_format($output['prod_price'] * $output['order_qty'], 2) ?></td>
                                                <td class="align-middle"><?php echo $output['order_qty'] ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <h5>Total Price: <span class="float-end fw-bold">₱ <?= number_format($d['totalp'], 2); ?></span></h5>
                            <p class="p-1 mb-2">
                                <label for="">Payment Mode</label>
                                <span class="float-end"><?php echo $d['payment_mode']; ?></span>
                            </p>
                            <p class="p-1 mb-3">
                                <label for="">Status</label>
                                <span class="float-end">
                                    <?php
                                    if ($d['order_status1'] == 0) {
                                        echo "<span class='float-end fw-bold'><font color='#FF8300'>Not Yet Received</font></span>";
                                    } elseif ($d['order_status1'] == 1) {
                                        echo "<span class='float-end fw-bold'><font color='#116530'>Order Received</font></span>";
                                    }
                                    ?>
                                </span>

                            <form action="./code.php" method="POST">
                                <input type="hidden" name="tracking_no" value="<?php echo $d['tracking_no']; ?>">
                                <select name="o_status" class="form-select">
                                    <?php
                                    if ($d['stat'] == 0) {
                                    ?>
                                        <option value="0" <?= $d['order_status'] == 0 ? "Selected" : "" ?>>Pending</option>
                                        <option value="1" <?= $d['order_status'] == 1 ? "Selected" : "" ?>>On Delivery</option>
                                    <?php
                                    } elseif ($d['stat'] == 1 && $d['stat1'] == 0) {
                                    ?>
                                        <option value="0" <?= $d['order_status'] == 0 ? "Selected" : "" ?>>Pending</option>
                                        <option value="1" <?= $d['order_status'] == 1 ? "Selected" : "" ?>>On Delivery</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="2" <?= $d['order_status'] == 2 ? "Selected" : "" ?>>Completed</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-success mt-3" name="update_order">Update Status</button>
                            </form>
                            </p>
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
                </div>
            </div>
        </div>
    </div>
    <!-- Section End -->


    <!-- For Script Section-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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