<?php
    session_start();
    include "connector.php";

    session_destroy();
    ?>
        <script>
            window.location="index.php";
        </script>
    <?php
?>