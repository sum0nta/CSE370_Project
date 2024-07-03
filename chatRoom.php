<?php
session_start();

include 'DBConnection.php';

function getAllChatrooms() {
  global $conn;
  $chatrooms = array();
  $query = "SELECT * FROM ChatRoom";
  $result = mysqli_query($conn, $query);
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $chatrooms[] = $row;
    }
  }
  return $chatrooms;
}


if (!isset($_SESSION['loggedin'])) {
  header('Location: login.php'); 
  exit;
}


if (isset($_POST['username'])) {
$username = $_POST['username'];
$query = "SELECT * FROM Users WHERE Name = '$username'";
$result = mysqli_query($conn, $query);
$usernameAvailable = mysqli_num_rows($result) > 0;

  


  if ($usernameAvailable) {
    if ($_SESSION['username'] != $username) {
      
          
    $query = "INSERT INTO ChatRoom (Username1, Username2) VALUES ('" . $_SESSION['username'] . "', '$username')";
    if (mysqli_query($conn, $query)) {
      
    $query = "SELECT chatRoomID FROM ChatRoom ORDER BY chatRoomID DESC LIMIT 1";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $chatroomID = $row['chatRoomID'];
      echo "Chatroom created successfully!";
      header('Location: chatroom.php?chatroomID=' . $chatroomID);
      exit;
    } else {
      echo "Error creating chatroom: " . mysqli_error($conn);
    }
}
}
  
}

$chatrooms = getAllChatrooms(); 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Chatrooms</title>
</head>
<body>
<div style="text-align: center;">
<form action="landingpage.php" method="get">    
    <button type = "submit" name = "home"> <b>Home </b></button></a>
</form> 
  <h1>Chatrooms</h1>

  <h2>Create New Chatroom</h2>
  <form method="post" action="">
    <label for="username">Username of the other user:</label>
    <input type="text" name="username" id="username" required>
    <input type="submit" value="Create Chatroom">
  </form>

  <h2>Existing Chatrooms</h2>
  <?php if (count($chatrooms) > 0): ?>
    <ul>
      <?php foreach ($chatrooms as $chatroom): ?>
        
        <a href="messages.php?chatroomID=<?php echo $chatroom['chatRoomID']; ?>">
            Chatroom ID: <?php echo $chatroom['chatRoomID']; ?>
             <b>Users: </b><?php echo $chatroom['Username1']; ?>
            & <?php echo $chatroom['Username2']; ?>
        </a> <br> <br>

        
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>No chatrooms found.</p>
  <?php endif; ?>
</div>
</body>
</html>
