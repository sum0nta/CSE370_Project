<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <style>
        .centered {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="centered">
<form action="landingpage.php" method="get">    
    <button type = "submit" name = "home"> <b>Home </b></button></a>
</form>
        
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        
            <h1>Select Song</h1>
            <input type="file" id="song" name="song" accept=".mp3">
            <h3>Title</h3>
            <input type="text" id="title" name="title">
            <h3>Album</h3>
            <input type="text" id="album" name="album">
            <h3>Artist</h3>
            <input type="text" id="artist" name="artist">
            <br><br>
            <button type="submit"> <b>Upload </b></button>
        </div>
    </form>

</body>
</html>

<?php
include 'DBConnection.php';


$upload_dir = "uploads/";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $_POST["title"];
    $album = $_POST["album"];
    $artist = $_POST["artist"];

    
    $file_name = $_FILES["song"]["name"];
    $file_tmp = $_FILES["song"]["tmp_name"];
    $target_file = $upload_dir . $title .".mp3";

    
    $sql = "SELECT ArtistID FROM Artist WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $artist);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows == 0) {
        $sql = "INSERT INTO Artist (Name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $artist);
        $stmt->execute();
        $artistID = $stmt->insert_id;
    } else {
        $row = $result->fetch_assoc();
        $artistID = $row["ArtistID"];
    }
    $stmt->close();

    
    $sql = "INSERT INTO Song(Name, Artist, Album) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $artist, $album);
    $stmt->execute();
    $songID = $stmt->insert_id;

    
    if ($stmt->affected_rows > 0) {
        if (move_uploaded_file($file_tmp, $target_file)){
        echo "Song uploaded successfully.";
        $sql = "INSERT INTO OF (SongID, ArtistID) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $songID, $artistID);
        $stmt->execute();
    }
        else{
            echo "Error uploading song: " . $conn->error;
        }
    } else {
        echo "Error uploading song: " . $conn->error;
    }

    
    $stmt->close();
}


$conn->close();
?>

</body>
</html>
