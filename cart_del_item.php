<?php
	session_start();
	include 'connector.php';
?>

<?php
    // ลบสินค้าที่เลือกออกจากตะกร้า (cart_item) (detail)
    $sql_del = "DELETE FROM cart_item 
                WHERE 	item_id = '".$_GET['item_id']."'
                AND     cart_id = '".$_SESSION['cart_id']."' ";
    $res_del = $db->query($sql_del);            
    if($res_del)
    {
        // ถ้าลบ detail สำเร็จก็มาปรับปรุงตัว Master
        // เขียน Agregation QUERY คำนวนยอดรวม
        $sql_sum = "    SELECT  SUM(qty) AS sqty,
                                SUM(qty*price) AS smoney
                        FROM    cart_item 
                        WHERE   cart_id = '".$_SESSION['cart_id']."'
                        GROUP BY cart_id";
        $res_sum=$db->query($sql_sum);
        $sum_array=$res_sum->fetch(PDO::FETCH_ASSOC);
        // คำนวนหายอดรวม ปรับปรุง Session
        // เหมือนกับตอน เพิ่มสินค้า
        
        // แก้ไข Session เพิ่อแสดงผล
        $_SESSION['cart_qty']=$sum_array['sqty'];
        $_SESSION['cart_money']=$sum_array['smoney'] ;

        // บันทึกลงฐานข้อมูล Master
        $sql_update2 = "	UPDATE cart
        SET	cart_qty = '" .  $sum_array['sqty'] . "',
            cart_money = '" .  $sum_array['smoney'] . "',
            key_date = '" . $the_date . "',
            key_time = '" . $the_time . "'
        WHERE	cart_id = '" .  $_SESSION['cart_id'] . "' "; 
        $res_update2 = $db->query($sql_update2);

        if($res_update2 = $db->query($sql_update2))
        {
            // เสร็จแล้วก็แสดงข้อมูลตะกร้า
            echo "<script>window.location='cart_show.php';</script>";
        } 
        else
        {
            echo $sql_update2;
        }
    }
    else
    {
?>
        <script>
            alert("ลบ<?=$_GET['item_id']?>ผิดพลาด");
            window.history.back();
        </script>
<?php        
    }
?>

