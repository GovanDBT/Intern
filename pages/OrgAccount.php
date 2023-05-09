<?php 
    // includes out connect.php script
    require_once("connect.php");

    session_start();
    // checks to see if the user is already logged in, if so redirect them to the home page
    if(isset($_SESSION['name'])){
        $LOGGED_IN = true;
    }
    else
        $LOGGED_IN = false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
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
                <h1 class="menu-title">Account</h1>
            </div>
            <!--links to other pages-->
            <ul class="menu-list">
                <li><a href="org.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="highlight"><a href="orgAccount.php"><i class="fas fa-user"></i> My account</a></li>
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
            <div class="account-body">
                <?php 
                    //selects all the data from the internship table in the database
                    $query = "SELECT * FROM Org_account WHERE name = '{$_SESSION['name']}'";
                    $select = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select)) {
                        $name = $row['name'];
                        $pass = $row['password'];
                        $city = $row['city'];
                        $supervisor = $row['supervisor'];
                        $address = $row['address'];
                        $email = $row['email'];
                        $country = $row['country'];
                        $phone = $row['phone'];
                        $status = $row['status'];
                        $log = $row['last_login'];
                        $date = $row['date_created'];
                        $about = $row['about'];

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>Company Name: </h4><span class='txt'>$name<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>Supervisor Name: </h4><span class='txt'>$supervisor<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>Company Status: </h4><span class='txt'>$status<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>Country: </h4><span class='txt'>$country<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>City: </h4><span class='txt'>$city<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>Email: </h4><span class='txt'>$email<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>Phone: </h4><span class='txt'>$phone<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>Last login: </h4><span class='txt'>".date("M d, Y", $log)."<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>Date created: </h4><span class='txt'>".date("M d, Y", $date)."<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>About Company: </h4><span class='txt'>$about<span>";
                        echo "</div>";

                        echo "<div class='account-detail'>";
                        echo "<h4 class='accountTxt'>Password: </h4><span class='txt'>$pass<span>";
                        echo "</div>";
            
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>