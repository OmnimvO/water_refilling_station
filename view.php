<?php

include("auth_session.php");


include_once 'db.php';


if (isset($_GET['id'])) {
    
    $customer_Id = mysqli_real_escape_string($conn, $_GET['id']);

    
    $resultCustomers = mysqli_query($conn, "SELECT * FROM customers WHERE customer_Id = $customer_Id");

    
    if (!$resultCustomers) {
       
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    
    if (mysqli_num_rows($resultCustomers) == 1) {
        $row = mysqli_fetch_assoc($resultCustomers);
    } else {
       
        echo "<p>Customer not found</p>";
        exit();
    }
} else {
   
    echo "<p>Customer ID not provided</p>";
    exit();
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
                <h2>3 ACES DEWDROPS ORDER TRACKING SYSTEM</h2>
            </div>
          
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Customer Details</h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Customer ID</th>
                                        <td><?php echo htmlspecialchars($row["customer_Id"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Full Name</th>
                                        <td><?php echo htmlspecialchars($row["customer_Name"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number</th>
                                        <td><?php echo htmlspecialchars($row["customer_Contact"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Shipping Address</th>
                                        <td><?php echo htmlspecialchars($row["shipping_Address"]); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button onclick="window.location.href='dashboard.php'" class="btn btn-primary">Back to Dashboard</button>
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

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="includes/js/demo.js"></script>
</body>
</html>
