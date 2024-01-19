<?php
// Require the database.php file which contains the database connection information and establishes a connection to the database
require_once('database.php');

// Get the fruit ID from the GET request and validate it as an integer
$fruitID = filter_input(INPUT_GET, 'fruit_id', FILTER_VALIDATE_INT);

// If the fruit ID is null or false, display an error message
if ($fruitID == NULL || $fruitID == FALSE) {
    echo 'Error: Invalid fruit ID';
    exit();
}

// Prepare a query to get the fruit with the given ID
$queryfruit = 'SELECT * FROM fruit WHERE fruitID = :fruitID';

// Prepare the statement using the database connection
$statement = getDB()->prepare($queryfruit);

// Bind the fruitID parameter to the statement
$statement->bindValue(':fruitID', $fruitID);

// Execute the statement
$statement->execute();

// Fetch the fruit from the statement
$fruit = $statement->fetch();

// Close the statement to free up resources
$statement->closeCursor();

// If the fruit is null, display an error message
if ($fruit == NULL) {
    echo 'Error: fruit not found';
    exit();
}

// Get the details of the fruit
$fruitCode = $fruit['fruitCode'];
$fruitName = $fruit['fruitName'];
$description = $fruit['description'];
$price = $fruit['price'];
// $image = $fruit['image'];

// Close the database connection
$db = NULL;
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title> BERRY-GO MARKET 
    </title>
    <link rel="shortcut icon" href="images/berries.jpg">
    <link rel="stylesheet" href="home.css">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
    <script>
      function changeImageOnMouseOver() {
        document.getElementById("fruitImage").src = "images/<?php echo $fruitID; ?>_bw.png";
      }

      function changeImageOnMouseOut() {
        document.getElementById("fruitImage").src = "images/<?php echo $fruitID; ?>.png";
      }
    </script>
</head>
    <header>
    <img src="images/berries.jpg" alt="Store Image" style="height: 80px; width: auto; object-fit: cover; object-position: left;">
    <h1 style="font-size: 200%; color: white; font-family: Sans-serif; text-align: center;">BERRY-GO MARKET!</h1>
        <nav>
    <ul>
        <li><a href = "home.php">Home</a><li>
        <?php session_start(); if(isset($_SESSION['is_valid_admin'])){ //if set, show it?>
    <li><a href="shipping.php">Shipping</a></li>
<?php } ?>
<?php if(isset($_SESSION['is_valid_admin'])){ ?>
        <li><a href = "shipping_results.php">Order Info</a><li>
            <?php } ?>
        <li><a href = "fruit.php">Fruits</a><li>
        <?php if(isset($_SESSION['is_valid_admin'])){ //if set, show it?>
    <li><a href="create.php">Create</a></li>
<?php } ?>        <li><a href="https://www.google.com/maps/place/Carteret+Middle+School/@40.6481488,-74.3650805,11z/data=!4m6!3m5!1s0x89c3b4bb3f00ffd1:0x65042319cb391d0d!8m2!3d40.5813544!4d-74.2327785!16s%2Fm%2F0766p9g">Visit Us</a><br><br></li>
        <?php
          //session_start();
          if(isset($_SESSION['is_valid_admin'])) {
        ?>
<li><a href="logout.php"><button class="logout-btn">LOGOUT</button></a></li>
        <?php } 
          else {?>
          
          <li><a href="login.php"><button class="login-btn">LOGIN</button></a></li>

        <?php } ?>
</ul>
</nav>
</header>
<body>
<div class="fruit_details">
<h2> Fruit Details </h2>
<?php if(isset($_SESSION['is_valid_admin'])) { ?>
      <h3 style="text-align: center;"><?php echo "Welcome " . $_SESSION['fname'] . " ". $_SESSION['lname'] . " (". $_SESSION['email'] . ")"; ?></h3>
    <?php } ?>
                <label>Fruit Name:</label>
                <span><?php echo htmlspecialchars($fruitName); ?></span>
                <br><br><br>
                <label>Description:</label>
                <span><?php echo htmlspecialchars($description); ?></span>
                <br><br><br>
                <label>Price:</label>
                <span><?php echo htmlspecialchars($price); ?></span>
                <br><br><br>
          <?php // Assuming $fruitID contains the ID of the fruit
                $imagePath = 'images/' . $fruitID . '-bw.png'; // Construct the path to the black and white image file

                if (file_exists($imagePath)) {
                    echo '<div id="image_rollovers">';
                    echo '<img src="' . $imagePath . '" alt="' . $fruitName . '">'; // Display the image with the fruit name as the alt text
                    echo '</div>';
                } else {
                    echo '<p>No image available</p>';
                }
                ?>
                <script>
    "use strict";

    $(document).ready(() => {

        $("#image_rollovers img").each((index, img) => {

            const src = $(img).attr('src');
            const new_src = src.replace("-bw.png", ".png"); // Replaces the -bw in the file name with .jpg to show the non -bw image
            const imgObj = new Image();
            imgObj.src = new_src;
            imgObj.onload = () => {
                $(img).data('imageLoaded', true); // Store the image loaded status as a data attribute
            };

            $(img).mouseover(function() {
                if ($(this).data('imageLoaded')) { // Check if the non -bw image is loaded
                    $(this).attr('src', new_src);
                }
            });

            $(img).mouseout(function() {
                $(this).attr('src', src); // Reverts back to the black and white image
            });

        });

    });
</script>
</div>
</body>
<footer>
        <p>&copy; 2023 BERRY-GO MARKET. All Rights Reserved.</p>
        <p3> Javin Kenta, 4/7/23, IT202-010, UNIT 9 ASSIGNMENT, jk636@njit.edu</p3>
    </footer>
    </body>
</html>