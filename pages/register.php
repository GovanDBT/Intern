<?php 

    // includes out connect.php script
    require_once("connect.php");

    // checks to see if the user is already logged in, if so redirect them to the home page
    session_start();
    if(isset($_SESSION['name']))
        header("Location: index.php");
    
    /** REGISTRATION FORM */
    // check to see if the submit button has been pressed, if so grab all the data in every form
    if(isset($_POST['register'])){
        // gets all the data from the form
        $status = $_POST['status'];
        $name = $_POST['name'];
        $supervisor = $_POST['username'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];
        $about = $_POST['about'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        // cleans the code from SQL statements and attacks from Hackers (SQL Injection)
        $name = mysqli_real_escape_string($connection, $name);
        $supervisor = mysqli_real_escape_string($connection, $supervisor);
        $city = mysqli_real_escape_string($connection, $city);
        $address = mysqli_real_escape_string($connection, $address);
        $phone = mysqli_real_escape_string($connection, $phone);
        $country = mysqli_real_escape_string($connection, $country);
        $about = mysqli_real_escape_string($connection, $about);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $confirm_password = mysqli_real_escape_string($connection, $confirm_password);

        // makes sure all the required fields are entered
        if($status == "organisation" && $name != "" && $supervisor != "" && $email != "" && $password != "" && $confirm_password != "" && $city!= "" && $address != "" && $phone != "" && $country != ""){
            // makes sure the two passwords match
            if($password === $confirm_password){
                // makes sure the passwords meet the min length and  strength requirement
                if(strlen($password) >= 5 && strpbrk($password, "! # $ . , : ; ( )" != false)){
                    // selects and goes through all the names in the database 
                    $select1 = "SELECT * FROM Organization WHERE name = '{$name}'";
                    //  query the database to see if the name is there
                    $query1 = mysqli_query($connection, $select1);

                    if(mysqli_num_rows($query1) == 1){
                        // selects and goes through all the names in the database 
                        $select = "SELECT * FROM Org_account WHERE name = '{$name}'";
                        //  query the database to see if the name is already taken
                        $query = mysqli_query($connection, $select);

                        if(mysqli_num_rows($query) == 0){
                            // create and format some variable for the database
                            $date_created = time(); // track the date the account was created
                            $last_login = 0; // track our users login
                            $account_status = 1; // lets our users login (1 = active account)

                            // insert the user into the database
                            $insert = "INSERT INTO Org_account VALUES ('{$name}','{$password}','{$city}','{$supervisor}','{$address}','{$email}','{$country}','{$phone}','{$status}','{$last_login}','{$account_status}','{$date_created}','{$about}')";
                            // query the database insert data into the database
                            $query = mysqli_query($connection, $insert);

                            // verifies if the user's account was created
                            $query = mysqli_query($connection, $select);
                            if(mysqli_num_rows($query) == 1){

                                /** USER CAN REGISTER */

                                $success = true;

                                // redirects user to the home page
                                header("Location: org.php");

                            }
                            else
                                $error_msg = "An error occurred and your account was not created :(";
                        }
                        else
                            $error_msg = "The company name <i>".$name."</i> already exist has a similar account.";
                    }
                    else
                        $error_msg = "The name <i>".$name."</i> does not exist. Please contact administrator"; 
                }
                else
                    $error_msg = "Your password should longer than five characters and should contain special characters, Eg !#$.,:;";
            }
            else
                $error_msg = "Your passwords do not match, please try again";
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
    <title>Register</title>
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
                <li><a href="../index.html"><i class="fa-solid fa-home"></i> Dashboard</a></li>
                <li><a href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a></li>
                <li class="highlight"><a href="register.php"><i class="fa-solid fa-address-card"></i> Register</a></li>
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
            <?php 
                // checks if the user has successfully created an account
                if (isset($success) && $success == true){
                    // redirects user to the home page
                    header("Location: org.php");
                }
                // checks to see if the error message is set, if so display if
                else if (isset($error_msg))
                    echo "<p style='color:red; text-align:center; font-weight:bold;'>".$error_msg."</p>";
                else
                    echo ""; // do nothing
            ?>
            <form action="register.php" method="post">
                <select name="status">
                    <option value="student">student</option>
                    <option selected value="organisation">organisation</option>
                    <option value="supervisor">supervisor</option>
                </select>
                <input type="text" name="name" placeholder="company name">
                <input type="text" name="username" placeholder="supervisor">
                <input type="text" name="city" placeholder="city">
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="address" placeholder="address">
                <input type="number" name="phone" placeholder="Phone number">
                <input type="text" name="country" placeholder="country">
                <textarea id="story" name="about" rows="5" cols="33" placeholder="about company..."></textarea>
                <input type="password" name="password" placeholder="password">
                <input type="password" name="confirm-password" placeholder="confirm password">
                <br>
                <input type="submit" name="register" value="Register">
            </form>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6f879d6c21.js" crossorigin="anonymous"></script>
</body>

</html>