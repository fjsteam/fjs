<?php
    session_start();
    include 'connector.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <link rel="icon" href="img/logo.ico" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$_SESSION['u_name']?></title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">
</head>
<body>
    <?php
        include "menuheader.php";
    ?>
    <div class="container">
        <form action="item_list.php" method="POST">
            <div class="row ">
                <h4 class="col s7 m5 pink-text">
                    ข้อมูลสินค้า
                    <a href="item_add.php" class="btn-floating blue"><i class="material-icons">add</i></a>
                </h4>
                <h4 class="col s11 m6 l4  input-field ">
                    <!-- สร้าง textbox สำหรับคนห้าสินค้า -->
                    <input id="findtext" name="findtext" type="text" class="validate">
                    <label for="findtext">ค้นหาสินค้า</label>
                </h4>
                <h4 class="col s1 ">
                    <button type="submit" class="btn-floating"><i class="material-icons">search</i></button>
                </h4>
            </div>
        </form>
    </div>
    <div class="container" id="item_pic">
        <table class="striped highlight">
            <tr class="green lighten-5">
                <th></th>
                <th colspan="2">สินค้า</th>
                <th>ราคา</th>
                <th>จำนวนคงเหลือ</th>
                <th>หมายเหตุ</th>
            </tr>
        
            <?php
                $sql_data = "   SELECT *  
                                FROM item 
                                WHERE item_id !='' AND ( item_rem LIKE  '%".$_POST['findtext']."%'
                                                           OR  item_name LIKE  '%".$_POST['findtext']."%'
                                                        ) 
                                
                                ORDER BY item_id LIMIT 0,30";
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
                                <?=$j?>
                            </td>
                            <td>
                                <a href="item_show.php?item_id=<?=$data_array['item_id']?>  "><?=$data_array['item_id']?></a>
                            </td>
                            <td>
                                <?=$data_array['item_name']?>
                            </td>
                            <td>
                                <?=$data_array['item_price']?>
                            </td>
                            <td>
                                <?=$data_array['cur_stk']?>
                            </td>
                            <td>
                                <?=$data_array['item_rem']?>
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