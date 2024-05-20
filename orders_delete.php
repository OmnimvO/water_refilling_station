<?php
include_once 'db.php'; // Assuming db.php contains the database connection logic

if(isset($_GET["id"])) {
    $order_Id = $_GET["id"];
    
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        // If confirmed, proceed with deletion
        $sql = "DELETE FROM orders WHERE order_Id=$order_Id";

        if (mysqli_query($conn, $sql)) {
            // Deletion successful
            mysqli_close($conn);
            header("Location: orders.php"); // Redirect to dashboard after deletion
            exit();
        } else {
            // Error occurred during deletion
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Confirmation dialog
        echo '<script>
            if (confirm("Are you sure you want to delete this order?")) {
                window.location.href = "orders_delete.php?id=' . $order_Id . '&confirmed=true";
            } else {
                window.location.href = "orders.php";
            }
        </script>';
    }
}
?>