<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6eada17be4.js" crossorigin="anonymous"></script>
    <title>Customer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-card">
    <h1 style="text-align: center;
    font-size: 2.2em;
    font-weight: 700;
    margin-bottom: 22px;
    color: #757575;">Register</h1><br>
    <form method="post" action="index.php?controller=customer&action=registerProcess">
        <input type="text" name="name" placeholder="Name">
        <input type="date" name="dob" placeholder="Birthday">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="text" name="phone" placeholder="Phone">
        <input type="text" name="address" placeholder="Address">

        <input type="submit" name="login" class="login login-submit" value="Register">
    </form>
    <div class="login-help">
        <a href="index.php?controller=customer&action=login">Login</a> • <a href="#">Forgot Password</a>
    </div>
</div>

</body>
</html>