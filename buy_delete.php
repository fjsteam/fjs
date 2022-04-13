<?php
	session_start();
	include 'connector.php';
?>

<?php
    // ลบเอกสาร buy ปัจจุบัน - Master
    $sql_del = "DELETE FROM buy 
                WHERE 	buy_id = '".$_GET['buy_id']."' ";   
    $res_del = $db->query($sql_del);
    if($res_del)
    {
        // ลบ Master สำเร็จ ก็มาลบตัว Detail
        $sql_del_dtl = "DELETE FROM buy_item
                        WHERE 	buy_id = '".$_GET['buy_id']."' ";   
        $res_del_dtl = $db->query($sql_del_dtl);
        
        
        
        
        echo "<script>window.location='buy_show.php'</script>";
    }
    else
    {
?>
        <script>
            alert("ลบ<?=$_GET['buy_id']?>ผิดพลาด");
            window.history.back();
        </script>
<?php        
    }
?>

