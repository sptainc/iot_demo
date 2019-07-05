<?php
// Include config file
require_once "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){

    // Prepare an insert statement
    $sqlGetLight = "SELECT light_enable FROM controls";
    
    if($stmt = mysqli_prepare($link, $sqlGetLight)) {
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            // Check if username exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){                    
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $isEnable);
                mysqli_stmt_fetch($stmt);
            }
        } else{
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);

    die("enabled:". $isEnable);
}
?>