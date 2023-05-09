<?php

// includes out connect.php script
    require_once("connect.php");
    session_start();
    /** LOGIN FORM */
    // checks to see if the user clicked the login button
    if(isset($_POST['login'])){
        // gets the form data for processing
        $status = $_POST['status'];
        $user = $_POST['name'];
        $password = $_POST['password'];

        /** LOGIN FOR STUDENT */
        if ($user != "" && $password != "" && $status == "student"){
            // selects and goes through all the organization names in the database
            $select = "SELECT * FROM Student_account WHERE student_Id = '{$user}'";
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
                        $update = "UPDATE Student_account SET last_login ='{$last_login}'";
                        $query = mysqli_query($connection, $update);

                        /** USER CAN LOGIN */

                        $_SESSION['stdId'] = $record['student_Id'];

                        $success = true;

                        // redirects user to the home page
                        header("Location: std.php");
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

        /** LOGIN FOR ORGANIZATIONS */
        // makes sure the required fields are entered
        if ($user != "" && $password != "" && $status == "organisation"){
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

    /** REGISTRATION FORM FOR STUDENTS*/
    $stdId = "";
    $stdName = "";
    $stdCourse = "";
    $stdCity = "";
    $stdYear = "";

    // check to see if the submit button has been pressed, if so grab all the data in every form
    if(isset($_POST['stdRegister'])){
        // gets all the data from the form
        $stdId = $_POST['stdId'];
        $stdStatus = $_POST['stdStatus'];
        $stdPrefer = $_POST['preference'];
        $stdName = $_POST['stdName'];
        $stdCourse = $_POST['stdCourse'];
        $stdCity = $_POST['stdCity'];
        $stdYear = $_POST['stdYear'];
        $stdPass = $_POST['stdPass'];
        $stdConPass = $_POST['stdConPass'];

        // cleans the code from SQL statements and attacks from Hackers (SQL Injection)
        $stdId = mysqli_real_escape_string($connection, $stdId);
        $stdName = mysqli_real_escape_string($connection, $stdName);
        $stdCourse = mysqli_real_escape_string($connection, $stdCourse);
        $stdCity = mysqli_real_escape_string($connection, $stdCity);
        $stdYear = mysqli_real_escape_string($connection, $stdYear);

        // makes sure all the required fields are entered
        if($stdStatus == "student" && $stdId != "" && $stdName != "" && $stdCourse != "" && $stdPass != "" && $stdConPass != "" && $stdCity != "" && $stdYear != ""){
            // makes sure the two passwords match
            if($stdPass === $stdConPass){
                // makes sure the passwords meet the min length and  strength requirement
                if(strlen($stdPass) >= 5 && strpbrk($stdPass, "! # $ . , : ; ( )" != false)){
                    // selects and goes through all the names in the database 
                    $select1 = "SELECT * FROM Student WHERE student_Id = '{$stdId}'";
                    //  query the database to see if the name is there
                    $query1 = mysqli_query($connection, $select1);

                    if(mysqli_num_rows($query1) == 1){
                        // selects and goes through all the names in the database 
                        $select = "SELECT * FROM Student_account WHERE student_Id = '{$stdId}'";
                        //  query the database to see if the name is already taken
                        $query = mysqli_query($connection, $select);

                        if(mysqli_num_rows($query) == 0){
                            // create and format some variable for the database
                            $select2 = "SELECT supervisorId FROM Supervisor ORDER BY RAND() LIMIT 1";
                            $query3 = mysqli_query($connection, $select2);
                            $record = mysqli_fetch_assoc($query3);
                            $supervisor = $record['supervisorId'];
                            $date_created = time(); // track the date the account was created
                            $last_login = 0; // track our users login
                            $account_status = 1; // lets our users login (1 = active account)

                            // insert the user into the database
                            $insert = "INSERT INTO Student_account(student_Id, password, full_Name, city, year, status, supervisor, preference, course, last_login, account_status, date_created) VALUES ('{$stdId}','{$stdPass}','{$stdName}','{$stdCity}','{$stdYear}','{$stdStatus}','{$supervisor}','{$stdPrefer}','{$stdCourse}','{$last_login}','{$account_status}','{$date_created}')";
                            // query the database insert data into the database
                            $query2 = mysqli_query($connection, $insert);
                            $query4 = mysqli_query($connection, $select);
                            if(mysqli_num_rows($query4) == 1){

                                /** USER CAN REGISTER */

                                $success = true;

                                // redirects user to the home page
                                header("Location: login.php");

                            }
                            else
                                $error_msg = "An error occurred and your account was not created :(";
                        }
                        else
                            $error_msg = "The Student ID <i>".$stdId."</i> already exist has a similar account.";
                    }
                    else
                        $error_msg = "The Student ID <i>".$stdId."</i> does not exist. Please contact administrator"; 
                }
                else
                    $error_msg = "Your password should longer than five characters and should contain special characters, Eg !#$.,:;";
            }
            else
                $error_msg = "Your passwords do not match, please try again";
        }
        else
            $error_msg = "Please fill out all the required fields! student";
    }

    /** REGISTRATION FORM FOR COMPANIES*/
    $status = "";
    $name = "";
    $supervisor = "";
    $city = "";
    $address = "";
    $phone = "";
    $country = "";
    $about = "";
    $email = "";
    $password = "";
    $confirm_password = "";
    
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
                            $query2 = mysqli_query($connection, $select);
                            if(mysqli_num_rows($query2) == 1){

                                /** USER CAN REGISTER */

                                $success = true;

                                // redirects user to the home page
                                header("Location: login.php");

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