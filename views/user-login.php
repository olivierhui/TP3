<?php
session_start();

?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <title>Log in</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Log in</h2>
        <form method="post" action="">
            <label for="username">username:</label>
            <input type="text" name="username" required>
            
            <label for="password">password:</label>
            <input type="password" name="password" required>
            
            <input type="submit" name="login" value="Log in">
        </form>
        <?php
        if (isset($loginFailed) && $loginFailed) {
            echo "<p>Login failed!</p>";
        }
        ?>
    </div>
</body>
</html>
