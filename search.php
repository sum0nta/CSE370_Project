<?php

include 'DBConnection.php';
echo '<a href="landingpage.php">' . '<button> <b>Home </b></button></a>';


$search_query = htmlspecialchars($_GET['q']); 


$sql = "INSERT INTO SearchHistory (Data) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $search_query);


        if (!$stmt->execute()) {
            echo "Error inserting search query: " . $conn->error;
        } 

        
        $stmt->close();
$sql = "SELECT * FROM Song WHERE Name LIKE '" . $search_query . "%' OR Artist LIKE '" . $search_query . "%'";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Search Results for: '" . $search_query . "'</h2>";
}
    while ($row = $result->fetch_assoc()) {
        $file_path = "uploads/" . $row["Name"] . ".mp3";
    
    if (file_exists($file_path)) {
        echo "<h3>" . $row["Name"] ." By " .$row["Artist"]. "</h3>";
        echo '<audio controls>';
        echo '<source src="' . $file_path . '" type="audio/mpeg">';
        echo 'Your browser does not support the audio element.';
        echo '</audio>';
    }
    
}
if ($result->num_rows == 0){
    echo "<h1>No results found for: '" . $search_query . "'</h1>";

}

