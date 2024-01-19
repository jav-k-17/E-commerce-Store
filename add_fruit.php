<?php
session_start();
// Get the product data
$category_id = filter_input(INPUT_POST, 'fruitCategoryID', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'fruitCode');
$name = filter_input(INPUT_POST, 'fruitName');
$description = filter_input(INPUT_POST, 'description');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

// Validate inputs
if (isset($_POST) && !empty($_POST)) {
    if ($category_id == null || $category_id == false || $code == null
        || $name == null || $price == null
        || $price == false || $description == null) {
        $error = "Invalid product data. Check all fields and try again.";
        include('create.php'); // Display the form page with the error message
        exit();
    } else {
        require_once('database.php');
    }

    // Check if the fruitCode already exists in the database
    function isDuplicateFruitCode($db, $code) {
        $query = 'SELECT COUNT(*) FROM fruit WHERE fruitCode = :code';
        $statement = $db->prepare($query);
        $statement->bindValue(':code', $code);
        $statement->execute();
        $count = $statement->fetchColumn();
        $statement->closeCursor();
        return $count > 0;
    }

    if (isDuplicateFruitCode(getDB(), $code)) {
        $error = "Duplicate fruit code value. Please choose a different fruit code.";
        include('create.php'); // Display the form page with the error message
        exit();
    } else {
       // Insert the record into the database
       $query = 'INSERT INTO fruit (fruitCategoryID, fruitCode, fruitName, description, price, dateAdded)
       VALUES(:category_id, :code, :name, :description, :price, NOW())';
        $statement = getDB()->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $success = $statement->execute();
        $statement->closeCursor();   
    if ($success) {
    // Get the ID of the newly inserted fruit
        $fruit_id = getDB()->lastInsertId();
    // Redirect to the category page of the fruit that was added
        header("Location: fruit.php?id=$category_id#fruit$fruit_id");
    exit();
    } else {
        echo "<p>Error inserting data.</p>";
    }

        // Display the Product List page
        include('fruit.php');
        exit();
    }
} else {
    $error = "Invalid request. Please try again.";
    include('create.php');
    exit();
}

// Display the form page
//include('create.php');
?>
