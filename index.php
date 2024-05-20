<?php
    require('db.php'); 
    session_start(); 

    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);   
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($conn, $query) or die(mysqli_connect_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username; 
            echo '<script>alert("Welcome Admin!")</script>';
            echo "<script>window.location.href ='dashboard.php'</script>";
        } else {
            echo '<script>alert("Incorrect Username/password.")</script>';
            echo "<script>window.location.href ='index.php'</script>";
        }
    } else {
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | 3 Aces Dewdrops</title>
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
</head>

<body class="login-page" style="background-image: url('img/wallpaper.png'); background-size: cover; background-repeat: no-repeat; margin-right: 60%; ">

<br>
<br>

    <div class="login-box">
        <div class="flex text-dark align-center">
           <h1>Sign in</h1>
           <br>
        </div>
        <div class="card" >
            <div class="body">
                <form id="sign_in" class="form" method="post" name="login">
                    <div class="msg">Login with your personal information</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <button class="btn btn-block bg-blue waves-effect" name="submit"  type="submit">SIGN IN</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="registration.php">Not registered? <b>Create an account</b></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    }
?>
    <!-- Jquery Core Js -->
    <script src="includes/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="includes/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="includes/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="includes/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>
    <script src="includes/js/pages/examples/sign-in.js"></script>
</body>

</html>