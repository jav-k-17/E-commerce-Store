<?php
    session_start();
    $_SESSION = [];
    session_destroy();     // Clean up the session ID
        $login_message = 'You have been logged out.';
        include('login.php');
?>