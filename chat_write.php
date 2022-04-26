<?php
        include "conn.php";
        $data_name = $_GET['first_name'] ?? "";
        $path = explode("?",$data_name) ?? "";
        $first_name = $path[0] ?? $_POST['first_name'];
        $last_name = substr($path[1],stripos($path[1],'=')+1) ?? $_POST['last_name'] ;
        $email = substr($path[2],stripos($path[2],'=')+1) ?? "" ;
        $imgPath = substr($path[3],stripos($path[3],'=')+1) ??  $_POST['imgPath'];

        $sql = "SELECT * from chat_data";
        $res = mysqli_query($con,$sql);
        $member = 0;
            foreach ($res as $key => $resm) {
                # code...
                if($resm['email'] !="1"){
                    ++$member;
                }
            }

        if(isset($_POST['send_massage'])){
            if(empty($_POST['massage'])  ){
                 $send_images = $_FILES['send_file'] ?? "";
                // if(empty($send_images["name"])){



                //     $massage = $_POST['massage'];
                //     $data = date('H:s'); 
                //     $send_images = $_FILES['send_file'];
                //     $send_file = 'send_file/'.$send_images["name"];
                //     move_uploaded_file($send_images["tmp_name"],$send_file);
                //     $sql_write = "INSERT INTO  chat_data (firstname,lastname,email,password,image,massage,data,file_send) 
                //     VALUES ('$first_name','$last_name','1','1','$imgPath','$massage','$data','$send_file')";
                //     $result_send = mysqli_query($con,$sql_write);
                //     if($result_send){
                //         header("location:chat_write.php?first_name=$first_name?last_name=$last_name?email=$email?imgPath=$imgPath");
                //     }    
                // }
                // else{
                //     echo "not erorr";
                // }
                
            } else {
                $massage = $_POST['massage'];
                $data = date('H:s'); 
                $send_images = $_FILES['send_file'];
                $send_file = 'send_file/'.$send_images["name"];
                move_uploaded_file($send_images["tmp_name"],$send_file);
                $sql_write = "INSERT INTO  chat_data (firstname,lastname,email,password,image,massage,data,file_send) 
                VALUES ('$first_name','$last_name','1','1','$imgPath','$massage','$data','$send_file')";
                $result_send = mysqli_query($con,$sql_write);
                if($result_send){
                    header("location:chat_write.php?first_name=$first_name?last_name=$last_name?email=$email?imgPath=$imgPath");
                } 
            } 
            echo "<pre>";
            var_dump( $_FILES['send_file'] ?? ""     );
            echo "</pre>";
            echo $_FILES['send_file']["type"];  
        
        }
       

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
   
    <div class="container" style=" position: relative;">
        <div class="chat-write-head" style=" display: block; height:107px;  overflow: hidden; transition: all .3s ease-in-out;">
            <div class="chat-m" style="display:flex;justify-content: space-between;" >
                <div class="chat_box">
                <img src="<?php echo "$imgPath"; ?>" class="men" alt="" style="cursor:pointer; width:35px; height:35px;">    
                <div class="email-collection">
                <p><?php echo $last_name."  ".$first_name ; ?>  </p>
                <p><?php echo $member; ?> members</p>
                </div>   
                </div>
                <div class="chat_box">
                <div>
                    <a href="log_in.php" style="background:crimson; box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2), 0px 1px 3px rgba(0, 0, 0, 0.1);border-radius: 8px; padding: 10px 16.5px; font-weight: 500; font-size: 14px; line-height: 16px; letter-spacing: 0.5px; color: #FFFFFF; border: none;margin: 10px;}">LOGOUT</a>
                </div>
                </div>
            </div>
            <div class="chat-members" style="overflow-y: auto; margin-top:20px;  height: 100%;">
             <?php 
                         echo "
                         <div style='display:flex;gap:30px;align-items:center; margin:15px 0;'>
                         <img src=".$imgPath." style='   
                         width: 28px;
                         height: 28px;
                         border-radius: 50%;
                         margin-right:20px;
                         '>
                         <p style='color:cyan;'>
                         ".$first_name."    ".$last_name."
                         </p>
                         </div>
                         ";


                    foreach ($res as $key => $res_member) {
                        if(empty($res_member['massage']) && $res_member["firstname"]!=$first_name && $res_member["lastname"]!=$last_name  ){
                            echo "
                            <div style='display:flex;gap:30px;align-items:center; margin:15px 0;'>
                            <img src=".$res_member['image']." style='   
                            width: 28px;
                            height: 28px;
                            border-radius: 50%;
                            margin-right:20px;
                            '>
                            <p style='color:cyan;'>
                            ".$res_member['firstname']."    ".$res_member['lastname']."
                            </p>
                            </div>
                            ";
                        }
                    }
                
                ?>


            </div>        
        </div>
        <div class="chat-write-body" style="overflow-y: auto;" > 
        <?php        
            foreach ($res as $key => $res_data) {
                if(!empty($res_data['massage'])){
                    if($res_data["firstname"]!=$first_name && $res_data["lastname"]!=$last_name ){
                        if(empty($res_data['image'])){
                            echo "data";
                            $imgPaths = $res_data['image'];
                        }   
                        echo "
                        <div class='write-chat' style='position: relative; padding: 22px 10px;  width:300px; margin:13px 0;'>
                        <span style=' position: absolute; top:2px; left:30px; color:crimson;font-weight:500; font-size: 15px;' >".$res_data["firstname"]."     ".$res_data["lastname"]."</span>
                        <p>".$res_data['massage']."</p>
                        <span class='clock' style='position: absolute; right: 5px; bottom:5px; color:white;'>".$res_data['data']."</span>
                        <img src=".$res_data['image']." style='   
                        width: 28px;
                        height: 28px;
                        border-radius: 50%;
                        margin-right: 8px;
                        position: absolute; left: -5px; top:-5px;
                        '>
                        </div>";
                    } else{
                        echo "
                        <div class='send-chat' style='position: relative; padding: 22px 10px; width:300px; margin:13px 0;'>
                        <span style=' position: absolute; top:2px; right:30px; color:cyan;font-weight:500; font-size: 15px;' >".$res_data["firstname"]."     ".$res_data["lastname"]."</span>
                        <p>".$res_data['massage']."</p>
                        <span class='clock' style='position: absolute; right: 5px; bottom:5px; color:white;'>".$res_data['data']."</span>
                        <img src=".$imgPath." style='    width: 28px;
                        height: 28px;
                        border-radius: 50%;
                        margin-right: 8px;
                        position: absolute; right: -15px; top:-5px
                        '>
                            </div>";                   
                    }
                };            
            }        
        ?>  
        </div>
        <form class="send-massage" method="post" enctype="multipart/form-data">
            <input type="file" style="position: absolute;width:25px;height:40px; overflow: hidden; left:8px; z-index:11;opacity: 0;   padding: 0" class="file" name="send_file">
            <button  style="padding:5px; background: cyan; display:block;margin-left:auto;  top: 18px; left: 12px; " >F</button>
            <input type="text" style="margin-left:20px; width:95%;" placeholder="Message..." name="massage">
            <input type="hidden" name="first_name" value="<?php echo $first_name; ?>">
            <input type="hidden" name="last_name" value="<?php echo $last_name; ?>">
            <input type="hidden" name="imgPath" value="<?php echo $imgPath; ?>">
            <button type="submit" name="send_massage" ><img src="image/Ellipse.png" alt=""></button>
        </form>
    </div>
    <?php ?>
</body>
<script>
    const men = document.querySelector(".men");
    const file = document.querySelector(".file"), 
    file_send = document.querySelector(".file_send");
    console.log(men);
    let bol = true;
    men.addEventListener('click',(e)=>{
        console.log();
       if(bol){
        e.target.parentElement.parentElement.parentElement.style.height = "100%";
        e.target.parentElement.parentElement.parentElement.style.position = "absolute";
        e.target.parentElement.parentElement.parentElement.style.top = "0";
        e.target.parentElement.parentElement.parentElement.style.zIndex = "1";
        e.target.parentElement.parentElement.parentElement.style.alignItems = "baseline";

        
        bol = false;
       } else {
        {
        e.target.parentElement.parentElement.parentElement.style.height = "107px";
        e.target.parentElement.parentElement.parentElement.style.position = "";
        e.target.parentElement.parentElement.parentElement.style.top = "";
        e.target.parentElement.parentElement.parentElement.style.alignItems = "";
        e.target.parentElement.parentElement.parentElement.style.zIndex = "1";
        bol = true;
       }
       }
    });
    
</script>
</html>