<?php 
    // includes out connect.php script
    require_once("connect.php");

    session_start();
    // checks to see if the user is already logged in, if so redirect them to the home page
    if(isset($_SESSION['stdId'])){
        $LOGGED_IN = true;
    }
    else
        $LOGGED_IN = false;

    // when uploading a file
    if(isset($_POST["upload"])){

        //retrieves file, file title and file type
        $name = $_POST["filename"];
        $type = $_POST["filetype"];

        if($name != ""){

            $query1 = "SELECT student_Id FROM Student_account WHERE student_Id = '{$_SESSION['stdId']}'";
            $select1 = mysqli_query($connection, $query1);
            $row1 = mysqli_fetch_assoc($select1);
            $stdId = $row1['student_Id'];
    
            //filename with a random number so that similar don't get replaced
            $file = rand(1000,10000)."-".$_FILES['file']['name'];
            //temporary filename tp store
            $file_loc = $_FILES['file']['tmp_name'];
            //upload dir path
            $uploads_dir = '../images';
            if(move_uploaded_file($file_loc, $uploads_dir.'/'.$file)){
                // spl query to insert into DB
                $sql = "INSERT INTO files(fileName,fileOwner,fileType,file) VALUES('{$name}','{$stdId}','{$type}','{$file}')";
                mysqli_query($connection, $sql);
                $success_msg = "File uploaded 👍";
            }
            else
                $error_msg = "Please upload file";
        }
        else
            $error_msg = "Please fill in file name";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
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
                <li><a href="stdAccount.php"><i class="fas fa-user"></i> My account</a></li>
                <li class="highlight"><a href="report.php"><i class="fas fa-bell"></i> Report</a></li>
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
                        $select = "SELECT * FROM Student_account WHERE student_Id = '{$_SESSION['stdId']}'";
                        $query = mysqli_query($connection, $select);
                        if(mysqli_num_rows($query) == 1){
                            $_USER = mysqli_fetch_assoc($query);
                            echo '<h2 class="Username">'.$_USER['full_Name'].'</h2>';
                            echo '<p class="log">'.$_USER['student_Id'].'</p>';
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
                <h1>Submit Report / logbook</h1>
                <?php 
                    // checks to see if the error message is set, if so display if
                    if (isset($error_msg))
                        echo "<p class='errors'>".$error_msg."</p>";
                    else if(isset($success_msg)){
                        echo "<p class='success'>".$success_msg."</p>";
                    }
                    else
                        echo ""; // do nothing
                ?>
                <form action="report.php" method="post" enctype="multipart/form-data">
                    <label>File Title</label>
                    <input type="text" name="filename"><br>
                    <select style="color:#a41c22;" name="filetype">
                        <option value="report">Report</option>
                        <option value="logbook">Logbook</option>
                    </select><br><br>
                    <label>Upload File</label><br>
                    <input type="file" name="file"><br><br>
                    <input type="submit" name="upload" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>