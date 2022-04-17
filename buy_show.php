<?php
    session_start();
    include 'connector.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <link rel="icon" href="img/Football Soccer Club Logo1.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>สินค้าเข้าร้าน</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">
    <script>
        // function ของ Javascript เพื่อให้ยืนยันการลบสินค้าในเอกสาร (detail)
        function cf_del_dtl(i_id,b_id)
        {
            //alert();
            cf = confirm("ยืนยันลบสินค้า"+i_id);
            if(cf)
            {
                window.location="buy_del_item.php?item_id="+i_id+"&buy_id="+b_id;
            }
        }
        // function ของ Javascript เพื่อให้ยืนยันการลบเอกสาร (Master)
        function cf_del_master(b_id)
        {
            //alert();
            cf = confirm("ยืนยันลบเอกสาร"+b_id);
            if(cf)
            {
                window.location="buy_delete.php?buy_id="+b_id;
            }
        }
        // function ของ Javascript เพื่อให้ยืนยันการรับสินค้าเข้าร้าน เพื่อไปปรับ Stock
        function cf_stk(b_id)
        {
            //alert();
            cf = confirm("ยืนยันสินค้าเข้าร้าน");
            if(cf)
            {
                window.location="buy_stk.php?buy_id="+b_id;
            }
        }
        // function ของ Javascript เพื่อให้ยกเลิกการยืนยันการรับสินค้าเข้าร้าน เพื่อไปปรับ Stock
        function cf_stk_void(b_id)
        {
            //alert();
            cf = confirm("ยกเลิกยืนยันสินค้าเข้าร้าน");
            if(cf)
            {
                window.location="buy_stk_void.php?buy_id="+b_id;
            }
        }
    </script>
