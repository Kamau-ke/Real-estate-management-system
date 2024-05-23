<?php




include '../components/connect.php';

session_start();
if(!isset($_SESSION["name"])){
    header("location:login.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include '../components/admin_header.php'; ?>
<!-- header section ends -->

<!-- dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
   
      <h3>welcome!</h3>
      <p><?= $_SESSION["name"] ?></p>
      <a href="update.php" class="btn">update profile</a>
   </div>

   <div class="box">
      <?php
         $select_listings_query ="SELECT * FROM `property`" or die($conn->error);
         $select_listings_res=$conn->query( $select_listings_query);
         if( $select_listings_res){
            $num_rows_listings = $select_listings_res->num_rows;
         
           
          
      ?>
      <h3><?php echo     $num_rows_listings ?></h3>
      <p>property posted</p>
      <a href="listings.php" class="btn">view listings</a>
 
   <?php
   }

   ?>
   </div>

   <div class="box">
      <?php
         $select_users_query ="SELECT * FROM `users`" or die($conn->error);
         $select_users_res=$conn->query($select_users_query);
         if($select_users_res){

            $num_rows_user = $select_listings_res->num_rows;

            ?>
         
      <h3><?php $num_rows_user; ?></h3>
      <p>total users</p>
      <a href="users.php" class="btn">view users</a>
   </div>

   <?php
}

?>

   <div class="box">
      <?php
         $select_admins_query = "SELECT * FROM `admins`" or die($conn->error);
         $select_admins_res=$conn->query($select_admins_query);

         if ( $select_admins_res) {

            $num_rows_admin = $select_listings_res->num_rows;
       

      ?>
      <h3><?php $num_rows_admin; ?></h3>
      <p>total admins</p>
      <a href="admins.php" class="btn">view admins</a>
   </div>
   <?php
}

?>

   <!-- <div class="box">
      <?php
         $select_messages_query = "SELECT * FROM `messages`" or die($conn->error);
         $select_messages_res=$conn->query($select_messages_query);
if($select_messages_res){
   while($count_messages =$select_messages_res->fetch_assoc()){

      ?>

         
      <h3><?= $count_messages; ?></h3>
      <p>new messages</p>
      <a href="messages.php" class="btn">view messages</a>
   </div>
   <?php
}
}
?> -->

   </div>

</section>


<!-- dashboard section ends -->




















<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../components/message.php'; ?>

</body>
</html>