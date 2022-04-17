<?php
    session_start();
    include "connector.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KU Computer Shop</title>
    <link rel="stylesheet" href="./css/materialize.min.css">
    <link rel="stylesheet" href="./iconfont/material-icons.css">
    <link rel="icon" href="./img/Football Soccer Club Logo1.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Mitr', sans-serif;
        }
    </style>
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
        <h4 class="pink-text"style="text-align: center;padding: 20px ;width: 100%;margin: auto; margin-top: 50px; margin-bottom: 50px; background-color: rgba(255, 255, 255, 0.6);backdrop-filter: blur(10px);">ลงทะเบียนผู้ใช้ใหม่</h4>
        
        <form action="u_add_ok.php" method="POST">
                <div class="row ">
                    <<div class="card-panel z-depth-4" style="width: 50%;margin: auto; margin-bottom: 50px; border-radius: 30px; background-color: rgba(255, 255, 255, 0.6);backdrop-filter: blur(10px);">
                        <div class="row">
                            <div class="col s12  input-field ">
                                <i class="material-icons prefix">account_box</i>
                                <input type="text" name="u_id" id="u_id" required>
                                <label for="u_id"class="black-text">ชื่อผู้ใช้(User Name)</label>
                            </div>
                            <div class="col s12  input-field">
                                <i class="material-icons prefix">font_download</i>
                                <input type="text" name="u_name" id="u_name" required>
                                <label for="u_name"class="black-text">ชื่อ นามสกุล</label>
                            </div>
                            <div class="col s12  input-field">
                                <i class="material-icons prefix">lock</i>
                                <input type="password" name="u_pwd" id="u_pwd" required>
                                <label for="u_pwd"class="black-text">รหัสผ่าน</label>
                            </div>
                            <div class="col s12  input-field">
                                <i class="material-icons prefix">check_box</i>
                                <input type="password" name="u_cf_pwd" id="u_cf_pwd"  required>
                                <label for="u_cf_pwd"class="black-text">ยืนยันรหัสผ่าน</label>
                            </div>
                            <div class="col s12  input-field">
                                <i class="material-icons prefix">chat</i>
                                <input type="text" name="u_desc" id="u_desc">
                                <label for="u_desc"class="black-text">หมายเหตุ</label>
                            </div>
                            <div class="col s12 right-align">
                                <button type="submit" class="btn blue">บันทึก</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div><!--container--->



    <?php
        include "menuscript.php";
    ?>
</body>
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