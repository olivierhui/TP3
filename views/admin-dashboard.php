<?php
session_start();

if (!isset($_SESSION['loggedin']) || !isset($_SESSION['roleID']) || $_SESSION['roleID'] != 1) {
    header('Location: user-login.php');
    exit;
}


include __DIR__ . '/../database.php';
include __DIR__ . '/../Class/User.php';

$user = new User($pdo);
$logs = $user->getAllLogs();

?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h2>User Activity Logs</h2>
    <table>
        <thead>
            <tr>
                <th>UserID</th>
                <th>IP Address</th>
                <th>Date</th>
                <th>Visited Page</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log) : ?>
                <tr>
                    <td><?php echo $log['userID']; ?></td>
                    <td><?php echo $log['ip']; ?></td>
                    <td><?php echo $log['date']; ?></td>
                    <td><?php echo $log['visitedPage']; ?></td>
                    <td>
                    <a href="admin-dashboard.php?action=editUser&userID=<?= $user['userID']; ?>">Edit</a> | 
                    <a href="admin-dashboard.php?action=deleteUser&userID=<?= $user['userID']; ?>">Delete</a>
                </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Add New Post</h2>
    <form method="post" action="index.php?action=addPost">
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="content">Content:</label>
        <textarea name="content" required></textarea>

        <input type="submit" name="addPost" value="Add Post">
    </form>

    <h2>All Users</h2>
<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change Role</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($allUsers as $user): ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['roleID']; ?></td> 
                <td>
                    <form method="post" action="changeUserRole.php">
                        <select name="roleID">
                           
                            <option value="1">Admin</option>
                            <option value="2">Client</option>
                        </select>
                        <input type="hidden" name="userID" value="<?php echo $user['userID']; ?>">
                        <input type="submit" value="Change Role">
                    </form>
                </td>
                <td>
                    <a href="admin-dashboard.php?action=editUser&userID=<?= $user['userID']; ?>">Edit</a> | 
                    <a href="admin-dashboard.php?action=deleteUser&userID=<?= $user['userID']; ?>">Delete</a>
                </td> 
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h2>Manage Categories</h2>
<form method="post" action="addCategory.php">
    <label for="categoryName">Category Name:</label>
    <input type="text" name="categoryName" required>
    <input type="submit" name="addCategory" value="Add Category">
</form>

<h3>All Categories</h3>
<ul>
    <?php foreach($allCategories as $category): ?>
        <li>
            <?php echo $category['categoryName']; ?>
            <a href="deleteCategory.php?categoryID=<?php echo $category['categoryID']; ?>">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>



</body>

</html>