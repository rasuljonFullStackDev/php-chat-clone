<?php include "conn.php";


$erorr = [];

if(isset($_POST['submit'])){
    $random = "qwertghjDFyuiop1234567zxcvTYUIbnmQWEROPASfGHJKLZX89asdklCVBNM";
    $ranFolder = [];
    for ($i=0; $i < random_int(4,10) ; $i++)
    { 
    $ran =  random_int(1,58);   
    $ranFolder[] =$random[$ran];
    }
     $item =  implode('',$ranFolder);
    // mkdir($item);

    if(empty($_POST['first_name'])){
        $erorr['first_name'] = "erorr not firstname";
    } 
    if(empty($_POST['last_name'])){
        $erorr['last_name'] = "erorr not last_name";
    } 
    if(empty($_POST['email'])){
        $erorr['email'] = "erorr not email";
    } 
    if(empty($_POST['password'])){
        $erorr['password'] = "erorr not password";
    } 
    if(substr($_FILES['image']["type"],0,stripos($_FILES['image']["type"],'/')) !="image" ){
        $erorr['image'] = "erorr not image";
    } 
// && ($_FILES['image']["type"] ==="image/png" || $_FILES['image']["type"] ==="image/jpg") 
    if(empty($erorr) ){
        echo "result";
           $img = $_FILES['image'];
           $first_name = $_POST['first_name'];
           $last_name = $_POST['last_name'];
           $email = $_POST['email'];
           $password = $_POST['password'];
           $imgPath = 'userImg/'.$img['name'];           
        //    $folder = mkdir($item);
        //    $imgPath = 'userImg/'.mkdir($item).'/'.$img['name'];
         
           move_uploaded_file($img["tmp_name"], $imgPath );

           $sql = "INSERT INTO  chat_data (firstname,lastname,email,password,image) 
           VALUES ('$first_name','$last_name','$email','$password','$imgPath')
           ";

           $result = mysqli_query($con,$sql);
          
           
        if($result){
            header("location:chat_write.php?first_name=$first_name?last_name=$last_name?email=$email?imgPath=$imgPath");

        }






    } else {
        $erorr['image'] = "erorr not image";
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
        </div>
        <form method="post" enctype="multipart/form-data" >
            <p>first name <span style="font-size: 14px;color: crimson !important; font-weight: 500; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"  class="erorr"><?php echo $erorr['first_name'] ?? "" ; ?></span></p>
            <input type="text" placeholder="first name" name="first_name" value="<?php echo $first_name ?? ""; ?>" class="log_in">
            <p>last name <span style="font-size: 14px;color: crimson !important; font-weight: 500; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;" class="erorr"><?php echo $erorr['last_name'] ?? "first_name"; ?></span></p>
            <input type="text" placeholder="last name" name="last_name" class="log_in">
            <p>Email <span style="font-size: 14px;color: crimson !important; font-weight: 500; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;" class="erorr"><?php echo $erorr['email'] ?? ""; ?></span></p>
            <input type="email" placeholder="email" name="email" class="log_in">
            <p>Password <span style="font-size: 14px;color: crimson !important; font-weight: 500; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;" class="erorr"><?php echo $erorr['password'] ?? ""; ?></span></p>
            <input type="password" placeholder="Password" name="password" class="log_in">
            <p>image <span style="font-size: 14px;color: crimson !important; font-weight: 500; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;" class="erorr"><?php echo $erorr['image'] ?? ""; ?></span></p>
            <input type="file" name="image" id="">
           <button type="submit" name="submit" class="btn_log_in">sign in</button>
           <a href="log_in.php" class="log_in_link">log in</a>

        </form>
    </div>
</body>

</html>