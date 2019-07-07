<?php
// Include config file
require_once "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    if( isset($_GET['e1'])) {
        $_enabled = trim($_GET["e1"]);
        $sqlSaveControl = "UPDATE controls set light_enable = ? where id = 1";
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
     
    if( isset($_GET['e2'])) {
        $_enabled = trim($_GET["e2"]);
        $sqlSaveControl = "UPDATE controls set light_enable = ? where id = 2";
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

    if( isset($_GET['e3'])) {
        $_enabled = trim($_GET["e3"]);
        $sqlSaveControl = "UPDATE controls set light_enable = ? where id = 3";
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

    if( isset($_GET['e4'])) {
        $_enabled = trim($_GET["e4"]);
        $sqlSaveControl = "UPDATE controls set light_enable = ? where id = 4";
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

     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);

    die("true");
}
?>