<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6eada17be4.js" crossorigin="anonymous"></script>
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-card">
    <h1 style="text-align: center;
    font-size: 2.2em;
    font-weight: 700;
    margin-bottom: 22px;
    color: #757575;">Login</h1><br>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'invalid') {
        echo "<p style='color: red;'>Invalid login credentials. Please try again.</p>";
    }
    ?>
    <form method="post" action="index.php?controller=staff&action=loginProcess">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="login" class="login login-submit" value="Login">
    </form>
    <div class="login-help">
        <a href="#">Register</a> • <a href="#">Forgot Password</a>
    </div>
</div>

</body>
</html>