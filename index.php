<?php 
    // includes out connect.php script
    require_once("pages/connect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="x-icon" href="images/UBotswana.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
    <div class="interface">
        <!--Side menu-->
        <div class="menu">
            <!--Header of the side menu-->
            <div class="header">
                <img class="logo" src="images/UBotswana.png" alt="UB logo">
                <h1 class="menu-title">Internship</h1>
            </div>
            <!--links to other pages-->
            <ul class="menu-list">
                <li class="highlight"><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="pages/login.php"><i class="fas fa-right-to-bracket"></i> Login</a></li>
                <li><a href="pages/register.php"><i class="fas fa-address-card"></i> Register</a></li>
                <li><a href="pages/about.html"><i class="fas fa-circle-info"></i> About</a></li>
                <li><a href="pages/contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
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
            <div class="catalog">
                <h1>Available Internships</h1>
                <!-- <div class="intern1 card"> -->
                    <!-- <div class="card-header"> -->
                        <?php 
                            // // selects all the data from the internship table in the database
                            // $query = "SELECT * FROM Internship";
                            // $select = mysqli_query($connection, $query);

                            // while($row = mysqli_fetch_assoc($select)) {
                            //     $company = $row['company'];
                            //     echo "<h3>$company</h3>";

                            // }
                        ?>
                    <!-- </div> -->
                    <!-- <div class="card-body"> -->
                        <!-- <table> -->
                            <?php 
                            // selects all the data from the internship table in the database
                            $query = "SELECT * FROM Internship";
                            $select = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select)) {
                                $company = $row['company'];
                                $position = $row['position'];
                                $avail_pos = $row['available_position'];
                                $loc = $row['location'];
                                $duration = $row['duration'];
                                $stipend = $row['stipend'];
                                $due = $row['due_date'];

                                echo "<div class='card'>";
                                echo "<div class='card-header'>";
                                echo "<h3>$company</h3>";
                                echo "</div>";
                                echo "<div class='card-body'>";
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>Position</th>";
                                echo "<td>$position</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<th>Location</th>";
                                echo "<td>$loc</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<th>Duration</th>";
                                echo "<td>$duration</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<th>Stipend</th>";
                                echo "<td>$stipend</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<th>Closes On</th>";
                                echo "<td>$due</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<th>Available Position</th>";
                                echo "<td>$avail_pos</td>";
                                echo "</tr>";
                                echo "</table>";
                                echo "<a href=''><p>View More</p></a>";
                                echo "</div>";
                                
                                echo "</div>";
                    
                            }
                        ?>
                        <!-- </table> -->
                        <!-- <a href=""><p>View More</p></a> -->
                    <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6f879d6c21.js" crossorigin="anonymous"></script>
</body>
</html>