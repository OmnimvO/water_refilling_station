<?php
include_once 'db.php'; // Assuming db.php contains the database connection logic

if(isset($_GET["id"])) {
    $customer_Id = $_GET["id"];
    
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        // If confirmed, proceed with deletion
        $sql = "DELETE FROM customers WHERE customer_Id=$customer_Id";

        if (mysqli_query($conn, $sql)) {
            // Deletion successful
            mysqli_close($conn);
            header("Location: dashboard.php"); // Redirect to dashboard after deletion
            exit();
        } else {
            // Error occurred during deletion
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Confirmation dialog
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
