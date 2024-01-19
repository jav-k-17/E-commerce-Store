<?php
    require_once('database.php');
    // Slide 18
    //function to check if info is correct
    function is_valid_admin_login($email, $password) 
    {
        $db = getDB();
        $query = 'SELECT password FROM fruitmanagers WHERE emailAddress = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if($row === false)
        {
            return false;
        }
        else
        {
            $hash = $row['password'];
            return password_verify($password, $hash);
        }
    }
    function add_fruit_manager($email, $password, $firstName, $lastName) {
        $db = new PDO('mysql:host=localhost;dbname=fruit_stand', 'web_user', 'pa55word');
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO fruitManagers (emailAddress, password, firstName, lastName)
                  VALUES (:email, :password, :firstName, :lastName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $hash);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->execute();
        $statement->closeCursor();
    }
    
    // // Inserting 3 records
    // add_fruit_manager('john@example.com', 'secret', 'John', 'Doe');
    // add_fruit_manager('jane@example.com', 'password', 'Jane', 'Smith');
    // add_fruit_manager('bob@example.com', '12345', 'Bob', 'Johnson');
    
?>