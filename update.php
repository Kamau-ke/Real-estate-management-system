<?php  

include 'components/connect.php';


session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])){
   header('Location: logout.php');

  

}
 
$user_id=$_SESSION['id'];

// echo $user_id;



$select_user_query = "SELECT * FROM `users` WHERE id = '$user_id' ";
$select_user_res=$conn->query($select_user_query) or die($conn->error);
if($select_user_res){
   // echo"sahil";

   while($fetch_user=$select_user_res->fetch_assoc()){

      // print_r($fetch_user);


if(isset($_POST['submit'])){
   // print_r($_POST);

   $name = $_POST['name'];
 
   $number = $_POST['number'];

   $email = $_POST['email'];


   if(!empty($name)){
     $update_name_query ="UPDATE `users` SET name = $name WHERE id = '$user_id'" or die ($conn->error);
      $update_name_res=$conn->query($update_name_query);
      if($update_name_res){
      $success_msg[] = 'name updated!';}
   }

   if(!empty($email)){
      $verify_email_query ="SELECT email FROM `users` WHERE email = '$email'";
      $verify_email_res=$conn->query($verify_email_query);
      if($verify_email){
         // print_r($verify_email_res);
         $warning_msg[] = 'email already taken!';
      }
      else{
         $update_email_query = "UPDATE `users` SET email = '$email' WHERE id = '$user_id'";
         $update_email_res=$conn->query($update_email_query);
         $success_msg[] = 'email updated!';
      }
   }

   if(!empty($number)){
      $verify_number_query ="SELECT number FROM `users` WHERE number = '$number'" or die($conn->error);
      $verify_number_res=$conn->query($verify_number_query) or die($conn->error);
      if($verify_number->num_rows > 0){
         $warning_msg[] = 'number already taken!';
      }else{
         $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
         $update_number->execute([$number, $user_id]);
         $success_msg[] = 'number updated!';
      }
   }

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $fetch_user['password'];
   $old_pass = sha1($_POST['old_pass']);

   $new_pass = sha1($_POST['new_pass']);

   $c_pass = sha1($_POST['c_pass']);


   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $warning_msg[] = 'old password not matched!';
      }elseif($new_pass != $c_pass){
         $warning_msg[] = 'confirm passowrd not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$c_pass, $user_id]);
            $success_msg[] = 'password updated successfully!';
         }else{
            $warning_msg[] = 'please enter new password!';
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
   <title>update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php 
include 'components/user_header.php'; 
?>

<section class="form-container">

   <form action="" method="post">
      <h3>update your account!</h3>
      <input type="tel" name="name" maxlength="50" placeholder="<?= $fetch_user['name']; ?>" class="box">
      <input type="email" name="email" maxlength="50" placeholder="<?= $fetch_user['email']; ?>" class="box">
      <input type="number" name="number" min="0" max="9999999999" maxlength="10" placeholder="<?= $fetch_user['number']; ?>" class="box">
      <input type="password" name="old_pass" maxlength="20" placeholder="enter your old password" class="box">
      <input type="password" name="new_pass" maxlength="20" placeholder="enter your new password" class="box">
      <input type="password" name="c_pass" maxlength="20" placeholder="confirm your new password" class="box">
      <input type="submit" value="update now" name="submit" class="btn">
   </form>

</section>
<?php

}
}
 ?>





<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php 
 'components/footer.php'; 
 ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php
 include 'components/message.php';
  ?>
</body>
</html>