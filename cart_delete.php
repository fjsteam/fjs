<?php
	session_start();
	include 'connector.php';
?>

<?php
    // ลบตะกร้า cart ปัจจุบัน - Master
    $sql_del = "DELETE FROM cart 
                WHERE 	cart_id = '".$_SESSION['cart_id']."' ";   
    $res_del = $db->query($sql_del);
    if($res_del)
    {
        // ลบ Master สำเร็จ ก็มาลบตัว Detail
        $sql_del_dtl = "DELETE FROM cart_item
                        WHERE 	cart_id = '".$_SESSION['cart_id']."' ";   
        $res_del_dtl = $db->query($sql_del_dtl);
        // แล้วก็มา Clear Session ทิ้ง
        unset ($_SESSION['cart_id']);
        unset ($_SESSION['cart_qty']);
        unset ($_SESSION['cart_money']);

        echo "<script>window.location='index.php'</script>";
    }
    else
    {
?>
        <script>
            alert("ลบ<?=$_SESSION['cart_id']?>ผิดพลาด");
            window.history.back();
        </script>
<?php        
    }
?>

