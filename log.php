<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: index.php");
    exit;
}
require_once "connect.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }

if(empty($err))
{
    $sql = "SELECT id, username, password FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["password"] = $password;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: index.php");
                            
                        }
                        else{
                            
                            $_SESSION["loggedin"] = false;
                            header("location: login.html");





                            echo '<script type ="text/JavaScript">';  
                            echo 'alert("JavaScript Alert Box by PHP")';  
                            echo '</script>';  



                            


                        }
                    }
                }
                else{
                    header("location: login.html");
                    echo "Please check the credantial";
                }
            }
}
}    




?>