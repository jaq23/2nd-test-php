<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
</head>
<body>
    <div class="navigation">
  <a href="index.html" >Home</a>
  <a href="service.html" >Service</a>
  <a class ="active" href="contact.html" >Contact</a>
  <a href="login.html" >Login</a>

<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $email = $_POST["email"];
           $username = $_POST["username"];
           $password = $_POST["password"];
           $passwordConfirm = $_POST["passwordConfirm"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($email) OR empty($username) OR empty($password) OR empty($passwordConfirm)) {
            array_push($errors,"Fill out ALL fields");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if ($password!==$passwordConfirm) {
            array_push($errors,"Passwords do not match");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already in use please use alternate");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO users (email, username, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$email, $username, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Account created successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
        }
        ?>

<div class="contact">
	
    <form accept-charset="UTF-8" action="registration.php" class="new_user"
id="new_user" method="post">
        <input name="authenticity_token" type="hidden"
value="NNb6+J/j46LcrgYUC60wQ2titMuJQ5lLqyAbnbAUkdo="
/>

    <label for="user_email">Email:</label><br>
    <input type="email" id="user_email" name="user[email]" placeholder="Email"><br><br>

    <label for="user_name">User name:</label><br>
    <input type="text" id="user_name" name="user[name]" placeholder="Create Username"><br><br>

    <label for="user_password">Password:</label><br>
    <input type="password" id="user_password" name="password" placeholder="Enter password"><br><br>

    <label for="user_password_confirm">Confirm Password:</label><br>
    <input type="password" id="user_password_confirm" name="user[password_confirm]" placeholder="Re-enter Password"><br><br>

    <input class="btn btn-primary" name="commit" type="submit" value="Create account" />

</form>
</div>
