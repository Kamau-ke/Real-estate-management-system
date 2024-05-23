<?php  

include 'components/connect.php';

session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])){
   header('Location:login.php');

  

}
 
$user_id=$_SESSION['id'];
// echo $user_id;




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
      <?php
         // $select_profile_query ="SELECT * FROM `users` WHERE id = ?";
         // $select_profile_res->execute([$user_id]);
         // $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <h3>welcome!</h3>
      <p>  <?php echo $_SESSION['name']?> </p>
      <a href="update.php" class="btn">update profile</a>
      </div>


      <div class="box">
      <?php
        $count_properties_query ="SELECT * FROM `property` WHERE user_id =' $user_id' ";
        $count_properties_res=$conn->query($count_properties_query);
        if ($count_properties_res) {
         
         while ($total_properties = $count_properties_res->fetch_assoc()) {
        }
      }
    
      ?>
      <h3><?php $total_properties; ?></h3>
      <p>properties listed</p>
      <a href="my_listings.php" class="btn">view all listings</a>
      </div>

      <div class="box">
   



<?php

$count_requests_received_query ="SELECT * FROM `requests` WHERE user_id ='$user_id'" or die('error');
$count_requests_received_res=$conn->query($count_requests_received_query);
if ($count_requests_received_res) {

  
   while ($total_requests_received = $count_requests_received_res->fetch_assoc()) {
}
}

?>
       <h3><?php $total_requests_received; ?></h3>
      <p>requests received</p>
      <a href="requests.php" class="btn">view all messages</a>
      </div>

    
  

</section>






















<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>