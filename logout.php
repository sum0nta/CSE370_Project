<?php
session_start();
$_SESSION["loggedin"] = null;
$_SESSION["username"] = null;
session_destroy();
header("Location: landingpage.php");
exit();