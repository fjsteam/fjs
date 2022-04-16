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
    <title>Football Jersey Store</title>
    <link rel="stylesheet" href="./css/materialize.min.css">
    <link rel="stylesheet" href="./iconfont/material-icons.css">
    <link rel="icon" href="./img/Football Soccer Club Logo1.png">
</head>
<body style="background-image: url(https://www.soccerbible.com/media/133276/mls-header-min.jpg); 
background-position: center;
background-repeat: no-repeat;
background-size: cover;
">
    
    <?php
        include "menuheader.php";
    ?>
    <div class="container">
        <form name="login" action="chkuser.php" method="POST" >
            <div class="card-panel z-depth-4" style="width: 50%;margin: auto; margin-top: 50px; margin-bottom: 50px; border-radius: 30px; background-color: rgba(255, 255, 255, 0.6);backdrop-filter: blur(10px);">
                <div class="col l6 s12 offset-l3">
                    <div class="row">
                        <div class="col s12 center">
                            <img src="./img/Football Soccer Club Logo.png" alt="" width="300px">
                        </div>
                        <div class="col s12 input-field">
                            <i class="material-icons prefix ">account_box</i>
                            <input type="text" name="username" id="username" required >
                            <label for="username">Username</label>
                        </div>
                        <div class="col s12 input-field">
                            <i class="material-icons prefix ">lock</i>
                            <input type="password" name="password" id="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="col s6 left-align">
                            <a href="u_add.php">ลงทะเบียน</a>
                        </div>
                        <div class="col s12 center">
                            <input class="submit green btn"  type="submit" value="Login" name="login" 
                            class="btn waves-effect waves-light " 
                            style="width:100%; background-color: #ff4081;">
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
<footer class="page-footer indigo darken-4">
          <div class="container">
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2022 All rights reserved.
Theme: ColorMag by FJS
            </div>
          </div>
</footer>
</html>