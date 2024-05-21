<?php
include_once 'db.php'; 

if(isset($_GET["id"])) {
    $employee_Id = $_GET["id"];
    
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {

        $sql = "DELETE FROM employees WHERE employee_Id=$employee_Id";

        if (mysqli_query($conn, $sql)) {

            mysqli_close($conn);
            header("Location: employees.php"); 
            exit();
        } else {

            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {

        echo '<script>
            if (confirm("Are you sure you want to delete this employee?")) {
                window.location.href = "employees_delete.php?id=' . $employee_Id . '&confirmed=true";
            } else {
                window.location.href = "employees.php";
            }
        </script>';
    }
}
?>