<?php 
	session_start(); 
	include 'connector.php';
?>

<html>
<head>
<meta http-equiv="Content-Language" content="th" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body >
<?php 
	ini_set('memory_limit', '30M'); //กำหนดการจองพื้นที่หน่วยความจำ
	
	$theFile=basename($_FILES['u_pic']['name']); //ระบุตำแหน่งของ File (ของเครื่องคอมพิวเตอร์) ที่จะอ่านมาทำการ Upload
	$ext = pathinfo($theFile, PATHINFO_EXTENSION); //นามสกุลของ file ต้นทาง (ไม่มีจุด)

	$uploaddir = 'u_img/'; //กำหนด Directory ของ Server ที่จะเอารูปไปเก็บ
	
	//ตั้งชื่อรูปที่จะเก็บ เป็น "ค่าของu_id.jpg" แล้วมาต่อกับ Directory ที่กำหนด เป็นข้อมูลการบันทึกทั้งหมด
	$uploadfile = $uploaddir.$_POST['u_id'].".".$ext; 
	
	//เป็นคำสั้ง Upload file ขึ้น Server ถ้า Upload สำเร็จจะ return ค่าเป็น true ไม่สำเร็จ return ค่าเป็น false
	if (move_uploaded_file($_FILES['u_pic']['tmp_name'], $uploadfile)) 
	{
		//ถ้า Upload สำเร็จก็ย้ายหน้าไปที่หน้า Show User เดิมที่ระบุจาก u_id
?>
		<script>
			window.location="u_show.php?u_id=<?=$_POST['u_id']?>";
		</script>	
<?php
	} 
	else 
	{
		//ถ้า Upload ไม่ได้ก็แจ้งเตือนแล้วให้ลอง Upload ใหม่
?>
		<script>
			alert ("Upload รูปภาพผิดพลาด");
			window.history.back();
		</script>	
<?php
	}
	
?>
</body>
</html>