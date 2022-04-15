<?php
    session_start();
    include "connector.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="./img/logo.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KU Sriracha SHOP</title>

    <link rel="stylesheet" href="./css/materialize.min.css">
    <link rel="stylesheet" href="./iconfont/material-icons.css">
</head>
<body>
    <?php
        include "menuheader.php";
    ?>
    <div class="container">
        <?php
            $sql_data="SELECT * FROM item WHERE item_id ='".$_GET['item_id']."' ";
            $res_data=$db->query($sql_data);
            $data_arr=$res_data->fetch(PDO::FETCH_ASSOC);
        ?>
        <!-- <h5><?=$data_arr['item_id']?>:<?=$data_arr['item_name']?></h5> -->
        <br><br>
        <div class="row">
            <div class="col s12 offset-l1">
                <div class="row">
                    <div class="col s12 m6 l5 center">
                        <img src="./it_img/<?=$data_arr['item_img']?>" 
                                            alt="<?=$data_arr['item_name']?>" 
                                            class="materialboxed z-depth-2" width="300px"> 
                    </div>
                    <div class="col s12 m6 l5">
                        <table>
                            <tr>
                                <th>รหัสสินค้า</th>
                                <td><?=$data_arr['item_id']?></td>
                            </tr>
                            <tr>
                                <th>ชื่อสินค้า</th>
                                <td><?=$data_arr['item_name']?></td>
                            </tr>
                            <tr>
                                <th>ราคา</th>
                                <td><?=$data_arr['item_price']?></td>
                            </tr>
                            <tr>
                                <th>คงเหลือ</th>
                                <td><?=$data_arr['cur_stk']?></td>
                            </tr>
                            <tr>
                                <th>รายละเอียด</th>
                                <td><?=$data_arr['item_rem']?></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php if($_SESSION['u_level']=='admin') { ?>
                                    <a href="item_edit.php?item_id=<?=$data_arr['item_id']?>" class="btn btn-floating blue"><i class="material-icons">build</i></a>
                                    <?php } ?>
                                </td>
                                <td class="right-align">
                                    <?php if($_SESSION['u_level']!='admin') { ?>
                                    <a href="cart_add.php?item_id=<?=$data_arr['item_id']?>" class="btn btn-floating pink"><i class="material-icons">shopping_cart</i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div><!-- row -->

            </div>
        </div>


        
        

    </div>
    


    <?php
        include "menuscript.php";
    ?>
</body>
</html>