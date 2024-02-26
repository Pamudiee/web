<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> API Flora Online Flower Shop</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="css/vendor/font.awesome.min.css">
    <link rel="stylesheet" href="css/vendor/linearicons.min.css">
    <link rel="stylesheet" href="css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/plugins/animate.min.css">
    <link rel="stylesheet" href="css/plugins/jquery-ui.min.css">
    <link rel="stylesheet" href="css/plugins/nice-select.min.css">
    <link rel="stylesheet" href="css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
   
<?php @include 'header.php'; ?>

<!-- Breadcrumb Area Start Here -->
<div class="breadcrumbs-area position-relative">
        <div class="container"> 
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h1>MY  ACCOUNT</h1>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                            <li style="color:red;">My account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Breadcrumb Area End Here -->

<!-- my account wrapper start -->
<div class="my-account-wrapper mt-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-custom">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboad" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                    <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                                    <a href="login.php"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8 col-custom">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Dashboard</h3>
                                            <div class="welcome">
                                                <p>Hello, <strong><?php echo $_SESSION['user_name']; ?></strong></p>
                                            </div>
                                            <p class="mb-0">From your account dashboard, you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
                                                            if(mysqli_num_rows($select_orders) > 0){
                                                                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                                                        ?>

                                                        <tr>
                                                            <td>1</td>
                                                            <td><?php echo $fetch_orders['placed_on']; ?></td>
                                                            <td><span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){echo 'tomato'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span> </td>
                                                            <td>Rs.<?php echo $fetch_orders['total_price']; ?>/=</td>
                                                        </tr>

                                                        <?php
                                                                }
                                                            }else{
                                                                echo '<p class="empty">no orders placed yet!</p>';
                                                            }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Account Details</h3>
                                            <div class="account-details-form">

                                                <form action="#">
                                                    <div class="row">
                                                        
                                                        <div class="col-lg-6 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="first-name" class="required mb-1">Name</label>
                                                                <input type="text" id="name" placeholder="Name"> </input>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="single-input-item mb-3">
                                                        <label for="email" class="required mb-1">Email Addres</label>
                                                        <input type="email" id="email" placeholder="Email Address" />
                                                    </div>

                                                    <fieldset> 
                                                    
                                                        <legend>Password change</legend>
                                                        <div class="single-input-item mb-3">
                                                            <label for="current-pwd" class="required mb-1">Current Password</label>
                                                            <input type="password" id="current-pwd" placeholder="Current Password" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-custom">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="new-pwd" class="required mb-1">New Password</label>
                                                                    <input type="password" id="new-pwd" placeholder="New Password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-custom">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="confirm-pwd" class="required mb-1">Confirm Password</label>
                                                                    <input type="password" id="confirm-pwd" placeholder="Confirm Password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                    <div class="single-input-item single-item-button">
                                                        <button class="btn flower-button secondary-btn theme-color  rounded-0">Save Changes</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- Single Tab Content End -->
                                </div>
                            </div> 
                            <!-- My Account Tab Content End -->
                        </div>
                    </div> 
                    <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->


<?php @include 'footer.php'; ?>

<a class="scroll-to-top" href="#">
    <i class="lnr lnr-arrow-up"></i>
</a>

<script src="js/vendor/jquery-3.6.0.min.js"></script>
<script src="js/vendor/jquery-migrate-3.3.2.min.js"></script>
<script src="js/vendor/modernizr-3.7.1.min.js"></script>
<script src="js/vendor/bootstrap.bundle.min.js"></script>
<script src="js/plugins/swiper-bundle.min.js"></script>
<script src="js/plugins/nice-select.min.js"></script>
<script src="js/plugins/jquery.ajaxchimp.min.js"></script>
<script src="js/plugins/jquery-ui.min.js"></script>
<script src="js/plugins/jquery.countdown.min.js"></script>
<script src="js/plugins/jquery.magnific-popup.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>