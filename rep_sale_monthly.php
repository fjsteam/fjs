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
        <!-- ระบุการส่งข้อมูลผ่าน FORM เป็นแบบ GET เพราะว่าเป็นรายงานไม่มี Security และเพื่อสะดวกต่อการ ย้อนกลับ  -->
        <form action="rep_sale_monthly.php" method="GET">
            <div class="row">
                <h5 class="col s6 m4 l5">รายงานขายสินค้ารายเดือน</h5>                
                <h5 class="col s3 m3 l2 input-field">
                    
                    <?php
                         //ถ่าไม่มีการรับค่า วันแรก ก็ให้กำหนดเป็นวันที่ 1 ของเดือนปัจจุบัน 
                        if(isset($_GET['sdate']))
                            $sdate=$_GET['sdate'];
                        else
                        {
                            $sdate=date('Y-m-01');
                        }
                    ?>
                    <input type="text" name="sdate" id="sdate" value="<?=$sdate?>" class="datepicker" >
                    <label for="sdate">ตั้งแต่</label>
                </h5>
                <h5 class="col s3 m3 l2  input-field">
                    
                    <?php
                        // ถ้าไม่มีการรับค่า วันสุดท้าย ก็ให้กำหนดเป็นวันสุดท้ายของเดือนนั้น 
                        // โดยผ่าน Paramiter 't' ใน Function date()
                        if(isset($_GET['edate']))
                            $edate=$_GET['edate'];
                        else
                        {
                            $edate=date('Y-m-t');
                        }
                    ?>
                    <input type="text" name="edate" id="edate" value="<?=$edate?>" class="datepicker" >
                    <label for="edate">ถึง</label>
                    </h5>
                <h5 class="s1 ">
                    <button type="submit" class="btn btn-floating   input-field"><i class="material-icons">search</i></button>
                </h5>
            </div>
        </form>
    </div>
    <div class="container" id="item_pic">
        <table class="striped highlight">
            <tr class="green lighten-5">
                <th></th>
                <th >รหัสสินค้า</th>
                <th >ชื่อสินค้า</th>
                <th class="right-align">จำนวน</th>
                <th class="right-align">ยอดเงิน</th>
            </tr>
        
            <?php
                // Query หายอดรวมของ สินค้า ผ่านการ JOIN กัน สามตาราง
                // cart เพื่อกำหนดวันที่
                // cart_item เพื่อเลือกสินค้าในเอกสารที่ตรงวันที่ หายอดจำนวน และราคา
                // item เพื่อแสดงชื่อสินค้า
                // อย่าลือ Group By field ที่ไม่มีการ SUM
                $sql_data = "   SELECT item.item_id,item.item_name,SUM(cart_item.qty) AS sQty,SUM(cart_item.price) AS sPrice
                                FROM cart LEFT JOIN cart_item ON cart.cart_id = cart_item.cart_id 
                                        LEFT JOIN item ON cart_item.item_id = item.item_id
                                WHERE item.item_id IS NOT NULL 
                                 AND cart.cart_date BETWEEN '".$sdate."' AND '".$edate."' 
                                GROUP BY item.item_id,item.item_name 
                                ORDER BY item.item_id";
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
                                <?=$data_array['item_id']?>
                            </td>
                            <td>
                                <?=$data_array['item_name']?>
                            </td>
                            <td class="right-align">
                                <?=$data_array['sQty']?>
                            </td>
                            <td class="right-align">
                                <?=number_format($data_array['sPrice'],2)?>
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