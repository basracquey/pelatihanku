<?php 
session_start();
require '../halaman/functions.php';
//cek apakah user sudah login
if(!isset($_SESSION["login"])){
    header("Location: ../halaman/login.php");
    exit;
}
// Include the navbar
generateNavbar('indexadmin.php');

// Check the user level
$userLevel = $_SESSION["user_level"];

// Check if the user is trying to access admin pages without admin level
if (strpos($_SERVER['PHP_SELF'], '/halaman_admin/') !== false && $_SESSION["user_level"] !== "admin") {
    header("location: ../index.php"); // Redirect unauthorized users to login
    exit;
}

// Check if the admin is trying to access user pages without user level
if (strpos($_SERVER['PHP_SELF'], '/halaman_admin/') === false && $_SESSION["user_level"] !== "user") {
    header("location: halaman_admin/indexadmin.php"); // Redirect unauthorized users to login
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Admin - Pelatihanqu</title>

    <!-- Internal CSS -->
    <style>
      body {
          background-color: #07393c;
          color: #f0edee;
          font-family: Arial, sans-serif;
          padding:20px;
      }

      .card {
          background-color: #0b5e66;
          border: none;
          border-radius: 10px;
          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      }

      .card-title {
          color: #f0edee;
          font-size: 2rem;
          margin-bottom: 1rem;
      }

      .card-text {
          color: #f0edee;
          font-size: 1.1rem;
      }

      section h2 {
          color: #f0edee;
          font-size: 1.5rem;
          margin-top: 1.5rem;
      }

      section p {
          color: #f0edee;
          font-size: 1rem;
      }
    </style>
  </head>
  <body>
    <div class="container mt-4">
      <div class="card">
        <div class="card-body">
          <h1 class="card-title">Selamat Datang di Halaman Admin</h1>

          <!-- Overview Section -->
          <section>
            <h2>Overview</h2>
            <p>Total Courses: <?php echo getTotalCourses(); ?></p>
            <p>Total Users: <?php echo getTotalUsers(); ?></p>
          </section>
        </div>
      </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
