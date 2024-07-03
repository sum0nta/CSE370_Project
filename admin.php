<?php
include 'DBConnection.php';
echo "<div style='margin: 0 auto; width: fit-content;'>";

function deleteEntry($conn, $table, $key, $value) {
    $query = "DELETE FROM $table WHERE $key = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $value);
    if ($stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entity = $_POST['entity']; 
    $key = $_POST['key']; 
    $value = $_POST['value']; 

    
    if (isset($_POST['delete'])) {
        if (deleteEntry($conn, $entity, $key, $value)) {
            echo "Entry deleted successfully.";
            
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error deleting entry.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
<form action="landingpage.php" method="get">    
    <button type = "submit" name = "home"> <b>Home </b></button></a>
</form>
    <h1>Admin Delete Access</h1>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h4>Avaiable Entities: <br>
        Artist, ChatMessages, ChatRoom, Follow, Playlist, SearchHistory, Song, Users</h4>    
    <label for="entity"> <b>Enter Entity (Table) Name: </b></label>
        <input type="text" id="entity" name="entity">
        <br><br>
        <button type="submit">Submit</button>
    </form>

    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['entity'])) {
        $entity = $_POST['entity']; 

        $query = "SELECT * FROM $entity";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Data from $entity:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Key</th><th>Other Columns</th><th></th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row[array_keys($row)[0]]}</td>"; 
                foreach ($row as $columnName => $columnValue) {
                    echo "<td>$columnValue</td>";
                }
                echo "<td>
                      <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                      <input type='hidden' name='entity' value='$entity'>
                      <input type='hidden' name='key' value='" . array_keys($row)[0] . "'> <!-- Key field -->
                      <input type='hidden' name='value' value='{$row[array_keys($row)[0]]}'> <!-- Value of the key field -->
                      <button type='submit' name='delete'>Delete</button>
                      </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No data found in $entity.";
        }
    }
    echo "</div>"
    ?>
</body>
</html>
