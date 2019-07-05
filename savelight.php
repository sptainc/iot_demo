<?php
// Include config file
require_once "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $_enabled = trim($_GET["e"]);
    $sqlSaveControl = "UPDATE controls set light_enable = ?";
    if($stmt = mysqli_prepare($link, $sqlSaveControl)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "d", $enabled);
        
        // Set parameters
        $enabled = $_enabled == "1" ? true : false;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
                        
        } else{
            die("Something went wrong. Please try again later.");
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);

    die("true");
}
?>