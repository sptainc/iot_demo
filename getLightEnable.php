<?php
// Include config file
require_once "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){

    // Prepare an insert statement
    $sqlGetLight = "SELECT light_enable FROM controls";
    
    if($stmt = mysqli_prepare($link, $sqlGetLight)) {
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            // Check if username exists, if yes then verify password
            mysqli_stmt_bind_result($stmt, $isEnable);
            if(mysqli_stmt_num_rows($stmt) >= 1){ 
                // Bind result variables
                $counter = 0;
                while(mysqli_stmt_fetch($stmt)) {
                    if ( $counter == 0 ) 
                        $result .= $isEnable;
                    else
                        $result .= "," . $isEnable;
                    $counter++;
                }
            }
        } else{
            $result = "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);

    die("enabled:". $result);
}
?>