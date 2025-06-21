<?php 
    session_start();
    include 'functions.php';

// Public pages that don't require login
$public_pages = [
    'home.php',
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
        header("location: home.php"); // Redirect unauthorized users to home
        exit;
    }
    
    // Restrict access to the wishlist page for non-logged-in users
    if ($current_page == 'wishlist.php' && !isset($_SESSION["login"])) {
        header("location: halaman/login.php");
        exit;
    }
  }

    generateUserNavbar('tentang');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tentang Kami - Pelatihanku</title>
    <style>
    body {
        background-color: #07393c;
        color: #f0edee;
    }


    h2, h3 {
        color: #007bff;
    }

    p {
        line-height: 1.6;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    ul li {
        margin-bottom: 10px;
        color: white; 
    }
</style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../style.css" />
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-lg">
            <div class="halaman">
                <h2 style="padding: 14px; color: #f0f0f0;">Tentang Kami</h2>
            </div>

            <p>Selamat datang di Pelatihanku!</p>

            <h3 style="padding: 14px; color: #f0f0f0;">Siapa Kami?</h3>
            <p>Kami adalah platform pembelajaran daring yang menghadirkan berbagai informasi tentang kursus berkualitas di bidang Sistem Informasi.</p>

            <h3 style="padding: 14px; color: #f0f0f0;">Visi dan Misi Kami</h3>
            <p>Visi kami adalah menjadi sumber informasi terpercaya untuk para pembelajar di bidang Sistem Informasi. Kami berkomitmen untuk memberikan akses kepada seluruh masyarakat guna memperluas pengetahuan dan keterampilan di dunia teknologi informasi melalui kurasi konten e-course yang berkualitas.<br>Misi kami adalah menyediakan informasi E-course berkualitas tinggi untuk memenuhi kebutuhan pengguna.</p>

            <h3 style="padding: 14px; color: #f0f0f0;">Keunggulan Kami</h3>
            <ul>
                <li>•Kualitas Terbaik: Kami mengutamakan kualitas dalam setiap produk dan layanan yang kami tawarkan.</li>
                <li>•Pelayanan Pelanggan: Layanan pelanggan adalah prioritas kami. Tim kami siap membantu Anda dengan setiap pertanyaan atau masalah yang Anda miliki.</li>
                <li>•Inovasi Terus-Menerus: Kami berkomitmen untuk terus berinovasi dan meningkatkan layanan kami sesuai dengan perkembangan terbaru di industri ini.</li>
            </ul>

            <h3 style="padding: 14px; color: #f0f0f0;">Mengapa Memilih Kami?</h3>
            <ul>
                <li>•Pengalaman yang Teruji: Dengan pengalaman bertahun-tahun, kami telah membangun reputasi sebagai mitra yang dapat diandalkan.</li>
                <li>•Portofolio Sukses: Lihatlah portofolio kami yang mencerminkan keberhasilan dan kualitas layanan yang kami berikan.</li>
                <li>•Komitmen Terhadap Kepuasan Pelanggan: Kepuasan pelanggan adalah prioritas utama kami. Kami berusaha keras untuk memastikan setiap pelanggan puas dengan pengalaman mereka.</li>
            </ul>

            <!-- <h3 style="padding: 14px; color: #f0f0f0;">Hubungi Kami</h3>
            <p>Jangan ragu untuk menghubungi kami untuk informasi lebih lanjut atau untuk memulai kerjasama bersama kami. Kami siap menjadi mitra terpercaya Anda.</p> -->

            <p>Terima kasih telah memilih Pelatihanku!</p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
