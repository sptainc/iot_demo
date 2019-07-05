<?php
// Include config file
require_once "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $result = "";

    // Prepare an insert statement
    $sqlGetDatas = "SELECT temperature, humidity, light, created_at FROM datas order by id desc";
    
    if($stmt = mysqli_prepare($link, $sqlGetDatas)) {
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            // Check if username exists, if yes then verify password
            mysqli_stmt_bind_result($stmt, $temperature, $humidity, $light, $created_at);
            if(mysqli_stmt_num_rows($stmt) >= 1){ 
                // Bind result variables
                while(mysqli_stmt_fetch($stmt)) {
                	$result .= '<div class="row" style="margin-bottom: 10px; text-align: center;">';
                		$result .= '<div class="col-xs-3">' . $temperature . '</div>';
                		$result .= '<div class="col-xs-3">' . $humidity . '</div>';
                		$result .= '<div class="col-xs-3">' . $light . '</div>';
                		$result .= '<div class="col-xs-3">' . $created_at . '</div>';
            		$result .= '</div>';
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

    die($result);
}
?>