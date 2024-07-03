<?php

session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create Playlist</title>
</head>
<body>
<div style="text-align: center;">
<form action="landingpage.php" method="get">
            <button type="submit" name="home"><b>Home</b></button>
        </form>
  <h2>Create Playlist</h2>
  
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="playlistname">Playlist Name:</label>
    <input type="text" id="playlistname" name="playlistname" required>
    <button type="submit" name="create_playlist">Create Playlist</button>
  </form>
  <form action="addSongs.php" method="post">
    <button type="submit" name="addSongs" style="width: 90px; height: 30px; margin-top: 30px;">Add Songs</button>
</form>
</div>
  <?php
  include 'DBConnection.php';

  $username = $_SESSION["username"];

  if (isset($_POST['create_playlist'])) {
    $playlist_name = $_POST['playlistname'];


    $sql_check_name = "SELECT * FROM Playlist WHERE PlaylistName = '$playlist_name'";
    $result_check_name = mysqli_query($conn, $sql_check_name);
  }
    if (mysqli_num_rows($result_check_name) > 0) {
      $playlist_error = "Playlist name already exists. Choose a different name.";
       echo $playlist_error;
    } else { 
    $sql_create_playlist = "INSERT INTO Playlist (PlaylistName) VALUES ('$playlist_name')";
    $conn->query($sql_create_playlist);
    $playlist_error = "Playlist created successfully!";
    echo $playlist_error;
    
    

    }
?>

</form>
</body>
</html>