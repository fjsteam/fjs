<?php
    session_start();
    include "connector.php";

    
    $sql_data="SELECT * FROM user WHERE u_id = '".$_POST['username']."' ";
    $res_data=$db->query($sql_data);
    $data_count=$res_data->rowCount();

    if($data_count!=0)
    {
        // echo "username-->".$_POST['username']."<br>";
        // echo "password-->".$_POST['password']."<br>";
        $data_array=$res_data->fetch(PDO::FETCH_ASSOC);
        if($data_array['u_pwd']==$_POST['password'])
        {
            $_SESSION['u_id']=$data_array['u_id'];
            $_SESSION['u_name']=$data_array['u_name'];
            $_SESSION['u_level']=$data_array['u_level'];

            $user_id=$data_array['u_id'];

            $sql_login_time="INSERT INTO user_date_login_user(user_id,date_time_login,date_time_logout) 
                                VALUES ('" .$_SESSION['u_id']. "',
                                        " .'CURRENT_TIMESTAMP()'. ",
                                        " .'CURRENT_TIMESTAMP()'. "
                                        );";
            $db->query($sql_login_time);
            
            ?>
                <script>
                   window.location="u_show.php?u_id=<?=$_SESSION['u_id']?>";
                </script>
            <?php
        }
        else
        {
            ?>
                <script>
                    alert("ข้อมูลผิดพลาด");
                    window.history.back();
                </script>
            <?php
        }
    }
    else
    {
        ?>
            <script>
                alert("ข้อมูลผิดพลาด");
                window.history.back();
            </script>
        <?php
    }
?>