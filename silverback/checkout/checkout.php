<?php
session_start();
include('../connection/connect.php');
include('../functions/userfunctions.php');
include('../cart/validator.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="checkout.css" />
    <style>
        .section-p1 {
            padding: 120px 100px;
        }

        #icon_click {
            cursor: pointer;
            border-radius: 0.25em;
        }

        .decrement-btn {
            color: maroon;
            margin-left: -35px;
            margin-top: 10px;
            padding-left: 0.5em;
            display: flex;
            position: absolute;
        }

        .increment-btn {
            color: darkblue;
            padding-left: 3.3em;
            margin-top: 10px;
            display: flex;
            position: absolute;
        }

        .input-group {
            padding-left: 0.1em;
            border: 1px solid black;
            position: absolute;
            display: flex;
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
    <title>Silverback | Check Out</title>
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
                            <a class="nav-link active ms-auto ps-4 pe-1" href="../cart/mycart.php"><i class="fas fa-shopping-cart fa-lg"></i>
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
    <section id="cart" class="table section-p1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">
                        <h6 style="font-size:30px; margin-right:55vh"><i class="fas fa-shopping-cart" style="color:darkgray"></i> Check Out</h6>
                        <hr style="width:160vh">
                    </div>
                </div>
                <div class="container " style="padding-left: 30px;">
                    <div class="card">
                        <div class="card-body">
                            <form action="../functions/orders.php" method="POST">
                                <div class="row">
                                    <div class="col-md-7">
                                        <?php
                                        $info = getInfo();
                                        if (mysqli_num_rows($info) > 0) {
                                            foreach ($info as $in => $personal) {
                                        ?>
                                                <h5>Personal Details</h5>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="fw-bold">Full Name</label>
                                                        <input type="text" required name="name" value="<?= $personal['fname'] ?> <?= $personal['lname'] ?>" disabled="disabled" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="fw-bold">Contact Number</label>
                                                        <input type="number" required name="contactnum" value="<?= $personal['contactnum'] ?>" disabled="disabled" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="fw-bold">Address</label>
                                                        <textarea name="address" class="form-control" rows="1" disabled="disabled"><?= $personal['address'] ?></textarea>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="fw-bold">City</label>
                                                        <input type="text" required name="city" value="<?= $personal['city'] ?>" disabled="disabled" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="fw-bold">Region</label>
                                                        <input type="text" required name="city" value="<?= $personal['region'] ?>" disabled="disabled" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="fw-bold">Zip Code</label>
                                                        <input type="number" required name="zip" value="<?= $personal['zip'] ?>" disabled="disabled" class="form-control">
                                                    </div>
                                                    <div class="modal fade" id="policy" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Terms and Agreement</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="" style="justify-content: center;">
                                                                        <p><b>TERMS OF USE</b><br><br><br>

                                                                            Last updated March 08, 2023<br><br><br>



                                                                            AGREEMENT TO OUR LEGAL TERMS<br><br><br>

                                                                            We are Silverback PH ("Company," "we," "us," "our"), a company registered in the Philippines at Amparo, Caloocan 1425.<br><br>

                                                                            We operate the website http://silverback.com (the "Site"), as well as any other related products and services that refer or link to these legal terms (the "Legal Terms") (collectively, the "Services").<br><br>

                                                                            You can contact us by email at silverbackthegreat.ph@gmail.com or by mail to Amparo, Caloocan 1425, Philippines.<br><br>

                                                                            These Legal Terms constitute a legally binding agreement made between you, whether personally or on behalf of an entity ("you"), and Silverback PH, concerning your access to and use of the Services. You agree that by accessing the Services, you have read, understood, and agreed to be bound by all of these Legal Terms. IF YOU DO NOT AGREE WITH ALL OF THESE LEGAL TERMS, THEN YOU ARE EXPRESSLY PROHIBITED FROM USING THE SERVICES AND YOU MUST DISCONTINUE USE IMMEDIATELY.<br><br>

                                                                            We will provide you with prior notice of any scheduled changes to the Services you are using. The modified Legal Terms will become effective upon posting or notifying you by __________, as stated in the email message. By continuing to use the Services after the effective date of any changes, you agree to be bound by the modified terms.<br><br>

                                                                            The Services are intended for users who are at least 13 years of age. All users who are minors in the jurisdiction in which they reside (generally under the age of 18) must have the permission of, and be directly supervised by, their parent or guardian to use the Services. If you are a minor, you must have your parent or guardian read and agree to these Legal Terms prior to you using the Services.<br><br>

                                                                            We recommend that you print a copy of these Legal Terms for your records.<br><br>


                                                                            TABLE OF CONTENTS<br><br>

                                                                            1. OUR SERVICES<br>
                                                                            2. INTELLECTUAL PROPERTY RIGHTS<br>
                                                                            3. USER REPRESENTATIONS<br>
                                                                            4. USER REGISTRATION<br>
                                                                            5. PRODUCTS<br>
                                                                            6. PURCHASES AND PAYMENT<br>
                                                                            7. RETURN POLICY<br>
                                                                            8. PROHIBITED ACTIVITIES<br>
                                                                            9. USER GENERATED CONTRIBUTIONS<br>
                                                                            10. CONTRIBUTION LICENSE<br>
                                                                            11. GUIDELINES FOR REVIEWS<br>
                                                                            12. SOCIAL MEDIA<br>
                                                                            13. SERVICES MANAGEMENT<br>
                                                                            14. PRIVACY POLICY<br>
                                                                            15. TERM AND TERMINATION<br>
                                                                            16. MODIFICATIONS AND INTERRUPTIONS<br>
                                                                            17. GOVERNING LAW<br>
                                                                            18. DISPUTE RESOLUTION<br>
                                                                            19. CORRECTIONS<br>
                                                                            20. DISCLAIMER<br>
                                                                            21. LIMITATIONS OF LIABILITY<br>
                                                                            22. INDEMNIFICATION<br>
                                                                            23. USER DATA<br>
                                                                            24. ELECTRONIC COMMUNICATIONS, TRANSACTIONS, AND SIGNATURES<br>
                                                                            25. MISCELLANEOUS<br>
                                                                            26. CONTACT US<br><br>


                                                                            1. <b>OUR SERVICES</b><br><br>

                                                                            The information provided when using the Services is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Services from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.<br><br>

                                                                            2. <b>INTELLECTUAL PROPERTY RIGHTS</b><br><br>

                                                                            Our intellectual property<br><br>

                                                                            We are the owner or the licensee of all intellectual property rights in our Services, including all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics in the Services (collectively, the "Content"), as well as the trademarks, service marks, and logos contained therein (the "Marks").<br><br>

                                                                            Our Content and Marks are protected by copyright and trademark laws (and various other intellectual property rights and unfair competition laws) and treaties in the Philippines and around the world.<br><br>

                                                                            The Content and Marks are provided in or through the Services "AS IS" for your personal, non-commercial use only.<br><br>

                                                                            Your use of our Services<br><br>

                                                                            Subject to your compliance with these Legal Terms, including the "PROHIBITED ACTIVITIES" section below, we grant you a non-exclusive, non-transferable, revocable license to:
                                                                             access the Services; and
                                                                             download or print a copy of any portion of the Content to which you have properly gained access.
                                                                            solely for your personal, non-commercial use.<br><br>

                                                                            Except as set out in this section or elsewhere in our Legal Terms, no part of the Services and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without our express prior written permission.<br><br>

                                                                            If you wish to make any use of the Services, Content, or Marks other than as set out in this section or elsewhere in our Legal Terms, please address your request to: silverbackthegreat.ph@gmail.com. If we ever grant you the permission to post, reproduce, or publicly display any part of our Services or Content, you must identify us as the owners or licensors of the Services, Content, or Marks and ensure that any copyright or proprietary notice appears or is visible on posting, reproducing, or displaying our Content.<br><br>

                                                                            We reserve all rights not expressly granted to you in and to the Services, Content, and Marks.<br><br>

                                                                            Any breach of these Intellectual Property Rights will constitute a material breach of our Legal Terms and your right to use our Services will terminate immediately.<br><br>

                                                                            Your submissions<br><br>

                                                                            Please review this section and the "PROHIBITED ACTIVITIES" section carefully prior to using our Services to understand the (a) rights you give us and (b) obligations you have when you post or upload any content through the Services.<br><br>

                                                                            Submissions: By directly sending us any question, comment, suggestion, idea, feedback, or other information about the Services ("Submissions"), you agree to assign to us all intellectual property rights in such Submission. You agree that we shall own this Submission and be entitled to its unrestricted use and dissemination for any lawful purpose, commercial or otherwise, without acknowledgment or compensation to you.<br><br>

                                                                            You are responsible for what you post or upload: By sending us Submissions through any part of the Services you:
                                                                             confirm that you have read and agree with our "PROHIBITED ACTIVITIES" and will not post, send, publish, upload, or transmit through the Services any Submission that is illegal, harassing, hateful, harmful, defamatory, obscene, bullying, abusive, discriminatory, threatening to any person or group, sexually explicit, false, inaccurate, deceitful, or misleading;
                                                                             to the extent permissible by applicable law, waive any and all moral rights to any such Submission;
                                                                             warrant that any such Submission are original to you or that you have the necessary rights and licenses to submit such Submissions and that you have full authority to grant us the above-mentioned rights in relation to your Submissions; and
                                                                             warrant and represent that your Submissions do not constitute confidential information.
                                                                            You are solely responsible for your Submissions and you expressly agree to reimburse us for any and all losses that we may suffer because of your breach of (a) this section, (b) any third party’s intellectual property rights, or (c) applicable law.<br><br>

                                                                            3. <b>USER REPRESENTATIONS</b><br><br>

                                                                            By using the Services, you represent and warrant that: (1) all registration information you submit will be true, accurate, current, and complete; (2) you will maintain the accuracy of such information and promptly update such registration information as necessary; (3) you have the legal capacity and you agree to comply with these Legal Terms; (4) you are not under the age of 13; (5) you are not a minor in the jurisdiction in which you reside, or if a minor, you have received parental permission to use the Services; (6) you will not access the Services through automated or non-human means, whether through a bot, script or otherwise; (7) you will not use the Services for any illegal or unauthorized purpose; and (8) your use of the Services will not violate any applicable law or regulation.<br><br>

                                                                            If you provide any information that is untrue, inaccurate, not current, or incomplete, we have the right to suspend or terminate your account and refuse any and all current or future use of the Services (or any portion thereof).<br><br>

                                                                            4. <b>USER REGISTRATION</b><br><br>

                                                                            You may be required to register to use the Services. You agree to keep your password confidential and will be responsible for all use of your account and password. We reserve the right to remove, reclaim, or change a username you select if we determine, in our sole discretion, that such username is inappropriate, obscene, or otherwise objectionable.<br><br>

                                                                            5. <b>PRODUCTS</b><br><br>

                                                                            We make every effort to display as accurately as possible the colors, features, specifications, and details of the products available on the Services. However, we do not guarantee that the colors, features, specifications, and details of the products will be accurate, complete, reliable, current, or free of other errors, and your electronic display may not accurately reflect the actual colors and details of the products. All products are subject to availability, and we cannot guarantee that items will be in stock. We reserve the right to discontinue any products at any time for any reason. Prices for all products are subject to change.<br><br>

                                                                            6. <b>PURCHASES AND PAYMENT</b><br><br>

                                                                            We accept the following forms of payment:<br><br>

                                                                            - Cash on Delivery<br><br>


                                                                            You agree to provide current, complete, and accurate purchase and account information for all purchases made via the Services. You further agree to promptly update account and payment information, including email address, payment method, and payment card expiration date, so that we can complete your transactions and contact you as needed. Sales tax will be added to the price of purchases as deemed required by us. We may change prices at any time. All payments shall be in Philippine (PHP).<br><br>

                                                                            You agree to pay all charges at the prices then in effect for your purchases and any applicable shipping fees, and you authorize us to charge your chosen payment provider for any such amounts upon placing your order. We reserve the right to correct any errors or mistakes in pricing, even if we have already requested or received payment.<br><br>

                                                                            We reserve the right to refuse any order placed through the Services. We may, in our sole discretion, limit or cancel quantities purchased per person, per household, or per order. These restrictions may include orders placed by or under the same customer account, the same payment method, and/or orders that use the same billing or shipping address. We reserve the right to limit or prohibit orders that, in our sole judgment, appear to be placed by dealers, resellers, or distributors.<br><br>

                                                                            7. <b>RETURN POLICY</b><br><br>

                                                                            All sales are final, and no refund will be issued. But there is 7 days replacement for the damage product.

                                                                            8. <b>PROHIBITED ACTIVITIES</b><br><br>

                                                                            You may not access or use the Services for any purpose other than that for which we make the Services available. The Services may not be used in connection with any commercial endeavors except those that are specifically endorsed or approved by us.<br><br>

                                                                            As a user of the Services, you agree not to:
                                                                             Systematically retrieve data or other content from the Services to create or compile, directly or indirectly, a collection, compilation, database, or directory without written permission from us.
                                                                             Trick, defraud, or mislead us and other users, especially in any attempt to learn sensitive account information such as user passwords.
                                                                             Circumvent, disable, or otherwise interfere with security-related features of the Services, including features that prevent or restrict the use or copying of any Content or enforce limitations on the use of the Services and/or the Content contained therein.
                                                                             Disparage, tarnish, or otherwise harm, in our opinion, us and/or the Services.
                                                                             Use any information obtained from the Services in order to harass, abuse, or harm another person.
                                                                             Make improper use of our support services or submit false reports of abuse or misconduct.
                                                                             Use the Services in a manner inconsistent with any applicable laws or regulations.
                                                                             Engage in unauthorized framing of or linking to the Services.
                                                                             Upload or transmit (or attempt to upload or to transmit) viruses, Trojan horses, or other material, including excessive use of capital letters and spamming (continuous posting of repetitive text), that interferes with any party’s uninterrupted use and enjoyment of the Services or modifies, impairs, disrupts, alters, or interferes with the use, features, functions, operation, or maintenance of the Services.
                                                                             Engage in any automated use of the system, such as using scripts to send comments or messages, or using any data mining, robots, or similar data gathering and extraction tools.
                                                                             Delete the copyright or other proprietary rights notice from any Content.
                                                                             Attempt to impersonate another user or person or use the username of another user.
                                                                             Upload or transmit (or attempt to upload or to transmit) any material that acts as a passive or active information collection or transmission mechanism, including without limitation, clear graphics interchange formats ("gifs"), 1×1 pixels, web bugs, cookies, or other similar devices (sometimes referred to as "spyware" or "passive collection mechanisms" or "pcms").
                                                                             Interfere with, disrupt, or create an undue burden on the Services or the networks or services connected to the Services.
                                                                             Harass, annoy, intimidate, or threaten any of our employees or agents engaged in providing any portion of the Services to you.
                                                                             Attempt to bypass any measures of the Services designed to prevent or restrict access to the Services, or any portion of the Services.
                                                                             Copy or adapt the Services' software, including but not limited to Flash, PHP, HTML, JavaScript, or other code.
                                                                             Except as permitted by applicable law, decipher, decompile, disassemble, or reverse engineer any of the software comprising or in any way making up a part of the Services.
                                                                             Except as may be the result of standard search engine or Internet browser usage, use, launch, develop, or distribute any automated system, including without limitation, any spider, robot, cheat utility, scraper, or offline reader that accesses the Services, or use or launch any unauthorized script or other software.
                                                                             Use a buying agent or purchasing agent to make purchases on the Services.
                                                                             Make any unauthorized use of the Services, including collecting usernames and/or email addresses of users by electronic or other means for the purpose of sending unsolicited email, or creating user accounts by automated means or under false pretenses.
                                                                             Use the Services as part of any effort to compete with us or otherwise use the Services and/or the Content for any revenue-generating endeavor or commercial enterprise.
                                                                             Use the Services to advertise or offer to sell goods and services.<br><br>

                                                                            9. <b>USER GENERATED CONTRIBUTIONS</b><br><br>

                                                                            The Services does not offer users to submit or post content.<br><br>

                                                                            10. <b>CONTRIBUTION LICENSE</b><br><br>

                                                                            You and Services agree that we may access, store, process, and use any information and personal data that you provide following the terms of the Privacy Policy and your choices (including settings).<br><br>

                                                                            By submitting suggestions or other feedback regarding the Services, you agree that we can use and share such feedback for any purpose without compensation to you.<br><br>

                                                                            11. <b>GUIDELINES FOR REVIEWS</b><br><br>

                                                                            We may provide you areas on the Services to leave reviews or ratings. When posting a review, you must comply with the following criteria: (1) you should have firsthand experience with the person/entity being reviewed; (2) your reviews should not contain offensive profanity, or abusive, racist, offensive, or hateful language; (3) your reviews should not contain discriminatory references based on religion, race, gender, national origin, age, marital status, sexual orientation, or disability; (4) your reviews should not contain references to illegal activity; (5) you should not be affiliated with competitors if posting negative reviews; (6) you should not make any conclusions as to the legality of conduct; (7) you may not post any false or misleading statements; and (8) you may not organize a campaign encouraging others to post reviews, whether positive or negative.<br><br>

                                                                            We may accept, reject, or remove reviews in our sole discretion. We have absolutely no obligation to screen reviews or to delete reviews, even if anyone considers reviews objectionable or inaccurate. Reviews are not endorsed by us, and do not necessarily represent our opinions or the views of any of our affiliates or partners. We do not assume liability for any review or for any claims, liabilities, or losses resulting from any review. By posting a review, you hereby grant to us a perpetual, non-exclusive, worldwide, royalty-free, fully paid, assignable, and sublicensable right and license to reproduce, modify, translate, transmit by any means, display, perform, and/or distribute all content relating to review.<br><br>

                                                                            12. <b>SOCIAL MEDIA</b><br><br>


                                                                            As part of the functionality of the Services, you may link your account with online accounts you have with third-party service providers (each such account, a "Third-Party Account") by either: (1) providing your Third-Party Account login information through the Services; or (2) allowing us to access your Third-Party Account, as is permitted under the applicable terms and conditions that govern your use of each Third-Party Account. You represent and warrant that you are entitled to disclose your Third-Party Account login information to us and/or grant us access to your Third-Party Account, without breach by you of any of the terms and conditions that govern your use of the applicable Third-Party Account, and without obligating us to pay any fees or making us subject to any usage limitations imposed by the third-party service provider of the Third-Party Account. By granting us access to any Third-Party Accounts, you understand that (1) we may access, make available, and store (if applicable) any content that you have provided to and stored in your Third-Party Account (the "Social Network Content") so that it is available on and through the Services via your account, including without limitation any friend lists and (2) we may submit to and receive from your Third-Party Account additional information to the extent you are notified when you link your account with the Third-Party Account. Depending on the Third-Party Accounts you choose and subject to the privacy settings that you have set in such Third-Party Accounts, personally identifiable information that you post to your Third-Party Accounts may be available on and through your account on the Services. Please note that if a Third-Party Account or associated service becomes unavailable or our access to such Third-Party Account is terminated by the third-party service provider, then Social Network Content may no longer be available on and through the Services. You will have the ability to disable the connection between your account on the Services and your Third-Party Accounts at any time. PLEASE NOTE THAT YOUR RELATIONSHIP WITH THE THIRD-PARTY SERVICE PROVIDERS ASSOCIATED WITH YOUR THIRD-PARTY ACCOUNTS IS GOVERNED SOLELY BY YOUR AGREEMENT(S) WITH SUCH THIRD-PARTY SERVICE PROVIDERS. We make no effort to review any Social Network Content for any purpose, including but not limited to, for accuracy, legality, or non-infringement, and we are not responsible for any Social Network Content. You acknowledge and agree that we may access your email address book associated with a Third-Party Account and your contacts list stored on your mobile device or tablet computer solely for purposes of identifying and informing you of those contacts who have also registered to use the Services. You can deactivate the connection between the Services and your Third-Party Account by contacting us using the contact information below or through your account settings (if applicable). We will attempt to delete any information stored on our servers that was obtained through such Third-Party Account, except the username and profile picture that become associated with your account.<br><br>

                                                                            13. <b>SERVICES MANAGEMENT</b><br><br>

                                                                            We reserve the right, but not the obligation, to: (1) monitor the Services for violations of these Legal Terms; (2) take appropriate legal action against anyone who, in our sole discretion, violates the law or these Legal Terms, including without limitation, reporting such user to law enforcement authorities; (3) in our sole discretion and without limitation, refuse, restrict access to, limit the availability of, or disable (to the extent technologically feasible) any of your Contributions or any portion thereof; (4) in our sole discretion and without limitation, notice, or liability, to remove from the Services or otherwise disable all files and content that are excessive in size or are in any way burdensome to our systems; and (5) otherwise manage the Services in a manner designed to protect our rights and property and to facilitate the proper functioning of the Services.<br><br>

                                                                            14. <b>PRIVACY POLICY</b><br><br>

                                                                            We care about data privacy and security. Please review our Privacy Policy: __________. By using the Services, you agree to be bound by our Privacy Policy, which is incorporated into these Legal Terms. Please be advised the Services are hosted in the Philippines. If you access the Services from any other region of the world with laws or other requirements governing personal data collection, use, or disclosure that differ from applicable laws in the Philippines, then through your continued use of the Services, you are transferring your data to the Philippines, and you expressly consent to have your data transferred to and processed in the Philippines.<br><br>

                                                                            15. <b>TERM AND TERMINATION</b><br><br>

                                                                            These Legal Terms shall remain in full force and effect while you use the Services. WITHOUT LIMITING ANY OTHER PROVISION OF THESE LEGAL TERMS, WE RESERVE THE RIGHT TO, IN OUR SOLE DISCRETION AND WITHOUT NOTICE OR LIABILITY, DENY ACCESS TO AND USE OF THE SERVICES (INCLUDING BLOCKING CERTAIN IP ADDRESSES), TO ANY PERSON FOR ANY REASON OR FOR NO REASON, INCLUDING WITHOUT LIMITATION FOR BREACH OF ANY REPRESENTATION, WARRANTY, OR COVENANT CONTAINED IN THESE LEGAL TERMS OR OF ANY APPLICABLE LAW OR REGULATION. WE MAY TERMINATE YOUR USE OR PARTICIPATION IN THE SERVICES OR DELETE YOUR ACCOUNT AND ANY CONTENT OR INFORMATION THAT YOU POSTED AT ANY TIME, WITHOUT WARNING, IN OUR SOLE DISCRETION.<br><br>

                                                                            If we terminate or suspend your account for any reason, you are prohibited from registering and creating a new account under your name, a fake or borrowed name, or the name of any third party, even if you may be acting on behalf of the third party. In addition to terminating or suspending your account, we reserve the right to take appropriate legal action, including without limitation pursuing civil, criminal, and injunctive redress.<br><br>

                                                                            16. <b>MODIFICATIONS AND INTERRUPTIONS</b><br><br>

                                                                            We reserve the right to change, modify, or remove the contents of the Services at any time or for any reason at our sole discretion without notice. However, we have no obligation to update any information on our Services. We also reserve the right to modify or discontinue all or part of the Services without notice at any time. We will not be liable to you or any third party for any modification, price change, suspension, or discontinuance of the Services.<br><br>

                                                                            We cannot guarantee the Services will be available at all times. We may experience hardware, software, or other problems or need to perform maintenance related to the Services, resulting in interruptions, delays, or errors. We reserve the right to change, revise, update, suspend, discontinue, or otherwise modify the Services at any time or for any reason without notice to you. You agree that we have no liability whatsoever for any loss, damage, or inconvenience caused by your inability to access or use the Services during any downtime or discontinuance of the Services. Nothing in these Legal Terms will be construed to obligate us to maintain and support the Services or to supply any corrections, updates, or releases in connection therewith.<br><br>

                                                                            17. <b>GOVERNING LAW</b><br><br>

                                                                            These Legal Terms shall be governed by and defined following the laws of the Philippines. Silverback PH and yourself irrevocably consent that the courts of the Philippines shall have exclusive jurisdiction to resolve any dispute which may arise in connection with these Legal Terms.<br><br>

                                                                            18. <b>DISPUTE RESOLUTION</b><br><br>

                                                                            You agree to irrevocably submit all disputes related to these Legal Terms or the legal relationship established by these Legal Terms to the jurisdiction of the Philippines courts. Silverback PH shall also maintain the right to bring proceedings as to the substance of the matter in the courts of the country where you reside or, if these Legal Terms are entered into in the course of your trade or profession, the state of your principal place of business.<br><br>

                                                                            19. <b>CORRECTIONS</b><br><br>

                                                                            There may be information on the Services that contains typographical errors, inaccuracies, or omissions, including descriptions, pricing, availability, and various other information. We reserve the right to correct any errors, inaccuracies, or omissions and to change or update the information on the Services at any time, without prior notice.<br><br>

                                                                            20. <b>DISCLAIMER</b><br><br>

                                                                            THE SERVICES ARE PROVIDED ON AN AS-IS AND AS-AVAILABLE BASIS. YOU AGREE THAT YOUR USE OF THE SERVICES WILL BE AT YOUR SOLE RISK. TO THE FULLEST EXTENT PERMITTED BY LAW, WE DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, IN CONNECTION WITH THE SERVICES AND YOUR USE THEREOF, INCLUDING, WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. WE MAKE NO WARRANTIES OR REPRESENTATIONS ABOUT THE ACCURACY OR COMPLETENESS OF THE SERVICES' CONTENT OR THE CONTENT OF ANY WEBSITES OR MOBILE APPLICATIONS LINKED TO THE SERVICES AND WE WILL ASSUME NO LIABILITY OR RESPONSIBILITY FOR ANY (1) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT AND MATERIALS, (2) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF THE SERVICES, (3) ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN, (4) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM THE SERVICES, (5) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR THROUGH THE SERVICES BY ANY THIRD PARTY, AND/OR (6) ANY ERRORS OR OMISSIONS IN ANY CONTENT AND MATERIALS OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE SERVICES. WE DO NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH THE SERVICES, ANY HYPERLINKED WEBSITE, OR ANY WEBSITE OR MOBILE APPLICATION FEATURED IN ANY BANNER OR OTHER ADVERTISING, AND WE WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND ANY THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGMENT AND EXERCISE CAUTION WHERE APPROPRIATE.<br><br>

                                                                            21. <b>LIMITATIONS OF LIABILITY</b><br><br>

                                                                            IN NO EVENT WILL WE OR OUR DIRECTORS, EMPLOYEES, OR AGENTS BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY DIRECT, INDIRECT, CONSEQUENTIAL, EXEMPLARY, INCIDENTAL, SPECIAL, OR PUNITIVE DAMAGES, INCLUDING LOST PROFIT, LOST REVENUE, LOSS OF DATA, OR OTHER DAMAGES ARISING FROM YOUR USE OF THE SERVICES, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.<br><br>

                                                                            22. <b>INDEMNIFICATION</b><br><br>

                                                                            You agree to defend, indemnify, and hold us harmless, including our subsidiaries, affiliates, and all of our respective officers, agents, partners, and employees, from and against any loss, damage, liability, claim, or demand, including reasonable attorneys’ fees and expenses, made by any third party due to or arising out of: (1) use of the Services; (2) breach of these Legal Terms; (3) any breach of your representations and warranties set forth in these Legal Terms; (4) your violation of the rights of a third party, including but not limited to intellectual property rights; or (5) any overt harmful act toward any other user of the Services with whom you connected via the Services. Notwithstanding the foregoing, we reserve the right, at your expense, to assume the exclusive defense and control of any matter for which you are required to indemnify us, and you agree to cooperate, at your expense, with our defense of such claims. We will use reasonable efforts to notify you of any such claim, action, or proceeding which is subject to this indemnification upon becoming aware of it.<br><br>

                                                                            23. <b>USER DATA</b><br><br>

                                                                            We will maintain certain data that you transmit to the Services for the purpose of managing the performance of the Services, as well as data relating to your use of the Services. Although we perform regular routine backups of data, you are solely responsible for all data that you transmit or that relates to any activity you have undertaken using the Services. You agree that we shall have no liability to you for any loss or corruption of any such data, and you hereby waive any right of action against us arising from any such loss or corruption of such data.<br><br>

                                                                            24. <b>ELECTRONIC COMMUNICATIONS, TRANSACTIONS, AND SIGNATURES</b><br><br>

                                                                            Visiting the Services, sending us emails, and completing online forms constitute electronic communications. You consent to receive electronic communications, and you agree that all agreements, notices, disclosures, and other communications we provide to you electronically, via email and on the Services, satisfy any legal requirement that such communication be in writing. YOU HEREBY AGREE TO THE USE OF ELECTRONIC SIGNATURES, CONTRACTS, ORDERS, AND OTHER RECORDS, AND TO ELECTRONIC DELIVERY OF NOTICES, POLICIES, AND RECORDS OF TRANSACTIONS INITIATED OR COMPLETED BY US OR VIA THE SERVICES. You hereby waive any rights or requirements under any statutes, regulations, rules, ordinances, or other laws in any jurisdiction which require an original signature or delivery or retention of non-electronic records, or to payments or the granting of credits by any means other than electronic means.<br><br>

                                                                            25. <b>MISCELLANEOUS</b><br><br>

                                                                            These Legal Terms and any policies or operating rules posted by us on the Services or in respect to the Services constitute the entire agreement and understanding between you and us. Our failure to exercise or enforce any right or provision of these Legal Terms shall not operate as a waiver of such right or provision. These Legal Terms operate to the fullest extent permissible by law. We may assign any or all of our rights and obligations to others at any time. We shall not be responsible or liable for any loss, damage, delay, or failure to act caused by any cause beyond our reasonable control. If any provision or part of a provision of these Legal Terms is determined to be unlawful, void, or unenforceable, that provision or part of the provision is deemed severable from these Legal Terms and does not affect the validity and enforceability of any remaining provisions. There is no joint venture, partnership, employment or agency relationship created between you and us as a result of these Legal Terms or use of the Services. You agree that these Legal Terms will not be construed against us by virtue of having drafted them. You hereby waive any and all defenses you may have based on the electronic form of these Legal Terms and the lack of signing by the parties hereto to execute these Legal Terms.<br><br>

                                                                            26. <b>CONTACT US</b><br><br>

                                                                            In order to resolve a complaint regarding the Services or to receive further information regarding use of the Services, please contact us at:<br><br>

                                                                            Silverback PH
                                                                            Amparo
                                                                            Caloocan 1425
                                                                            Philippines
                                                                            silverbackthegreat.ph@gmail.com
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 ms-5">
                                                        <input type="checkbox" name="agree" id="agree" required>
                                                        <label for="agree">I understand and agree to the</label>&nbsp;<a href="#policy" data-bs-target="#policy" data-bs-toggle="modal">Terms and Agreement.</a>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-5">
                                        <h5>Order Details</h5>
                                        <hr>
                                        <?php
                                        $total = 0;
                                        $q = 0;
                                        $item = getCart();
                                        foreach ($item as $cart => $res) {
                                        ?>
                                            <div class="mb-1 border">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <img src="../admin/images/<?php echo $res['prod_image']; ?>" alt="Images" style="width: 120px; height: 120px;" />
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label><?php echo $res['prod_name']; ?></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label>₱ <?php echo number_format($res['prod_price'], 2); ?></label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>* <?php echo $res['cart_qty']; ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                            $total += $res['prod_price'] * $res['cart_qty'];
                                            $q += $res['cart_qty'];
                                        }
                                        ?>
                                        <hr>
                                        <small>Quantity: <span class="float-end"> <?= $q ?></small><br>
                                        <!--<small>Shipping Fee: <span class="float-end"> </small><br>-->
                                        <hr>
                                        <h5>Total Price : <span class="float-end fw-bold">₱ <?= number_format($total, 2) ?></span></h5>
                                        <div class="">
                                            <input type="hidden" name="payment_mode" value="COD">
                                            <button type="submit" name="placeOrder" class="btn btn-success w-100 mt-1"><i class="fa-solid fa-sack"></i> Cash On Delivery</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                        <p>Silverback Gaming and Office Chairs Online Web Page Ⓒ 2022 - <?= date('Y') ?>. Allright Reserved.</p>
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
    <script type="text/javascript" src="../assets/js/script.js"></script>
    <!-- End Script Section-->

    <!-- Script for Payment Mode -->

</body>

</html>