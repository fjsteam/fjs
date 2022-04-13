<?php
    session_start();
    include "connector.php";

    if(isset($_POST['u_id']) && $_POST['u_pwd'] == $_POST['u_cf_pwd'])
    {
        //ทำงาน
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
        if($res_update = $db->query($sql_update))
        {
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
            ?>
                <script>
                    alert("บันทึกผิดพลาด");
                    window.history.back();
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