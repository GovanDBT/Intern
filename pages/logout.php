<?php 

    // checks to see if the user is already logged in, if so redirect them to the home page
    session_start();
    session_unset();
    unset($_SESSION['stdId']);
    unset($_SESSION['name']);
    session_destroy();
  
    header("Location: ../index.php");
    exit;
    
?>