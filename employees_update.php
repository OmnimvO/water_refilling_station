<?php
// Include database connection file
require_once "db.php";
include("auth_session.php");

// Check if form is submitted
if (isset($_POST['save'])) {
    // Update employee information
    $employee_Id = $_POST['employee_Id'];
    $employee_Name = mysqli_real_escape_string($conn, $_POST['employee_Name']);

    mysqli_query($conn, "UPDATE employees SET employee_Name='$employee_Name' WHERE employee_Id='$employee_Id'");
    
    // Alert for successful update
    echo '<script>alert("Employee information updated successfully")</script>';

    // Redirect to dashboard after updating
    echo "<script>window.location.href ='dashboard.php'</script>";
    exit();
}

// Fetch employee data from database
if (isset($_GET['id'])) {
    $employee_Id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM employees WHERE employee_Id='$employee_Id'");
    $row = mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Update Employee | WRS Employee Management System</title>
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
                <h2>UPDATE EMPLOYEE</h2>
            </div>

            <!-- Update Employee Form -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="employee_Name">Employee Name:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="employee_Name" name="employee_Name" value="<?php echo htmlspecialchars($row['employee_Name']); ?>" required>
                                </div>
                                <input type="hidden" name="employee_Id" value="<?php echo htmlspecialchars($row['employee_Id']); ?>"/>
                                <input type="submit" class="btn btn-primary" name="save" value="Update">
                                <a href="employees.php" class="btn btn-danger">Cancel</a>
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

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>
</body>

</html>