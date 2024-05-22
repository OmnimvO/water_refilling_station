<?php

include("auth_session.php");
include_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_Id = $_POST['customer_Id'];
    $product_Id = $_POST['product_Id'];
    $employee_Id = $_POST['employee_Id'];
    $order_Date = $_POST['order_Date'];
    $order_Status = $_POST['order_Status'];
    $product_Quantity = $_POST['product_Quantity'];

    $sql = "INSERT INTO orders (customer_Id, product_Id, employee_Id, order_Date, order_Status, product_Quantity) VALUES ('$customer_Id', '$product_Id', '$employee_Id', '$order_Date', '$order_Status', '$product_Quantity')";
    if (mysqli_query($conn, $sql)) {
        echo "Records added successfully.";
        echo "<script>window.location.href ='orders.php'</script>";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
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

    <!-- Bootstrap Select Css -->
    <link href="includes/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

</head>

<body class="theme-red">
    <?php include("nav.php"); ?>

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
                                CREATE NEW ORDER
                            </h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                
                                <label for="customer_Id">Customer</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="customer_Id" class="form-control show-tick" name="customer_Id" required>
                                            <option value="">-- Please select a customer --</option>
                                            <?php
                                            $resultCustomer = mysqli_query($conn, "SELECT customer_Id, CONCAT(customer_fName, ' ', customer_lName) AS customer_Name FROM customers");
                                            while ($row = mysqli_fetch_assoc($resultCustomer)) {
                                                echo "<option value='" . $row['customer_Id'] . "'>" . $row['customer_Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <br>

                                <label for="product_Id">Product</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="product_Id" class="form-control show-tick" name="product_Id" required>
                                            <option value="">-- Please select a product --</option>
                                            <?php
                                            $resultProduct = mysqli_query($conn, "SELECT product_Id, product_Name FROM products");
                                            while ($row = mysqli_fetch_assoc($resultProduct)) {
                                                echo "<option value='" . $row['product_Id'] . "'>" . $row['product_Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <br>

                                <label for="employee_Id">Employee</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="employee_Id" class="form-control show-tick" name="employee_Id" required>
                                            <option value="">-- Please select an employee --</option>
                                            <?php
                                            $resultEmployee = mysqli_query($conn, "SELECT employee_Id, CONCAT(employee_fName, ' ', employee_lName) AS employee_Name FROM employees");
                                            while ($row = mysqli_fetch_assoc($resultEmployee)) {
                                                echo "<option value='" . $row['employee_Id'] . "'>" . $row['employee_Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <br>

                                <label for="order_Date">Order Date</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" id="order_Date" class="form-control" name="order_Date" required>
                                    </div>
                                </div>

                                <label for="order_Status">Order Status</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="order_Status" class="form-control show-tick" name="order_Status" required>
                                            <option value="">-- Please select a status --</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                    </div>
                                </div>

                                <br>

                                <label for="product_Quantity">Product Quantity</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="product_Quantity" class="form-control" name="product_Quantity" min="1" required>
                                    </div>
                                </div>
                               
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="save" value="Submit">
                                <a href="orders.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
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

