<?php

session_start();
include 'DBConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talk&Tunes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section id="search-button-container">
        <form action="search.php" method="get">
            <input type="search" name="q" placeholder="Search Songs or Artists" required>
            <button type="submit" name="search">Search</button>
        </form>
    </section>

    <?php
    
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        
        echo '<div class="login-button-container">';
        echo '<form action="login.php" method="get">';
        echo '<button type="submit" name="login">Login</button>';
        echo '</form>';
        echo '</div>';
    }
    else{
        $current_user = $_SESSION['username'];
        $sql_following = "SELECT COUNT(*) AS following_count FROM Follow WHERE FollowerName = ? GROUP BY FollowerName";
        $stmt_following = $conn->prepare($sql_following);
        $stmt_following->bind_param("s", $current_user);
        $stmt_following->execute();
        $result_following = $stmt_following->get_result();
        $row_following = $result_following->fetch_assoc();
        $following_count = $row_following["following_count"];
    
        $sql_followers = "SELECT COUNT(*) AS follower_count FROM Follow WHERE FollowingName = ? GROUP BY FollowingName";
        $stmt_followers = $conn->prepare($sql_followers);
        $stmt_followers->bind_param("s", $current_user);
        $stmt_followers->execute();
        $result_followers = $stmt_followers->get_result();
        $row_followers = $result_followers->fetch_assoc();
        $follower_count = $row_followers["follower_count"];
        if ($result_following->num_rows === 0){
            $following_count = 0;
        }
        if ($result_followers->num_rows === 0){
            $follower_count = 0;
        }
    
        echo '<div class="user-button-container">';
        
        echo '<p style="text-align: center"><b>Hello, ' . $_SESSION["username"] ."!". '</b></p>';
        echo "<div style='text-align: center'>";
        echo "<br>Followers: " . $follower_count;
        echo "<br>Following: " . $following_count. "<br>"."<br>";
        echo "</div>";
        echo '<form action="logout.php" method="post">';
        echo '<input type="submit" name="logout" formaction="logout.html" value = "Logout" class="logout-button">';
        echo '</form>';
        echo '</div>';
        
        
            
        echo '<div class="upload-button-container">';
        echo '<form action="upload.php" method="post">';
        echo '<input type="submit" name="upload" formaction="upload.php" value = "Upload" class="upload-button" style = "width: 100%">';
        echo '</form>';
        echo '</div>';
        echo '<div class="playlist-button-container">';
        echo '<form action="playlist.php" method="post">';
        echo '<input type="submit" name="playlist" formaction="playlist.php" value = "Create/Edit Playlists" style = "width: 100%">';
        echo '</form>';
        echo '</div>';
        echo '<div class="show-playlist-button-container">';
        echo '<form action="showPlaylist.php" method="post">';
        echo '<input type="submit" name="showPlaylist" formaction="showPlaylist.php" value = "Show Playlist" style = "width: auto">';
        echo '</form>';
        echo '</div>';
        echo '<div class="chatroom-button-container">';
        echo '<form action="chatRoom.php" method="post">';
        echo '<input type="submit" name="chatRoom" formaction="chatRoom.php" value = "ChatRoom" style = "width: auto">';
        echo '</form>';
        echo '</div>';
        echo '<div class="follow-button-container">';
        echo '<form action="newFollow.php" method="post">';
        echo '<input type="submit" name="newFollow" formaction="newFollow.php" value = "Follow/Unfollow" style = "width: auto">';
        echo '</form>';
        echo '</div>';
        
    
    }
    


$sql = "SELECT * FROM Song";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        
        $file_path = "uploads/" . $row["Name"] . ".mp3";
        
        
        
        if (file_exists($file_path)) {
            
            echo "<h3>" . $row["Name"] ." By " .$row["Artist"]. "</h3>";
            echo '<audio controls>';
            echo '<source src="' . $file_path . '" type="audio/mpeg">';
            echo 'Your browser does not support the audio element.';
            echo '</audio>';
            
        } else {
            echo "File not found: " . $file_path;
        }
    }
} else {
    echo "No songs found.";
}

    ?>

    
               
</body>
</html>
