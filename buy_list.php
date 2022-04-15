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
</head>
<body>
    <?php
        include "menuheader.php";
    ?>
    <div class="container">
        <form action="buy_list.php" method="GET">
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
                    <input id="findtext" name="findtext" type="text" class="validate" value="<?=$_GET['findtext']?>">
                    <label for="findtext">ค้นหา</label>
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
                <th></th>
                <th>เลขที่เอกสาร</th>
                <th colspan="2">ผู้ขาย</th>
                <th>วันที่</th>
                <th>จำนวน</th>
                <th>ยอดเงิน</th>
                <th>จ่ายเงิน</th>
                <th>รับของ</th>
                <th>ผู้บันทึก</th>
            </tr>
        
            <?php
                $sql_data = "   SELECT *  
                                FROM buy LEFT JOIN sup ON buy.sup_id = sup.sup_id 
                                WHERE buy_id !='' 
                                AND  (      buy_id LIKE  '%".$_GET['findtext']."%' 
                                        OR  buy.sup_id LIKE  '%".$_GET['findtext']."%' 
                                        OR  sup_name LIKE  '%".$_GET['findtext']."%'
                                        )
                                AND buy_date = '".$_GET['finddate']."'
                                
                                ORDER BY buy_id LIMIT 0,30";
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
                                <a href="buy_show.php?buy_id=<?=$data_array['buy_id']?>  "><?=$data_array['buy_id']?></a>
                            </td>
                            <td>
                                <?=$data_array['sup_id']?>
                            </td>
                            <td>
                                <?=$data_array['sup_name']?>
                            </td>
                            <td>
                                <?=$data_array['buy_date']?>
                            </td>
                            <td>
                                <?=$data_array['buy_qty']?>
                            </td>
                            <td>
                                <?=$data_array['buy_money']?>
                            </td>
                            <td>
                                <?=$data_array['buy_paid']?>
                            </td>
                            <td>
                                <?=$data_array['buy_recv']?>
                            </td>
                            <td>
                                <?=$data_array['key_id']?>
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