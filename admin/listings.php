<?php

include '../components/connect.php';

session_start();
if(!isset($_SESSION["name"])){
    header("location:login.php");
}

if(isset($_POST['delete'])){

   $delete_id = $_POST['delete_id'];
   // echo"deleter id". $delete_id;

   $sql="DELETE FROM `property` WHERE id = '$delete_id'" or die($conn->error) ;
   $res=$conn->query($sql) or die($conn->error);
   if($res){
      $success_msg[] = 'Listing deleted!';
         }else{
            $warning_msg[] = 'Listing deleted already!';
         }



         }
  


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Listings</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include '../components/admin_header.php'; ?>
<!-- header section ends -->

<section class="listings">

   <h1 class="heading">all listings</h1>

 

   <div class="box-container">

   <?php
   
         $select_listings_query = "SELECT * FROM `property` ORDER BY date DESC" or die($conn->error);
         $select_listings_res=$conn->query(  $select_listings_query);
      
      $total_images = 0;
       if($select_listings_res->num_rows>0){
         while($fetch_listing = $select_listings_res->fetch_assoc()){

            // echo"<pre>";
            // print_r($fetch_listing);

         $listing_id = $fetch_listing['id'];

         $select_user_query = "SELECT * FROM `users` WHERE id = '$fetch_listing[user_id]'" or die($conn->error);
         $select_user_res=$conn->query( $select_user_query);
       while (  $fetch_use=$select_user_res->fetch_assoc()) {
         # code...
      

         if(!empty($fetch_listing['image_02'])){
            $image_coutn_02 = 1;
         }else{
            $image_coutn_02 = 0;
         }
         if(!empty($fetch_listing['image_03'])){
            $image_coutn_03 = 1;
         }else{
            $image_coutn_03 = 0;
         }
         if(!empty($fetch_listing['image_04'])){
            $image_coutn_04 = 1;
         }else{
            $image_coutn_04 = 0;
         }
         if(!empty($fetch_listing['image_05'])){
            $image_coutn_05 = 1;
         }else{
            $image_coutn_05 = 0;
         }

         $total_images = (1 + $image_coutn_02 + $image_coutn_03 + $image_coutn_04 + $image_coutn_05);
   ?>


       <div class="box">
         <div class="thumb">
            <p><i class="far fa-image"></i><span><?= $total_images; ?></span></p>
            <img src="../uploaded_files/<?= $fetch_listing['image_01']; ?>" alt="">
         </div>
         <p class="price">KSH: <?= $fetch_listing['price']; ?></p>
         <h3 class="name"><?= $fetch_listing['property_name']; ?></h3>
         <p class="location"><i class="fas fa-map-marker-alt"></i><?= $fetch_listing['address']; ?></p>



         <form action="" method="POST">
            <input type="hidden" name="delete_id" value="<?php echo $listing_id; ?>">
            <a href="view_property.php?get_id=<?= $listing_id; ?>" class="btn">view property</a>
            <input type="submit" value="delete listing" onclick="return confirm('delete this listing?');" name="delete" class="delete-btn" >
         </form>
      </div>
   <?php
         }
          }
      
      }else{
         echo '<p class="empty">no property posted yet!</p>';
      }
   ?>

   </div>

</section>



















<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../components/message.php'; ?>

</body>
</html>