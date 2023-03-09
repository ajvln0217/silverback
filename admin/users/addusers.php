<?php
session_start();
include('../connection/connect.php');
include('../functions/functions.php');

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

  <title>Users - Add New Users</title>
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

    .form-select {
      border: 1px solid #b3a1a1 !important;
      padding: 12px 12px;
    }

    .picture-container {
      position: relative;
      cursor: pointer;
      text-align: center;
    }

    .picture-container .picture {
      width: 150px;
      height: 150px;
      background-color: #999999;
      border: 4px solid #CCCCCC;
      color: #FFFFFF;
      border-radius: 50%;
      margin: 5px auto;
      overflow: hidden;
      transition: all 0.2s;
      -webkit-transition: all 0.2s;
    }

    .picture-container .picture:hover {
      border-color: #2ca8ff;
    }

    .picture-container .picture input[type="file"] {
      cursor: pointer;
      display: block;
      height: 100%;
      left: 0;
      opacity: 0 !important;
      position: absolute;
      top: 0;
      width: 100%;
    }

    .picture-container .pic-src {
      width: 100%;
    }

    label.error {
      display: block;
      color: #FF3B30;
      font-size: 14px;
      padding-bottom: 5px;
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
            <a style="color: #FFE15D;padding: 20px 20px;" class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#user"><span class="me-2"><i class="fa-sharp fa-solid fa-users"></i></span>
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
                  <a style="color: #FFE15D;" href="./users.php" class="nav-link px-3">
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
  <div class="container">
    <div class="row">
      <div class="col-md-12 py-md-5 mx-md-5">
        <div class="card1 shadow">
          <div class="card-header">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./users.php">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Users</li>
              </ol>
            </nav>
            <h4><i class="fa-solid fa-user-plus"></i> Add New Users</h4>
          </div>
          <div class="card-body">
            <form id="userForm" action="../code.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                <center>
                  <div class="mb-5 mt-2">
                    <div class="picture-container">
                      <div class="picture">
                        <img src="./default.jpg" class="pic-src" id="pic-prev" />
                        <input class="form-control" name="image" type="file" id="picts">
                      </div>
                    </div>
                    <center><small style="font-weight: 800">Select Picture</small></center>
                  </div>
                </center>

                <div class="container">
                  <div class="row align-items-start mt-4">
                    <div class="col">
                      <i class="fa-solid fa-user fa-lg"></i> User Account <br><br>
                      <label class="mb-0">Username</label>
                      <input type="text" name="username" placeholder="Enter Username" class="form-control mb-2">
                      <label class="mb-0">Password</label>
                      <input type="password" name="user_password" id="user_password" placeholder="Enter Password" class="form-control mb-2">
                      <label class="mb-0">Confirm Password</label>
                      <input type="password" name="cpassword" placeholder="Re-Enter Password" class="form-control mb-2">
                      <label class="mb-0">Email Address</label>
                      <input type="email" name="user_email" placeholder="Enter email Address" class="form-control mb-2">
                    </div>

                    <div class="col">
                      <i class="fas fa-address-card fa-lg"></i> Basic Information <br><br>
                      <label class="mb-0">First Name</label>
                      <input type="text" name="fname" placeholder="Enter First Name" class="form-control mb-2">
                      <label class="mb-0">Last Name</label>
                      <input type="text" name="lname" placeholder="Enter Last Name" class="form-control mb-2">
                      <label class="mb-0">Contact Number</label>
                      <input type="number" name="contactnum" placeholder="Enter Contact Number" min=1 class="form-control mb-2">
                      <label class="mb-0">Birthday</label>
                      <input type="date" name="birthday" placeholder="Enter Birthday" class="form-control mb-2">
                    </div>

                    <div class="col">
                      <i class="fas fa-city fa-lg"></i> Complete Address <br><br>
                      <label class="mb-0">Address</label>
                      <input type="text" name="address" placeholder="Enter Address" class="form-control mb-2">
                      <label class="mb-0">City</label>
                      <input type="text" name="city" placeholder="Enter City" class="form-control mb-2">
                      <label class="mb-0">Region</label>
                      <input type="text" name="region" placeholder="Enter Region" class="form-control mb-2">
                      <label class="mb-0">Zip</label>
                      <input type="number" name="zip" placeholder="Enter Zip Code" min=1 class="form-control mb-2">
                    </div>
                  </div>
                  <center>
                    <div class="row align-items-start mt-3">
                      <div class="col-sm-4 mt-2" style="margin-left: 45vh">
                        <i class="fa-solid fa-user-tie fa-lg"></i>
                        <label class="mb-0">User Role</label><br><br>
                        <select name="role" class="form-select">
                          <option value="3">Staff</option>
                        </select>
                      </div>
                  </center>
                </div>
                <br>
                <div class="col-md-12">
                  <button class="btn btn-primary" name="add_user">Save</button>
                </div>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Script -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <!-- End -->

  <script>
    //Pop Up Message
    <?php if (isset($_SESSION['message'])) {
    ?>
      alertify.set('notifier', 'position', 'top-center');
      alertify.success('<?= $_SESSION['message']; ?>');
    <?php
      unset($_SESSION['message']);
    }
    ?>

    //Pag palit ng picture
    $("#picts").change(function() {
      readURL(this);
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#pic-prev').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    //Validator galing sa jquery validator plugin

    $(document).ready(function() {
      var $validator = $("#userForm").validate({
        rules: {
          username: {
            required: true,
            minlength: 5,
          },
          user_password: {
            required: true,
            noSpace: true,
            minlength: 6,
            maxlength: 8,
          },
          cpassword: {
            required: true,
            noSpace: true,
            equalTo: "#user_password",
            minlength: 6,
            maxlength: 8,
          },
          user_email: {
            email: true,
            required: true,
          },
          fname: {
            required: true,
          },
          lname: {
            required: true,
          },
          contactnum: {
            number: true,
            phonePH: true,
            required: true,

            minlength: 11,
            maxlength: 11,
          },
          birthday: {
            date: true,
            required: true,
          },
          address: {
            required: true,
          },
          city: {
            required: true,
          },
          region: {
            required: true,
          },
          zip: {
            number: true,
            required: true,
            minlength: 4,
            maxlength: 4,
          },
          role: {
            required: true,
          },
          image: {
            required: true,
            extension: "jpg|jpeg|png"
          },
          agree: {
            required: true,
          },
        },
        messages: {
          username: {
            required: "Please Enter your User Name",
            minlength: "Please enter at least 5 characters",
          },
          user_password: {
            required: "Please Enter your Password",
            minlength: "Please enter at least 6-8 characters",
            maxlength: "Character Exceeded to 8 characters",
          },
          cpassword: {
            required: "Re-Enter your password!",
            equalTo: "Password do not match!",
            minlength: "Password do not match!",
            maxlength: "Password do not match!",
          },
          user_email: {
            required: "Please Enter your email",
          },
          fname: {
            required: "Please Enter your First Name",
          },
          lname: {
            required: "Please Enter your Last Name",
          },
          contactnum: {
            minlength: "11 numbers only allowed",
            maxlength: "11 numbers only allowed",
          },
          birthday: {
            required: "This field is required",
          },
          address: {
            required: "Please Enter your Address",
          },
          city: {
            required: "Please Enter your City Name",
          },
          region: {
            required: "Please Enter your Region. eg(METRO MANILA)",
          },
          zip: {
            required: "Please Enter your Zip Code. eg(1428)",
            minlength: "Invalid Zip Code! Zip Code must contain 4 numbers",
            maxlength: "Invalid Zip Code! Zip Code must contain 4 numbers",
          },
          image: {
            required: "Please upload file.",
            extension: "Please upload file in these format only (jpg, jpeg, png)."
          }
        },
        submitHandler: function(form) {
          form.submit();
        }
      });

      //Apply ng REGEX (Regular Expression)

      jQuery.validator.addMethod("phonePH", function(value, element) {
        return this.optional(element) || /^(09|\+639)\d{9}$/.test(value);
      }, "Please enter a valid phone number.");
      jQuery.validator.addMethod("email", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test(value);
      }, "Please enter a valid email address.");
      jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
      }, "Space are not allowed");

    });
  </script>
</body>

</html>