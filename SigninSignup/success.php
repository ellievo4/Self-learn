<?php
    // Start the session
    ob_start();
    session_start();

    // Check to see if actually logged in. If not, redirect to login page
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: index.php");
        exit();
    }
    
    //output the successful message
    echo "You are successfully loggin in as " . $_SESSION['email'];
?>
<form method="post" action="logout.php">
    <input type="submit" value="Logout">
</form>
