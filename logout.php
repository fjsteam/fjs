<?php
    session_start();
    include "connector.php";

    session_destroy();
    session_start();
    $_SESSION['u_level']='';
    ?>
        <script>
            window.location="index.php";
        </script>
    <?php
?>