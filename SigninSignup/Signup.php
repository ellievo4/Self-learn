<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Sign Up </title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            html {
                height: 100%;
                background: url("panda.jpg") no-repeat center center;
                background-size: cover;
            }
            
            body {
                width: 80%;
                height: auto;
                margin: 4em auto;
                background-color: white;
            }
        </style>
    </head>
    
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class = "col-sm-offset-1 col-sm-10 containingDiv">
                    <h1> Never Stay Apart! </h1>
                    
<?php
                    //connect database
                    $link  = @mysqli_connect("127.0.0.1:3307", "root", "", "chickorg") or die ("Error: Unable to connect: " . mysqli_connect_error());
                    //echo '<p class="alert alert-success"> Connect successfully to the database </p>';
                    
                    //get user inputs
                    $error = '';
                    $firstname = isset($_POST['firstname'])?$_POST['firstname']:'';
                    $lastname = isset($_POST['lastname'])?$_POST['lastname']:'';
                    $email = isset($_POST['email'])?$_POST['email']:'';
                    $password = isset($_POST['password'])?$_POST['password']:'';
                    
                    //error messages
                    $existEmail = "<p>This email is existed, please enter a new email</p>";
                    $emptyFirstname = "<p>Please enter your first name</p>";
                    $emptyLastname = "<p>Please enter your last name</p>";
                    $emptyEmail = "<p>Please enter your email</p>";
                    $invalidEmail = "<p>Please enter a valid email</p>";
                    $emptyPassword = "<p>Please enter your password</p>";
                    
                    if (isset($_POST["submit"])) {
                        //check for error 
                        if (!$firstname) {
                            $error .= $emptyFirstname;
                        }
                        else {
                            $firstname = filter_var($firstname,FILTER_SANITIZE_STRING);
                        }
                        
                        if (!$lastname) {
                            $error .= $emptyLastname;
                        }
                        else {
                            $lastname = filter_var($lastname,FILTER_SANITIZE_STRING);
                        }
                        
                        if (!$email) {
                            $error .= $emptyEmail;
                        }
                        else {
                            $email = filter_var($email,FILTER_SANITIZE_EMAIL);
                            
                            //error for invalid email format
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                $error .= $invalidEmail;
                            }
                            
                            //error for duplicate email in database
                            $email = mysqli_real_escape_string($link,$email);
                            $sql = "SELECT * FROM users WHERE email='" . $email . "'";
                            if($result = mysqli_query($link,$sql)) {
                                if (mysqli_num_rows($result)>0) {
                                    $error .= $existEmail;
                                }
                            }
                            
                            else {
                                echo "<p>Unable to excecute: $sql. " . mysqli_error($link) ."</p>";
                            }
                        }
                        
                        if (!$password) {
                            $error .= $emptyPassword;
                        }
                    
                        if ($error) {
                            $resultMsg = '<div class= "alert alert-danger"> ' . $error . '</div>';
                            echo $resultMsg;
                        }
                        else {
                            //no error prepare var for query
                            $tblname = "users";
                            $firstname = mysqli_real_escape_string($link,$firstname);
                            $lastname = mysqli_real_escape_string($link,$lastname);
                            $password = mysqli_real_escape_string($link,$password);
                            $password = md5($password);


                            //exe insert query
                            $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
                            if (mysqli_query($link,$sql)) {
                                $resultMsg = '<div class="alert alert-success"> Data Successfully Added to the Database </div>';
                                echo $resultMsg;
                            }
                            else {
                                $resultMsg = '<div class="alert alert-warning"> Error: Unable to execute: ' . $sql . '.' . mysqli_error($link) .'</div>';
                                echo $resultMsg;
                            }
                        }
                    }
                    
?>
                    
                    <form method="POST" action="Signup.php">
                        <div class="form-group">
                            <label for="firstName">First name: </label>
                            <input type="text" id="firstName" placeholder="Enter your first name.." class="form-control" name="firstname" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last name: </label>
                            <input type="text" id="lastName" placeholder="Enter your last name.." class="form-control" name="lastname" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="email" id="email" placeholder="Enter your email.." class="form-control" name="email" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" id="password" placeholder="Enter your password.." class="form-control" name="password" maxlength="40">
                        </div>
                        
                        <input type="submit" name="submit" class="btn btn-success btn-lg" value="Got Ya Hand Held!">
                        
                    </form>
                    <br/>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>