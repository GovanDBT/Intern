<?php 
    // connects the user to the database
    $connection = mysqli_connect("localhost", "root", "", "intern");

    // checks if the user is connect to the database, if not display
    if (!$connection){
        die("<p style='color:red;'>Failed to connect to database :(</p>");
    }
?>