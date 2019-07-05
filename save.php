<?php
// Include config file
require_once "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $_temperature = trim($_GET["t"]);
    $_humidity = trim($_GET["h"]);
    $_light = trim($_GET["l"]);
    $result = "";

    // Prepare an insert statement
    $sql = "INSERT INTO datas (temperature, humidity, light) VALUES (?, ?, ?)";
    $sqlGetLight = "SELECT light_enable FROM controls WHERE id = 1";
    
    if(isset($_GET['e'])) {
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
    }
     
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
                $result = "Cannot get light enabled";
            }
        } else{
            $result = "Oops! Something went wrong. Please try again later.";
        }
    }

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sss", $temperature, $humidity, $light);
        
        // Set parameters
        $temperature = $_temperature;
        $humidity = $_humidity;
        $light = $_light;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
            $result = "enabled:" . $isEnable;
            
        } else{
            $result =  "Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);

    die($result);
}
?>