<?php
    session_start();
    include "connector.php";
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KU Computer Shop</title>
    <link rel="stylesheet" href="./css/materialize.min.css">
    <link rel="stylesheet" href="./iconfont/material-icons.css">
    <link rel="icon" href="./img/kulogo.ico">
</head>

<body>
    <?php
        include "menuheader.php";
    ?>
    <div class="container">
        <h4 class="pink-text">สินค้า</h4>

        <div class="row">
            <?php
            $sql_data = "SELECT * FROM item ORDER BY item_id ";
            $res_data = $db->query($sql_data);
            while ($data_array = $res_data->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <div class="col l3 m4 s6">
                    <div class="card">
                        <div class="card-image">
                            <img class="materialboxed tooltipped" 
                                src="./it_img/<?= $data_array['item_img'] ?>" 
                                alt="<?= $data_array['item_id'] ?>" width="100px" 
                                data-position="right" 
                                data-tooltip="<?= $data_array['item_price'] ?>">
                        </div>
                        <!-- <div class="card-content">
                        </div> -->
                        <div class="card-action">
                            <a href="item_show.php?item_id=<?=$data_array['item_id']?>">
                                <i class="material-icons ">more_horiz</i>
                            </a>
                            <?php if($_SESSION['u_level']!='admin') { ?> 
                            <a href="cart_add.php?item_id=<?=$data_array['item_id']?>" >
                                <i class="material-icons right">shopping_cart</i>
                            </a>
                            <?php } ?>
                        </div>
                    </div>

                    

                </div>
            <?php
            }
            ?>
        </div>
        <!--row -->
    </div>
    <!--Container -->

    <?php
        include "menuscript.php";
    ?>
</body>

</html>