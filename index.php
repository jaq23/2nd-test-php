<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
<title> Jackie CS 152</title>
</head>
<body>

<marquee> Over 3 stories and counting </marquee>

<div class="navigation">
  <a class="active" href="#home" >Home</a>
  <a href="service.html" >Service</a>
  <a href="contact.html" >Contact</a>
  <a href="login.html" >Login</a>
</div>

<h1> Some of our most popular works that have been made into books </h1>

<img src="developed memories.jpg" height="30%" width="30%" alt="developedMemories">
<img src="heart value.jpg" width="30%" height="30%" alt="heartValue">
<img src="its high noon.jpg" width="30%" height="30%" alt="itsHighNoon">

</body>
</html>
