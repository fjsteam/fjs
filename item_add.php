<?php
    session_start();
    include 'connector.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <link rel="icon" href="img/Football Soccer Club Logo1.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$_SESSION['u_name']?></title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">
</head>
<body>
    <?php
        include "menuheader.php";
    ?>
    <?php
        ini_set('memory_limit', '30M'); //กำหนดการจองพื้นที่หน่วยความจำ
        
        $theFile=basename($_FILES['u_img']['name']); //ระบุตำแหน่งของ File (ของเครื่องคอมพิวเตอร์) ที่จะอ่านมาทำการ Upload
        $ext = pathinfo($theFile, PATHINFO_EXTENSION); //นามสกุลของ file ต้นทาง (ไม่มีจุด)
        echo'<script>
        alert("'.$theFile.'")
        
    </script>' ;
    echo'<script>
    alert("'.$ext.'")
    
</script>' ;
        $uploaddir = 'it_img/'; //กำหนด Directory ของ Server ที่จะเอารูปไปเก็บ
        $uploadfile = $uploaddir.$theFile; 
        //ตั้งชื่อรูปที่จะเก็บ เป็น "ค่าของu_id.jpg" แล้วมาต่อกับ Directory ที่กำหนด เป็นข้อมูลการบันทึกทั้งหมด
        
        if(move_uploaded_file($_FILES['u_img']['tmp_name'], $uploadfile))
        {
            echo'<script>
            alert("upload success")
            
        </script>' ;
        }
        else{
            echo'<script>
    alert("upload error")
    
</script>' ;
        }
        

        $data_id_max="SELECT count(item_id) as countid from item ";
        $data_id_max=$db->query($data_id_max);
        $data_array = $data_id_max->fetch(PDO::FETCH_ASSOC);
        $id_max=$data_array['countid']+1;
        echo'<script>
                    alert("'.$id_max.'")
                    
                </script>' ;
        //ทำงาน
        try{
                    $sql_update = "INSERT  INTO item (
                        item_id,
                        item_name,
                        item_price,
                        cur_stk,
                        item_rem,
                        item_img
                    )
            VALUES (
                        'pd".$id_max."',
                        '".$_POST['name_product']."',
                        '".$_POST['price_product']."',
                        '".$_POST['cur_product']."',
                        '".$_POST['desc_product']."',
                        '".$theFile."'
            );";
                    $res_update = $db->query($sql_update);
                    echo'<script>
                    alert("'.$theFile.'+Success")
                    window.location="item_list.php"
                </script>' ;
        }
        catch (Exception $e){
           echo'<script>
           alert("Error")
           
       </script>' ;
        }
        ?>
         
                                       
                                    <?php
        
    
    
     ?>
    
    
    <?php
        include "menuscript.php";
    ?>
</body>
</html>