<?php
session_start();
include('./admin.php');
include('./connection/connect.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../logos/alogo.png" type="image/ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
  <link rel="stylesheet" href="home.css" />
  <style>
    .badge {
      height: 18px;
      width: 12vh;
      margin-left: 22vh;
      margin-top: 1.7vh;
      background-color: #388e3e;
    }
  </style>
  <title>Silverback - Dashboard</title>
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample"><span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <div class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold">
        <a style="color:#CECECE;font-size: 25px;;font-weight: 900;margin-left:40px">Silver</a><a style="color:#FFE15D;font-size: 25px;;font-weight: 900">back</a><a href="#" style="color:white;margin-left:55rem"></a>
      </div>
    </div>
  </nav>

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
            <a style="color: #FFE15D;padding: 20px 20px;" href="#" class="nav-link px-3 active">
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
                    <span> Manage User </span>
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
                  <a style="color: #fff;" href="./transaction.php" class="nav-link px-3">
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



  <!-- Dashboard -->
  <main class="mt-5 pt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4 style="padding-bottom:20px"><i class="fa-sharp fa-solid fa-chart-line"></i> Dashboard</h4>
          <?php $profile = getProfile();
          if (mysqli_num_rows($profile) > 0) {
            foreach ($profile as $dp => $pro) {
          ?>
              <h5 style="font-weight: 700;margin-top:20px;margin-bottom: 10px">Welcome, <?php echo $pro['fname'] ?> <?php echo $pro['lname'] ?>
                <div class="float-end">
                  <?php
                  echo date("l,  F j, Y");
                  ?>
                </div>
              </h5>
          <?php
            }
          }
          ?>
          <br><br>
        </div>
      </div>
      <div class="row">


        <!--Listahan ng mga product etong line-->

        <div class="col-md-4 mb-4">
          <div class="modal fade" id="quantity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">List of Products</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered table-striped" id="prod_table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($conn, "SELECT * FROM `products` ORDER BY prod_id");
                      if (mysqli_num_rows($query) > 0) {
                        foreach ($query as $q => $data) {
                      ?>
                          <tr>
                            <td><?php echo $data['prod_id'] ?></td>
                            <td><?php echo $data['prod_name'] ?></td>
                            <td><img src="./images/<?php echo $data['prod_image'] ?>" width="80px" height="80px" alt="<?php echo $data['prod_image'] ?>"></td>
                            <td><?php echo max($data['prod_qty'], 0) ?></td>
                          </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card text-white h-100" style="background:rgba( 208, 2, 27, 0.8 );backdrop-filter: blur( 20px );-webkit-backdrop-filter: blur( 20px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 )">
            <div class="card-body" style="text-align:center;padding-bottom:20px">Number of all products</div>
            <?php
            $sum = getQtySUM(); {
              while ($d = $sum->fetch_assoc()) {

                echo "<center><strong><p style='font-size:25px'>" . $d['quantity'] . "</p></strong></center>";
              }
            }
            ?>
            <div class="card-footer d-flex" type="button" data-bs-target="#quantity" data-bs-toggle="modal">
              View Details
              <span class="ms-auto">
                <i class="fa-solid fa-chevron-right drop-down"></i>
              </span>
            </div>
          </div>
        </div>

        <!-- END -->

        <!-- Listahan ng mga out of stock product -->

        <div class="col-md-4 mb-4">
          <div class="modal fade" id="outofstock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">List of Products</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <?php
                  $query = mysqli_query($conn, "SELECT * FROM `products` WHERE prod_qty = '0' OR prod_qty < '5'");
                  if (mysqli_num_rows($query) > 0) {
                    foreach ($query as $q => $data) {
                  ?>
                      <table id="prod_table" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?php echo $data['prod_id'] ?></td>
                            <td><?php echo $data['prod_name'] ?></td>
                            <td><img src="./images/<?php echo $data['prod_image'] ?>" width="80px" height="80px" alt="<?php echo $data['prod_image'] ?>"></td>
                            <td><?php echo max($data['prod_qty'], 0) ?></td>
                          </tr>
                        </tbody>
                      </table>
                  <?php
                    }
                  } else {
                    echo "All goods! No Low Stock Product.";
                  }
                  ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card text-dark h-100" style="background: rgba( 126, 211, 33, 0.65 );backdrop-filter: blur( 20px );-webkit-backdrop-filter: blur( 20px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
            <div class="card-body" style="text-align:center;padding-bottom:20px">Number of Low Stock Product</div>
            <?php
            $count = getOutofStocks(); {
              while ($d = $count->fetch_assoc()) {

                echo "<center><strong><p style='font-size:25px'>" . $d['count'] . "</p></strong></center>";
              }
            }
            ?>
            <div class="card-footer d-flex" type="button" data-bs-target="#outofstock" data-bs-toggle="modal">
              View Details
              <span class="ms-auto">
                <i class="fa-solid fa-chevron-right drop-down"></i>
              </span>
            </div>
          </div>
        </div>

        <!-- Total Revenue ng business this month -->
        <div class="col-md-4 mb-4">
          <div class="card text-white h-100" style="background: rgba( 74, 144, 226, 1 );backdrop-filter: blur( 9.5px );-webkit-backdrop-filter: blur( 9.5px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
            <div class="card-body" style="text-align:center;padding-bottom:20px">Total Revenue This Month</div>
            <?php
            $revenue = getRevenueMonth(); {
              while ($d = $revenue->fetch_assoc()) {
                echo "<center><strong><p style='font-size:25px'>₱ " . number_format($d['revenue'], 2) . "</p></strong></center>";
              }
            }
            ?>
            <div class="mb-5">
            </div>
          </div>
        </div>

        <!-- JS Table ng mga frequent purchased product -->
        <div class="col-md-8">
          <div class="card my-5">
            <div class="card-body">
              <canvas id="bargraph">
                <?php
                $chart = getFrequentPurch();
                $data = "";
                if (mysqli_num_rows($chart) > 0) {
                  foreach ($chart as $item => $rowdat) {
                    $prodname[] = $rowdat['product_name'];
                    $qty[] = $rowdat['order_quantity'];
                  }
                }
                ?>
              </canvas>
            </div>
          </div>
        </div>
        <!--<div class="col-md-4 float-end">
          <div class="card my-5">
          </div>
        </div>-->
      </div>
    </div>
  </main>
  <!-- END -->


  <!-- SCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.1.2/chart.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.js"></script>
  <!-- END -->

  <!-- JS -->
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

  <script type="text/javascript">
    var ctx = document.getElementById("bargraph").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($prodname); ?>,
        datasets: [{
          label: 'Top 5 Frequent Ordered Product',
          backgroundcolor: [
            "#5969ff",
            "#5945fd",
            "#25d5f2",
            "#2ec551",
            "#ff044e",
          ],
          data: <?php echo json_encode($qty); ?>
        }]
      },
      option: {
        legend: {
          display: true,
          position: 'bottom',
          labels: {
            fontColor: '#71748d',
            fontFamily: 'Circular Std Book',
            fontSize: 14,
            plugins: {
              title: {
                display: true,
                text: 'Frequent Purchase Product'
              }
            }
          }
        }
      }
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#prod_table').DataTable({
        searching: false,
        pageLength: 3,
        lengthMenu: [
          [3, 4, 5, -1],
          [3, 4, 5, 'Show All']
        ]
      })
    });
  </script>
  <!-- END-->
</body>

</html>