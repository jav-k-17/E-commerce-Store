<?php
require_once('database.php');

// Get the fruit ID from the form
$fruitID = filter_input(INPUT_POST, 'fruit_id', FILTER_VALIDATE_INT);
$fruitCategoryID = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete one fruit from the database
if ($fruitID!= false && $fruitCategoryID != false) {
    $query = 'DELETE FROM fruit WHERE fruitID = :fruitID LIMIT 1';
    $statement = getDB()->prepare($query);
    $statement->bindValue(':fruitID', $fruitID);
    $success = $statement->execute();
    $statement->closeCursor();
}

// Redirect back to the fruit list page
header('Location: fruit.php');
exit;
?>