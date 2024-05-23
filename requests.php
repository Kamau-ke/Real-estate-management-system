<?php  
include 'components/connect.php';

session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])){
    header('Location:login.php');
}

$user_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="requests">
    <h1 class="heading">All Messages</h1>
    <div class="box-container">
        <?php
        $select_requests_query = "SELECT m.*, u.id AS sender_id, u.name AS sender_name FROM messages m JOIN users u ON m.sender_id = u.id WHERE m.receiver_id = ?";

        $stmt = $conn->prepare($select_requests_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               $sender_id=$row['sender_id'];
                echo '<div class="message-box">';
                echo '<p><strong>' . htmlspecialchars($row['sender_name']) . ':</strong> ' . htmlspecialchars($row['message']) . '</p>';
                echo '<button class="reply_btn" onclick="location.href=\'reply.php?id=' . $sender_id . '\'  " >Reply</button>';
                echo '</div>';
            }
        } else {
            echo '<p class="empty">You have no messages!</p>';
        }
        $stmt->close();
        ?>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
<?php include 'components/message.php'; ?>

</body>
</html>
