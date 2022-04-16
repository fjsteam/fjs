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
<body>
    <?php
        include "menuheader.php";
    ?>

    <div class="container">
        <form action="u_edit_ok.php" method="POST">
        <?php
            $u_id=$_GET['u_id'];
            $sql_u="SELECT * FROM user WHERE u_id = '".$u_id."' ";
            $res_u=$db->query($sql_u);
            $data_arr=$res_u->fetch(PDO::FETCH_ASSOC);

            if(isset($data_arr['u_id']))
            {
                //ผู้ใช้เก่า
                $thehead="แก้ใข้ข้อมูล".$data_arr['u_name'];
                ?>
                    <input type="hidden" name="edit" id="edit" value="Y">
                <?php
            }
            else
            {
                //ผู้ใช้ใหม่
                $thehead="ลงทะเบียนผู้ใช้ใหม่";
                ?>
                    <input type="hidden" name="edit" id="edit" value="N">
                <?php
            }
        ?>
        
        <h4 class="pink-text"><?=$thehead?></h4>
        
        
                <div class="row">
                    <div class="card-panel col s12 m8 l6 offset-l3 offset-m2">
                        <div class="row">
                            <div class="col s12  input-field">
                                <i class="material-icons prefix">account_box</i>
                                <input type="text" name="u_id" id="u_id" value="<?=$data_arr['u_id']?>" required>
                                <input type="hidden" name="old_u_id" id="old_u_id" value="<?=$data_arr['u_id']?>" required>
                                <label for="u_id">ชื่อผู้ใช้(User Name)</label>
                            </div>
                            <div class="col s12  input-field">
                                <i class="material-icons prefix">font_download</i>
                                <input type="text" name="u_name" id="u_name" value="<?=$data_arr['u_name']?>" required>
                                <label for="u_name">ชื่อ นามสกุล</label>
                            </div>
                            <div class="col s12  input-field">
                                <i class="material-icons prefix">lock</i>
                                <input type="password" name="u_pwd" id="u_pwd" value="<?=$data_arr['u_pwd']?>" required>
                                <label for="u_pwd">รหัสผ่าน</label>
                            </div>
                            <div class="col s12  input-field">
                                <i class="material-icons prefix">check_box</i>
                                <input type="password" name="u_cf_pwd" id="u_cf_pwd" value="<?=$data_arr['u_pwd']?>" required>
                                <label for="u_cf_pwd">ยืนยันรหัสผ่าน</label>
                            </div>
                            <div class="col s12  input-field">
                                <i class="material-icons prefix">chat</i>
                                <input type="text" name="u_desc" id="u_desc" value="<?=$data_arr['u_desc']?>">
                                <label for="u_desc">หมายเหตุ</label>
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
</html>