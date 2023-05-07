<?php 
    // includes out connect.php script
    require_once("connect.php");

    // checks to see if the user is already logged in, if so redirect them to the home page
    session_start();
    if(isset($_SESSION['name'])){

        session_destroy();
  
    }
    header("Location: ../index.html");
    
?>