    <nav class="navbar-fixed">
        <div class="nav-wrapper indigo darken-4">
            <!-- ทำ Side Nav -->
            <a href="#" class="sidenav-trigger show-on-large " data-target="sidenav">
				<i class="material-icons ">menu</i>
			</a>
            <!--  -->

            <div class="container">
                <img src="./img/Football Soccer Club Logo2.png" alt="" width="60px">&nbsp;
                <a href="index.php" class="brand-logo">Football Jersey Store</a>
                <ul class="right hide-on-med-and-down">

                    <li>
                        <?php if(isset($_SESSION['cart_id'])) { ?>
                            <a href="cart_show.php" class="btn  pink">
                                    <i class="material-icons left">shopping_cart</i>
                                    <?=$_SESSION['cart_qty']?>&nbsp;(<?=number_format($_SESSION['cart_money'])?>)
                            </a>
                        <?php } ?>    
                    </li>	

                    <li><a href="index.php">สินค้า</a></li>
                    <!-- <li><a href="#">ผู้ใช้</a></li> -->
                    <li><a href="#">About US</a></li>
                    <?php
                        if(!isset($_SESSION['u_id']))
                        {
                            ?>
                                <li><a href="login.php">Login</a></li>
                            <?php
                        }
                        else
                        {
                            ?>
                                <li><a href="u_show.php?u_id=<?=$_SESSION['u_id']?>"><?=$_SESSION['u_name']?></a></li>
                                <li><a href="logout.php">Logout</a></li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ---------------------------------------------------- -->
    <ul class="sidenav indigo " id="sidenav">
        <?php 
            if($_SESSION['u_level']=='admin') 
            { 
                // ส่วนเจ้าหน้าที่
                ?>
                    <!-- ถ้าทำเป็น Sub MEnu แทนที่จะ link ไปPage อื่นให้ระบุเป็น dropdown-triger แทน -->
                    <!-- โดยการระบุ class เป็น dropdown-trigger พร้อมระบุ data-target 
                        ไป id ของ Dropdown Content  ที่ระบุ -->
                    <li><a href="#" class="dropdown-trigger white-text " data-target="work" >ทำงาน</a></li>
                    <li><a href="#" class="dropdown-trigger white-text " data-target="manage" >จัดการข้อมูลพื้้นฐาน</a></li>
                    <li><a href="#" class="dropdown-trigger white-text " data-target="report" >รายงาน</a></li>	
                <?php 
            } 
            else 
            { 
                //ส่วนลูกค้า
                ?>
                    <li><a href="index.php" class="white-text" >สินค้า</a></li>
                    <li><a href="#" class=" white-text" >About</a></li>	
                <?php 
            } 
        ?>	

	</ul><!--Side Nav-->
    <!-- Side Nav Sub MENU -->
    <!-- ระบุ Class เป็น dropdown-contert และระบุ id ของแต่ละ submenu -->
	<ul id="manage" class="dropdown-content green lighten-2">
		<li><a href="user_list.php?findtext=" class="green-text text-darken-4" >ข้อมูลผู้ใช้</a></li>
		<li><a href="item_list.php?findtext=" class="green-text text-darken-4" >ข้อมูลสินค้า</a></li>
		<li><a href="sup_list.php" class="green-text text-darken-4" >ข้อมูลผู้จัดจำหน่าย</a></li>
	</ul>
    <!-- ส่วน Sub Menu -->
	<!-- ระบุ Class เป็น dropdown-contert และระบุ id ของแต่ละ submenu -->
    <ul id="work" class="dropdown-content green lighten-2">
		<li><a href="buy_show.php?buy_id=" class="green-text text-darken-4" >รับสินค้าเข้าร้าน</a></li>
		<li><a href="buy_list.php?findtext=&finddate=" class="green-text text-darken-4" >เอกสารรับสินค้าเข้าร้าน</a></li>
		<li><a href="cart_list.php" class="green-text text-darken-4" >เอกสารขายสินค้า</a></li>
	</ul>

    <ul id="report" class="dropdown-content green lighten-2">
		<li><a href="rep_sale_daily.php?finddate=" class="green-text text-darken-4" >สินค้าขายรายวัน</a></li>
		<li><a href="rep_sale_monthly.php?finddate=" class="green-text text-darken-4" >สินค้าขายรายเดือน</a></li>
		<li><a href="rep_buy_daily.php?finddate=" class="green-text text-darken-4" >สินค้าเข้ารายวัน</a></li>
		<li><a href="rep_buy_monthly.php" class="green-text text-darken-4" >สินค้าเข้ารายเดือน</a></li>
		<li><a href="rep_stk_item.php" class="green-text text-darken-4" >เคลือนไหวสินค้า</a></li>
		<li><a href="checklogin.php?validate=" class="green-text text-darken-4" >รายการผู้ใช้งานรอบรายวัน</a></li>
		<li><a href="monthly_login.php?validate=" class="green-text text-darken-4" >รายการผู้ใช้งานรอบรายเดือน</a></li>
	</ul>

    