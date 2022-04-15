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
        <!-- ระบุการส่งข้อมูลผ่าน FORM เป็นแบบ GET เพราะว่าเป็นรายงานไม่มี Security และเพื่อสะดวกต่อการ ย้อนกลับ  -->
        <form action="rep_buy_daily.php" method="GET">
            <div class="row ">
                <h5 class="col s6 m6 l8">รายงานสินค้าซื้อเข้ารายวัน</h5>                
                <div class="col s4 m4 l3">
                    
                    <?php
                        //ถ่าไม่มีการรับค่า วันที่ระบุ ก็ให้กำหนดเป็นวันปัจจุบัน 
                        if(isset($_GET['finddate']))
                            $finddate=$_GET['finddate'];
                        else
                            $finddate=date('Y-m-d');
                    ?>
                    <input type="text" name="finddate" id="finddate" value="<?=$finddate?>" class="datepicker" onchange="this.form.submit();">
                    <label for="finddate">วันที่</label>
                </div>
            </div>
        </form>
    </div>
    <div class="container" >
        <table class="striped highlight">
            <tr class="green lighten-5">
                <th></th>
                <th colspan="2">สินค้า</th>
                <th class="right-align">จำนวน</th>
                <th class="right-align">ยอดเงิน</th>
            </tr>
        
            <?php
                // Query หายอดรวมของ สินค้า ผ่านการ JOIN กัน สามตาราง
                // buy เพื่อกำหนดวันที่
                // buy_item เพื่อเลือกสินค้าในเอกสารที่ตรงวันที่ หายอดจำนวน และราคา
                // item เพื่อแสดงชื่อสินค้า
                // อย่าลือ Group By field ที่ไม่มีการ SUM
                $sql_data = "   SELECT item.item_id,item.item_name,SUM(buy_item.qty) AS sQty,SUM(buy_item.price) AS sPrice
                                FROM buy LEFT JOIN buy_item ON buy.buy_id = buy_item.buy_id 
                                        LEFT JOIN item ON buy_item.item_id = item.item_id
                                WHERE item.item_id IS NOT NULL 
                                AND buy.buy_date = '".$_GET['finddate']."' 
                                GROUP BY item.item_id,item.item_name
                                ORDER BY item.item_id ";
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