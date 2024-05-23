<?php

include '../components/connect.php';

session_start();
if(!isset($_SESSION["name"])){
    header("location:login.php");
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
 
}else{
   $get_id = '';
   header('location:dashboard.php');
}



if(isset($_POST['delete'])){

   $delete_id = $_POST['delete_id'];

   
      $delete_listings_query ="DELETE FROM `property` WHERE id = '$get_id'" or die($conn->error);
      $delete_listings_res=$conn->query( $delete_listings_query);
      if ($delete_listings_res) {
         $success_msg[] = 'Listing deleted!';
      }
   

      else{
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
   <title>property details</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include '../components/admin_header.php'; ?>
<!-- header section ends -->

<section class="view-property">

   <h1 class="heading">property details</h1>

   <?php
      $select_properties_query ="SELECT * FROM `property` WHERE id = '$get_id' " or die($conn->error);
      $select_properties_res=$conn->query( $select_properties_query ) or die($conn->error);
      if($select_properties_res){
    
         while($fetch_property = $select_properties_res->fetch_assoc()){
            // echo "<pre>";
            // print_r($fetch_property);

         $property_id = $fetch_property['user_id'];

         $select_user_query ="SELECT * FROM `users` WHERE id = '$property_id'"  or die($conn->error);
         $select_user_res=$conn->query(  $select_user_query) or die($conn->error);
         if($select_user_res ){
          
            while($fetch_user=$select_user_res->fetch_assoc()){
               // echo "sahil";
               // echo "<pre>";
               // print_r($fetch_user);

   ?>


   <div class="details">
     <div class="swiper images-container">
         <div class="swiper-wrapper">
            <img src="../uploaded_files/<?php echo $fetch_property['image_01']; ?>" alt="" class="swiper-slide">
            <?php if(!empty($fetch_property['image_02'])){ ?>
            <img src="../uploaded_files/<?php echo $fetch_property['image_02']; ?>" alt="" class="swiper-slide">
            <?php } ?>
            <?php if(!empty($fetch_property['image_03'])){ ?>
            <img src="../uploaded_files/<?php echo $fetch_property['image_03']; ?>" alt="" class="swiper-slide">
            <?php } ?>
            <?php if(!empty($fetch_property['image_04'])){ ?>
            <img src="../uploaded_files/<?php echo $fetch_property['image_04']; ?>" alt="" class="swiper-slide">
            <?php } ?>
            <?php if(!empty($fetch_property['image_05'])){ ?>
            <img src="../uploaded_files/<?php echo $fetch_property['image_05']; ?>" alt="" class="swiper-slide">
            <?php } ?>
         </div>
         <div class="swiper-pagination"></div>
     </div>
      <h3 class="name"><?php echo $fetch_property['property_name']; ?></h3>
      <p class="location"><i class="fas fa-map-marker-alt"></i><span><?php echo $fetch_property['address']; ?></span></p>
      <div class="info">
         <p>KSH: <span><?php echo $fetch_property['price']; ?></span></p>
         <p><i class="fas fa-user"></i><span><?php echo $fetch_user['name']; ?></span></p>
         <p><i class="fas fa-phone"></i><a href="tel:1234567890"><?php echo $fetch_user['number']; ?></a></p>
         <p><i class="fas fa-building"></i><span><?php echo $fetch_property['type']; ?></span></p>
         <p><i class="fas fa-house"></i><span><?php echo $fetch_property['offer']; ?></span></p>
         <p><i class="fas fa-calendar"></i><span><?php echo $fetch_property['date']; ?></span></p>
      </div>
      <h3 class="title">details</h3>
      <div class="flex">
         <div class="box">
            <p><i>deposit amount : </i><span>KSH</span></p>
            <p><i>status :</i><span><?php echo $fetch_property['status']; ?></span></p>
            <p><i>bedroom :</i><span><?php echo $fetch_property['bedroom']; ?></span></p>
            <p><i>bathroom :</i><span><?php echo $fetch_property['bathroom']; ?></span></p>
            <p><i>balcony :</i><span><?php echo $fetch_property['balcony']; ?></span></p>
         </div>
         <div class="box">
            <p><i>carpet area :</i><span><?php echo $fetch_property['carpet']; ?>sqft</span></p>
            <p><i>age :</i><span><?php echo $fetch_property['age']; ?> years</span></p>
            <p><i>total floors :</i><span><?php echo $fetch_property['total_floors']; ?></span></p>
            <p><i>room floor :</i><span><?php echo $fetch_property['room_floor']; ?></span></p>
            <p><i>furnished :</i><span><?php echo $fetch_property['furnished']; ?></span></p>
            
         </div>
      </div>
      <h3 class="title">amenities</h3>
      <div class="flex">
         <div class="box">
            <p><i class="fas fa-<?php if($fetch_property['lift'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>lifts</span></p>
            <p><i class="fas fa-<?php if($fetch_property['security_guard'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>security guards</span></p>
            <p><i class="fas fa-<?php if($fetch_property['play_ground'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>play ground</span></p>
            <p><i class="fas fa-<?php if($fetch_property['garden'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>gardens</span></p>
            <p><i class="fas fa-<?php if($fetch_property['water_supply'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>water supply</span></p>
            <p><i class="fas fa-<?php if($fetch_property['power_backup'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>power backup</span></p>
         </div>
         <div class="box">
            <p><i class="fas fa-<?php if($fetch_property['parking_area'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>parking area</span></p>
            <p><i class="fas fa-<?php if($fetch_property['gym'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>gym</span></p>
            <p><i class="fas fa-<?php if($fetch_property['shopping_mall'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>shopping mall</span></p>
            <p><i class="fas fa-<?php if($fetch_property['hospital'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>hospital</span></p>
            <p><i class="fas fa-<?php if($fetch_property['school'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>schools</span></p>
            <p><i class="fas fa-<?php if($fetch_property['market_area'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>market area</span></p>
         </div>
      </div>
      <h3 class="title">description</h3>
      <p class="description"><?php echo $fetch_property['description']; ?></p>


      <form action="" method="post" class="flex-btn">
         <input type="hidden" name="delete_id" value="<?php echo $property_id; ?>">
         <input type="submit" value="delete property" name="delete" class="delete-btn" onclick="return confirm('delete this listing?');">
      </form>
   </div>
   <?php
            }
         }
         }
    
   }
   else{
      echo '<p class="empty">property not found! <a href="listings.php" style="margin-top:1.5rem;" class="option-btn">go to listings</a></p>';
   }
   ?>

</section>


















<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../components/message.php'; ?>

<script>

var swiper = new Swiper(".images-container", {
   effect: "coverflow",
   grabCursor: true,
   centeredSlides: true,
   slidesPerView: "auto",
   loop:true,
   coverflowEffect: {
      rotate: 0,
      stretch: 0,
      depth: 200,
      modifier: 3,
      slideShadows: true,
   },
   pagination: {
      el: ".swiper-pagination",
   },
});

</script>

</body>
</html>