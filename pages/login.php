<?php

    // includes out connect.php script
    require_once("connect.php");
    require_once("process.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="x-icon" href="../images/UBotswana.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/all.css">
</head>

<body>
    <div class="interface">
        <!--Side menu-->
        <div class="menu">
            <!--Header of the side menu-->
            <div class="header">
                <img class="logo" src="../images/UBotswana.png" alt="UB logo">
                <h1 class="menu-title">Internship</h1>
            </div>
            <!--links to other pages-->
            <ul class="menu-list">
                <li><a href="../index.php"><i class="fa-solid fa-home"></i> Dashboard</a></li>
                <li class="highlight"><a href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a></li>
                <li><a href="register.php"><i class="fa-solid fa-address-card"></i> Register</a></li>
                <li><a href="about.html"><i class="fa-solid fa-circle-info"></i> About</a></li>
                <li><a href="contact.html"><i class="fa-solid fa-envelope"></i> Contact</a></li>
            </ul>
            <hr>
            <!--shows the number of registered students and companies-->
            <div class="count-students count">
                <h3>50</h3>
                <p>Students</p>
            </div>
            <div class="count-orgs count">
                <h3>50</h3>
                <p>Organisation</p>
            </div>
            <!--Footer of the side menu-->
            <footer>
                <p>&copy University of Botswana</p>
            </footer>
        </div>

        <!--Main content of the page-->
        <div class="main-content">
            <h2 class="login-title">Welcome Back</h2>
            <form class="login-form" action="process.php" method="post">
                <select name="status">
                    <option value="student">student</option>
                    <option value="organisation">organisation</option>
                    <option value="supervisor">supervisor</option>
                </select>
                <input class="input login-input" type="text" name="name" placeholder="ID number or name">
                <input class="input login-input" type="password" name="password" placeholder="password">
                <br>
                <input class="input-button" type="submit" name="login" value="login">
            </form>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6f879d6c21.js" crossorigin="anonymous"></script>
</body>

</html>