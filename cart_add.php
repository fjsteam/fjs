<?php
    session_start();
    include "connector.php";
?>

<?php
    $the_date = date('Y-m-d');
    $the_time = date("H:i:s");    
    // ทำการตรวจสอบว่า Login หรือยัง ถ้ายังก็ให้ไปหน้า Login ก่อน login.php
    if(!isset($_SESSION['u_id']))
    {
        echo "<script>window.location='login.php';</script>";
    }
    // ถ้า Login แล้วก็ทำการตรวจสอบว่า มีตะกร้า ($_SESSION['cart_id']) หรือยัง
    // ถ้ายังไม่มี ก็จะทำการสร้างตะกร้า
    // การสร้างตะกร้าต้องสร้างหมายเลขตะกร้า (หรือหมายเลขใบสั่งซื้อ) ขึ้นมาก่อน ---> cart_id
    elseif(!isset($_SESSION['cart_id']))
    {
        //ใช้ Loop do-while() เพราะว่าจะสร้าง id ขึ้นมาก่อน
        // แล้วตรวจสอบว่าซ้ำกับที่ออกไว้แล้วหรือไม่ 
        // ถ้าซ้ำก็เพิ่มค่าไปทีละ 1 
        // วิธีการ Generate แบบง่ายๆก็ใช้ ปี เดือน วัน เวลา นาที วินาที มาต่อกัน แล้วต่อด้วยเลข 1
        // ถ้าบังเอิญระบบเรามีคนใช้มาก เข้ามาสร้าง cart_id ในช่วงต่างกันไม่ถึงวินาที 
        // ก็ให้คนที่สร้างทีหลัง +1 เข้าไปจนกว่าจะไม่ซ้ำ
        $i=0;
        do
        {
            $i++;
            $theid=date('YmdHis').$i;
            $chk_row="SELECT * FROM cart WHERE cart_id = '".$theid."' ";
            $res_row=$db->query($chk_row);
            $cnt=$res_row->rowCount();
        }
        while($cnt!=0);
        
        // เมือได้ id ทีไม่ซ้ำก็ สร้างตะกร้าขึ้นมาเก็บค่า หมายเลขตะกร้าในระบบ
        // ก็คือสร้าง Session[cart_id] ขึ้นมา พร้อมค่าเริ่มต้นคือยังไม่มีสินค้า และยอดเงินก็เป็น 0
        // แล้วบันทึตะกร้าลงฐานข้อมูล
        //  **** ยังไม่ได้เอาสินค้าลงตะกร้า แค่สร้างตะกร้าก่อนถ้ายังไม่มีตะกร้า
        $_SESSION['cart_id']=$theid;
        $_SESSION['cart_qty']=0;
        $_SESSION['cart_money']=0;
        $sql_update =    "INSERT INTO cart (
                                            cart_id,
                                            cus_id,
                                            cart_date,
                                            cart_time,
                                            cart_qty,
                                            cart_money,
                                            key_date,
                                            key_time
                                            )
                                            VALUES (
                                            '" . $_SESSION['cart_id']. "',
                                            '" . $_SESSION['u_id']. "',
                                            '".$the_date."',
                                            '".$the_time."',
                                            '" . $_SESSION['cart_qty']. "',
                                            '" . $_SESSION['cart_money'] . "',
                                            '".$the_date."',
                                            '".$the_time."'
                                            ) ";
        if($res_update = $db->query($sql_update))
        {
            // เมือสร้างตะกร้าสำเร็จ ก็ไปหน้าที่ทำการบันทึกสินค้าลงตะกร้า โดยส่งรหัสสินค้าที่จะใส่ ส่งต่อไปด้วย
            // ****ไม่ต้องส่งหมายเลขตะกร้า เพราะเป็นตัวแปร Session 
            // ****การ Login แต่ละครั้งสร้างได้ทีละตะกร้า 
            // จะสร้างตะกร้าใหม่ต้อง ลบตะกร้า หรือ ยืนยันซื้อ หรือ Logout ออกจากระบบก่อน
            echo "<script>window.location='cart_add_item.php?item_id=".$_GET['item_id']."';</script>";
        }
        else
        {
            echo $sql_update;
            ?>
                <script>
                    alert("สร้างตะกร้าไม่สำเร็จ");
                </script>
            <?php
        }
       
    }
    else
    {
            // เมือสร้างตะกร้าสำเร็จ ก็ไปหน้าที่ทำการบันทึกสินค้าลงตะกร้า โดยส่งรหัสสินค้าที่จะใส่ ส่งต่อไปด้วย
            // ****ไม่ต้องส่งหมายเลขตะกร้า เพราะเป็นตัวแปร Session 
            // ****การ Login แต่ละครั้งสร้างได้ทีละตะกร้า 
            // จะสร้างตะกร้าใหม่ต้อง ลบตะกร้า หรือ ยืนยันซื้อ หรือ Logout ออกจากระบบก่อน
            echo "<script>window.location='cart_add_item.php?item_id=".$_GET['item_id']."';</script>";
    }
?>

