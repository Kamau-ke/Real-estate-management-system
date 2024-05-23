<?php

include '../components/connect.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   // $name = filter_var($name, FILTER_SANITIZE_STRING); 
   $pass = sha1($_POST['pass']);
   // $pass = filter_var($pass, FILTER_SANITIZE_STRING); 

   $sql ="SELECT * FROM `admins` WHERE name = '$name' AND password = '$pass' LIMIT 1";
   $res=$conn->query($sql);
   if ($res-> num_rows >0) {
            while($row=$res->fetch_assoc()){
            //    echo "<pre>";
            // print_r($row);
     session_start();

     $_SESSION["id"]=$row["id"];
     $_SESSION["name"]=$row["name"];
   
            }

 
   // $select_admins->execute([$name, $pass]);
   // $row = $select_admins->fetch(PDO::FETCH_ASSOC);

 
      // print_r($select_admins);?
      header('location:dashboard.php');
   }else{
      $warning_msg[] = 'Incorrect username or password! ';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="padding-left: 0;">

<!-- login section starts  -->

<section class="form-container" style="min-height: 100vh;">

   <form action="" method="POST">
      <h3>welcome back!</h3>
      <!-- <p>default name = <span>admin</span> & password = <span>111</span></p> -->
      <input type="text" name="name" placeholder="enter username" maxlength="20" class="box">
      <input type="password" name="pass" placeholder="enter password" maxlength="20" class="box">
      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>

<!-- login section ends -->


















<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include '../components/message.php'; ?>

</body>
</html>