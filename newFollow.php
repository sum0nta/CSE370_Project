<?php
session_start(); 
include 'DBConnection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow</title>
</head>
<body>
<div style="text-align:center">  
<form action="landingpage.php" method="get">    
    <button type = "submit" name = "home"> <b>Home </b></button></a>
</form>
<h2>Follow/Unfollow</h2>

    <?php

        if (isset($_SESSION['username'])) {
            $current_user = $_SESSION['username'];
            echo "Logged in as: " . "<b> ".$current_user ."</b>";
    ?>
    
    <ul>
        <?php
            
            $sql = "SELECT Name FROM Users WHERE Name <> ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $current_user);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                
                echo "<h2> Available Users: </h2>";
                while($row = $result->fetch_assoc()) {
                    $friend_username = $row["Name"];

                    
                    $sql_check = "SELECT * FROM Follow 
                    WHERE (FollowerName = ? AND FollowingName = ?)";
                    $stmt_check = $conn->prepare($sql_check);
                    $stmt_check->bind_param("ss", $current_user, $friend_username);
                    $stmt_check->execute();
                    $result_check = $stmt_check->get_result();
                    $row = $result_check->fetch_assoc();
                    $followID = $row["followID"];

                    if ($result_check->num_rows > 0) {
                        echo "<b>".$friend_username ."</b>". "  ";
                        
                              echo" <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post' style='display: inline-block;'>
                                <input type='hidden' name='followID' value='$followID'>
                                <button type='submit'>Unfollow</button>
                              </form> <br> <br>";
                    } else {
                        echo "<b>".$friend_username ."</b>". "  ";
                        echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post' style='display: inline-block;'>
                                <input type='hidden' name='friend_username' value='$friend_username'>
                                <button type='submit'>Follow</button>
                          </form> <br> <br>";
                    }
                
                }
            } else {
                echo "No other users found.";
            }
        ?>
    </ul>

    <?php
        } else {
            echo "Please log in to Follow.";
        }
    ?>

    <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['friend_username'])){
            $friend_username = $_POST['friend_username'];
            $sql_follow = "INSERT INTO Follow (FollowerName, FollowingName) VALUES (?, ?)";
            $stmt_follow = $conn->prepare($sql_follow);
            $stmt_follow->bind_param("ss", $current_user, $friend_username);

            if ($stmt_follow->execute()) {
                echo "<script>alert('Following " . $friend_username . " successfully!');</script>";
            } else {
                echo "Error: Unable to follow " . $friend_username . ".";
            }
            $stmt_follow->close();
        }
        else if (isset($_POST['followID'])) {
            $followID = $_POST['followID'];
            $sql_unfollow = "DELETE FROM Follow WHERE followID = ?";
            $stmt_unfollow = $conn->prepare($sql_unfollow);
            $stmt_unfollow->bind_param("i", $followID);

            if ($stmt_unfollow->execute()) {
                echo "<script>alert('Unfollowed successfully!');</script>";
            }
            else {
                echo "Error: Unable to unfollow.";
            }

            
            $conn->close();
        }
    }
    ?>
</div>
</body>
</html>
