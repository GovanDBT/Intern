<?php

// includes out connect.php script
    require_once("connect.php");

    // checks to see if the user is already logged in, if so redirect them to the home page
    session_start();
    if(isset($_SESSION['name']))
        header("Location: org.php");

    /** LOGIN FORM */
    // checks to see if the user clicked the login button
    if(isset($_POST['login'])){
        // gets the form data for processing
        $status = $_POST['status'];
        $user = $_POST['name'];
        $password = $_POST['password'];

        // makes sure the required fields are entered
        if ($user != "" && $password != "" && $status = "organization"){
            // selects and goes through all the organization names in the database
            $select = "SELECT * FROM Org_account WHERE name = '{$user}'";
            // query the database to see if the name already exists
            $query = mysqli_query($connection, $select);
            if(mysqli_num_rows($query) == 1){
                // gets the records from the query
                $record = mysqli_fetch_assoc($query);

                // compares the passwords to make sure they match
                if($password === $record['password']){
                    // makes sure the user has activated their account
                    if($record['account_status'] == 1){
                        // update the last_login tracker
                        $last_login = time();
                        $update = "UPDATE Org_account SET last_login ='{$last_login}'";
                        $query = mysqli_query($connection, $update);

                        /** USER CAN LOGIN */

                        $_SESSION['name'] = $record['name'];

                        $success = true;

                        // redirects user to the home page
                        header("Location: org.php");
                    }
                    else
                        $error_msg = "Please activate your account before you Login!";
                }
                else
                    $error_msg = "Your password is incorrect.";
            }
            else
                $error_msg = "Account does not exist! Try registering.";
        }
        else
            $error_msg = "Please fill out all the required fields!";
    }

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
            <form action="login.php" method="post">
                <select name="status">
                    <option value="student">student</option>
                    <option value="organization">organisation</option>
                    <option value="supervisor">supervisor</option>
                </select>
                <input type="text" name="name" placeholder="ID number or name">
                <input type="password" name="password" placeholder="password">
                <br>
                <input type="submit" name="login" value="login">
            </form>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6f879d6c21.js" crossorigin="anonymous"></script>
</body>

</html>