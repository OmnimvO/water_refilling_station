<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
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

    <!-- JQuery DataTable Css -->
    <link href="includes/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Export Css -->
    <link href="includes/plugins/jquery-datatable/extensions/export/buttons.dataTables.min.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="includes/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="includes/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red" style="background-color: #f1f1f1;">
    <?php include("nav.php"); ?>

    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ORDERS
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="orders_create.php" class="btn btn-primary float-right">Add New Order</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <?php
                                include_once 'db.php';

                                
                                $resultOrders = mysqli_query($conn, "
                                    SELECT 
                                        o.order_Id, 
                                        c.customer_Name, 
                                        p.product_Name, 
                                        e.employee_Name, 
                                        o.order_Date, 
                                        o.order_Status, 
                                        o.product_Quantity 
                                    FROM 
                                        orders o
                                    LEFT JOIN 
                                        customers c ON o.customer_Id = c.customer_Id
                                    LEFT JOIN 
                                        products p ON o.product_Id = p.product_Id
                                    LEFT JOIN 
                                        employees e ON o.employee_Id = e.employee_Id
                                ");
                                ?>
                                <?php
                                if (mysqli_num_rows($resultOrders) > 0) {
                                ?>
                                    <table class="table table-bordered table-striped table-hover js-basic-example">
                                        <thead>
                                            <tr>    
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Employee Name</th>
                                                <th>Order Date</th>
                                                <th>Order Status</th>
                                                <th>Quantity</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($resultOrders)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row["order_Id"]; ?></td>
                                                    <td><?php echo $row["customer_Name"]; ?></td>
                                                    <td><?php echo $row["product_Name"]; ?></td>
                                                    <td><?php echo $row["employee_Name"]; ?></td>
                                                    <td><?php echo $row["order_Date"]; ?></td>
                                                    <td><?php echo $row["order_Status"]; ?></td>
                                                    <td><?php echo $row["product_Quantity"]; ?></td>
                                                    <td>
                                                        <a href="orders_view.php?id=<?php echo $row["order_Id"]; ?>" class="btn btn-primary" title='View Record'>View</a>
                                                        <a href="orders_update.php?id=<?php echo $row["order_Id"]; ?>" class="btn btn-success" title='Update Record'>Update</a>
                                                        <a href="orders_delete.php?id=<?php echo $row["order_Id"]; ?>" class="btn btn-danger" title='Delete Record'>Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else {
                                    echo "No result found for orders";
                                }
                                ?>
                            </div>
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
