<?php
    session_start();
    include "connector.php";
?>

<?php

    // echo "-->".$_GET['item_id']."<br>";
    // echo "-->".$_SESSION['cart_id']."<br>";
    // echo "-->".$_SESSION['cart_qty']."<br>";
    // echo "-->".$_SESSION['cart_money']."<br>";
    
    $the_date = date('Y-m-d');
    $the_time = date("H:i:s");
    // ตรวจสอบก่อนว่ามีตะกร้าหรือยัง ถ้ายังไม่มีก็ให้วนไปสร้าง
    // **** จริงๆแล้วเป็นไปได้ยาก เพราะจะมาที่ Page นี้ก็ต้องมาจาก Page สร้างตะกร้าก่อน
    // **** แต่ก็ตรวจสอบไว้ไม่เป็นอะไร
    if(!isset($_SESSION['cart_id']))
    {
        echo "<script>window.location='cart_add.php?item_id=".$_GET['item_id']."';</script>";
    }
    else
    {
        // สร้าง Query เพื่อตรวจสอบว่า ในตะกร้าปัจจุบัน มีสินค้าที่เลือกเข้ามาแล้วหรือยัง
        $sql_show = "   SELECT *  FROM cart_item 
                        WHERE item_id = '" . $_GET['item_id'] . "' 
                        AND     cart_id = '".$_SESSION['cart_id']."'";
        $res_show = $db->query($sql_show);
        $show_array = $res_show->fetch(PDO::FETCH_ASSOC);
        if(!isset($show_array['item_id']))
        {
            //สร้าง Query เพื่ออ่านราคาสินค้า (หรือข้อมูลอื่นๆ) ว่าสินค้าที่เลือกชิ้นละเท่าไร
            $sql_data = "    SELECT *  FROM item 
                            WHERE item_id = '" . $_GET['item_id'] . "' ";
            $res_data = $db->query($sql_data);
            $data_array = $res_data->fetch(PDO::FETCH_ASSOC);
            // แล้วทำการบันทึกข้อมูลลงตาราง สินค้าในตะกร้า cart_item
            $sql_update =    "INSERT INTO cart_item (
                                                        cart_id,
                                                        item_id,
                                                        price,
                                                        qty
                                                        )
                                                        VALUES (
                                                        '" . $_SESSION['cart_id']. "',
                                                        '" . $_GET['item_id']. "',
                                                        '" . $data_array['item_price']. "',
                                                        '1'
                                                        ) ";
            
        }
        else
        {
            //update เพิ่มสินค้า
            // ถ้ามีสินค้าที่เลือกในตะกร้าอยู่แล้ว (โดยปรกติ)ก็จะเพิ่มสินค้าทีละ 1 ก็คือ + เข้าไปเลย
            $add_qty=1;

            $sql_chack1 = "   SELECT *  FROM item 
            WHERE item_id = '" . $_GET['item_id'] . "'";
            $res_chack1 = $db->query($sql_chack1);
            $chack_array1 = $res_chack1->fetch(PDO::FETCH_ASSOC);

            $sql_chack2 = "   SELECT *  FROM cart_item 
            WHERE item_id = '" . $_GET['item_id'] . "' 
            AND     cart_id = '".$_SESSION['cart_id']."'";
            $res_chack2 = $db->query($sql_chack2);
            $chack_array2 = $res_chack2->fetch(PDO::FETCH_ASSOC);

            // -------------เพิ่มหรือลด--------------------------
            if(isset($_GET['add_qty']))
                $add_qty=$_GET['add_qty'];
                if($chack_array2['qty']+$add_qty<=0)
                {
                    echo'<script>
                    window.location="cart_show.php"
                    alert("ไม่สามารถลดจำนวนได้อีกแล้ว")
                    </script>' ;
                }

                elseif($chack_array2['qty']+$add_qty>$chack_array1['cur_stk'])
                {
                    echo'<script>
                    window.location="cart_show.php"
                    alert("จำนวนสินค้าเกินจำนวนในสต๊อก")
                    </script>' ;
                }
            //--------------------------------------
                else
                {
                    $sql_update = "	UPDATE cart_item 
                    SET	qty = qty+'" . $add_qty . "'
                    WHERE	cart_id = '" .  $_SESSION['cart_id'] . "'
                                AND     item_id = '" . $_GET['item_id'] . "' 
                    "; 
                }
                
            // if($sql_update == 0)
            // {
            //     $sql_update = "	UPDATE cart_item 
            //                     SET	qty = '1'
            //                     WHERE	cart_id = '" .  $_SESSION['cart_id'] . "'
            //                     AND     item_id = '" . $_GET['item_id'] . "' 
            //                     "; 
            // }
            //เปลี่ยนหน้า
            // echo "<script>window.location='cart_show.php';</script>";
        }

        /////สั่งให้ Update ตามข้อแม้
        // ถ้าบันทึกสินค้าลงตะกร้าสำเร็จ
        // ก็จะทำการคำนวนยอดเงิน และ(ทุก)สินค้าที่มีอยู่ในตะกร้าทั้งหมด
        // เพื่อเป็นสรุปรวมลงในฐานข้อมูล ตะกร้า cart (Master)

        if($res_update = $db->query($sql_update))
        {
            // เขียน Agregation QUERY คำนวนยอดรวม
            $sql_sum = "    SELECT  SUM(qty) AS sqty,
                                    SUM(qty*price) AS smoney
                            FROM    cart_item 
                            WHERE   cart_id = '".$_SESSION['cart_id']."'
                            GROUP BY cart_id";
            $res_sum=$db->query($sql_sum);
            $sum_array=$res_sum->fetch(PDO::FETCH_ASSOC);
            
            // แก้ไข Session เพิ่อแสดงผล
            $_SESSION['cart_qty']=$sum_array['sqty'];
            $_SESSION['cart_money']=$sum_array['smoney'] ;
            
            // บันทึกลงฐานข้อมูล Master
            $sql_update2 = "	UPDATE cart
                                SET	cart_qty = '" .  $sum_array['sqty'] . "',
                                    cart_money = '" .  $sum_array['smoney'] . "',
                                    key_date = '" . $the_date . "',
                                    key_time = '" . $the_time . "'
                                WHERE	cart_id = '" .  $_SESSION['cart_id'] . "' 
                            "; 

            if($res_update2 = $db->query($sql_update2))
            {
                // เสร็จแล้วก็แสดงข้อมูลตะกร้า
                echo "<script>window.location='cart_show.php';</script>";
            } 
            else
            {
                echo $sql_update2;
            }
        }// res_update
    }
        
        
        
        
?>

