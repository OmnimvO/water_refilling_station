<?php
include_once 'db.php'; 

if(isset($_GET["id"])) {
    $customer_Id = $_GET["id"];
    
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {

        $sql = "DELETE FROM customers WHERE customer_Id=$customer_Id";

        if (mysqli_query($conn, $sql)) {

            mysqli_close($conn);
            header("Location: dashboard.php"); 
            exit();
        } else {

            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {

        echo '<script>
            if (confirm("Are you sure you want to delete this customer?")) {
                window.location.href = "delete.php?id=' . $customer_Id . '&confirmed=true";
            } else {
                window.location.href = "dashboard.php";
            }
        </script>';
    }
}
?>
