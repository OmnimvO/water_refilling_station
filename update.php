<?php
// Include database connection file
require_once "db.php";
include("auth_session.php");

// Check if form is submitted
if (isset($_POST['save'])) {
    // Update student information
    $customer_Id = $_POST['customer_Id'];
    $customer_Name = mysqli_real_escape_string($conn, $_POST['customer_Name']);
    $customer_Contact = mysqli_real_escape_string($conn, $_POST['customer_Contact']);
    $shipping_Address = mysqli_real_escape_string($conn, $_POST['shipping_Address']);

    mysqli_query($conn, "UPDATE customers SET customer_Name='$customer_Name', customer_Contact='$customer_Contact', shipping_Address='$shipping_Address' WHERE customer_Id='$customer_Id'");
    
    // Alert for successful update
    echo '<script>alert("Customer information updated successfully")</script>';

    // Redirect to dashboard after updating
    echo "<script>window.location.href ='dashboard.php'</script>";
    exit();
}

// Fetch student data from database
if (isset($_GET['id'])) {
    $customer_Id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM customers WHERE customer_Id='$customer_Id'");
    $row = mysqli_fetch_array($result);
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

    <!-- Custom Css -->
    <link href="includes/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="includes/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <?php include("nav.php"); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>UPDATE CUSTOMER</h2>
            </div>

            <!-- Update Student Form -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="customer_Name">Full Name:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="customer_Name" name="customer_Name" value="<?php echo $row["customer_Name"]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer_Contact">Contact Number:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="customer_Contact" name="customer_Contact" value="<?php echo $row["customer_Contact"]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="shipping_Address">Shipping Address:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="shipping_Address" name="shipping_Address" value="<?php echo $row["shipping_Address"]; ?>" required>
                                </div>
                                <input type="hidden" name="customer_Id" value="<?php echo $row["customer_Id"]; ?>"/>
                                <input type="submit" class="btn btn-primary" name="save" value="Update">
                                <a href="dashboard.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="includes/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="includes/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="includes/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="includes/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="includes/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

    <!-- DataTables Export Plugin Js -->
    <script src="includes/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>
    <script src="includes/js/pages/tables/jquery-datatable.js"></script>

</body>

</html>
