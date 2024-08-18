<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <link rel="stylesheet" href="css/home.css">

</head>
<body>

    <div class="container">
        <a class="logout" href="logout.php">log out</a>
        <h1><?php echo "Welcome ". $_SESSION['username']?> </h1>
    </div>



</body>
</html>