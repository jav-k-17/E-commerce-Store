<?php
$name = filter_input(INPUT_POST, 'name');
$from_address = '43-Berry Go Way,<br> Birmingham, New York, 08532';
$to_address= filter_input(INPUT_POST, 'to_address');
$company = 'UPS';
$shipping_class = 'Next Day Air';
$t_num = rand(pow(10,12-1), pow(10,12-1));
$city = filter_input(INPUT_POST, 'city');
$state = filter_input(INPUT_POST, 'state');
$zip = filter_input(INPUT_POST, 'zip');
$date = filter_input(INPUT_POST, 'date');
$o_num = filter_input(INPUT_POST, 'o_num', FILTER_VALIDATE_INT);
$p_length = filter_input(INPUT_POST, 'p_length', FILTER_VALIDATE_FLOAT);
$p_height = filter_input(INPUT_POST, 'p_height', FILTER_VALIDATE_FLOAT);
$p_width = filter_input(INPUT_POST, 'p_width', FILTER_VALIDATE_FLOAT);
$p_weight = filter_input(INPUT_POST, 'p_weight', FILTER_VALIDATE_FLOAT);


if (empty($p_length) || empty($p_width) || empty($p_height) || empty($p_weight) || empty($state) || empty($zip)  || empty($name)  || empty($to_address)  || empty($city)  || empty($o_num)  || empty($date)) {
    $error_message = "Please fill in all required fields.";
}
else if($p_length > 36){
    $error_message = "Please enter valid length.";
}
else if($p_width >36){
    $error_message = "Please enter valid width.";
}
else if($p_height > 36 ){
$error_message = "Please enter valid height.";
}
else if($p_weight > 150 ){
    $error_message = "Please enter valid weight.";
}
else if(!preg_match("/^[a-zA-Z]{2}$/", $state)){
    $error_message = "Please enter valid state.";
}
else if(!preg_match("/^[0-9]{5}(?:-[0-9]{4})?$/", $zip)){
    $error_message = "Please enter valid zip."; 
}else{
    $error_message = '';
}
if($error_message != ''){
    include('shipping.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title> BERRY-GO MARKET 
    </title>
    <link rel="shortcut icon" href="images/berries.jpg">
    <link rel="stylesheet" href="shipping_results.css">
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
<div class="shipping-label">
<h2> Order Details </h2>
<?php if(isset($_SESSION['is_valid_admin'])) { ?>
      <h3 style="text-align: center;"><?php echo "Welcome " . $_SESSION['fname'] . " ". $_SESSION['lname'] . " (". $_SESSION['email'] . ")"; ?></h3>
    <?php } ?>
<label>From Address:</label>
<span><?php echo $from_address ?> <?php echo "<br>"?></span>
    <br>
    <label>To Address:</label>
    <span><?php echo $to_address; ?><?php echo "<br>" ?><?php echo $city. ", ".$state. ", ".$zip?></span>
    <br>
    <label>Shipping Company:</label>
    <span><?php echo htmlspecialchars($company); ?></span>
    <br>
    <label>Shipping Class:</label>
    <span><?php echo htmlspecialchars($shipping_class); ?></span>
    <br>
    <label>Tracking Number:</label>
    <span><?php echo htmlspecialchars($t_num); ?></span>
    <br>
    <label>Order Number:</label>
    <span><?php echo htmlspecialchars($o_num); ?></span>
    <br>
    <label>Package Length:</label>
    <span><?php echo htmlspecialchars($p_length);?><?php echo " in."?></span>
    <br>
    <label>Package Height:</label>
    <span><?php echo htmlspecialchars($p_height); ?><?php echo " in."?> </span>
    <br>
    <label>Package Width:</label>
    <span><?php echo htmlspecialchars($p_width); ?><?php echo " in."?></span>
    <br>
    <label>Package Weight:</label>
    <span><?php echo htmlspecialchars($p_weight); ?><?php echo " lbs."?></span>
    <br>
    <label>Ship Date:</label>
    <span><?php echo htmlspecialchars($date); ?></span>
    <br>
    <img src="images/barcode.png" class="jav">
</div>

</div>
    <footer>
        <p>&copy; 2023 BERRY-GO MARKET. All Rights Reserved.</p>
        <p3> Javin Kenta, 4/7/23, IT202-010, UNIT 9 ASSIGNMENT, jk636@njit.edu</p3>
    </footer>
</body>
</html>
