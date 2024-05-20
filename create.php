<?php
require_once "db.php";
include("auth_session.php");

if(isset($_POST['save'])) {    
    $customer_Name = $_POST['customer_Name'];
    $customer_Contact = $_POST['customer_Contact'];
    $shipping_Address = $_POST['shipping_Address'];

    $sql = "INSERT INTO customers (customer_Name, customer_Contact, shipping_Address)
            VALUES ('$customer_Name', '$customer_Contact', '$shipping_Address')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Customer has been added.")</script>';
        echo "<script>window.location.href ='dashboard.php'</script>";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>3 ACES DEWDROPS</title>
    <!-- Favicon-->
    <link rel="icon" href="includes/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="includes/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="includes/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="includes/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="includes/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="includes/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="includes/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
<?php include ("nav.php");   ?>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>3 ACES DEWDROPS ORDER TRACKING SYSTEM</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CREATE CUSTOMER INFORMATION
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                
                                <label for="customer_Name">Full Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="customer_Name" class="form-control" maxlength="50" placeholder="Enter your Name" name="customer_Name">
                                    </div>
                                </div>
                                <label for="customer_Contact">Contact Number</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" id="customer_Contact" class="form-control" maxlength="50" placeholder="Enter your contact number" name="customer_Contact">
                                    </div>
                                </div>
                                <label for="shipping_Address">Shipping Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" id="shipping_Address" class="form-control" maxlength="50" placeholder="Enter your address" name="shipping_Address">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="save" value="Submit">
                                <a href="dashboard.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="includes/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="includes/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="includes/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="includes/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="includes/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="includes/js/demo.js"></script>
</body>

</html>
