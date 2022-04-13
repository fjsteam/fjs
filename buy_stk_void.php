<?php
	session_start();
	include 'connector.php';
?>

<?php
    $ok=0;
    $err=0;
    // สร้าง Query เพื่อหาว่ามีสินค้าอะไรบ้างในเอกสารที่ระบุ โดยเลือกจาก Table buy_item
    $sql_data = "SELECT * FROM buy_item WHERE buy_id = '".$_GET['buy_id']."' ";
    $res_data = $db->query($sql_data);
    while($data_array=$res_data->fetch(PDO::FETCH_ASSOC) )
    {
        // วน Loop อ่านที่ละสินค้า (item) 
        // แล้วเขียน Query เพื่อทำการ ลด จำนวนสินค้า ตามเอกสารที่ระบุ cur_stk - '".$data_array['qty']."' 
        $sql_update = " UPDATE item SET cur_stk = cur_stk - '".$data_array['qty']."' 
                        WHERE 	item_id = '".$data_array['item_id']."' ";   
        $res_update = $db->query($sql_update);
        // ถ้าบันทึกสำเร็จก็ระบุว่าสำเร็จ
        // ถ้าไม่สำเร็จก็เพิ่มว่าไม่สำเร็จ
        if($res_update)
            $ok++;
        else
            $err++;
    }
    // ถ้ามีรายการไม่มีรายการไม่สำเร็จ ก็ไป Update เอกสารรับสินค้าเข้าร้าน ว่ายกเลิก buy_recv = 'N' 
    if($err==0)
    {
        $sql_update = " UPDATE buy SET buy_recv = 'N' 
                        WHERE 	buy_id = '".$_GET['buy_id']."' ";   
        $res_update = $db->query($sql_update);
        echo "<script>window.location='buy_show.php?buy_id=".$_GET['buy_id']."'</script>";
    }
    else
    {
        ?>
                <script>
                    alert("ยกเลิกยืนยันรับ<?=$_GET['buy_id']?>ผิดพลาด");
                    window.history.back();
                </script>
        <?php        
    }
?>


    

