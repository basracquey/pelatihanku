<?php
session_start();
require '../halaman/functions.php';

// Check if the user is not logged in
if (!isset($_SESSION["login"])) {
    header("Location: ../halaman/login.php");
    exit;
}

// Include the navbar
generateNavbar('admin_akun.php');

// Check the user level
$userLevel = $_SESSION["user_level"];

// Check if the user is trying to access admin pages without admin level
if (strpos($_SERVER['PHP_SELF'], '/halaman_admin/') !== false && $_SESSION["user_level"] !== "admin") {
    header("Location: ../index.php"); // Redirect unauthorized users to login
    exit;
}

// Check if the admin is trying to access user pages without user level
if (strpos($_SERVER['PHP_SELF'], '/halaman_admin/') === false && $_SESSION["user_level"] !== "user") {
    header("Location: halaman_admin/indexadmin.php"); // Redirect unauthorized users to login
    exit;
}

// Initialize variables
$userData = getAllUserData();

// Handle create action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $newUsername = $_POST["new_username"];
    $newPassword = $_POST["new_password"];
    $newUserLevel = $_POST["new_user_level"];

    createUser($newUsername, $newPassword, $newUserLevel);
    header("Location: admin_akun.php");
    exit;
}

// Handle edit action
if (isset($_GET["edit"])) {
    $editUserId = $_GET["edit"];
    $editUserData = getUserById($editUserId);
}

// Handle update action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $updateId = $_POST["update_id"];
    $updateUsername = $_POST["update_username"];
    $updatePassword = $_POST["update_password"];
    $updateUserLevel = $_POST["update_user_level"];

    updateUser($updateId, $updateUsername, $updatePassword, $updateUserLevel);
    header("Location: admin_akun.php");
    exit;
}

// Handle delete action
if (isset($_GET["delete"])) {
    $deleteUserId = $_GET["delete"];
    deleteUser($deleteUserId);
    header("Location: admin_akun.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Akun</title>
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <style>
        label,td,th,h1,h2,h3,p {
            color: #f0edee;
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <title>Admin - Pelatihanqu</title>
</head>

<body style="background-color:#07393c; padding:20px;">

    <div style="margin: 0 30px; padding: 0 30px;">
        <p>Selamat datang di halaman edit akun</p>

        <!-- Display user data -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>User Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userData as $user) : ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td>********</td>
                            <td><?php echo $user['user_level']; ?></td>
                            <td>
                                <a style="margin : 5px;" href="edit_user_form.php?edit=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a style="margin : 5px;" href="admin_akun.php?delete=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Form for create action -->
        <h2>Create New User</h2>
        <form method="post">
            <div class="mb-3">
                <label for="new_username" class="form-label">Username:</label>
                <input type="text" name="new_username" class="form-control" required placeholder="Enter username">
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">Password:</label>
                <input type="password" name="new_password" class="form-control" required placeholder="Enter password">
            </div>

            <div class="mb-3">
                <label for="new_user_level" class="form-label">User Level:</label>
                <select name="new_user_level" class="form-select" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button  type="submit" name="create" class="btn btn-primary">Create</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>
