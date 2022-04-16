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
</head>
<body>
    <?php
        include "menuheader.php";
    ?>

    <div class="container">
        <?php
            $u_id=$_GET['u_id'];
            $sql_u="SELECT * FROM user WHERE u_id = '".$u_id."' ";
            $res_u=$db->query($sql_u);
            $data_arr=$res_u->fetch(PDO::FETCH_ASSOC);
        ?>
        <h4 class="pink-text">ข้อมูลของ<?=$data_arr['u_name']?></h4>
        <div class="row">
            <div class="col l6 m6 s12 ">
               <img src="./u_img/<?=$data_arr['u_id']?>.jpg" alt="<?=$data_arr['u_id']?>" class="materialboxed z-depth-2 " width="200px">
            </div>
            <div class="col l6 m6 s12">
                <table>
                    <tr>
                        <th>ชื้อผู้ใช้งาน</th>
                        <td><?=$data_arr['u_id']?></td>
                    </tr>
                    <tr>
                        <th>ชื่อ นามสกุล</th>
                        <td><?=$data_arr['u_name']?></td>
                    </tr>
                    <tr>
                        <th>สิทธิ</th>
                        <td><?=$data_arr['u_level']?></td>
                    </tr>
                    <tr>
                        <th>รายละเอียด</th>
                        <td><?=$data_arr['u_desc']?></td>
                    </tr>
                    <tr>
                        <td><a href="u_img.php?u_id=<?=$data_arr['u_id']?>"> แก้ไขรูปภาพ</a></td>
                        <td><a href="u_edit.php?u_id=<?=$data_arr['u_id']?>"> แก้ไขข้อมูล</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>



    <?php
        include "menuscript.php";
    ?>
</body>
</html>