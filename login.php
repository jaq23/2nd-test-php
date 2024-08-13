<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="styles.css">
<title> Login </title>
<head>
	<h1> Login </h1>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>

         <div class="navigation">
  <a href="index.html" >Home</a>
  <a href="service.html" >Service</a>
  <a class ="contact.html" href="contact.html" >Contact</a>
  <a class="active" href="login.html" >Login</a>
</div>

<div class="login">
	<form accept-charset="UTF-8" action="/login" method="post">
        <input name="authenticity_token" type="hidden"
value="NNb6+J/j46LcrgYUC60wQ2titMuJQ5lLqyAbnbAUkdo="
/>
        <label for="session_email">Email:</label><br>
        <input type="text" id="session_email" name="session[email]" placeholder="Username"><br><br>

        <label for="session_password">Password:</label><br>
        <input type="password" id="session_password" name="session[password]" placeholder="Password"><br><br>

        <input class="btn btn-primary" name="commit" type="submit" value="submit"/>

    </form>
</div>

</body>
</html>
