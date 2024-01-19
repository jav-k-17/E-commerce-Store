<?php
require_once('database.php');

$fruitCategoryID = filter_input(INPUT_GET, 'fruitCategoryID', FILTER_VALIDATE_INT);
if ($fruitCategoryID === NULL || $fruitCategoryID === FALSE) {
    // Get the ID of the first category in the database
    $queryFirstCategory = 'SELECT fruitCategoryID FROM fruitcategories ORDER BY fruitCategoryID ASC LIMIT 1';
    $statement = getDB()->query($queryFirstCategory);
    $result = $statement->fetch();
    $statement->closeCursor();

    // Use the ID of the first category as the default category ID
    $fruitCategoryID = $result['fruitCategoryID'];
}

// Get name for selected category
$queryCategory = 'SELECT * FROM fruitcategories WHERE fruitCategoryID = :fruitCategoryID';
$statement1 = getDB()->prepare($queryCategory);
$statement1->bindValue(':fruitCategoryID', $fruitCategoryID);
$statement1->execute();
$category = $statement1->fetch();
$category_name = " ";

if ($category !== false) {
    $category_name = $category['fruitCategoryName'];
}
$statement1->closeCursor();

// Get all categories
$queryAllCategories = 'SELECT * FROM fruitcategories ORDER BY fruitCategoryID';
$statement2 = getDB()->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get products for selected category
$queryProducts = 'SELECT * FROM fruit WHERE fruitCategoryID = :fruitCategoryID ORDER BY fruitID';
$statement3 = getDB()->prepare($queryProducts);
$statement3->bindValue(':fruitCategoryID', $fruitCategoryID);
$statement3->execute();
$fruits = $statement3->fetchAll();
$statement3->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> BERRY-GO MARKET 
    </title>
    <link rel="shortcut icon" href="images/berries.jpg">
    <link rel="stylesheet" href="fruit.css">
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
    <main>
    <h1> Fruit List</h1>
    <?php if(isset($_SESSION['is_valid_admin'])) { ?>
      <h3 style="text-align: center;"><?php echo "Welcome " . $_SESSION['fname'] . " ". $_SESSION['lname'] . " (". $_SESSION['email'] . ")"; ?></h3>
    <?php } ?>
    <aside>
    <h2>Categories</h2>
    <?php if (!empty($error)) { ?>
    <div style="text-align: center;">
    <h5 style="color: red; font-weight: bold; font-size: 20px;"><?php echo htmlspecialchars($error); ?></h5>
</div>
<?php } ?>
    <nav>
        <select name="fruitCategoryID" onchange="window.location.href=this.value">
            <?php foreach ($categories as $category) : ?>
                <option value="?fruitCategoryID=<?php echo $category['fruitCategoryID']; ?>" <?php if ($fruitCategoryID == $category['fruitCategoryID']) echo 'selected'; ?>>
                    <?php echo $category['fruitCategoryName']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </nav>
</aside>
<section>
    <h2><?php echo $category_name; ?></h2>
    <table>
    <thead>
        <tr>
            <th>Fruit Category</th>
            <th>Fruit Code</th>
            <th>Fruit Name</th>
            <th>Fruit Description</th>
            <th>Price ($US Dollar)</th>
           <?php if(isset($_SESSION['is_valid_admin'])){ ?>
                <th>Delete Fruit</th>
<?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($fruits as $fruit) : ?>
            <tr>
            <td><?php echo htmlspecialchars($category_name); ?></td>
            <td><a href="details.php?fruit_id=<?php echo $fruit['fruitID']; ?>"><?php echo $fruit['fruitCode']; ?></a></td>
            <td><?php echo htmlspecialchars($fruit['fruitName']); ?></td>
            <td><?php echo htmlspecialchars($fruit['description']); ?></td>
            <td><?php echo htmlspecialchars($fruit['price']); ?></td>
            <?php if(isset($_SESSION['is_valid_admin'])){ ?>
                <td><form action="delete.php" method="post" onsubmit="return confirmDelete = confirm ('Are you sure you want to delete this item?');">
                    <input type="hidden" name="fruit_id"
       value="<?php echo $fruit['fruitID']; ?>">
                    <input type="hidden" name="category_id"
                        value="<?php echo $fruit['fruitCategoryID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
<?php } ?>
</tr>
        <?php endforeach; ?>
    </tbody>
</table>
</section>
</main>
<footer>
        <p>&copy; 2023 BERRY-GO MARKET. All Rights Reserved.</p>
        <p3> Javin Kenta, 4/7/23, IT202-010, UNIT 9 ASSIGNMENT, jk636@njit.edu</p3>
    </footer>
</body>
</html>