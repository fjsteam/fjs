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
        <!-- ระบุการส่งข้อมูลผ่าน FORM เป็นแบบ GET เพราะว่าเป็นรายงานไม่มี Security และเพื่อสะดวกต่อการ ย้อนกลับ  -->
        <form action="rep_stk_item.php" method="GET">
            <div class="row valign-wrapper">
                <h5 class="col s6 m4 l3">เคลื่อนไหวสินค้า</h5>
                <h5 class="col l2 input-field">
                    <!-- ทำ List สำหรับเลือกชนิดสินค้า -->
                    <input type="text" name="item_id" id="item_id" value="<?=$_GET['item_id']?>"  list="itemlist">
                    <label for="item_id">สินค้า</label>
                    <datalist id="itemlist">
                    <?php
                        $sql_list="SELECT * FROM item ORDER BY item_name";
                        $res_list=$db->query($sql_list);
                        while($list_array=$res_list->fetch(PDO::FETCH_ASSOC))
                        {
                            ?>
                                <option value="<?=$list_array['item_id']?>"><?=$list_array['item_name']?></option>
                            <?php
                        }
                    ?>
                    </datalist>
                </h5>
                <h5 class="col s3 m3 l2  input-field">
                    
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
                    <label for="sdate">เริ่ม</label>
                </h5>
                <h5 class="col s3 m3 l2 input-field">
                    
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
                <h5 class="s1">
                    <button type="submit" class="btn btn-floating   input-field"><i class="material-icons">search</i></button>
                </h5>
            </div>
        </form>
    </div>
    <div class="container" >
        <?php
            // Query เพื่อแสดงชื่อของสินค้าที่เลือก
            $sql_item="SELECT * FROM item WHERE item_id = '".$_GET['item_id']."' ";
            $res_item=$db->query($sql_item);
            $item_array=$res_item->fetch(PDO::FETCH_ASSOC);

            // Query หายอดรวม สินค้าเข้า ของสินค้าที่ระบุ ก่อนวันแรก ที่เลือก
            $sql_rem_in="SELECT SUM(buy_item.qty) AS sQty 
                        FROM buy JOIN buy_item ON buy.buy_id = buy_item.buy_id
                        WHERE  buy_item.item_id = '".$_GET['item_id']."'
                        AND buy.buy_recv = 'Y'
                        AND buy.buy_date < '".$_GET['sdate']."' ";
            // echo $sql_rem_in."<br>";
            $res_rem_in = $db->query($sql_rem_in);
            $rem_in_arr = $res_rem_in->fetch(PDO::FETCH_ASSOC);
            
            // Query หายอดรวม สินค้าออก ของสินค้าที่ระบุ ก่อนวันแรก ที่เลือก
            $sql_rem_out="SELECT SUM(cart_item.qty) AS sQty 
                        FROM cart JOIN cart_item ON cart.cart_id = cart_item.cart_id
                        WHERE  cart_item.item_id = '".$_GET['item_id']."'
                        AND cart.cart_cf = 'Y'
                        AND cart.cart_date < '".$_GET['sdate']."' ";
            // echo $sql_rem_out."<br>";            
            $res_rem_out = $db->query($sql_rem_out);
            $rem_out_arr = $res_rem_out->fetch(PDO::FETCH_ASSOC);
            
            // คำนวนค่าคงเหลือ ก่อนวันที่ระบุวันแรก
            $remain=$rem_in_arr['sQty']-$rem_out_arr['sQty'];

        ?>
        <h5><?=$item_array['item_name']?></h5>
        <table class="striped highlight">
            <tr class="green lighten-5">
                <th></th>
                <th >วันที่</th>
                <th class="right-align">เข้า</th>
                <th class="right-align">ออก</th>
                <th class="right-align">คงเหลือ(<?=$remain?>)</th>
            </tr>
        
            <?php
                $j=0;
                $date=$_GET['sdate'];
                // ทำการวน Loop วันแรกถึงวันสุดท้ายที่ระบุ
                // ถ้ายังน้อยกว่าหรือทำเท่ากับวันสุดท้ายที่ระบุก็ยังทำงานต่อ
                while (strtotime($date) <= strtotime($_GET['edate'])) 
                {
                    $j++;
                    //เขียน Qurey หา SUM QTY IN จาก  buy_item ของสินค่าที่ระบุ $data_array['item_id'] ในวันที่ระบุ $date
                    //เขียน Qurey หา SUM QTY OUT จาก cart_item ของสินค่าที่ระบุ $data_array['item_id'] ในวันที่ระบุ $date

                    $remain=$remain+$q_in-$q_out;
                    ?>
                        <tr>
                            <td><?=$j?></td>
                            <td><?=$date?></td>
                            <td class="right-align"><?=$q_in?></td>
                            <td class="right-align"><?=$q_out?></td>
                            <td class="right-align"><?=$remain?></td>
                        </tr>
                    <?php
                    // ทำการเพิ่มค่าวันที่ $date ทีละ 1 วัน
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
            ?>
            
            </table>
        
        
    </div>


    
    <?php
        include "menuscript.php";
    ?>
    
</body>
</html>