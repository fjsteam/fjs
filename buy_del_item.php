<?php
	session_start();
	include 'connector.php';
?>

<?php
    // ลบสินค้าที่เลือกออกจากเอกสาร (buy_item) (detail)
    $sql_del = "DELETE FROM buy_item 
                WHERE 	item_id = '".$_GET['item_id']."'
                AND     buy_id = '".$_GET['buy_id']."' ";   
    $res_del = $db->query($sql_del);
    if($res_del)
    {
        // ถ้าลบ detail สำเร็จก็มาปรับปรุงตัว Master
        // คำนวนหายอดรวม ปรับปรุง Master
        // เหมือนกับตอน เพิ่มสินค้า
        $sql_sum = "    SELECT  SUM(qty) AS sqty,
                                SUM(qty*price) AS smoney
                        FROM    buy_item 
                        WHERE   buy_id = '".$_GET['buy_id']."'";
                        $res_sum = $db->query($sql_sum);
                        $sum_array = $res_sum->fetch(PDO::FETCH_ASSOC);

                        $sql_update2 = "	UPDATE buy
                            SET	buy_qty = '" .  $sum_array['sqty'] . "',
                                buy_money = '" .  $sum_array['smoney'] . "',
                                key_date = '" . $the_date . "',
                                key_time = '" . $the_time . "'
                            WHERE	buy_id = '" .  $_GET['buy_id'] . "' 
                        "; 
                        $res_update2 = $db->query($sql_update2);
        
        echo "<script>window.location='buy_show.php?buy_id=".$_GET['buy_id']."'</script>";
    }
    else
    {
?>
        <script>
            alert("ลบ<?=$_GET['item_id']?>ผิดพลาด!");
            window.history.back();
        </script>
<?php        
    }
?>

