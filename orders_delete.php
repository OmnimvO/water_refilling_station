<?php
include_once 'db.php'; 

if(isset($_GET["id"])) {
    $order_Id = $_GET["id"];
    
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        
        $sql = "DELETE FROM orders WHERE order_Id=$order_Id";

        if (mysqli_query($conn, $sql)) {
            
            mysqli_close($conn);
            header("Location: orders.php"); 
            exit();
        } else {
            
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        
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