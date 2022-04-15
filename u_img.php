<?php
session_start();
include 'connector.php';
?>
<!DOCTYPE html>
<html lang="th">

<head>

	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$_SESSION['u_name']?></title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">

	<link rel="icon" href="img/Football Soccer Club Logo1.png" />
</head>

<body>
	<?php
		include "menuheader.php";
	?>
	<div class="container">
		<!--ในการ Upload File ต้องระบุ enctype="multipart/form-data" ใน TAG form ด้วย-->
		<form enctype="multipart/form-data" name="u_img" action="u_img_ok.php" method="POST">
			
			<?php
				//อ่านข้อมูลของ u_id เพื่อเอามาแสดงชื่อ
				$sql_u = "SELECT * FROM user WHERE u_id = '" . $_GET['u_id'] . "' ";
				$res_u = $db->query($sql_u);
				$u_array = $res_u->fetch(PDO::FETCH_ASSOC);
			?>
			<!-- กำหนด input ชนิด hidden  เพื่อส่งค่า u_id ไปหน้าต่อไป -->
			<input type="hidden" name="u_id" value="<?= $u_array['u_id'] ?>" />
			<!--กำหนด ขนาดสูงสุดของ File ที่จะ Upload หน่วยเป็น Byte-->
			<input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
			<div class="card-panel">
					<h4 class="pink-text">
						บันทึกภาพสำหรับ <?= $u_array['u_name'] ?>
					</h4>
				
					<div class="row">
						<div class="file-field input-field col s6">
							<div class="btn">
								<span>File</span>
								<!----กำหนด input ชื่อ u_pic ให้เป็นการอ่านค่า file โดยให้รับค่าเฉพาะ file image ----->
								<input  type="file" accept="image/jpeg" name="u_pic">
								<!-- accept="image/*,application/pdf" -->
							</div>
							<div class="file-path-wrapper">
								<!----ระบุ path ที่เก็บ file สำหรับการ Upload----->
								<input class="file-path validate " type="text" placeholder="เลือกfileรูปภาพ"  >
							</div>
						</div>
						<div class="col s2">
							<button class="btn-floating btn" type="submit">
								<i class="material-icons right">done</i>
							</button>
						</div>
						
					</div>
				
			</div>
		</form>
	</div>

	<?php
		include "menuscript.php";
	?>
</body>

</html>