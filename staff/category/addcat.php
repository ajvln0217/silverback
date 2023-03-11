<?php
session_start();
include('../connection/connect.php');
include('../functions/functions.php');

if (isset($_SESSION['auth'])) {
  if ($_SESSION['role'] != 3) {

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
  <link rel="stylesheet" href="../home.css" />

  <title>Inventory - Add Category</title>
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

    .card {
      z-index: 1;
      background: rgba(179, 179, 179, 0.8);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.18);
      margin-top: 50px;
    }

    .card .table .thead .tr {
      position: fixed;
      height: calc(100% - 9%);
      width: calc(100% - 9%);
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
      margin-left: calc(100% - 25%);
    }

    .bt:hover {
      color: greenyellow;
    }

    .ebt {
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
    }

    .ebt:hover {
      color: navy;
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
            $profile = getStaff();
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
                  <a style="color: #FFE15D;" href="../category/category.php" class="nav-link px-3">
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
  <div class="container">
    <div class="row">
      <div class="col-md-12 py-md-5 mx-md-5">
        <div class="card1 shadow">
          <div class="card-header">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../category/category.php">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Category</li>
              </ol>
            </nav>
            <h4><i class="fa-solid fa-tag"></i> Add Category</h4>
          </div>
          <div class="card-body">
            <form action="../code.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <label for="">Category Name</label>
                  <input type="text" name="cat_name" placeholder="Enter Category Name" class="form-control mb-3">
                </div>
                <div class="col-md-6">
                  <label for="">Product Index Name</label>
                  <input type="text" name="cat_index" placeholder="Enter Index Name" class="form-control mb-3">
                </div>
                <div class="col-md-12">
                  <label for="">Description</label>
                  <textarea rows="3" name="cat_description" placeholder="Enter Description" class="form-control mb-3"></textarea>
                </div>
                <div class="col-md-12">
                  <label for="">Upload Image</label>
                  <input type="file" name="cat_image" class="form-control mb-3">
                </div>
                <div class="col-md-12">
                  <label for="">Keywords</label>
                  <textarea row="3" name="cat_keywords" placeholder="Enter Keywords" class="form-control mb-3"></textarea>
                </div>
                <div class="col-md-6">
                  <label for="">Status</label>
                  <input type="checkbox" name="cat_status">
                </div>
                <div class="col-md-6">
                  <label for="">Popular</label>
                  <input type="checkbox" name="cat_popular">
                </div>
                <div class="col-md-12">
                  <button class="btn btn-primary" name="add_category">Save</button>
                </div>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- End -->

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
</body>

</html>