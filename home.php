
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> BERRY-GO MARKET 
    </title>
    <link rel="shortcut icon" href="images/berries.jpg">
    <link rel="stylesheet" href="home.css">
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
    <?php if(isset($_SESSION['is_valid_admin'])) { ?>
      <h3 style="text-align: center;"><?php echo "Welcome " . $_SESSION['fname'] . " ". $_SESSION['lname'] . " (". $_SESSION['email'] . ")"; ?></h3>
    <?php } ?>
    <p> 
        The BERRY-GO MARKET Fruit Shop was founded in 1967 in Birmingham, NY with the goal of providing fresh and delicious fruits to the local community and providing 
        a family-friendly orchard to visit. Since then, we have grown our selection of produce and expanded our services to include fruit baskets and gift options. 
        We ensure that our customers always receive the freshest and best-tasting fruits available. At  BERRY-GO MARKET, we believe that eating healthy and flavorful fruits 
        should be an enjoyable and accessible experience for everyone, and we strive to make that possible through our commitment to customer satisfaction and community engagement. 
        Having the opportunity to expand, we have launched this online platform where our fruits can be shipped right to your doorstep.
</p>
<p2> Address: 43-Berry Go Way, Birmingham, New York, 08532
</p2>
<figure>
<img src="images/fruit.jpg" alt="Image" height="200" width="267" style="border: 1px solid #ddd; border-radius: 5px;">
  <figcaption style="font-size: 18px; font-weight: bold; text-align: center; margin-top: 10px; font-family: Arial, sans-serif;">Shop Vibrant and Delicious Fruit Selection!</figcaption>
  <img src="images/fruit-basket-deluxe.jpg" alt="Image" height="200" width="267" style="border: 1px solid #ddd; border-radius: 5px;">
  <figcaption style="font-size: 18px; font-weight: bold; text-align: center; margin-top: 10px; font-family: Arial, sans-serif;">Gift Baskets</figcaption>
  <img src="images/fruit2.jpg" alt="Image" height="200" style="border: 1px solid #ddd; border-radius: 5px;">
  <figcaption style="font-size: 18px; font-weight: bold; text-align: center; margin-top: 10px; font-family: Arial, sans-serif;">Come Visit Our Market!</figcaption>
  <img src="images/bb.jpg" alt="Image" height="200" width="267" style="border: 1px solid #ddd; border-radius: 5px;">
  <figcaption style="font-size: 18px; font-weight: bold; text-align: center; margin-top: 10px; font-family: Arial, sans-serif;">Pick Fresh Berries at our Orchard!</figcaption>
</figure>


<main>
    <footer>
        <p>&copy; 2023 BERRY-GO MARKET. All Rights Reserved.</p>
        <p3> Javin Kenta, 4/7/23, IT202-010, UNIT 9 ASSIGNMENT, jk636@njit.edu</p3>
    </footer>
</body>
</html>