<?php
    session_start();
    include "connector.php";
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KU Computer Shop</title>
    <link rel="stylesheet" href="./css/materialize.min.css">
    <link rel="stylesheet" href="./iconfont/material-icons.css">
    <link rel="icon" href="./img/kulogo.ico">
</head>
<body>
    <?php
        include "menuheader.php";
    ?>
    <div class="container">
        <form name="login" action="chkuser.php" method="POST" >
            <div class="row">
                <div class="col l6 s12 offset-l3">
                    <h4 class="pink-text ">KU SHOP</h4>
                    <div class="row">
                        <div class="col s12 center">
                            <img src="./img/kulogo.png" alt="" >
                        </div>
                        <div class="col s12 input-field">
                            <i class="material-icons prefix purple-text">account_box</i>
                            <input type="text" name="username" id="username" required >
                            <label for="username">Username</label>
                        </div>
                        <div class="col s12 input-field">
                            <i class="material-icons prefix purple-text">lock</i>
                            <input type="password" name="password" id="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="col s6 left-align">
                            <a href="u_add.php">ลงทะเบียน</a>
                        </div>
                        <div class="col s6 right-align">
                            
                            <button class="submit green btn">ตกลง</button>
                        </div>
                    </div><!---row--->
                </div><!--Col Off---->
            </div><!---row---->
        </form>
    </div><!-----Container------>

    <?php
        include "menuscript.php";
    ?>
</body>
</html>