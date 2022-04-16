<?php
    session_start();
    include 'connector.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <link rel="icon" href="img/logo.ico" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$_SESSION['u_name']?></title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Mitr', sans-serif;
        }
    </style>
</head>
<body>
    <?php
        include "menuheader.php";
    ?>
    <div class=container>
    
        <form action="item_list.php" method="GET">
            <div class='row'>
            
                <h4 class="col s11 m6 l4  input-field ">
                   
                   <input id="findtext" name="findtext" type="text" class="validate">
                   <label for="findtext">ค้นหาสินค้า</label>
               </h4>
               <h4 class="col s1 ">
                   <button type="submit" class="btn-floating"><i class="material-icons">search</i></button>
               </h4>
            </div>
            
            
               
            
        </form>
    </div>
          
        
    
    <div class="container" id="item_pic">
    <h4 class="col s7 m5 pink-text">
                    ข้อมูลผู้ใช้
                    
                </h4>
        <table class="striped highlight">
            <tr class="green lighten-5">
                <th></th>
                <th colspan="2">ชื่อ นามสกุล</th>
                <th>ประเภทผู้ใช้</th>
                <th>หมายเหตุ</th>
            </tr>
        
            <?php
                $sql_data = "   SELECT *  
                                FROM  user  
                                WHERE u_name LIKE  '%".$_GET['findtext']."%'
                                                           OR  u_level LIKE  '%".$_GET['findtext']."%'
                                                           OR  u_desc LIKE  '%".$_GET['findtext']."%'
                                                        
                                
                                ";
                // echo  $sql_data;           
                $res_data = $db->query($sql_data);

                $j=0;
                //วนลูปแสดงผล
                while ($data_array = $res_data->fetch(PDO::FETCH_ASSOC)) 
                {
                    $j++;
                    ?>
                        <tr>
                            <td>
                                <?=$j?>
                            </td>
                            <td>
                                <?=$data_array['u_name']?>
                            </td>
                            <td>
                                <?=$data_array['u_level']?>
                            </td>
                            <td>
                                <?=$data_array['u_desc']?>
                            </td>
                            
                        </tr>  
                    <?php
                }
            ?> 
            
            </table>
        
        
    </div>
    
    <?php
        include "menuscript.php";
    ?>
</body>
</html>