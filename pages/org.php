<?php 
    // includes out connect.php script
    require_once("connect.php");

    // checks to see if the user is already logged in, if so redirect them to the home page
    session_start();
    if(isset($_SESSION['name']))
        $LOGGED_IN = true;
    else
        $LOGGED_IN = false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization</title>
    <link rel="icon" type="x-icon" href="images/UBotswana.png">
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
                <li class="highlight"><a href="org.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="orgAccount.php"><i class="fas fa-user"></i> My account</a></li>
                <li><a href="#"><i class="fas fa-bell"></i> Notification</a></li>
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
            <h2 class="search">Search</h2>
            <?php 
                // display the user aware navigation links
                if($LOGGED_IN == true){
                    
                    //get the users account information from the database
                    $select = "SELECT * FROM Org_account WHERE name = '{$_SESSION['name']}'";
                    $query = mysqli_query($connection, $select);

                    if(mysqli_num_rows($query) == 1){
                        $_USER = mysqli_fetch_assoc($query);
                        
                        echo '<h3>Hello <i class="fa-solid fa-skull"></i></h3><h2 style="color:#17c141;">'.$_USER['name'].'</h2><h3>You are now logged in.</h3> <br/><br/>';

                        echo "Your account was created on: <u>".date("M d, Y", $_USER['date_created'])."</u><br/><br/>";
                        echo "You logged in at <i>".date("g:i A (t)", $_USER['last_login'])."</i> on <i>".date("M d, Y", $_USER['last_login'])."</i><br/>";
                    }
                    else{
                        echo "Unable to load your account information. Please logout and login back in";
                    }
                }
                else{
                    echo "<h3>Login to your account to view your account information</h3><br/>";
                }
                    

            ?>
            <div class="catalog">
                <a href="internships.php"><p class="intern-btn">Apply Internships</p></a>
                <h1>Internships</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Intern-ID</th>
                            <th>Company name</th>
                            <th>Position</th>
                            <th>Available positions</th>
                            <th>Location</th>
                            <th>Duration</th>
                            <th>Stipend</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Due-Date</th>
                            <th>About</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                            // selects all the data from the internship table in the database
                            $query = "SELECT * FROM Internship WHERE company = '{$_SESSION['name']}'";
                            $select_intern = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_intern)) {
                                $internId = $row['internId'];
                                $company = $row['company'];
                                $position = $row['position'];
                                $avail_pos = $row['available_position'];
                                $loc = $row['location'];
                                $duration = $row['duration'];
                                $stipend = $row['stipend'];
                                $phone = $row['phone'];
                                $email = $row['email'];
                                $due = $row['due_date'];
                                $about = $row['about_intern'];
                                
                                echo "<tr>";
                                echo "<td>$internId</td>";
                                echo "<td>$company </td>";
                                echo "<td>$position</td>";
                                echo "<td>$avail_pos</td>";
                                echo "<td>$loc</td>";
                                echo "<td>$duration</td>";
                                echo "<td>$stipend</td>";
                                echo "<td>$phone</td>";
                                echo "<td>$email</td>";
                                echo "<td>$$due</td>";
                                echo "<td>$about</td>";

                                echo "<td><a href='comment.php?update'>Update</a></td>";
                                echo "<td><a href='comment.php?delete'>delete</a></td>";
                                echo "</tr>";
                    
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>