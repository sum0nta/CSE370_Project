<!DOCTYPE html>
<html>
<head>
    <title>Show Playlist</title>
</head>
<div style="text-align: center">
<form action='landingpage.php' method='get'>
<button type='submit' name='home'><b>Home</b></button> <br> <br>
</form>

<form method="post" action="">
    Enter the name of the playlist: <input type="text" name="playlistName">
    <input type="submit" value="Submit">
</form>

<?php

include 'DBConnection.php';
echo "<div style='text-align: center'>";
$query = "SELECT PlaylistName FROM Playlist";
$result = mysqli_query($conn, $query);
echo '<h2>Playlists:</h2>';
while ($row = mysqli_fetch_assoc($result)) {
    echo "Playlist Name: " . $row['PlaylistName'] . '<br>'.'<br>';
}
echo '</div>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $playlistName = $_POST["playlistName"];

   
    $query = "SELECT * FROM Playlist WHERE PlaylistName = '$playlistName'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
       
        $row = mysqli_fetch_assoc($result);
        $playlistID = $row['PlaylistID'];

        
        $query = "SELECT * FROM COMPRISES WHERE PlaylistID = '$playlistID'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            
            echo "<h2>Songs in playlist: $playlistName</h2>";
            while ($row = mysqli_fetch_assoc($result)) {
                $songID = $row['SongID'];

                
                $query = "SELECT * FROM Song WHERE SongID = '$songID'";
                $songResult = mysqli_query($conn, $query);
                $songRow = mysqli_fetch_assoc($songResult);

               
                echo "<h3>{$songRow['Name']} By {$songRow['Artist']}</h3>";
                echo '<audio controls>';
                echo '<source src="uploads/' . $songRow['Name'] . '.mp3" type="audio/mpeg">';
                echo 'Your browser does not support the audio element.';
                echo '</audio>';
            }
        } else {
            echo "No songs found in playlist: $playlistName";
        }
    } else {
        echo "Playlist not found: $playlistName";
    }
}
echo "</div>";
?>
</div> 
</body>
</html>