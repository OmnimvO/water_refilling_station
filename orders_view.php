<?php

include("auth_session.php");


include_once 'db.php';


if (isset($_GET['id'])) {
    
    $order_Id = mysqli_real_escape_string($conn, $_GET['id']);

    
    $query = "
    SELECT 
        orders.order_Id, 
        customers.customer_Name, 
        products.product_Name, 
        employees.employee_Name, 
        orders.order_Date, 
        orders.order_Status, 
        orders.product_Quantity 
    FROM 
        orders
    LEFT JOIN 
        customers ON orders.customer_Id = customers.customer_Id
    LEFT JOIN 
        products ON orders.product_Id = products.product_Id
    LEFT JOIN 
        employees ON orders.employee_Id = employees.employee_Id
    WHERE 
        orders.order_Id = $order_Id

    ";
    $resultOrders = mysqli_query($conn, $query);

    
    if (!$resultOrders) {
        
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    
    if (mysqli_num_rows($resultOrders) == 1) {
        $row = mysqli_fetch_assoc($resultOrders);
    } else {
        
        echo "<p>Order not found</p>";
        exit();
    }
} else {
    
    echo "<p>Order ID not provided</p>";
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
            <!-- View Order Details -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Order Details</h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Order ID</th>
                                        <td><?php echo htmlspecialchars($row["order_Id"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Customer</th>
                                        <td><?php echo htmlspecialchars($row["customer_Name"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <td><?php echo htmlspecialchars($row["product_Name"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Employee</th>
                                        <td><?php echo htmlspecialchars($row["employee_Name"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td><?php echo htmlspecialchars($row["order_Date"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><?php echo htmlspecialchars($row["order_Status"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td><?php echo htmlspecialchars($row["product_Quantity"]); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button onclick="window.location.href='orders.php'" class="btn btn-primary">Back</button>
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
