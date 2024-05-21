<?php
include_once 'db.php'; 

if(isset($_GET["id"])) {
    $product_Id = $_GET["id"];
    
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        
        $sql = "DELETE FROM products WHERE product_Id=$product_Id";

        if (mysqli_query($conn, $sql)) {
            
            mysqli_close($conn);
            header("Location: products.php"); 
            exit();
        } else {
            
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        
        echo '<script>
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = "products_delete.php?id=' . $product_Id . '&confirmed=true";
            } else {
                window.location.href = "products.php";
            }
        </script>';
    }
}
?>
