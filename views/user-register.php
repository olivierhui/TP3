<?php
session_start();

?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <title>register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>register</h2>
        <form method="post" action="">
            <label for="username">username:</label>
            <input type="text" name="username" required>
            
            <label for="password">password:</label>
            <input type="password" name="password" required>
            
            <label for="email">e-mail:</label>
            <input type="email" name="email" required>
            
            <input type="submit" name="register" value="register">
        </form>
    </div>
</body>
</html>
