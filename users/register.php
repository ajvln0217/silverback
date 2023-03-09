<?php
session_start();
include('../connection/connect.php');

if (isset($_SESSION['auth'])) {
  $_SESSION['message'] = "You are already logged in";
  header('Location: ../index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"/>
  <link rel="stylesheet" href="./register.css">
  <title>Silverback | Registration Form</title>
</head>

<body>
  <section>
    <div class="container">
      <form name="userForm" id="userForm" class="form" action="../functions/authentication.php" method="POST" enctype="multipart/form-data">
        <div class="step step-active">
          <center>
            <h2>User Account</h2>
            <small>
              <p><span style="color:#FF0000 ">*</span> Please fill all the necessary fields</p>
            </small>
          </center>
          <?php
          if (isset($_SESSION['message'])) {
          ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong></strong> <?= $_SESSION['message'] ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php
            unset($_SESSION['message']);
          }
          ?>
          <label class="mb-1" for="name">Username <span style="color:#FF0000 ">*</span></label>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input class="form-control" type="text" id="username" name="username" placeholder="Enter your Username" autocomplete="off" />
          </div>

          <label class="mb-1" for="password">Password <span style="color:#FF0000 ">*</span></label>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input class="form-control" type="password" id="user_password" name="user_password" placeholder="Enter your Password" autocomplete="off" />
          </div>

          <label class="mb-1" for="cpassword">Confirm Password <span style="color:#FF0000 ">*</span></label>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="Confirm your Password" autocomplete="off" />
          </div>

          <label for="user_email">Email <span style="color:#FF0000 ">*</span></label>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input class="form-control" type="email" name="user_email" placeholder="Enter your email" autocomplete="off" />
          </div>
          <div class="mt-4 pt-2">
            <input type="button" class="next-btn" name="next" id="next" value="Next" />
            <p class="small fw-bold">Already have an account? <a class="bttn" href="../users/login.php"> Login</a></p>
          </div>
        </div>


        <div class="step">
          <center>
            <h2>User Information</h2>
            <small>
              <p>Note: Kindly fill all the necessary fields. The information you entered will be use during the transaction.</p>
            </small>
          </center>
          <br>
          <i class="fas fa-address-card"></i> <label class="mb-1">Basic Information</label> <span style="color:#FF0000 ">*</span>
          <div class="column">
            <div class="input-box">
              <input type="text" id="fname" name="fname" placeholder="Enter your First Name" />
            </div>

            <div class="input-box">
              <input type="text" id="lname" name="lname" placeholder="Enter your Last Name" />
            </div>
          </div>

          <div class="column">
            <div class="form-group">
              <input type="number" id="contactnum" name="contactnum" placeholder="Enter your Contact Number" />
            </div>

            <div class="form-group">
              <input type="date" id="birthday" name="birthday" placeholder="Enter your Birthday" />
            </div>
          </div>
          <br>
          <div class="form-group">
            <i class="fas fa-city"></i> <label for="address">Billing Address</label> <span style="color:#FF0000 ">*</span>
            <input type="text" name="address" placeholder="Enter your Address" />
            <input type="text" name="city" placeholder="Enter your City" />
          </div>
          <div class="column form-group">
            <input type="text" name="region" placeholder="Enter your Region">
            <input type="number" name="zip" min=0 placeholder="Enter your Zip Code" />
          </div>

          <div class="modal fade" id="policy" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Privacy Policy</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <br>
          <div class = "mt-2 ms-3" style="display:flex;justify-content:center;">
          <small>
          <p>Privacy Notice: Your information will be collected and only use during the transaction within the platform. The <b>Silverback</b> website will not sell or give the personal information collected in any third party or organization existed in the internet under the <a href="https://www.privacy.gov.ph/data-privacy-act/">Republic Act 10173 – Data Privacy Act of 2012.</a></p>
          </small>
          </div>

          <div class="mt-3 ms-5" style="display:inline-flex;justify-content:center;">
            <input type="checkbox" name="agree" id="agree" style="margin-top:-6vh; margin-right: 1vh;"/>
            <p for="agree">&nbsp;By clicking this, you are agree in providing your personal &nbsp;information within the platform.</p>
          </div>

          <div class="input-box button">
            <input type="button" class="previous-btn" name="previous" id="previous" value="Previous" />
            <input type="submit" class="btn" name="sign_up" id="sign_up" value="Submit" />
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- Script Assets -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <!-- End -->

  <!-- JS Section -->
  <script>
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
        },
        submitHandler: function(form) {
          form.submit();
        }
      });
      jQuery.validator.addMethod("phonePH", function(value, element) {
        return this.optional(element) || /^(09|\+639)\d{9}$/.test(value);
      }, "Please enter a valid phone number.");
      jQuery.validator.addMethod("email", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test(value);
      }, "Please enter a valid email address.");
      jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
      }, "Space are not allowed");

      //Sa mga buttons

      $("#next").click(function() {
        if ($("#userForm").valid()) {
          $('.step').removeClass('step-active').hide().next().show().addClass('step-last');
        }
        if ($('.step').hasClass('step-last')) {
          $("#next").attr('disabled', true);
        }
        $("#previous").attr('disabled', null);
      })

      $("#previous").click(function() {
        if ($('.step').hasClass('step-last')) {
          $('.step').removeClass('step-last').hide().prev().show().addClass('step-active');
        }
        if ($('.step').hasClass('step-active')) {
          $("#previous").attr('disabled', true);
        }
        $("#next").attr('disabled', null);
      })
    });
  </script>
  <!-- END JS -->
</body>

</html>