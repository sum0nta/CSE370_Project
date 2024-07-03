<?php
session_start();

include 'DBConnection.php';


$chatroomID = isset($_GET['chatroomID']) ? $_GET['chatroomID'] : null; 


if (empty($chatroomID) || !isset($_SESSION['loggedin'])) {
    header('Location: landingpage.php'); 
    exit;
}

function isUserInChatroom($conn, $chatroomID, $username) {
    $query = "SELECT * FROM ChatRoom WHERE chatRoomID = ? AND (Username1 = ? OR Username2 = ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $chatroomID, $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->num_rows > 0;
}


$isUserInRoom = isUserInChatroom($conn, $chatroomID, $_SESSION['username']);

if (!$isUserInRoom) {
    echo "<form action='landingpage.php' method='get'>    
    <button type = 'submit' name = 'home'> <b>Home </b></button></a>
</form>";  
    echo "Unauthorized access! You are not part of this chatroom.";
    
    exit;
}


if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $usernameValue = $_SESSION['username'];
    $dateValue = date('Y-m-d H:i:s');
    $chatroomID = (int)$chatroomID;
    $query = "INSERT INTO ChatMessage(ChatRoomID, SenderName, msgVal, MessageTime) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $chatroomID, $usernameValue, $message, $dateValue);
    var_dump($chatroomID, $usernameValue, $message, $dateValue);
    if ($stmt->execute()) {
        header('Location: messages.php?chatroomID=' . $chatroomID);
        exit;
    } else {
        
        echo "Error sending message: " . mysqli_error($conn);
    }
    $stmt->close();
}


function getChatMessage($conn, $chatroomID) {
    $messages = array();
    $query = "SELECT * FROM ChatMessage WHERE ChatRoomID = ? ORDER BY MessageTime ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $chatroomID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }
    $stmt->close();
    return $messages;
}


$messages = getChatMessage($conn, $chatroomID);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Chatroom (ID: <?php echo $chatroomID; ?>)</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="landingpage.php" method="get">    
    <button type = "submit" name = "home"> <b>Home </b></button></a>
</form>    
<div style="text-align: center;">  
<h1>Chatroom (ID: <?php echo $chatroomID; ?>)</h1>
    <p> Users in this chatroom: 
    <?php
    $query = "SELECT Username1, Username2 FROM ChatRoom WHERE chatRoomID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $chatroomID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<br>".'<b>'.$row['Username1'] .'</b>'."<br> " . "<b>". $row['Username2']. "</b>";
        }
    }
    $stmt->close();
    ?>
    <p>
  <h4> Refresh the page to see new messages </h4>

<div id="chat-window">
    <?php foreach ($messages as $message): ?>
        <div class="messageSend">
            <span class="username"><?php echo $message['SenderName']; ?>:</span>
            <?php echo $message['msgVal']; ?>
        </div>
    <?php endforeach; ?>
</div>

<form method="post" action="">
   
<br> <label for="message"> <b>Your message: </b> </label> <br>
    <textarea name="message" id="message" required></textarea> <br>
    <input type="submit" value="Send">
</form>
</div>

</body>
</html>