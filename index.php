<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <style type="text/css">
        body{ font: 16px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        .m-b-10 { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-xs-10">
            <h2 class="m-b-10">Dashboard</h2>
        </div>
        <div class="col-xs-2">
            <input type="checkbox" data-toggle="toggle" id="lightEnable">
        </div>

    </div>    
    <div class="row">
        <div class="col-xs-12">
            <div class="row m-b-10" style="text-align: center; font-weight: bold;">
                <div class="col-xs-3">Nhiệt độ</div>
                <div class="col-xs-3">Độ ẩm</div>
                <div class="col-xs-3">Ánh sáng</div>
                <div class="col-xs-3">Thời gian</div>
            </div>

            <div id="datas">
                
            </div>
            
        </div>
    </div>
    
    <script type="text/javascript">
        $( document ).ready(function() {
            getDataFromServer();
            getLightEnabled();
            setInterval(function(){ 
                getDataFromServer();
            }, 5000);

        });

        function getDataFromServer() {
            $.ajax({
                url: "/getdata.php",
            }).done(function(data) {
              $("#datas").html(data);
            });
        }

        function getLightEnabled() {
            $.ajax({
                url: "/getLightEnable.php",
            }).done(function(data) {
                var enabled = data.substr(data.indexOf(":") + 1, data.length);
                if ( enabled == "1" ) {
                    $("#lightEnable").bootstrapToggle("on");
                }

                $("#lightEnable").change(function (){
                    if ( $(this).prop('checked') ) {
                        saveLight(1);
                    } else { 
                        saveLight(0);
                    }
                });
            });
        }

        function saveLight( enabled ) {
            $.ajax({
                url: "/savelight.php?e=" + enabled,
            }).done(function(data) {
                alert("Updated");
            });
        }
    </script>
</body>
</html>