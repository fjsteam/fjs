<?php
    session_start();
    include "connector.php";

    if(isset($_POST['u_id']) && $_POST['u_pwd'] == $_POST['u_cf_pwd'])
    {
        if($_POST['edit']=='Y')
        {
            //UPDATE
            $sql_update = " UPDATE user 
                            SET u_id='".$_POST['u_id']."',
                                u_name='".$_POST['u_name']."',
                                u_pwd='".$_POST['u_pwd']."',
                                u_desc='".$_POST['u_desc']."',
                                u_level='user' 
                            WHERE u_id = '".$_POST['old_u_id']."' ";
        }
        else
        {
            //INSERT
                $sql_update = "INSERT  INTO user (
                                                    u_id,
                                                    u_pwd,
                                                    u_name,
                                                    u_desc,
                                                    u_level
                                                )
                                        VALUES (
                                                    '".$_POST['u_id']."',
                                                    '".$_POST['u_pwd']."',
                                                    '".$_POST['u_name']."',
                                                    '".$_POST['u_desc']."',
                                                    'user'

                                                ) ";
            
        }
        
        
        if($res_update = $db->query($sql_update))
        {
            $thefile="u_img/".$_POST['old_u_id'].".jpg";
            // is_file() เป็นการตรวจสอบว่ามี file ตามที่ระบุหรือไม่ 
			// ถ้ามี Return true  , ไม่มี return false
            if(is_file($thefile))
            {
                $newfile = "u_img/".$_POST['u_id'].".jpg";
                rename($thefile,$newfile);
            }

            $_SESSION['u_id']=$_POST['u_id'];
            $_SESSION['u_name']=$_POST['u_name'];
            $_SESSION['u_level']="user";
            ?>
                <script>
                    window.location="u_show.php?u_id=<?=$_POST['u_id']?>"
                </script>
            <?php
        }
        else
        {
            echo $sql_update;
            ?>
                <script>
                    alert("บันทึกผิดพลาด");
                    // window.history.back();
                </script>
            <?php
        }
    }
    else
    {
        //เตือน ย้อนกลับ
        ?>
            <script>
                alert("ข้อมูลไม่ครบหรือรหัสผ่านไม่ตรงกัน");
                window.history.back();
            </script>
        <?php
    }    

    

    

    
?>