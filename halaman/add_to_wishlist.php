<?php
session_start();
include 'functions.php';
// $conn = mysqli_connect("localhost", "root", "", "pelatihanonline");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $course_id = $_POST['course_id'];

    $query = "SELECT * FROM user_wishlist WHERE user_id = $user_id AND course_id = $course_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // pelatihan sudah ada di wishlist
        echo "
            <script>
            alert('pelatihan sudah ada di wishlist');
            window.location.href = 'tutorial.php';  // Redirect to tutorial.php
            </script>
        ";
    } else {
        $query = "INSERT INTO user_wishlist (user_id, course_id) VALUES ($user_id, $course_id)";
        if (mysqli_query($conn, $query)) {
            // Course added to wishlist successfully
            echo "
                <script>
                alert('Course added to wishlist successfully');
                window.location.href = 'tutorial.php';  // Redirect to tutorial.php
                </script>
            ";
        } else {
            // Error adding course to wishlist
            echo "
                <script>
                alert('Error adding course to wishlist: " . mysqli_error($conn) . "');
                document.body.style.backgroundColor = '#FFD2D2';  // Set a light red background for better visibility
                window.location.href = 'tutorial.php';  // Redirect to tutorial.php
                </script>
            ";
        }
    }
} else {
    // User is not logged in, redirect to login page or show an error message
    echo "Please log in to add courses to your wishlist";
}

mysqli_close($conn);
?>
