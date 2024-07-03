<?php
include 'DBConnection.php';
session_start();



$error_message = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($username == "admin" && $password == "admin") {
        header("Location: admin.php");
        exit();
    }
    
    
    
    $sql = "SELECT password FROM Users WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    
    if ($result->num_rows == 1) {
        
        $row = $result->fetch_assoc();
        
        if ($password == $row["password"]) {
            
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            
            header("Location: landingpage.php");
            exit();
        } else {
            
            $error_message = "Invalid username or password.";
        }
    } else {
        
        $error_message = "Invalid username or password.";
    }
    
    
    $stmt->close();
}


$conn->close();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .centered {
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="landingpage.php" method="get">    
    <button type = "submit" name = "home"> <b>Home </b></button></a>
</form>
    
    <h1 style="text-align: center">Login</h1>
    <?php
    
    if (!empty($error_message)) {
        echo '<p style="color: red; text-align: center;">' . $error_message . '</p>';
    }
    ?>
    <form action="login.php" method="post">
        <label for="username"><b>Username</b></label><br>
        <input type="text" name="username" required>
        <label for="password"><b>Password</b></label><br>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login" style="font-weight: bold;"><br>
        <h4>Don't have an account?</h4> <br>
    </form>
    <div class="centered">
    <a href="signup.php"><button> <b>Register </b></button></a>
    </div>
</body>
</html>
