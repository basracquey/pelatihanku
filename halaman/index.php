<?php 
session_start();
include 'functions.php';
// Public pages that don't require login
$public_pages = [
  'index.php',
  'tutorial.php',
  'tentang.php',
];

// Get the current page
$current_page = basename($_SERVER['PHP_SELF']);

// Check if the current page is not in the public pages array
if (!in_array($current_page, $public_pages)) {
  // Check if user is not logged in
  if (!isset($_SESSION["login"])) {
      header("location: login.php");
      exit;
  }

  // Check the user level
  $userLevel = $_SESSION["user_level"];

  // Check if the user is trying to access admin pages without admin level
  if (strpos($_SERVER['PHP_SELF'], '/halaman_admin/') !== false && $userLevel !== "admin") {
      header("location: index.php"); // Redirect unauthorized users to home
      exit;
  }
  
  // Restrict access to the wishlist page for non-logged-in users
  if ($current_page == 'wishlist.php' && !isset($_SESSION["login"])) {
      header("location: halaman/login.php");
      exit;
  }
}
  generateUserNavbar('home');
  ?>
  <!DOCTYPE html>
  <html>
  <head>
   <title>Home - Pelatihanqu</title>

   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   <link type="text/css" rel="stylesheet" href="../style.css" />
 </head>
 <body>
  <div class="container" >
    <div class="row">
      <div class="col-md-lg">
        <h2 style="padding: 14px; color: var(--bs-dark-text-emphasis);">Halaman Depan</h2>
        <!-- carousel update -->
        <div class="container">
          <div class="mh-50">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="../img/websitecarousel/carousel1.png" class="d-block w-100" style="height: 300px;" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="../img/websitecarousel/carousel2.png" class="d-block w-100" style="height: 300px;" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="../img/websitecarousel/carousel3.png" class="d-block w-100" style="height: 300px;" alt="...">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>

        <!-- end of carousel update -->

        <div class="halaman">
          <section class="container">
            <style>
              .container {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                /* height: 100vh;
                padding: 20px; */
                box-sizing: border-box;
              }
              .text {
                flex: 1;
                min-width: 300px;
                padding: 20px;
              }
              .image {
                flex: 1;
                min-width: 300px;
                padding: 20px;
              }
              .image img {
                max-width: 100%;
                height: auto;
                display: block;
                margin: 0 auto;
              }
              @media (max-width: 768px) {
                .container {
                  flex-direction: column;
                }
                .text, .image {
                  max-width: 100%;
                  padding: 10px;
                }
              }
            </style>
            <div class="text">
              <h1 style="color:white;">Kembangkan keterampilan anda hari ini!</h1>
              <p>Perkaya keahlian anda dalam sistem informasi dengan platform online terbaik kami.</p>
            </div>
            <div class="image">
              <img src="https://images.unsplash.com/photo-1587620962725-abab7fe55159?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Placeholder Image">
            </div>
          </section>
          <a class="btn btn-primary" href="tutorial.php" style="margin-left:40px;">Jelajahi!</a>
          <section>
            <div class="text">
              <h1 style="color:white;">Pelatihanku : Platform pelatihan online premier</h1>
            </div>
            <div class="text">
              <p>Pelatihanku adalah platform online utama yang didedikasikan untuk menyediakan pelatihan berkualitas tinggi dalam sistem informasi (SI). Spesialisasi dalam berbagai kursus, kami memberikan individu dengan keterampilan dan keahlian yang diperlukan untuk berkembang dalam lanskap SI yang selalu berubah. Dari manajemen database hingga bahasa pemrograman yang penting untuk SI, pilihan kursus kami yang dipilih dengan cermat menjamin peluang pembelajaran yang komprehensif.</p>
            </div>
          </section>

        </div>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
  crossorigin="anonymous"></script>
</body>
</html>
