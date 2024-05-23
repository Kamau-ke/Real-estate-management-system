<?php

include 'components/connect.php';



if (isset($_POST['submit'])) {
   // $name = $_POST['name'];
   //  $email = $_POST['email'];

   // echo "<pre>";
   // print_r($_POST);

   $name = $_POST['name'];

   $number = $_POST['number'];

   $email = $_POST['email'];

   $pass = sha1($_POST['pass']);

   $c_pass = sha1($_POST['c_pass']);

   //query for checking email taken ==========

   $select_users_query = "SELECT * FROM `users` WHERE email = '$email'";
   $select_users_res = $conn->query($select_users_query);

   if ($select_users_res->num_rows > 0) {

      print_r($select_users_res);
      $warning_msg[] = 'email already taken!';
   } else {
      if ($pass != $c_pass) {
         $warning_msg[] = 'Password not matched!';
      } else {
         $insert_user_query = "INSERT INTO users (name, number, email, password) VALUES('$name', '$number', '$email', '$c_pass')" or die('error');

         $insert_user_res = $conn->query($insert_user_query);
         if (!$insert_user_res) {
            die('Error: ' . mysqli_error($conn));
         } else {

        

         //    print
            // echo "<script>alert('Registration Successful')</script>";
            $success_msg[] = 'Registration Successful';
         } 
         // else {
         //    $error_msg[] = 'something went wrong!';
         // print_r($insert_user_res);
         // }
      }
   }
}

?>

<!DOCTYPE html>
<!-- < lang="en"> -->

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <!-- register section starts  -->

   <section class="form-container">

      <form action="" method="post">
         <h3>create an account!</h3>
         <input type="tel" name="name" required maxlength="50" placeholder="enter your name" class="box">
         <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
         <input type="number" name="number" required min="0" max="9999999999" maxlength="10" placeholder="enter your number" class="box">
         <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box">
         <input type="password" name="c_pass" required maxlength="20" placeholder="confirm your password" class="box">
         <p>already have an account? <a href="login.php">login now</a></p>
         <input type="submit" value="register now" name="submit" class="btn">
      </form>

   </section>

   <!-- register section ends -->










   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   <?php include 'components/footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   <?php include 'components/message.php'; ?>

</body>

</html>