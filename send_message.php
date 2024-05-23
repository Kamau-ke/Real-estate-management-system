<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit(); // ensure execution stops upon redirection
}
$user_id = $_SESSION['id'];
include 'components/connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid or missing property ID.');
}
$property_id = $_GET['id'];



$select_seller_stmt = $conn->prepare("SELECT user_id FROM `property` WHERE id = ?");
if ($select_seller_stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}
$select_seller_stmt->bind_param('i', $property_id);
if ($select_seller_stmt->execute()) {
    $select_seller_stmt->bind_result($seller_id);
    if (!$select_seller_stmt->fetch()) {
        echo "No property found with that ID.";
        exit;
    }
} else {
    die('Execute error: ' . $select_seller_stmt->error);
}
$select_seller_stmt->close();

if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $buyer_id = $user_id; 
    
    $insertMessage = $conn->prepare("INSERT INTO messages (receiver_id, sender_id, message) VALUES (?, ?, ?)");
    if (!$insertMessage) {
        die('Prepare error: ' . $conn->error);
    }
    $insertMessage->bind_param("iis", $seller_id, $buyer_id, $message);
    if ($insertMessage->execute()) {
        $insertMessage->close();
        header("Location: home.php");
        exit();
    } else {
        die('Execute error: ' . $insertMessage->error);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Message</title>
       <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php 
include 'components/user_header.php'; 
?>  
    <div class="send_message">
    <form  method="post" class="send_area">
        <textarea name="message" class="text_area" placeholder="Type your message here..." required></textarea>
        <button type="submit" >Send Message</button>
    </form>
    </div>
    <?php include 'components/footer.php'; ?>
</body>
</html>