</head>
<body>
    <?php
        include "menuheader.php";
    ?>

    
    <div class="container">
        <?php
            // Query อ่านข้อมูลเอกสารปัจจุบัน (Master) 
            // เพื่อตรวจสอบว่าเป็นการแก้ข้อมูลเก่า หรือต้องการบันทึกใหม่
            $sql_master = "     SELECT *  FROM buy 
                                WHERE buy_id = '".$_GET['buy_id']."'";
            $res_master = $db->query($sql_master);
            $master_array = $res_master->fetch(PDO::FETCH_ASSOC);
        ?>
        <!-- ทำ Card แสดงส่วน Master  -->
        <form action="buy_add.php" method="POST">
            <div class="card-panel blue-grey lighten-5">
                <div class="row">
                    <h5 class="col s10 orange-text text-darken-2">สินค้าเข้าร้าน <?=$master_array['buy_id']?></h5>
                    <input type="hidden" name="buy_id" value="<?=$master_array['buy_id']?>">
                    <h5 class="col s2">
                        <!-- ถ้ายังไม่ได้รับ Stock หรือยืนยันรับสินค้าเข้าร้าน ก็ให้มีปุ่มเพื่อทำการยืนยัน -->
                        <!-- เพิ่มเติมว่า ถ้ามีการ ปรับ Stock หรือรับสินค้าแล้ว ก็ให้แสดงปุมยกเลิกแทน -->
                        <?php if($master_array['buy_recv']!='Y') { ?> 
                            <button type="button" class="orange darken-2 btn" onclick="cf_stk('<?=$master_array['buy_id']?>');">ยืนยันสินค้าเข้าร้าน</button>
                        <?php } else { ?>
                            <button type="button" class="red darken-2 btn" onclick="cf_stk_void('<?=$master_array['buy_id']?>');">ยกเลิกยืนยันสินค้าเข้าร้าน</button>
                        <?php } ?>
                    </h5>
                </div>
                <div class="row">
                    <div class="col s12 m6 l3 input-field">
                        <select name="sup_id" id="sup_id" required>
                            <option value="" disabled selected>เลือกผู้จัดจำหน่าย</option>
                            <?php
                                // แสดงรายชื่อ Supplier จาก Table มาแสดงใน Select
                                // วน Loop แล้วเอาไปแสดงที่ Option
                                $sql_list = "SELECT * FROM sup ORDER BY sup_name";
                                $res_list = $db->query($sql_list);
                                while($list_array=$res_list->fetch(PDO::FETCH_ASSOC))
                                {
                                    // ทำการเปรียบเทียบ ค่าของเอกสารเดิม $master_array['sup_id'])
                                    // กับค่าที่อ่านจาก Table SUP เพื่อการแสดงผล
                                    // ถ้าตรงกัน ให้ OPTION นั้นมี Properties เป็น SELECTED
                                    // ถ้าไม่ตรงก็ไม่ต้องแสดงค่าอะไร
                                    if ($list_array['sup_id']==$master_array['sup_id'])
                                        $sel = ' selected ';
                                    else
                                        $sel = '';
                                    ?>
                                        <!-- Value คือค่าที่ใช้ทำงานของตัว input  (อยู่ใน Option)-->
                                        <!-- ค่าที่นำมาแสดงผลจะแสดงระหว่าง Tag OPTION -->
                                        <option <?=$sel?> value="<?=$list_array['sup_id']?>" ><?=$list_array['sup_name']?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                   
                    <div class="col s12 m6 l3 input-field">
                        <input type="text" id="buy_date" name="buy_date" class="datepicker" value="<?=$master_array['buy_date']?>">
                        <label for="buy_date">วันที่</label>
                    </div>
                    <!-- <div class="col s5 m4 l2 input-field">
                        <input type="number" id="buy_qty" name="buy_qty" value="" >
                        <label for="buy_qty">จำนวน</label>
                    </div>
                    <div class="col s5 m4 l2 input-field">
                        <input type="number" id="buy_money" name="buy_money" value="" >
                        <label for="buy_money">ยอดเงิน</label>
                    </div> -->
                    
                    <?php if($master_array['buy_recv']!='Y') { ?> 
                    <div class="col s2 m4 l1 input-field">
                        <button type="submit" class="btn "  >บันทึก</button>
                    </div>
                    <?php } ?>

                    <!-- ถ้ามีข้อมูลเอกสารแล้ว ให้แสดง Button เพื่อทำการลบเอกสาร -->
                    <!-- แต่ถ้ามีการยืนยันรับแล้ว ก็ไม่ให้แสดงการลบเอกสาร -->
                    <?php if(isset($master_array['buy_id']) && $master_array['buy_recv']!='Y' ) { ?>
                    <div class="col s1 input-field">
                        <!-- การลบจะไปเรียก JAVASCRIPT เพื่อทำการยืนยันว่าจะลบจริงหรือไม่ -->
                        <!-- โดยส่งค่า รหัสเอกสาร ไปกับ function ของ JAVA -->
                        <button class="btn-floating red darken-2 right" type="button" onclick="cf_del_master('<?=$master_array['buy_id']?>')"  >
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </form>

                        
        <!-- ส่วนบันทึกรายละเอียด item  -->
        <!-- สร้าง Form มาอีกส่วนสำหรับบันทึก buy_item -->
        <!-- ถ้ามีการยืนยันรับสินค้าแล้ว ก็ไม่ให้มีการเพิ่มเข้าไปได้ -->
        <?php if(isset($master_array['buy_id']) && $master_array['buy_recv']!='Y') { ?> 
        <form action="buy_add_item.php" method="POST">
            <div class="row input-field">
                <div class="col s6 m4 l4">
                    <!-- สร้าง input แบบ HIDDEN เพื่อ ส่ง Master KEY ไป Page ที่ทำการ Update ด้วย-->
                    <input type="hidden" name="buy_id" id="buy_id" value="<?=$master_array['buy_id']?>">    
                    <!-- สร้าง input text แบบ Datalist เพื่อให้พิมพ์รายการแสดงให้เลือกได้  -->
                    <!-- แต่ข้อเสียของ input แบบนี้คือจะแสดงค่าที่จะบันทึกจริง (ส่วนมากจะเป็น id) -->
                    <input type="text" name="item_id" id="item_id" list="item_list" >
                    <label for="item_id">สินค้า</label>
                    <!-- ตัว Datalist กับ input จะระบุผ่าน id -->
                    <!-- และแสดงวน Loop เหมือน SELECT -->
                    <!-- แต่ไม่ต้องตรวจสอบค่าให้ตรงกันระหว่าง list กับ ค่าที่อ่านได้ เพราะ ค่าที่ได้จะแสดงใน Textbox ผ่าน Properties value แล้ว -->
                    <datalist id="item_list">
                        <?php
                            $sql_list = "SELECT * FROM item ORDER BY item_name";
                            $res_list = $db->query($sql_list);
                            while($list_array=$res_list->fetch(PDO::FETCH_ASSOC))
                            {
                                if ($list_array['item_id']==$master_array['item_id'])
                                ?>
                                    <option  value="<?=$list_array['item_id']?>" ><?=$list_array['item_name']?></option>
                                <?php
                            }
                        ?>
                    </datalist>
                </div>
                <div class="col s2 m2 l2">
                    <!--  input Type number จะรับค่าเฉพาะตัวเลข -->
                    <!-- Properties Min MAx กำหนดค่าสูงสุดตำสุด -->
                    <!-- Properties Step ถ้าไม่กำหนดจะเพิ่มค่าที่ละ 1 และไม่รับค่าจุด ทศนิยม -->
                    <input type="number" name=price id="price" min="0" step="any" max="10000" required>
                    <label for="price">ราคา</label>           
                </div>
                <div class="col s2 m2 l2">
                    <input type="number" name=qty id="qty" min="0" step="any" max="10000" required>
                    <label for="qty">จำนวน</label>           
                </div>
                <div class="col s1">
                    <button class="btn-floating purple darken-2" type="submit"><i class="material-icons">done</i></button>
                </div>
                
            </div>
        </form>
        <?php } ?>

        <!-- สร้าง Table แสดงส่วน Detail (buy_item) -->
        <table class="table striped highlight">
            <tr>
                <th></th>
                <th colspan="2">สินค้า</th>
                <th>ราคา</th>
                <th class="center-align">จำนวน</th>
                <th>รวม</th>
                <th>
                </th>
            </tr>
            
        <?php
            // กำหนดค่าเริ่มต้น จำนวนแถว สินค้า(ทั้งหมด)รวม ยอดเงินรวม(ทั้งเอกสาร)
            $i=0;
            $sqty=0;
            $smoney=0;
            // สร้าง Query แสดงรายละเอียดสินค้าใน เอกสาร
            // join กับตาราง item เพื่ออ่านชื่อของสินค้า (item_name)
            // เชือมกับตาราง Master ผ่าน buy_id -->$master_array['buy_id']
            $sql_dtl = "    SELECT buy_item.*,item.item_name  
                            FROM buy_item  LEFT JOIN item ON buy_item.item_id=item.item_id
                            WHERE  buy_id = '".$master_array['buy_id']."' ";
            $res_dtl = $db->query($sql_dtl);
            // วน Loop แสดงสินค้าที่อยู่ในเอกสาร
            while($dtl_array = $res_dtl->fetch(PDO::FETCH_ASSOC))
            {
                $i++;
        ?>
                <tr>
                    <td><?=$i?></td>
                    <td>
                        <?=$dtl_array['item_id']?>
                    </td>
                    <!-- แสดงชื่อของสินค้า -->
                    <td><?=$dtl_array['item_name']?></td>
                    <!-- แสดงข้อมูลตัวเลขแบบมี comma คั่น  ผ่าน function number_format(ค่าที่จะแสดง,จุดทศนิยม)-->
                    <td><?=number_format($dtl_array['price'])?></td>
                    
                    <td class="center-align">   
                        <!-- แสดงจำนวนสินค้าปัจจุบัน ในเอกสาร -->
                        <?=$dtl_array['qty']?>
                    </td>
                    
                    <!-- แสดงยอดเงินรวมของสินค้าปัจจุบัน -->
                    <td><?=number_format($dtl_array['price']*$dtl_array['qty'])?></td>
                    <!-- สร้าง Link เพิ่อไปลบรายการสินค้าออก -->
                    <!-- ถ้ามีการยืนยันรับสินค้าแล้วก็ไม่ให้ลบรายการ -->
                    <td class="center-align">
                        <?php if($master_array['buy_recv']!='Y') { ?> 
                        <a href="#" onclick="cf_del_dtl('<?=$dtl_array['item_id']?>','<?=$dtl_array['buy_id']?>')" class="red-text"><i class="material-icons">clear</i></a>
                        <?php } ?>
                    </td>
                </tr>
        <?php
                // คำนวนหายอดรวมของทุกสินค้า
                $sqty=$sqty+$dtl_array['qty'];
                // คำนวนหายอดเงินรวมของทั้งเอกสาร
                $smoney=$smoney+($dtl_array['price']*$dtl_array['qty']);
            }
        ?>
            <tr class="pink-text">
                <td colspan="4" class="right-align">ยอดรวม</td>
                <td class="center-align"><?=$sqty?></td>
                <td><?=number_format($smoney)?></td>
                <td class="center-align"></td>
            </tr>
        </table>        
    </div>
    
    <?php
        include "menuscript.php";
    ?>
</body>
</html>
