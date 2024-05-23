<?php




// if(!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])){
//    header('Location:logout.php');

  

// }
 
// $user_id=$_SESSION['id'];

if(isset($_POST['save'])){
   if($user_id != ''){

    
      $property_id = $_POST['property_id'];


      $verify_saved_query ="SELECT * FROM `saved` WHERE property_id = '$property_id' and user_id = '$user_id'" or die($conn->error);
      $verify_saved_res=$conn->query($verify_saved_query);

      if($verify_saved_res){
         $remove_saved_query = "DELETE FROM `saved` WHERE property_id = '$property_id' AND user_id = '$user_id'" or die($conn->error);
         $remove_saved_res=$conn->query( $remove_saved_query);
         $success_msg[] = 'removed from saved!';
      }else{
         $insert_saved_query ="INSERT INTO`saved`(id, property_id, user_id) VALUES('$save_id', '$property_id', '$user_id')" or die($conn->error);
         $insert_saved_res=$conn->query($insert_saved_query);
         $success_msg[] = 'listing saved!';
      }

   }else{
      $warning_msg[] = 'please login first!';
   }
}

if(isset($_POST['send'])){
   if($user_id != ''){

      $property_id = $_POST['property_id'];
      

      $select_receiver_query ="SELECT user_id FROM `property` WHERE id = '$property_id' LIMIT 1" or die($conn->error);
      $select_receiver_res=$conn->query( $select_receiver_query);
      if ( $select_receiver_res) {
        while($fetch_receiver=$select_receiver_res->fetch_assoc()){

// echo "<pre>";
// print_r($fetch_receiver);

$receiver = $fetch_receiver['user_id'];
        }
      }
     
      

      $verify_request_query = "SELECT * FROM `requests` WHERE property_id = '$property_id' AND sender = '$user_id' AND receiver = '$receiver'" or die($conn->error);
      if(($verify_request_res)){
      $verify_request_res=$conn->query($verify_request_query);

         $warning_msg[] = 'request sent already!';
      }else{
         $send_request_query ="INSERT INTO `requests`(id, property_id, sender, receiver) VALUES('$request_id', '$property_id', '$user_id', '$receiver')" or die($conn->error);
         $send_request_res=$conn->query($send_request_query);
         $success_msg[] = 'request sent successfully!';
      }

   }else{
      $warning_msg[] = 'please login first!';
   }
}

?>