<?php
session_start();
include('../connection/connect.php');
include('../functions/functions.php');
if (isset($_SESSION['auth'])) {
    if ($_SESSION['role'] != 1) {

        redirect('../index.php', "You Don't have any Authorization to Access this Module!");
    }
} else {
    redirect('../users/login.php', "Log-in to continue");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Section -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <!-- END Section -->


    <link rel="stylesheet" type="text/css" href="../home.css" />
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
    </style>
    <title>Silverback - Sales Report</title>
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
                                    <img src='../profile/<?php echo $pro['image'] ?>' style="width:100px;height:100px;border-radius: 50%" />
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
                        <a style="color: #fff;padding: 20px 20px;" href="../home.php" class="nav-link px-3">
                            <span class="me-2"><i class="fa-sharp fa-solid fa-chart-line"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a style="color: #FFE15D;padding: 20px 20px;" class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#reports"><span class="me-2"><i class="fa-solid fa-chart-simple"></i></span>
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
                                    <a style="color: #FFE15D;" href="./salesreport.php" class="nav-link px-3">
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
                                    <a style="color: #fff;" href="../category/category.php" class="nav-link px-3">
                                        <span class="me-2"><i class="fa-solid fa-tag"></i></span>
                                        <span>Category</span>
                                    </a>
                                    <a style="color: #fff;" href="../product/product.php" class="nav-link px-3">
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
                                    <a style="color: #fff;" href="../users/users.php" class="nav-link px-3">
                                        <span class="me-2"><i class="fa-solid fa-users-gear"></i></span>
                                        <span> Manage Users </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a style="color: #fff;padding: 20px 20px;" class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#transaction"><span class="me-2"><i class="fa-sharp fa-solid fa-receipt"></i>
                                <?php
                                $pending = getPending();
                                $arr = mysqli_num_rows($pending);
                                if (empty($arr)) {
                                    echo "";
                                } else {
                                    echo "<span class='position-absolute top-40 start-10 translate-middle badge badge-secondary'>New Order</span>";
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
                                    <a style="color: #fff;" href="../transaction.php" class="nav-link px-3">
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
                        <a style="color: #fff;padding: 20px 20px;" href="../logout.php" class="nav-link px-3">
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
                                <li class="breadcrumb-item"><a href="../home.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sales Report</li>
                            </ol>
                        </nav>
                        <h4>Sales Report</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-info text-white"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-info text-white"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button id="search" name="search" class="btn btn-info">Search</button>
                                        <button id="reset" name="reset" class="btn btn-warning">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <table id="sales_report" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Tracking No</th>
                                            <th>Order Date</th>
                                            <th>Customer</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section End -->


        <!-- For Script Section-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!-- End Script Section-->

        <!-- JS Section -->
        <script type="text/javascript" charset="utf-8" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap5.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
        <script charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script charset="utf-8" src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <!-- END Section -->

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
            $(function() {
                $("#start_date").datepicker({
                    "dateFormat": "yy-mm-dd"
                });
                $("#end_date").datepicker({
                    "dateFormat": "yy-mm-dd"
                });
            });
        </script>
        <script>
            function fetch(start_date, end_date) {
                $.ajax({
                    url: "../functions/fetch.php",
                    type: "POST",
                    data: {
                        start_date: start_date,
                        end_date: end_date
                    },
                    dataType: "json",
                    success: function(data) {

                        $('#sales_report').DataTable({
                            order:[[2,'desc'], [0,'asc']],
                            searching: false,
                            "data": data,
                            dom: "<'row'<'col-sm-12 col-md-8'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-5'f>>" + "<'row'<'col-sm-12'rt>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-4'p>>",
                            buttons: [{
                                extend: 'print',
                                text: '<i class="fas fa-print"></i> Print',
                                title: '',
                                customize: function(win) {
                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('color', 'black')
                                        .css('font-size', 'inherit');

                                    $(win.document.body)
                                        .css('font-size', '11pt')
                                        .prepend('<div><img src="https://i.postimg.cc/xCtX9JRG/logo.png" style="position:absolute; left:9vh; right: 9vh; height:125px; width:125px; margin-top: -18vh;" /></div>')
                                        .prepend('<center><h1>SILVERBACK</h1><p> Address: 149 Makabud Street Amparo Village, Caloocan City <br> TIN NO: xxxxxxxxxxxx <br></p></center>')
                                        .css('margin-top', '9vh')
                                }
                            }],

                            "columns": [{
                                    "data": "o_order_id",
                                    "render": function(data, type, row, meta) {
                                        return `0000` + `${row.o_order_id}`;
                                    }
                                },
                                {
                                    "data": "o_tracking",
                                    "render": function(data, type, row, meta) {
                                        return `${row.o_tracking}`;
                                    }
                                },
                                {
                                    "data": "order_date",
                                    "render": function(data, type, row, meta) {
                                        return moment(row.order_date).format('MM-DD-YYYY');
                                    }
                                },
                                {
                                    "data": "full_name",
                                    "render": function(data, type, row, meta) {
                                        return `${row.full_name}`;
                                    }
                                },
                                {
                                    "data": "prod_quantity",
                                    "render": function(data, type, row, meta) {
                                        return `${row.prod_quantity}`;
                                    }
                                },
                                {
                                    "data": "total_price",
                                    "render": function(data, type, row, meta) {
                                        return `₱ ${row.total_price}`;
                                    }
                                }
                            ]
                        })
                    }
                })
            }
            fetch();

            $(document).on("click", "#search", function(e) {
                e.preventDefault();

                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();

                if (start_date == "" || end_date == "") {
                    alert("Both date required!");
                } else {
                    $('#sales_report').DataTable().destroy();
                    fetch(start_date, end_date);
                }

            });

            $(document).on("click", "#reset", function(e) {
                e.preventDefault();
                $("#start_date").val('');
                $("#end_date").val('');

                $('#sales_report').DataTable().destroy();
                fetch();
            });
        </script>
        <!-- END -->
</body>

</html>