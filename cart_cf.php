<?php
    session_start();
    include "connector.php";
?>

<?php
    $db->beginTransaction();
    $ok=0;
    $err=0;
    // สร้าง Query เพื่อหาว่ามีสินค้าอะไรบ้างโดยเลือกจาก Table cart_item
    $sql_data = "SELECT * FROM cart_item WHERE cart_id = '".$_SESSION['cart_id']."' ";
    $res_data = $db->query($sql_data);
    // วน Loop อ่านที่ละสินค้า (item) 
    while($data_array=$res_data->fetch(PDO::FETCH_ASSOC) )
    {
        // แล้วเขียน Query เพื่อทำการ ลด จำนวนสินค้า ตามเอกสารที่ระบุ cur_stk + '".$data_array['qty']."' 
        $sql_update = " UPDATE item SET cur_stk = cur_stk - '".$data_array['qty']."' 
                        WHERE 	item_id = '".$data_array['item_id']."' ";   
        $res_update = $db->query($sql_update);
        if($res_update)
            $ok++;
        else
            $err++;
    }
        
   
    // ถ้าไม่มีรายการไม่สำเร็จ ก็ไป Update  ว่าได้ส่งสินค้าทั้งหมดแล้ว cart_cf = 'Y' 
    if($err==0)
    {
        $db->commit();
        //echo "-->".$_GET['item_id'];
        $the_date = date('Y-m-d');
        $the_time = date("H:i:s");
        
        // มาแก้ไขตะกร้าว่ามีการ ยืนยันซื้อสินค้าแล้ว    
        $sql_update = "	UPDATE cart
                        SET	cart_cf = 'Y',
                            key_date = '" . $the_date . "',
                            key_time = '" . $the_time . "'
                        WHERE	cart_id = '" .  $_SESSION['cart_id'] . "' 
                        "; 
        $res_update = $db->query($sql_update);
   
        // เมือยืนยันซื้อสินค้าแล้ว การบันทึกซื้อสินค้าก็จบ
        // ก็ Clear ข้อมูล Session ตะกร้าปัจจุบันทั้งหมด
        // ถ้ามีการเลือกซื้อสินค้าใหม่ ก็จะสร้าง Session ใหม่ เป็นตะกร้าใหม่ เริ่มต้นใหม่
        if($res_update)
        {
            unset ($_SESSION['cart_id']);
            unset ($_SESSION['cart_qty']);
            unset ($_SESSION['cart_money']); 
            
            echo "<script>window.location='index.php';</script>";
        }
    }
    else
    {
        $db->rollBack();
        ?>
                <script>
                    alert("ยืนยันสั่งสินค้า<?=$_SESSION['cart_id']?>ผิดพลาด");
                    window.history.back();
                </script>
        <?php        
    }      
            

    


?>

