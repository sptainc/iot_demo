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

        <h2 class="m-b-10" style="text-align: center">Giám Sát Và Điều Khiển Thiết Bị</h2>
        <hr>

        <div class="row" style="text-align: center;">
                <div class="col-xs-3">
                        <label for="lightEnable1">Relay 1</label>
                        <input type="checkbox" data-toggle="toggle" id="lightEnable1">
                </div>
                <div class="col-xs-3">                
                        <label for="lightEnable1">Relay 2</label>

                        <input type="checkbox" data-toggle="toggle" id="lightEnable2">
                </div>
                <div class="col-xs-3">
                        <label for="lightEnable1">Relay 3</label>

                        <input type="checkbox" data-toggle="toggle" id="lightEnable3">
                </div>
                <div class="col-xs-3">
                        <label for="lightEnable1">Relay 4</label>

                        <input type="checkbox" data-toggle="toggle" id="lightEnable4">
                </div>
        </div>    
        <br>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                    <div class="row m-b-10" style="text-align: center; font-weight: bold;">
                    <div class="col-xs-3">Nhiệt độ</div>
                    <div class="col-xs-3">Độ ẩm</div>
                    <div class="col-xs-3">Trạng Thái Thiết Bị</div>
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
                var dtEnabled = enabled.split(",");
                if ( dtEnabled[0] == "1" ) {
                        $("#lightEnable1").bootstrapToggle("on");
                }
                if ( dtEnabled[1] == "1" ) {
                        $("#lightEnable2").bootstrapToggle("on");
                }
                if ( dtEnabled[2] == "1" ) {
                        $("#lightEnable3").bootstrapToggle("on");
                }
                if ( dtEnabled[3] == "1" ) {
                        $("#lightEnable4").bootstrapToggle("on");
                }
                $("#lightEnable1").change(function (){
                        if ( $(this).prop('checked') ) {
                        saveLight(1, 1);
                        } else { 
                        saveLight(1, 0);
                        }
                });
                $("#lightEnable2").change(function (){
                        if ( $(this).prop('checked') ) {
                        saveLight(2, 1);
                        } else { 
                        saveLight(2, 0);
                        }
                });
                $("#lightEnable3").change(function (){
                        if ( $(this).prop('checked') ) {
                        saveLight(3, 1);
                        } else { 
                        saveLight(3, 0);
                        }
                });
                $("#lightEnable4").change(function (){
                        if ( $(this).prop('checked') ) {
                        saveLight(4, 1);
                        } else { 
                        saveLight(4, 0);
                        }
                });
                });
        }
        function saveLight( lightNum ,enabled ) {
                $.ajax({
                url: "/savelight.php?e" + lightNum + "=" + enabled,
                }).done(function(data) {
                console.log("updated")
                });
        }
        </script>
</body>
</html>