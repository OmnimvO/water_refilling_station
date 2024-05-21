<?php

require_once "db.php";
include("auth_session.php");


if (isset($_POST['save'])) {
   
    $product_Id = $_POST['product_Id'];
    $product_Name = mysqli_real_escape_string($conn, $_POST['product_Name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    mysqli_query($conn, "UPDATE products SET product_Name='$product_Name', price='$price' WHERE product_Id='$product_Id'");
    
    
    echo '<script>alert("Product information updated successfully")</script>';

    
    echo "<script>window.location.href ='products.php'</script>";
    exit();
}


if (isset($_GET['id'])) {
    $product_Id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM products WHERE product_Id='$product_Id'");
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
                <h2>UPDATE Product</h2>
            </div>

           
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="product_Name">Product Name:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="product_Name" name="product_Name" value="<?php echo $row["product_Name"]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="price" name="price" value="<?php echo $row["price"]; ?>" required>
                                </div>
                                <input type="hidden" name="product_Id" value="<?php echo $row["product_Id"]; ?>"/>
                                <input type="submit" class="btn btn-primary" name="save" value="Update">
                                <a href="products.php" class="btn btn-danger">Cancel</a>
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
