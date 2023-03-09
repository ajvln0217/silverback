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
<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.css" />
  <!-- END -->

  <!-- JS -->
  <script type="text/javascript" charset="utf-8" src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.js"></script>
  <!-- END -->

  <link rel="stylesheet" href="../home.css" />

  <title>Inventory - Category</title>
  <style>
    .container-fluid .navbar-brand {
      color: #CECECE;
      font-size: 25px;
      text-transform: uppercase;
      font-weight: 900;
      height: calc(100% - 9%);
    }

    .container-fluid .navbar-brand span {
      color: #FFE15D;
      font-size: 25px;
      text-transform: uppercase;
      font-weight: 900;
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

    .bt {
      background-color: #1c9e49;
      border: none;
      color: white;
      padding: 12px 16px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 15px;
      text-decoration: none;
    }

    .bt:hover {
      color: greenyellow;
    }

    .form-control {
      border: 1px solid #b3a1a1 !important;
      padding: 15px 15px;
    }
    .badge {
      height: 18px;
      width: 12vh;
      margin-left: 22vh;
      margin-top: 1.7vh;
      background-color: #388e3e;
    }
  </style>
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
  <!-- END -->

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
                  <a style="color: #fff;" href="../report/salesreport.php" class="nav-link px-3">
                    <span class="me-2"><i class="fa-solid fa-chart-pie"></i></span>
                    <span>Sales Report</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li>
            <a style="color: #FFE15D;padding: 20px 20px;" class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#inventory"><span class="me-2"><i class="fa-sharp fa-solid fa-warehouse"></i></span>
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
                  <a style="color: #FFE15D;" href="./category.php" class="nav-link px-3">
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

  <!-- Card -->
  <div class="container">
    <div class="row">
      <div class="col-md-12 py-md-5 mx-md-5">
        <div class="card1 shadow">
          <div class="card-header">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../home.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
              </ol>
            </nav>
            <h4><i class="fa-solid fa-tag"></i> Categories <a class="bt float-end" href="./addcat.php"><i class="fa-regular fa-plus"></i> Add New Category</a></h4>
          </div>
          <div class="card-body">
            <table id="cat_table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM `category` ORDER BY cat_id");
                while ($result = mysqli_fetch_array($query)) {
                  $cat_id = $result['cat_id'];
                  $cat_name = $result['cat_name'];
                  $image = $result['cat_image'];
                  $status = $result['cat_status'];
                ?>
                  <tr>
                    <td><?= $cat_id; ?></td>
                    <td><?= $cat_name; ?></td>
                    <td><img src="../images/<?php echo $image ?>" width="80px" height="80px" alt='<?php echo $image ?>' /></td>
                    <td><?= $status == '0' ? "Visible" : "Hidden" ?></td>
                    <td><a href="./editcat.php?id=<?= $cat_id; ?>" class="btn btn-primary">Edit</td>
                    <td>
                      <form action="../code.php" method="POST">
                        <input type="hidden" name="category_id" value="<?= $cat_id; ?>">
                        <button type="submit" name="delete_cat" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- END -->

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- End -->

    <!-- Script -->
    <script type="text/javascript">
      $(document).ready(function() {
        var table = $('#cat_table').DataTable({
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