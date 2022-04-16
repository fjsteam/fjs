<?php
    session_start();
    include "connector.php";


    $sql_logout_time="UPDATE user_date_login_user SET date_time_logout = CURRENT_TIMESTAMP() where user_id = '".$_SESSION['u_id']."'";

    $db->query($sql_logout_time);

    session_destroy();
    ?>
        <script>
            window.location="index.php";
        </script>
    <?php
?>