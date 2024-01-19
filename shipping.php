<?php
    //set default values for variables
    if(!isset($name)){
        $name = '';
    }
    if(!isset($from_address)){
        $from_address = '43-Berry Go Way, Birmingham, New York, 08532';
    }
    if(!isset($to_address)){
        $to_address = '';
    }
    if(!isset($company)){
        $company = 'UPS';
    }
    if(!isset($shipping_class)){
        $shipping_class = 'Next Day Air';
    }
    if(!isset($t_num)){
        $t_num = '';
    }
    if(!isset($city)){
        $city = '';
    }
    if(!isset($state)){
        $state = '';
    }
    if(!isset($zip)){
        $zip = '';
    }
    if(!isset($date)){
        $date = '';
    }
    if(!isset($o_num)){
        $o_num = '';
    }
    if(!isset($p_length)){
        $p_length = '';
    }
    if(!isset($p_height)){
        $p_height = '';
    }
    if(!isset($p_width)){
        $p_width = '';
    }
    if(!isset($p_weight)){
        $p_weight = '';
    }
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <title> BERRY-GO MARKET 
    </title>
    <link rel="shortcut icon" href="images/berries.jpg">
    <link rel="stylesheet" href="shipping.css">
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
<div class="header-container">
  <h2>Shipping Details</h2>
  <?php if(isset($_SESSION['is_valid_admin'])) { ?>
      <h3 style="text-align: center;"><?php echo "Welcome " . $_SESSION['fname'] . " ". $_SESSION['lname'] . " (". $_SESSION['email'] . ")"; ?></h3>
    <?php } ?>
</div>
<div style="text-align: center;">
    <?php if(!empty($error_message)) { ?>
        <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php } ?>
</div>
    <form action="shipping_results.php" method="post" style="font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto;">
    <label style="font-weight: bold;">Full Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">Street Address:</label>
    <input type="text" name="to_address" value="<?php echo htmlspecialchars($to_address); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">City:</label>
    <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">State:</label>
    <input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">Zip Code:</label>
    <input type="number" name="zip" value="<?php echo htmlspecialchars($zip); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">Shipping Date:</label>
    <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">Order Number:</label>
    <input type="text" name="o_num" value="<?php echo htmlspecialchars($o_num); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">Package Length (inches):</label>
    <input type="text" name="p_length" value="<?php echo htmlspecialchars($p_length); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">Package Height (inches):</label>
    <input type="text" name="p_height" value="<?php echo htmlspecialchars($p_height); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">Package Width (inches):</label>
    <input type="text" name="p_width" value="<?php echo htmlspecialchars($p_width); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <label style="font-weight: bold;">Package Weight (inches):</label>
    <input type="text" name="p_weight" value="<?php echo htmlspecialchars($p_weight); ?>" required style="padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; width: 100%;">
    <br>
    <input type="submit" value="Submit" style="background-color: #4CAF50; border: none; color: white; padding: 12px 24px; text-align: center;">
    <input type="reset" value="Clear All" style="background-color: #cccccc; border: none; color: white; padding: 12px 24px; text-align: center;">
            </form>
<footer>
        <p>&copy; 2023 BERRY-GO MARKET. All Rights Reserved.</p>
        <p3> Javin Kenta, 4/7/23, IT202-010, UNIT 9 ASSIGNMENT, jk636@njit.edu</p3>
    </footer>
</body>
</html>
