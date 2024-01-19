<?php
    require_once('database.php');
    require_once('admin.php');
    session_start();
    $db = new PDO('mysql:host=localhost;dbname=fruit_stand', 'web_user', 'pa55word'); //makes pdo object
    // Slide 22 (mostly)
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if(is_valid_admin_login($email, $password)) 
    {
        $_SESSION['is_valid_admin'] = true;
        $queryCategory = 'SELECT * FROM fruitmanagers WHERE emailAddress = :email';
        $statement1 = $db->prepare($queryCategory); // Step 1 Prepare
        $statement1->bindValue(':email', $email); // Step 2 Bind Value
        $statement1->execute(); // Step 3 execute (go)
        $info = $statement1->fetch(); // Step 4 Fetch Data
        $_SESSION['fname'] = $info['firstName']; //gets first name 
        $_SESSION['lname'] = $info['lastName']; //gets last name
        $_SESSION['email'] = $email; //gets email
        $statement1->closeCursor(); //Step 5 Close Cursor
        //echo "<p>$category_name</p>";
        header('Location: home.php');
        exit;
        
    }
    else
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if($email == NULL && $password == NULL)
        {
            $login_message = 'You must login to view this page.';
        }
        else
        {
            $login_message = 'Invalid credentials';
        }
        include('login.php');
    }
}
session_destroy();
?>