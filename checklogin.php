<?php
    session_start();
    include 'connector.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <link rel="icon" href="img/Football Soccer Club Logo1.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$_SESSION['u_name']?></title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">
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
        <form action="checklogin.php" method="GET">
            <div class="row valign-wrapper">
                <div class="col s5 m5 l3">
                    <?php
                        if(isset($_GET['finddate']))
                            $finddate=$_GET['finddate'];
                        else
                            $finddate=date('Y-m-d');
                    ?>
                    <input type="text" name="finddate" id="finddate" value="<?=$finddate?>" class="datepicker">
                </div>
                <div class="col s5 m5 l4  input-field right">
                    <i class="material-icons prefix">search</i>
                    <!-- สร้าง textbox สำหรับคนห้าสินค้า -->
                    <input id="validate" name="validate" type="text" class="validate" value="<?=$_GET['validate']?>">
                    <label for="validate">ค้นหา</label>
                </div>
                <div class="col s1 ">
                    <button type="submit" class="btn-floating"><i class="material-icons">done</i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="container" id="item_pic">
        <table class="striped highlight">
            <tr class="green lighten-5">
                <th>ชื่อพนักงาน</th>
                <th>เวลาล็อกอิน</th>
                <th>เวลาล็อกเอ้าท์</th>
                
            </tr>
        
            <?php
                $sql_data = "   SELECT *FROM user_date_login_user
                left join user on user_date_login_user.user_id=user.u_id
                WHERE user_date_login_user.date_time_login like'%".$finddate."%' 
                and user_date_login_user.date_time_login like'%".$finddate."%' and user.u_name like'%".$_GET['validate']."%'";

                // echo  $sql_data;           
                $res_data = $db->query($sql_data);

                $j=0;
                //วนลูปแสดงผล
                while ($data_array = $res_data->fetch(PDO::FETCH_ASSOC)) 
                {
                    $j++;
                    ?>
                        <tr>
                            <td>
                                <?=$data_array['u_name']?>
                            </td>
                            <td>
                                <?=$data_array['date_time_login']?>
                            </td>
                            <td>
                                <?=$data_array['date_time_logout']?>
                            </td>
                        </tr>  
                    <?php
                }
            ?> 
            
            </table>
        
        
    </div>
    
    <?php
        include "menuscript.php";
    ?>
</body>
</html>