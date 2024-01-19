<?php
require_once('database.php');

// check if session is already started
if (!isset($_SESSION)) {
    session_start();
}

$query_product = 'SELECT *
          FROM fruitCategories
          ORDER BY fruitCategoryID, fruitCategoryName';
$statement = getDB()->prepare($query_product);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> BERRY-GO MARKET 
    </title>
    <link rel="shortcut icon" href="images/berries.jpg">
    <link rel="stylesheet" href="create.css">
</head>
<header>
    <img src="images/berries.jpg" alt="Store Image" style="height: 80px; width: auto; object-fit: cover; object-position: left;">
    <h1 style="font-size: 200%; color: white; font-family: Sans-serif; text-align: center;">BERRY-GO MARKET!</h1>
        <nav>
    <ul>
        <li><a href = "home.php">Home</a><li>
        <?php if(isset($_SESSION['is_valid_admin'])){ //if set, show it?>
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
<h1>Add Fruit</h1>
<?php if(isset($_SESSION['is_valid_admin'])) { ?>
      <h3 style="text-align: center;"><?php echo "Welcome " . $_SESSION['fname'] . " ". $_SESSION['lname'] . " (". $_SESSION['email'] . ")"; ?></h3>
    <?php } ?>
<?php if (!empty($error)) { ?>
    <div style="text-align: center;">
    <h5 style="color: red; font-weight: bold; font-size: 20px;"><?php echo htmlspecialchars($error); ?></h5>
</div>
<?php } ?>
<form action="add_fruit.php" method="post" id="add_fruit_form">

<label>Category:</label>
<select name="fruitCategoryID">
    <?php foreach ($categories as $category) : ?>
        <option value="<?php echo $category['fruitCategoryID']; ?>">
            <?php echo $category['fruitCategoryName']; ?>
        </option>
    <?php endforeach; ?>
</select><br>

<label>Code:</label>
<input type="text" name="fruitCode" id="fcode"><br>

<label>Name:</label>
<input type="text" name="fruitName" id="fname"><br>

<label>Description:</label>
<textarea name="description" id="descp"></textarea><br>

<label>Price:</label>
<input type="number" name="price" step="0.01" min="0" max="1000" id="fprice"><br>

<label>&nbsp;</label>
<input type="submit" id="submit" value="Add Fruit" style="background-color: #4CAF50; border: none; color: white; padding: 12px 24px; text-align: center;">
    <input type="reset" value="Clear All" style="background-color: #cccccc; border: none; color: white; padding: 12px 24px; text-align: center;">
</form>

    </main>
</body>
<script>
       const checkFields = evt => {
  const code = document.querySelector("#fcode").value;
  const name = document.querySelector("#fname").value;
  const description = document.querySelector("#descp").value;
  const price = parseFloat(document.querySelector("#fprice").value);
if(code.trim() == "" && name.trim() == "" && decription.trim() == "" && price.trim() == ""){
    alert("Must enter field values");
    evt.preventDefault();
}else if (!(/[A-Z]\d{0,2}/).test(code)){
    alert("Fruit code must be Uppercase letter followed one or two numbers.");
    evt.preventDefault();
  } else if (!(/^[a-zA-Z]+$/.test(name))) {
    alert("Invalid Name");
    evt.preventDefault();
  } else if (description.trim() === "") {
    alert("Must enter fruit description");
    evt.preventDefault();
  } else if (!(/^\d+(\.\d{1,2})?$/.test(price))) {
    alert("Must input valid price");
    evt.preventDefault();
  }
}

document.addEventListener("DOMContentLoaded", () => {
  document.querySelector("#submit").addEventListener("click", checkFields);
});

</script>
<footer>
        <p>&copy; 2023 BERRY-GO MARKET. All Rights Reserved.</p>
        <p3> Javin Kenta, 4/7/23, IT202-010, UNIT 9 ASSIGNMENT, jk636@njit.edu</p3>
    </footer>
</html>