<?php 
    // includes out connect.php script
    require_once("connect.php");

    // checks to see if the user is already logged in, if so redirect them to the home page
    session_start();
    if(isset($_SESSION['name']))
        $LOGGED_IN = true;
    else
        $LOGGED_IN = false;

    /** APPLY INTERNSHIP */
    // check to see if the submit button has been pressed, if so grab all the data in every form
    if(isset($_POST['submit'])){
        // gets all the data from the form
        $pos = $_POST['position'];
        $location = $_POST['location'];
        $duration = $_POST['duration'];
        $stipend = $_POST['stipend'];
        $due = $_POST['due_date'];
        $about = $_POST['about'];
        $avail_pos = $_POST['avail_pos'];

        // cleans the code from SQL statements and attacks from Hackers (SQL Injection)
        $pos = mysqli_real_escape_string($connection, $pos);
        $location = mysqli_real_escape_string($connection, $location);
        $duration = mysqli_real_escape_string($connection, $duration);
        $stipend = mysqli_real_escape_string($connection, $stipend);
        $due = mysqli_real_escape_string($connection, $due);
        $about = mysqli_real_escape_string($connection, $about);
        $avail_pos = mysqli_real_escape_string($connection, $avail_pos);

        // makes sure all the required fields are entered
        if($pos != "" && $location != "" && $stipend != "" && $duration != "" && $due != "" && $about != "" && $avail_pos!= ""){
            if($LOGGED_IN == true){
                // selects the email, name and phone of the organization
                $select = "SELECT * FROM Org_account WHERE name = '{$_SESSION['name']}'";
                $query1 = mysqli_query($connection, $select);
                $record = mysqli_fetch_assoc($query1);
                $name = $record['name'];
                $email = $record['email'];
                $phone = $record['phone'];
                // insert the user into the database
                $insert = "INSERT INTO Internship(company, position, available_position, location, duration, stipend, phone, email, due_date, about_intern) VALUES ('{$name}','{$pos}','{$avail_pos}','{$location}','{$duration}','{$stipend}','{$phone}','{$email}','{$due}','{$about}')";
                // query the database insert data into the database
                $query = mysqli_query($connection, $insert);
                $success = true;
                $success_msg = "Application successful 👍";
            }else
                $error_msg = "Login to submit application";
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
    <title>Internships</title>
    <link rel="icon" type="x-icon" href="../images/UBotswana.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../ss/normalize.css">

    <script src="https://kit.fontawesome.com/6f879d6c21.js" crossorigin="anonymous"></script>
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
                <li><a href="org.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="orgAccount.php"><i class="fas fa-user"></i> My account</a></li>
                <li><a href="#"><i class="fas fa-bell"></i> Participants</a></li>
                <li><a href="contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="logout.php"><i class="fas fa-arrow-left"></i> Logout</a></li>
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
            <div class="nav">
                <h2 class="search">Search</h2>
                <?php
                    // display the user aware navigation links
                    if($LOGGED_IN == true){
                
                        //get the users account information from the database
                        $select = "SELECT * FROM Org_account WHERE name = '{$_SESSION['name']}'";
                        $query = mysqli_query($connection, $select);
                        if(mysqli_num_rows($query) == 1){
                            $_USER = mysqli_fetch_assoc($query);
                            echo '<h2 class="Username">'.$_USER['name'].'</h2>';
                            echo '<p class="log">login time: '.date("g:i A ", $_USER['last_login']).'</p>';
                        }
                        else{
                            echo "Unable to load your account information. Please logout and login back in";
                        }
                    }
                    else{
                        echo "<h3>Login to your account to view your account information</h3>";
                    }
                
                ?>
            </div>
            <div class="catalog">
                <div class="catalog-header">
                    <a href="org.php"><p>Go Back</p></a>
                    <h1>Apply Internships</h1>
                </div>

                <?php 
                    // checks if the user has successfully created an account
                    if(isset($success_msg)){
                        echo "<p class='success'>".$success_msg."</p>";
                    }
                    // checks to see if the error message is set, if so display if
                    else if (isset($error_msg))
                        echo "<p style='color:red; text-align:center; font-weight:bold;'>".$error_msg."</p>";
                    else
                        echo "";// do nothing
                ?>
                <form action="internships.php" method="post">
                    <input type="text" name="position" placeholder="Position">
                    <input type="text" name="location" placeholder="Location">
                    <input type="text" name="duration" placeholder="Duration">
                    <input type="number" name="stipend" placeholder="Stipend">
                    <input type="text" name="due_date" placeholder="Closes on">
                    <textarea id="story" name="about" rows="5" cols="33" placeholder="about position..."></textarea>
                    <input type="number" name="avail_pos" placeholder="Available Positions">
                    <br>
                    <input type="submit" name="submit" value="Post">
                </form>
            </div>
        </div>
    </div>
</body>
</html>