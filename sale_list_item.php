<?php
    session_start();
    include "connector.php";
?>

<?php
//Frank Frank2 Frank3 Kom1 Jackkk Jacktest2
    //echo "-->".$_GET['item_id'];
    $the_date = date('Y-m-d');
    $the_time = date("H:i:s");
    // ตรวจสอบก่อนว่ามีเอกสารหรือยัง ถ้ายังไม่มีก็ให้วนไปสร้าง
    // **** จริงๆแล้วเป็นไปได้ยาก เพราะจะมาที่ Page นี้ก็ต้องมาจาก Page สร้างเอกสารก่อน
    // **** แต่ก็ตรวจสอบไว้ไม่เป็นอะไร
    if(isset($_POST['sale_id']))
    {
        
        // สร้าง Query เพื่อตรวจสอบว่า ในเอกสารปัจจุบัน มีสินค้าที่เลือกเข้ามาแล้วหรือยัง
        $sql_show = "   SELECT *  FROM sale_item 
                        WHERE item_id = '" . $_POST['item_id'] . "' 
                        AND     sale_id = '".$_POST['sale_id']."'";
        $res_show = $db->query($sql_show);
        $show_array = $res_show->fetch(PDO::FETCH_ASSOC);
        // ถ้ายังไม่มีสินค้าที่เลือกในเอกสาร ก็ทำการเพิ่มสินค้าเข้าในเอกสารตามที่ระบุ
        if(!isset($show_array['item_id']))
        {
            // แล้วทำการบันทึกข้อมูลลงตาราง สินค้าในเอกสาร sale_item
            $sql_update =    "INSERT INTO sale_item (
                                                sale_id,
                                                item_id,
                                                price,
                                                qty
                                                )
                                                VALUES (
                                                '" . $_POST['sale_id']. "',
                                                '" . $_POST['item_id']. "',
                                                '" . $_POST['price']. "',
                                                '" . $_POST['qty']. "'
                                                ) ";

        }
        else
        {
            // ถ้ามีสินค้าที่เลือกในเอกสารอยู่แล้ว (โดยปรกติ)ก็จะเพิ่มสินค้า ตามจำนวนที่ส่งมา  qty+'" . $_POST['qty']
            
            $sql_update = "	UPDATE sale_item 
                            SET	    qty = qty+'" . $_POST['qty'] . "',
                                    price = '" . $_POST['price'] . "'
                            WHERE	sale_id = '" .  $_POST['sale_id'] . "'
                            AND     item_id = '" . $_POST['item_id'] . "' 
                            "; 
        }
        //echo $res_update; 
        $res_update = $db->query($sql_update);
        // ถ้าบันทึกสินค้าลงเอกสารสำเร็จ
        // ก็จะทำการคำนวนยอดเงิน และ(ทุก)สินค้าที่มีอยู่ในเอกสารทั้งหมด
        // เพื่อเป็นสรุปรวมลงในฐานข้อมูล เอกสาร  (Master)
        if($res_update)
        {
            // เขียน Agregation QUERY คำนวนยอดรวม
            $sql_sum = "    SELECT  SUM(qty) AS sqty,
                                    SUM(qty*price) AS smoney
                            FROM    sale_item 
                            WHERE   sale_id = '".$_POST['sale_id']."'";
            $res_sum=$db->query($sql_sum);
            $sum_array=$res_sum->fetch(PDO::FETCH_ASSOC);
            
            // บันทึกลงฐานข้อมูล Master
            $sql_update2 = "	UPDATE sale
                                SET	sale_qty = '" .  $sum_array['sqty'] . "',
                                    sale_money = '" .  $sum_array['smoney'] . "',
                                    key_date = '" . $the_date . "',
                                    key_time = '" . $the_time . "'
                                WHERE	sale_id = '" .  $_POST['sale_id'] . "' 
                            "; 
            $res_update2 = $db->query($sql_update2);
            
            
        }
        // เสร็จแล้วก็แสดงข้อมูลเอกสาร ระบุ id ของตัว Master ด้วย
        echo "<script>window.location='sale_show.php?sale_id=".$_POST['sale_id']."';</script>";

    }   
?>

