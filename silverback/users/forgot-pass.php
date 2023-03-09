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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
    <link rel="stylesheet" href="./forgot-pass.css">
    <title>Silverback | Reset Password</title>
    <style>
       
        .button-bttn {
            align-items: center;
            background-color: #0A66C2;
            border: 0;
            border-radius: 100px;
            box-sizing: border-box;
            color: #ffffff;
            cursor: pointer;
            display: inline-flex;
            font-family: -apple-system, system-ui, system-ui, "Segoe UI", Roboto, "Helvetica Neue", "Fira Sans", Ubuntu, Oxygen, "Oxygen Sans", Cantarell, "Droid Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Lucida Grande", Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;
            justify-content: center;
            line-height: 20px;
            max-width: 480px;
            min-height: 40px;
            min-width: 0px;
            overflow: hidden;
            padding: 0px;
            padding-left: 20px;
            padding-right: 20px;
            text-align: center;
            touch-action: manipulation;
            transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
            user-select: none;
            -webkit-user-select: none;
            vertical-align: middle;
        }

        .button-bttn:hover,
        .button-bttn:focus {
            background-color: #16437E;
            color: #ffffff;
        }

        .button-bttn:active {
            background: #09223b;
            color: rgb(255, 255, 255, .7);
        }

        .button-bttn:disabled {
            cursor: not-allowed;
            background: rgba(0, 0, 0, .08);
            color: rgba(0, 0, 0, .3);
        }

        .button-bttn {
            float: right;
            margin-top: 20px;
            padding: 10px 30px;
            border: none;
            outline: none;
            background-color: #939597;
            font-family: sans-serif;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <form name="userForm" id="userForm" class="form" action="./pass-reset.php" method="POST" enctype="multipart/form-data">
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
                <div class="step step-active mt-4 pt-4">
                    <center>
                        <h2>Reset Password</h2>
                        <small>
                            <p><span style="color:#FF0000 ">*</span> Please Enter your Email Address</p>
                        </small>
                    </center>
                    <div class="mt-4 pt-4">
                        <label for="user_email">Email <span style="color:#FF0000 ">*</span></label>
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input class="form-control" type="email" name="user_email" placeholder="Enter your email" autocomplete="off" />
                        </div>
                    </div>

                    <div class="mt-4 pt-4">
                        <p class="small fw-bold" style="margin-top: 3vh;">Remember Password? <a class="bttn" href="../users/login.php"> Login</a></p>
                    </div>
                    <button type="submit" role="button" class="button-bttn" style="margin-top: -6.5vh" name="submits" id="submits">Submit</button>
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
                    user_email: {
                        email: true,
                        required: true,
                    },
                },
                messages: {
                    user_email: {
                        required: "Please Enter your email",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            jQuery.validator.addMethod("email", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test(value);
            }, "Please enter a valid email address.");
        });
    </script>
    <!-- END JS -->
</body>

</html>