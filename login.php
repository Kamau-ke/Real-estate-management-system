<?php

include 'components/connect.php';



if(isset($_POST['submit'])){
  

   $email = $_POST['email'];
   // $email = filter_var($email, FILTER_SANITIZE_STRING); 
   // $pass = $_POST['pass'];
   $pass = sha1($_POST['pass']);
   // $pass = filter_var($pass, FILTER_SANITIZE_STRING); 

   $sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass' ";
   $res=$conn->query($sql);

   if ($res) {
     
      while($row=$res->fetch_assoc()){

         session_start();
         $_SESSION["id"]= $row['id'];
         $_SESSION["name"]= $row['name'];
         $_SESSION["email"]= $row['email'];
         
         header('location:dashboard.php');
       }
        

      }
   
   else {
       
                   
         die('Error: ' . mysqli_error($conn));
      
   


    
        

      
      
      // 
   }
     
  



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php 

include 'components/user_header.php'; 

?>

<!-- login section starts  -->

<section class="form-container">

   <form action="" method="post">
      <h3>welcome back!</h3>
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
      <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box">
      <p>don't have an account? <a href="register.php">register new</a></p>
      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>

<!-- login section ends -->










<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php
 include 'components/footer.php';
  ?>

custom js file link 
<script src="js/script.js"></script>

<?php
 include 'components/message.php'; 
 ?>

</body>
</html>