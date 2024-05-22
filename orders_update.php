<?php
include("auth_session.php");

include_once 'db.php';

$customer_Id = $product_Id = $employee_Id = $order_Date = $order_Status = $product_Quantity = "";
$customer_Id_err = $product_Id_err = $employee_Id_err = $order_Date_err = $order_Status_err = $product_Quantity_err = "";

if (isset($_GET['id'])) {
    $order_Id = mysqli_real_escape_string($conn, $_GET['id']);

    $resultOrders = mysqli_query($conn, "SELECT * FROM orders WHERE order_Id = $order_Id");

    if (!$resultOrders) {
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    if (mysqli_num_rows($resultOrders) == 1) {
        $row = mysqli_fetch_assoc($resultOrders);
        $customer_Id = $row['customer_Id'];
        $product_Id = $row['product_Id'];
        $employee_Id = $row['employee_Id'];
        $order_Date = $row['order_Date'];
        $order_Status = $row['order_Status'];
        $product_Quantity = $row['product_Quantity'];
    } else {
        echo "<p>Order not found</p>";
        exit();
    }
} else {
    echo "<p>Order ID not provided</p>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["customer_Id"]))) {
        $customer_Id_err = "Please select a customer.";
    } else {
        $customer_Id = trim($_POST["customer_Id"]);
    }

    if (empty(trim($_POST["product_Id"]))) {
        $product_Id_err = "Please select a product.";
    } else {
        $product_Id = trim($_POST["product_Id"]);
    }

    if (empty(trim($_POST["employee_Id"]))) {
        $employee_Id_err = "Please select an employee.";
    } else {
        $employee_Id = trim($_POST["employee_Id"]);
    }

    if (empty(trim($_POST["order_Date"]))) {
        $order_Date_err = "Please enter an order date.";
    } else {
        $order_Date = trim($_POST["order_Date"]);
    }

    if (empty(trim($_POST["order_Status"]))) {
        $order_Status_err = "Please select the order status.";
    } else {
        $order_Status = trim($_POST["order_Status"]);
    }

    if (empty(trim($_POST["product_Quantity"]))) {
        $product_Quantity_err = "Please enter the quantity.";
    } else {
        $product_Quantity = trim($_POST["product_Quantity"]);
    }

    if (empty($customer_Id_err) && empty($product_Id_err) && empty($employee_Id_err) && empty($order_Date_err) && empty($order_Status_err) && empty($product_Quantity_err)) {

        $sql = "UPDATE orders SET customer_Id = ?, product_Id = ?, employee_Id = ?, order_Date = ?, order_Status = ?, product_Quantity = ? WHERE order_Id = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "iiissii", $param_customer_Id, $param_product_Id, $param_employee_Id, $param_order_Date, $param_order_Status, $param_product_Quantity, $param_order_Id);

            $param_customer_Id = $customer_Id;
            $param_product_Id = $product_Id;
            $param_employee_Id = $employee_Id;
            $param_order_Date = $order_Date;
            $param_order_Status = $order_Status;
            $param_product_Quantity = $product_Quantity;
            $param_order_Id = $order_Id;

            if (mysqli_stmt_execute($stmt)) {
                header("location: orders.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
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
<?php include ("nav.php"); ?>

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
                        <h2>UPDATE ORDER</h2>
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
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $order_Id; ?>" method="post">

                            <label for="customer_Id">Customer</label>
                            <div class="form-group <?php echo (!empty($customer_Id_err)) ? 'has-error' : ''; ?>">
                                <div class="form-line">
                                    <select id="customer_Id" class="form-control" name="customer_Id">
                                        <option value="">Select Customer</option>
                                        <?php
                                            $result = mysqli_query($conn, "SELECT customer_Id, CONCAT(customer_fName, ' ', customer_lName) AS customer_Name FROM customers");
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $selected = ($row['customer_Id'] == $customer_Id) ? 'selected' : '';
                                                echo '<option value="' . $row['customer_Id'] . '" ' . $selected . '>' . $row['customer_Name'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <span class="help-block"><?php echo $customer_Id_err; ?></span>
                            </div>

                            <label for="product_Id">Product</label>
                            <div class="form-group <?php echo (!empty($product_Id_err)) ? 'has-error' : ''; ?>">
                                <div class="form-line">
                                    <select id="product_Id" class="form-control" name="product_Id">
                                        <option value="">Select Product</option>
                                        <?php
                                            $result = mysqli_query($conn, "SELECT product_Id, product_Name FROM products");
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $selected = ($row['product_Id'] == $product_Id) ? 'selected' : '';
                                                echo '<option value="' . $row['product_Id'] . '" ' . $selected . '>' . $row['product_Name'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <span class="help-block"><?php echo $product_Id_err; ?></span>
                            </div>

                            <label for="employee_Id">Employee</label>
                            <div class="form-group <?php echo (!empty($employee_Id_err)) ? 'has-error' : ''; ?>">
                                <div class="form-line">
                                    <select id="employee_Id" class="form-control" name="employee_Id">
                                        <option value="">Select Employee</option>
                                        <?php
                                            $result = mysqli_query($conn, "SELECT employee_Id, CONCAT(employee_fName, ' ', employee_lName) AS employee_Name FROM employees");
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $selected = ($row['employee_Id'] == $employee_Id) ? 'selected' : '';
                                                echo '<option value="' . $row['employee_Id'] . '" ' . $selected . '>' . $row['employee_Name'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <span class="help-block"><?php echo $employee_Id_err; ?></span>
                            </div>

                            <label for="order_Date">Order Date</label>
                            <div class="form-group <?php echo (!empty($order_Date_err)) ? 'has-error' : ''; ?>">
                                <div class="form-line">
                                    <input type="date" id="order_Date" class="form-control" name="order_Date" value="<?php echo $order_Date; ?>">
                                </div>
                                <span class="help-block"><?php echo $order_Date_err; ?></span>
                            </div>

                            <label for="order_Status">Status</label>
                            <div class="form-group <?php echo (!empty($order_Status_err)) ? 'has-error' : ''; ?>">
                                <div class="form-line">
                                    <select id="order_Status" class="form-control" name="order_Status">
                                        <option value="">Select Status</option>
                                        <option value="Pending" <?php echo ($order_Status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="Delivered" <?php echo ($order_Status == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
                                    </select>
                                </div>
                                <span class="help-block"><?php echo $order_Status_err; ?></span>
                            </div>

                            <label for="product_Quantity">Quantity</label>
                            <div class="form-group <?php echo (!empty($product_Quantity_err)) ? 'has-error' : ''; ?>">
                                <div class="form-line">
                                    <input type="number" id="product_Quantity" class="form-control" name="product_Quantity" value="<?php echo $product_Quantity; ?>">
                                </div>
                                <span class="help-block"><?php echo $product_Quantity_err; ?></span>
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
