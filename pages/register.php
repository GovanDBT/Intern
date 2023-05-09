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
                <li><a href="../index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="login.php"><i class="fas fa-right-to-bracket"></i> Login</a></li>
                <li class="highlight"><a href="register.php"><i class="fas fa-address-card"></i> Register</a></li>
                <li><a href="about.html"><i class="fas fa-circle-info"></i> About</a></li>
                <li><a href="contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
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
                // checks to see if the error message is set, if so display if
                if (isset($error_msg))
                    echo "<p style='color:red; text-align:center; font-weight:bold;'>".$error_msg."</p>";
                else
                    echo ""; // do nothing
            ?>
            <div class="form">
                <div class="form-btn">
                    <div class="form-company-btn active">Company</div>
                    <div class="form-student-btn">Student</div>
                </div>
                <div class="form-body">
                    <div class="form-company active">
                        <h2>Register as an Organization</h2>
                            <form class="form-input" action="process.php" method="post">
                            <select name="status">
                                <option value="student">student</option>
                                <option selected value="organisation">organisation</option>
                                <option value="supervisor">supervisor</option>
                            </select>
                            <input class="input" type="text" name="name" placeholder="company name" value="<?php echo $name; ?>">
                            <input class="input" type="text" name="username" placeholder="supervisor" value="<?php echo $supervisor; ?>">
                            <input class="input" type="text" name="city" placeholder="city" value="<?php echo $city; ?>">
                            <input class="input" type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
                            <input class="input" type="text" name="address" placeholder="address" value="<?php echo $address; ?>">
                            <input class="input" type="number" name="phone" placeholder="Phone number" pattern="[0-9]{6,8}" value="<?php echo $phone; ?>">
                            <input class="input" type="text" name="country" placeholder="country" value="<?php echo $country; ?>">
                            <textarea class="input" id="story" name="about" rows="3" placeholder="about company..." value="<?php echo $about; ?>"></textarea>
                            <input class="input" type="password" name="password" placeholder="password">
                            <input class="input" type="password" name="confirm-password" placeholder="confirm password">
                            <br>
                            <input class="input-button" type="submit" name="register" value="Register">
                        </form>
                    </div>
                    <div class="form-student">
                        <h2>Register as a Students</h2>
                        <form action="process.php" method="post">
                            <select name="stdStatus">
                                <option selected value="student">student</option>
                                <option value="organisation">organisation</option>
                                <option value="supervisor">supervisor</option>
                            </select>
                            <select name="preference">
                                <option value="none">none</option>
                                <option value="webDev">Web Developer</option>
                                <option value="frontEnd">Frontend Developer</option>
                                <option value="backEnd">Backend Developer</option>
                                <option value="designer">UI Designer</option>
                                <option value="analyst">Data analyst</option>
                            </select>
                            <input type="number" class="input" name="stdId" placeholder="StudentID" value="<?php echo $stdId; ?>">
                            <input type="text" class="input" name="stdName" placeholder="fullname" value="<?php echo $stdName; ?>">
                            <input type="text" class="input" name="stdCourse" placeholder="Course" value="<?php echo $stdCourse; ?>">
                            <input type="text" class="input" name="stdCity" placeholder="City" value="<?php echo $stdCity; ?>">
                            <input type="number" class="input" name="stdYear" placeholder="Year 1,2" value="<?php echo $stdYear; ?>">
                            <input type="password" class="input" name="stdPass" placeholder="password">
                            <input type="password" class="input" name="stdConPass" placeholder="confirm password">
                            <br>
                            <input class="input-button" type="submit" name="stdRegister" value="Register">
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script>
        
    </script>
    <script src="https://kit.fontawesome.com/6f879d6c21.js" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
</body>

</html>