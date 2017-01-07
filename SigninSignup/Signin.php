<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Sign In </title>
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
                    <h1> Welcome Back </h1>                    
<?php
                    //start the session
                    session_start();
                    //connect database
                    $link  = @mysqli_connect("127.0.0.1:3307", "root", "", "chickorg") or die ("Error: Unable to connect: " . mysqli_connect_error());
                    //echo '<p class="alert alert-success"> Connect successfully to the database </p>';
                    
                    //prepare database email and password, and store user inputs for email and password
                    $dbemail = '';
                    $dbpassword = '';
                    $email = isset($_POST['email'])?$_POST['email']:'';
                    $password = isset($_POST['password'])?$_POST['password']:'';
                    if(isset($_POST["submit"])){
                        if ($email && $password){
                            //exit if email is invalid
                            $email = filter_var($email,FILTER_SANITIZE_EMAIL);
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                die("<p>Please enter a valid email</p>");
                            }

                            //prepare var for query
                            $email = mysqli_real_escape_string($link,$email);
                            $password = mysqli_real_escape_string($link,$password);
                            $password = md5($password);
                            
                            //get info in database from input email and password
                            $sql = "SELECT * FROM users WHERE email='" . $email . "' AND password='" . $password . "' LIMIT 1";
                            if($result = mysqli_query($link,$sql)) {
                                if (mysqli_num_rows($result)>0) {
                                    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                        $dbemail = $row["email"];
                                        $dbpassword = $row["password"];
                                    }
                                    
                                    //store email and loggedIn into session array
                                    $_SESSION['email'] = $dbemail;
                                    $_SESSION['loggedIn'] = true;
                                    
                                    //free the result and redirect to success page
                                    mysqli_free_result($result);
                                    header("Location:success.php");
                                    exit();
                                } 
                                
                                //zero row in result
                                else {
                                    die ("incorrect email and/or password");
                                }
                            }
                            
                            //cant do query
                            else {
                                die("<p>Unable to excecute: $sql. " . mysqli_error($link) ."</p>");
                            }
                        }
                        
                        //no input is received
                        else {
                            die("enter email and password");
                        }
                    }
?>
                    <form method="POST" action="Signin.php">
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="email" id="email" placeholder="Enter your email.." class="form-control" name="email" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" id="password" placeholder="Enter your password.." class="form-control" name="password" maxlength="40">
                        </div>
            
                        <input type="submit" name="submit" class="btn btn-success btn-lg" value="Log in">
                        
                    </form>
                    <br/>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>