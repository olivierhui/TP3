<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <form method="post" action="admin-dashboard.php?action=updateUser">
            <input type="hidden" name="userID" value="<?= $user['userID']; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?= $user['username']; ?>" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= $user['email']; ?>" required>
            <input type="submit" name="updateUser" value="Update User">
        </form>
    </div>
</body>
</html>
