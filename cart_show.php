<?php
    session_start();
    include 'connector.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ตะกร้าสินค้า</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">
    <script>
        // function ของ Javascript เพื่อให้ยืนยันการลบสินค้าในตะกร้า (detail)
        function cf_del_dtl(the_id)
        {
            //alert();
            cf = confirm("ยืนยันลบสินค้า"+the_id);
            if(cf)
            {
                window.location="cart_del_item.php?item_id="+the_id;
            }
        }
        // function ของ Javascript เพื่อให้ยืนยันการลบตะกร้า (Master)
        function cf_del_master(the_id)
        {
            //alert();
            cf = confirm("ยืนยันตะกร้า"+the_id);
            if(cf)
            {
                window.location="cart_delete.php?item_id="+the_id;
            }
        }
        // function ของ Javascript เพื่อให้ยืนยันการสั่งสินค้า
        function cf_cf(the_id)
        {
            //alert();
            cf = confirm("ยืนยันสั่งสินค้า");
            if(cf)
            {
                window.location="cart_cf.php";
            }
        }
    </script>
</head>
<body>
    <?php
        include "menuheader.php";
    ?>
    <div class="container">
                <h4 class="teal-text ">
                    ข้อมูลตะกร้าสินค้า
                </h4>
                <?php
                    // Query อ่านข้อมูลตะกร้าปัจจุบัน (Master) 
                    $sql_master = "     SELECT *  FROM cart 
                                        WHERE cart_id = '".$_SESSION['cart_id']."'";
                    $res_master = $db->query($sql_master);
                    $master_array = $res_master->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="card ">
                        <div class="card-content ">
                            <span class="card-title grey-text text-darken-1">คำสั่งซื้อ <strong><?=$master_array['cart_id']?></strong> </span>
                            <div class="left-align grey-text text-lighten-1">สังซื้อวันที่&nbsp<?=$master_array['cart_date']?>&nbsp<?=$master_array['cart_time']?></div> 
                            <div class="right-align pink-text">จำนวนสินค้า&nbsp;<?=$master_array['cart_qty']?>&nbsp;ยอดเงิน&nbsp;<?=number_format($master_array['cart_money'],2)?>&nbsp;บาท</div>
                            <hr>
                            <div class="cart-action">
                                <!-- สร้าง Link Button เพื่อลบตะกร้าสินค้า  -->
                                <a href="#" onclick="cf_del_master('<?=$master_array['cart_id']?>')"  class="btn red darken-2">
                                    <i class="material-icons left">remove_shopping_cart</i> ลบตะกร้าสินค้า
                                </a>
                                <!-- สร้าง Link Button เพื่อยืนยันสั่งสินค้า  -->
                                <a href="#" onclick="cf_cf('<?=$master_array['cart_id']?>')"  class="btn blue darken-2 right">
                                    <i class="material-icons left">attach_money</i>ยืนยันสั่งสินค้า
                                </a>
                            </div>
                        </div>
                </div><!---Header card-->
                
                
                <!-- สร้าง Table แสดงส่วน Detail (cart_item) -->
                <table class="table striped highlight">
                    <tr>
                        <th></th>
                        <th colspan="2">สินค้า</th>
                        <th>ราคา</th>
                        <th></th>
                        <th class="center-align">จำนวน</th>
                        <th></th>
                        <th>รวม</th>
                        <th></th>
                    </tr>
                    <?php
                        $sql_dtl = "    SELECT cart_item.*,item.item_name  
                                        FROM cart_item  LEFT JOIN item ON cart_item.item_id=item.item_id
                                        WHERE  cart_id = '".$master_array['cart_id']."' ";
                        $res_dtl = $db->query($sql_dtl);
                        // วน Loop แสดงสินค้าที่อยู่ในตะกร้า
                        $i=0;
                        while($dtl_array = $res_dtl->fetch(PDO::FETCH_ASSOC))
                        {
                            $i++;
                            ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>
                                        <!-- Link เพื่อแก้ไขข้อมูลตะกร้าสินค้า มีการส่งหมายเลขตะกร้าสินค้าไปหน้าแก้ไขข้อมูล -->
                                        <a href="item_show.php?item_id=<?=$dtl_array['item_id']?>">
                                        <?=$dtl_array['item_id']?>
                                        </a>
                                    </td>
                                    <!-- แสดงชื่อของสินค้า -->
                                    <td><?=$dtl_array['item_name']?></td>
                                    <!-- แสดงข้อมูลตัวเลขแบบมี comma คั่น  ผ่าน function number_format(ค่าที่จะแสดง,จุดทศนิยม)-->
                                    <td><?=number_format($dtl_array['price'])?></td>
                                    <td class="right-align ">
                                        <a href="cart_add_item.php?item_id=<?=$dtl_array['item_id']?>&add_qty=-1" class="grey-text">
                                        <i class="material-icons">remove_circle</i>
                                        </a>
                                    </td>
                                    <td class="center-align">   
                                        <!-- แสดงจำนวนสินค้าปัจจุบัน ในตะกร้า -->
                                        <?=$dtl_array['qty']?>
                                    </td>
                                    <td  class="left-align">
                                        <a href="cart_add_item.php?item_id=<?=$dtl_array['item_id']?>&add_qty=1" class="teal-text">
                                        <i class="material-icons ">add_circle</i>
                                        </a>
                                    </td>
                                    <!-- แสดงยอดเงินรวมของสินค้าปัจจุบัน -->
                                    <td><?=number_format($dtl_array['price']*$dtl_array['qty'])?></td>
                                    
                                    <!-- สร้าง Link เพิ่อไปลบรายการสินค้าออก -->
                                    <td class="center-align">
                                        <a href="#" onclick="cf_del_dtl('<?=$dtl_array['item_id']?>')" class="red-text"><i class="material-icons">clear</i></a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </table>
    </div><!---Conteainer---->
    <?php
        include "menuscript.php";
    ?>
</body>
</html>