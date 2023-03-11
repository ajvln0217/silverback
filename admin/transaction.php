<?php
session_start();
include('./admin.php');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Section -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <!-- END Section -->


    <!-- JS Section -->
    <script type="text/javascript" charset="utf-8" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.js"></script>
    <!-- END Section -->

    <link rel="stylesheet" type="text/css" href="./home.css" />
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

        .badge {
            height: 18px;
            width: 12vh;
            margin-left: 22vh;
            margin-top: 1.7vh;
            background-color: #388e3e;
        }
        .badges {
            height: 18px;
            width: 5.5vh;
            margin-left: 3vh;
            margin-top: 1.7vh;
            background-color: white;
            color: black;
            font-size: 13px;
        }
        .ord_txt{
            margin-right: 1vh;
        }

    </style>
    <title>Silverback - Transactions</title>
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
                        <a style="color: #FFE15D;padding: 20px 20px;" class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#transaction"><span class="me-2"><i class="fa-sharp fa-solid fa-receipt"></i>
                                <?php
                                $pending = getPending();
                                $arr = mysqli_num_rows($pending);
                                if (empty($arr)) {
                                    echo "";
                                } else {
                                    echo "<span class='position-absolute top-40 start-10 translate-middle badge badge-light'>New Order</span>";
                                }
                                ?>
                            </span>
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
                                <li class="breadcrumb-item"><a href="./home.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                            </ol>
                        </nav>
                        <h4>Customer Orders <a class="btn btns btn-success float-end pe-5" href="./received.php"><span class="ord_txt">Order Received</span>
                            <?php
                                $received = itemReceived();
                                $arr = mysqli_num_rows($received);
                                if (empty($arr)) {
                                    echo "<span class='position-absolute top-40 start-10 translate-middle badges badge-secondary'>None</span>";
                                } else {
                                    echo "<span class='position-absolute top-40 start-10 translate-middle badges badge-secondary'>New</span>";
                                }
                            ?>
                            </a></h4>
                    </div>
                    <div class="card-body">
                        <table id="transact_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Tracking No</th>
                                    <th>Subtotal</th>
                                    <th>Date</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $order = getPending();

                                if (mysqli_num_rows($order) > 0) {
                                    foreach ($order as $item => $res) {
                                ?>
                                        <tr>
                                            <td><?php echo $res['order_id']; ?></td>
                                            <td><?php echo $res['fname'] ?> <?php echo $res['lname'] ?></td>
                                            <td><?php echo $res['tracking_no']; ?></td>
                                            <td>₱ <?php echo number_format($res['total_price'], 2); ?></td>
                                            <td><?php echo $res['order_date']; ?></td>
                                            <td>
                                                <a href="vieworder.php?track_no=<?= $res['tracking_no']; ?>" class="btn btn-primary">View Details</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else if (mysqli_num_rows($order) < 0) {
                                    echo "<td class=\"blank\">blank</td>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section End -->


        <!-- For Script Section-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
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
            $(document).ready(function() {
                var table = $('#transact_table').DataTable({
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 15, -1],
                        [5, 10, 15, 20]
                    ]
                })
            });
        </script>
        <!-- END -->
</body>

</html>