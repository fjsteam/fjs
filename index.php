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
                                <i class="material-icons ">more_horiz</i>
                            </a>
                            <?php if ($_SESSION['u_level'] != 'admin') { ?>
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
        <!--row -->
    </div>
    <!--Container -->
    <div class="container">
        <h4 class="pink-text">สินค้า</h4>

        <div class="row">
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/chelsea_1.png" alt="it001" height="250px" data-position="right" data-tooltip="1990"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it001">
                            <!-- <i class="material-icons ">Chelsea</i> -->
                            <i>Chelsea</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/chelsea_2.png" alt="it002" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it002">
                            <!-- <i class="material-icons ">Chelsea</i> -->
                            <i>Chelsea</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/arsenal_1.jpg" alt="it003" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it003">
                            <!-- <i class="material-icons ">Arsenal</i> -->
                            <i>Arsenal</i>
                        </a>
                    </div>
                </div>



            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/arsenal_2.png" alt="it004" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it004">
                            <!-- <i class="material-icons ">Arsenal</i> -->
                            <i>Arsenal</i>
                        </a>
                    </div>
                </div>



            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/liverpool_1.jpg" alt="it005" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it005">
                            <!-- <i class="material-icons ">Liverpool</i> -->
                            <i>Liverpool</i>
                        </a>
                    </div>
                </div>



            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/liverpool_2.png" alt="it007" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it007">
                            <!-- <i class="material-icons ">Liverpool</i> -->
                            <i>Liverpool</i>
                        </a>
                    </div>
                </div>



            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/manu_1.png" alt="it008" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it008">
                            <!-- <i class="material-icons ">Manchester united</i> -->
                            <i>Manchester united</i>
                        </a>
                    </div>
                </div>



            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/manu_2.png" alt="it009" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it009">
                            <!-- <i class="material-icons ">Manchester united</i> -->
                            <i>Manchester united</i>
                        </a>
                    </div>
                </div>



            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/mancity_1.png" alt="it010" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it010">
                            <!-- <i class="material-icons ">Manchester city</i> -->
                            <i>Manchester city</i>
                        </a>
                    </div>
                </div>



            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/mancity_1.png" alt="it011" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it011">
                            <!-- <i class="material-icons ">Manchester city</i> -->
                            <i>Manchester city</i>
                        </a>
                    </div>
                </div>



            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/spur_1.jpg" alt="it12" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it12">
                            <!-- <i class="material-icons ">Spur</i> -->
                            <i>Spur</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col l3 m4 s6">
                <div class="card">
                    <div class="card-image">
                        <div class="material-placeholder"><img class="materialboxed tooltipped" src="./it_img/spur_2.jpg" alt="it13" height="250px" data-position="right" data-tooltip="1990 bath"></div>
                    </div>
                    <!-- <div class="card-content">
                        </div> -->
                    <div class="card-action">
                        <a href="item_show.php?item_id=it13">
                            <!-- <i class="material-icons ">Spur</i> -->
                            <i>Spur</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--row -->
    </div>
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