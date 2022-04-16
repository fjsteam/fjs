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
    <link rel="icon" href="./img/Football Soccer Club Logo1.png">
    <style>
        img.material-placeholder{
            width: 25%;
            margin-left: auto;
            left: auto;
            right: auto;
        }
    </style>
</head>

<body>
    
    <?php
    include "menuheader.php";
    ?>  
    <div class="slider">
          <ul class="slides">
            <li> 
              <img src="./img/chelsea.jpg"style="background-size: contain;">
              <div class="caption center-align" style="background-color: rgba(128, 128, 128, 0.4);"  >
              
                    <h3>Chelsea</h3>
                    <h5 class="light grey-text text-lighten-3">2021/2022</h5>
              
              </div>
            </li>
            <li>
              <img src="./img/mancity.jpeg" style="background-size: contain;">
              <div class="caption center-align" style="background-color: rgba(128, 128, 128, 0.4);" >
                <h3>Manchester City</h3>
                <h5 class="light grey-text text-lighten-3">2021/2022</h5>
              </div>
            </li>
            <li>
              <img src="./img/liverpool.jpeg" style="background-size: contain;">
              <div class="caption center-align" style="background-color: rgba(128, 128, 128, 0.4);" >
                <h3>liverpool</h3>
                <h5 class="light grey-text text-lighten-3">2021/2022</h5>
              </div>
            </li>
            <li>
              <img src="./img/manu.jpg" style="background-size: contain;">
              <div class="caption center-align" style="background-color: rgba(128, 128, 128, 0.4);" >
                <h3>Manchester United</h3>
                <h5 class="light grey-text text-lighten-3">2021/2022</h5>
              </div>
            </li>
            <li>
              <img src="./img/Arsenal.webp" style="background-size: contain;">
              <div class="caption center-align" style="background-color: rgba(128, 128, 128, 0.4);" >
                <h3>Arsenal</h3>
                <h5 class="light grey-text text-lighten-3">2021/2022</h5>
              </div>
            </li>
          </ul>
        
        </div>
        <br>
        <br>    

        <div class="container">
        <h4 class="pink-text">สินค้า</h4>
        <!-- <h4 class="pink-text">สินค้า</h4> -->

        <div class="row">
            <?php
            $sql_data = "SELECT * FROM item ORDER BY item_id ";
            $res_data = $db->query($sql_data);
            while ($data_array = $res_data->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <div class="col l3 m4 s6">
                    <div class="card">
                        <div class="card-image">
                            <img class="materialboxed tooltipped" height="250px" width="200px"
                                src="./it_img/<?= $data_array['item_img'] ?>" 
                                alt="<?= $data_array['item_id'] ?>" width="100px" 
                                data-position="right" 
                                data-tooltip="<?= $data_array['item_price'] ?>">
                        </div>
                        <!-- <div class="card-content">
                        </div> -->
                        <div class="card-action">
                            <a href="item_show.php?item_id=<?= $data_array['item_id'] ?>">
                                <?= $data_array['item_name'] ?>
                            </a>
                            <?php if ($_SESSION['u_level'] != 'admin'and$_SESSION['u_level']!='') { ?>
                                <a href="cart_add.php?item_id=<?= $data_array['item_id'] ?>">
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
        </div>
        <!--row -->
    </div>
    <!--Container -->

    <?php
    include "menuscript.php";
    ?>
</body>
<footer class="page-footer indigo darken-4">
          <div class="container">
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2022 All rights reserved.
Theme: ColorMag by FJS
            </div>
          </div>
</footer>
</html>