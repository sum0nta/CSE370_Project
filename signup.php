<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="landingpage.php" method="get">    
    <button type = "submit" name = "home"> <b>Home </b></button></a>
</form>
    <h1 style="text-align: center">Sign Up</h1>
    
    <?php
    
    if (isset($success_message)) {
        echo '<p style="color: green; text-align: center;">' . $success_message . '</p>';
        header("Location: login.php");
    } elseif (isset($error_message)) {
        echo '<p style="color: red; text-align: center;">' . $error_message . '</p>';
    }
    ?>
    
    <form action="signup.php" method="post">
        <label for="name"> <b>Name</b></label><br>
        <input type="text" name="name" required><br>
        <label for="email"><b>Email</b></label><br>
        <input type="email" name="email" required><br>
        <label for="password"><b>Password</b></label><br>
        <input type="password" name="password" required><br>
        <input type="submit" value="Sign Up" style="font-weight: bold";>
    </form>

</body>
</html>
<?php
include 'DBConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    

    $check_username_sql = "SELECT * FROM Users WHERE Name = ?";
    $stmt = $conn->prepare($check_username_sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $error_message = "Username already exists. Please choose a different username.";
    } else {
        
        $insert_sql = "INSERT INTO Users (Name, email, password) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sss", $name, $email, $password);
        
        if ($insert_stmt->execute()) {
            $success_message = "Signup successful. You can now login.";
            echo $success_message;
            
            
            
        } else {
            $error_message = "Error: " . $insert_sql . "<br>" . $conn->error;
            echo $error_message;
        }
    }
}
    
   
    $stmt->close();



$conn->close();
?>