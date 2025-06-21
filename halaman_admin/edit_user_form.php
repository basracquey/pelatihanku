<?php
session_start();
require '../halaman/functions.php';

// Check if the user is logged in
if (!isset($_SESSION["login"])) {
    header("Location: ../halaman/login.php");
    exit;
}

// Check the user level
$userLevel = $_SESSION["user_level"];

// Check if the admin is trying to access user pages without admin level
if (strpos($_SERVER['PHP_SELF'], '/halaman_admin/') === false && $_SESSION["user_level"] !== "user") {
    header("location: halaman_admin/indexadmin.php");
    exit;
}

// Check if the user is trying to access admin pages without admin level
if (strpos($_SERVER['PHP_SELF'], '/halaman_admin/') !== false && $_SESSION["user_level"] !== "admin") {
    header("location: ../index.php");
    exit;
}

// Handle the form submission for editing user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update"])) {
        $userId = $_POST["user_id"];
        $newUsername = $_POST["new_username"];
        $newPassword = $_POST["new_password"];
        $newUserLevel = $_POST["new_user_level"];

        // Update the user
        updateUser($userId, $newUsername, $newPassword, $newUserLevel);
        header("Location: admin_akun.php");
        exit;
    }
}

// Fetch user data for the selected user
if (isset($_GET["edit"])) {
    $editUserId = $_GET["edit"];
    $editUserData = getUserById($editUserId);

    // Check if the user exists
    if (!$editUserData) {
        echo "User not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        label,
        td,
        th,
        h1,
        h2,
        h3,
        p {
            color: #f0edee;
        }

        /* Add your additional styles here */
        body {
            background-color: #07393c;
            padding: 20px;
        }

        h2 {
            color: #007bff;
        }

        form {
            background-color: #1c1e21;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            color: #000000;
        }

        .back-button {
            background-color: #6c757d; /* Gray color */
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #495057; /* Darker gray color on hover */
        }

        .back-button {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit User</h2>
        <button class="back-button" onclick="goBack()">Back</button>
        <form method="post">
            <input type="hidden" name="user_id" value="<?php echo $editUserData['id']; ?>">

            <div class="mb-3">
                <label for="new_username">Username:</label>
                <input type="text" name="new_username" value="<?php echo $editUserData['username']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="new_password">Password:</label>
                <input type="password" name="new_password" value="" required>
            </div>

            <div class="mb-3">
                <label for="new_user_level">User Level:</label>
                <select name="new_user_level" class="form-select" required>
                    <option value="admin" <?php echo ($editUserData['user_level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?php echo ($editUserData['user_level'] == 'user') ? 'selected' : ''; ?>>User</option>
                </select>
            </div>

            <input type="submit" name="update" value="Update" class="btn btn-primary">
        </form>

        <!-- Add your JavaScript notification handling here -->
        <script>
            // JavaScript function to go back
            function goBack() {
                window.location.href = 'admin_akun.php';
            }
        </script>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></script>
</body>

</html>
