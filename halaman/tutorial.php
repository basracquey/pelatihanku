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

generateUserNavbar('tutorial');

// Filter category
$categories = query("SELECT DISTINCT kategori FROM t_pelatihan");

// Handle category filter
$selected_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Configure Pagination 
$results_per_page = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_limit = ($page - 1) * $results_per_page;

// Modify the query to include kategori filter
$query = "SELECT * FROM t_pelatihan";
if ($selected_kategori) {
    $query .= " WHERE kategori = '$selected_kategori'";
}

// Count total courses with the selected filter
$total_courses = count(query($query));

// Calculate total pages
$total_pages = ceil($total_courses / $results_per_page);

// Adjust pagination query with kategori filter
$query .= " LIMIT $start_limit, $results_per_page";
$pelatihan = query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Pelatihan</title>
    <style>
        p,h5{
            color:black;
        }
        form {
            background-color: white;
            background : white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0px 0px 0px 0px #000000;
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link type="text/css" rel="stylesheet" href="../style.css" />
    <style>
        p,h5{
            color:black;
        }
        form {
            background-color: white;
            background : white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0px 0px 0px 0px #000000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4" style="color:#f0f0f0;">Halaman Daftar Pelatihan</h2>

        <!-- kategori -->
        <form method="GET" action="">
            <div class="form-group">
                <label for="kategori" style="color:black;">Kategori Pelatihan :</label>
                <select id="kategori" name="kategori" class="form-control" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($categories as $kategori): ?>
                        <option value="<?php echo $kategori['kategori']; ?>" <?php echo ($kategori['kategori'] == $selected_kategori) ? 'selected' : ''; ?>>
                            <?php echo $kategori['kategori']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
        <!-- akhir dari filter kategori -->

        <div class="card-container row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($pelatihan as $row) : ?>
                <div class="col">
                    <div class="card h-100">
                        <img style="padding:10px;"src="../img/<?php echo $row["gambar"]; ?>" class="card-img-top" alt="Course Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["nama_pelatihan"]; ?></h5>
                            <p class="card-text"><?php echo $row["deskripsi_pelatihan"]; ?></p>
                            <p class="card-text"><small class="text-muted">Sumber Website: <?php echo $row["nama_website"]; ?></small></p>
                            <p class="card-text">Kategori : <?php echo $row["kategori"]; ?></p>
                            <p class="card-text">Harga: Rp<?php echo $row["harga_pelatihan"]; ?></p>
                            <a href="<?php echo $row["link_pelatihan"]; ?>" target ="_blank" class="btn btn-primary">Learn More</a>
                            <form style="padding : 0px;margin : 0px 0px 0px 0px;" method="post" action="add_to_wishlist.php">
                                <input type="hidden" name="course_id" value="<?php echo $row["id_pelatihan"]; ?>">
                                <button type="submit" name="add_to_wishlist" class="btn btn-outline-primary mt-2">Add to Wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <!-- Previous Page Link -->
                <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&kategori=<?php echo $selected_kategori; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <!-- link halaman -->
                <?php for ($p = max(1, $page - 2); $p <= min($page + 2, $total_pages); $p++) : ?>
                    <li class="page-item <?php echo ($p == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $p; ?>&kategori=<?php echo $selected_kategori; ?>"><?php echo $p; ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Next Page Link -->
                <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&kategori=<?php echo $selected_kategori; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>
