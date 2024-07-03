<!DOCTYPE html>
<html>
<head>
    <title>Add Song</title>
</head>
<body>
<div style="text-align: center;">
<form action="landingpage.php" method="get">
            <button type="submit" name="home"><b>Home</b></button>
        </form>

<h2>Add Song to Playlist:</h2>
    <form method="POST" action="">
        <label for="playlistName">Playlist Name:</label>
        <input type="text" name="playlistName" id="playlistName" required><br><br>

        <label for="songID">Song ID:</label>
        <input type="text" name="songID" id="songID" required><br><br>

        <input type="submit" value="Add Song">
    </form>

    <?php
    include 'DBConnection.php';

    
    $query = "SELECT * FROM Song";
    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
        echo "<h2>List of Songs:</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "{$row['Name']} (SongID: {$row['SongID']})<br><br>";
        }
        echo "</ul>";
    } else {
        echo "No songs found.";
    }
    $query = "SELECT PlaylistName FROM Playlist";
    $result = mysqli_query($conn, $query);
    echo '<h2>List of Playlists:</h2>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Playlist Name: " . $row['PlaylistName'] . '<br>'.'<br>';
    }


   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $playlistName = $_POST['playlistName'];
        $songID = $_POST['songID'];
        $query = "SELECT * FROM Song WHERE SongID = '$songID'";
        $result = mysqli_query($conn, $query);


        if (mysqli_num_rows($result) > 0) {
            $query = "SELECT PlaylistID FROM Playlist WHERE PlaylistName = '$playlistName'";

            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $playlistID = $row['PlaylistID'];
                
                $query = "INSERT INTO COMPRISES (PlaylistID, SongID) VALUES ('$playlistID', '$songID')";
                if (mysqli_query($conn, $query)) {
                    echo "Song added to playlist successfully.";
                } else {
                    echo "Error adding song to playlist: " . mysqli_error($conn);
                }
            }
            else{
                echo "Playlist not found.";
            }
        } else {
            echo "Song not found.";
        }
    }
    ?>

</div>  
</body>
</html>