<?php
require_once "db.php";
include("auth_session.php");

if (isset($_POST['save'])) {
    $customer_Id = $_POST['customer_Id'];
    $customer_fName = mysqli_real_escape_string($conn, $_POST['customer_fName']);
    $customer_lName = mysqli_real_escape_string($conn, $_POST['customer_lName']);
    $customer_Contact = mysqli_real_escape_string($conn, $_POST['customer_Contact']);
    $house_Number = mysqli_real_escape_string($conn, $_POST['house_Number']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $barangay = mysqli_real_escape_string($conn, $_POST['barangay']);

    $sql = "UPDATE customers 
            SET customer_fName='$customer_fName', 
                customer_lName='$customer_lName', 
                customer_Contact='$customer_Contact', 
                house_Number='$house_Number', 
                street='$street', 
                barangay='$barangay' 
            WHERE customer_Id='$customer_Id'";

    mysqli_query($conn, $sql);

    echo '<script>alert("Customer information updated successfully")</script>';
    echo "<script>window.location.href ='dashboard.php'</script>";
    exit();
}

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
    <link rel="icon" href="includes/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="includes/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="includes/plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="includes/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="includes/css/style.css" rel="stylesheet">
    <link href="includes/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <?php include("nav.php"); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>UPDATE CUSTOMER</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="customer_fName">First Name:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="customer_fName" name="customer_fName" value="<?php echo $row['customer_fName']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer_lName">Last Name:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="customer_lName" name="customer_lName" value="<?php echo $row['customer_lName']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer_Contact">Contact Number:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="customer_Contact" name="customer_Contact" value="<?php echo $row['customer_Contact']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="house_Number">House Number:</label>
                                    <input style="border: 1px solid #eee;" type="number" class="form-control" id="house_Number" name="house_Number" value="<?php echo $row['house_Number']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="street">Street:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="street" name="street" value="<?php echo $row['street']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="barangay">Barangay:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="barangay" name="barangay" value="<?php echo $row['barangay']; ?>" required>
                                </div>
                                <input type="hidden" name="customer_Id" value="<?php echo $row['customer_Id']; ?>"/>
                                <input type="submit" class="btn btn-primary" name="save" value="Update">
                                <a href="dashboard.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="includes/plugins/jquery/jquery.min.js"></script>
    <script src="includes/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="includes/plugins/node-waves/waves.js"></script>
    <script src="includes/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="includes/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script src="includes/js/admin.js"></script>
    <script src="includes/js/pages/tables/jquery-datatable.js"></script>
</body>
</html>
