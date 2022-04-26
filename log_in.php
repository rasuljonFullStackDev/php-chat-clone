<?php include "conn.php"; 

$sql = "SELECT * FROM `chat_data`";
$result = mysqli_query($con,$sql);
$erorr = [];

if(isset($_POST['submit'])){
    // echo "data submit";
    if(empty($_POST['email'])){
        $erorr['email'] = "erorr not email";
    } 
    if(empty($_POST['password'])){
        $erorr['password'] = "erorr not password";
    } 
    if(empty($erorr)){
        foreach ($result as $key => $res) {
            if($res['email'] == $_POST['email'] && $res['password'] == $_POST['password']){
               
                $first_name = $res['firstname'];
                $last_name = $res['lastname'];
                $email = $res['email'];
                $email = $res['email'];
                $imgPath = $res['image'];
            
                header("location:chat_write.php?first_name=$first_name?last_name=$last_name?email=$email?imgPath=$imgPath");
                
            } else
            {
                $erorr['log_in'] = "Log in erorr";
            }
            
        }
    }
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegramm</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <div class="sign_in container">
        <div class="logo">
            <img src="./image/Vector.svg" alt="">
            <p>Telegram</p>
            <p style="font-size: 18px;color: crimson !important; font-weight: 500; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"><?php echo $erorr['log_in'] ?? ""; ?></p>
        </div>
        <form action="" method="post" >
            <p>Email <span style="font-size: 14px;color: crimson !important; font-weight: 500; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;" class="erorr"><?php echo $erorr['email'] ?? ""; ?></span></p>
            <input type="email" placeholder="email" name="email"  class="log_in">
            <p>Password <span style="font-size: 14px;color: crimson !important; font-weight: 500; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;" class="erorr"><?php echo $erorr['password'] ?? ""; ?></span></p>
            <input type="password" placeholder="password" name="password"  class="log_in">

           <button type="submit" name="submit" class="btn_log_in">sign in</button>
           <a href="sign_in.php" class="log_in_link">log in</a>

        </form>
    </div>
</body>

</html>