<?php
session_start();
include 'functions.php';

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION["login"])) {
    header("location: halaman/login.php");
    exit;
}

// Check the user level
$userLevel = $_SESSION["user_level"];

// Check if the user is trying to access admin pages without admin level
if (strpos($_SERVER['PHP_SELF'], '/halaman_admin/') !== false && $userLevel !== "admin") {
    header("location: home.php"); // Redirect unauthorized users to home
    exit;
}

// Check if the admin is trying to access user pages without user level
if (strpos($_SERVER['PHP_SELF'], '/halaman_admin/') === false && $userLevel !== "user") {
    header("location: ../halaman_admin/indexadmin.php"); // Redirect unauthorized users to admin home
    exit;
}

// Check if user_id is set in the session
if (!isset($_SESSION["user_id"])) {
    echo "Error: User ID not set in session. Please log in again.";
    exit;
}

generateUserNavbar('wishlist');

// Retrieve wishlist items for the logged-in user
$user_id = $_SESSION["user_id"];

// Pagination logic
$itemsPerPage = 10; // How many items to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Fetch categories from the database
$categories = query("SELECT DISTINCT kategori FROM t_pelatihan");

// Default query to retrieve wishlist items
$query = "SELECT t_pelatihan.*
          FROM user_wishlist
          JOIN t_pelatihan ON user_wishlist.course_id = t_pelatihan.id_pelatihan
          WHERE user_wishlist.user_id = $user_id";

// Check if a category filter is applied
$kategoriFilter = isset($_GET['kategori']) && $_GET['kategori'] != 'null' ? $_GET['kategori'] : null;
if ($kategoriFilter) {
    $query .= " AND t_pelatihan.kategori = '$kategoriFilter'";
}

// Add pagination to the query
$query .= " LIMIT $offset, $itemsPerPage";

// Execute the query to fetch wishlist items
$wishlist = query($query);

// Count total wishlist items for pagination
$totalWishlistItemsQuery = "SELECT COUNT(*) as total
                            FROM user_wishlist
                            JOIN t_pelatihan ON user_wishlist.course_id = t_pelatihan.id_pelatihan
                            WHERE user_wishlist.user_id = $user_id";

if ($kategoriFilter) {
    $totalWishlistItemsQuery .= " AND t_pelatihan.kategori = '$kategoriFilter'";
}

$totalWishlistItemsResult = query($totalWishlistItemsQuery);
$totalWishlistItems = $totalWishlistItemsResult[0]['total'];

// Calculate total pages
$totalPages = ceil($totalWishlistItems / $itemsPerPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Wishlist</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../style.css" />
    <style>
        td, th {
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-lg">
                <div class="halaman">
                    <h2 class="mt-4 mb-4" style="color:#f0f0f0;">Halaman Wishlist</h2>
                </div>

                <!-- Category Filter Dropdown -->
                <form action="" method="GET" class="mb-3" style="box-shadow:0 0 0 0; background-color:white;">
                    <label for="kategori" class="form-label" style="color:black;">Filter by kategori:</label>
                    <select name="kategori" id="kategori" class="form-select" onchange="this.form.submit()">
                        <option value="null">Semua Kategori</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['kategori']; ?>" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == $category['kategori']) ? 'selected' : ''; ?>>
                                <?php echo $category['kategori']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>

                <table border="1" cellpadding="10" cellspacing="0">
                    <tr bgcolor="#f0edee">
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Sumber Website</th>
                        <th>Nama Pelatihan</th>
                        <th>Deskripsi Singkat</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>

                    <?php $i = $offset + 1; ?>
                    <?php foreach ($wishlist as $row) : ?>
                        <tr bgcolor="#f0edee">
                            <td><?php echo $i; ?></td>
                            <td><img src="../img/<?php echo $row["gambar"]; ?>" width="50"></td>
                            <td><?php echo $row["nama_website"]; ?></td>
                            <td><a href="<?php echo $row["link_pelatihan"]; ?>"><?php echo $row["nama_pelatihan"]; ?></a></td>
                            <td><?php echo $row["deskripsi_pelatihan"]; ?></td>
                            <td><?php echo $row["kategori"]; ?></td>
                            <td>Rp<?php echo $row["harga_pelatihan"]; ?></td>
                            <td>
                                <a style="margin: 5px;" href="<?php echo $row["link_pelatihan"]; ?>" class="btn btn-primary">Learn More</a>
                                <a style="margin: 5px;" class="btn btn-danger" href="hapuswishlist.php?id_wishlist=<?php echo $row["id_pelatihan"]; ?>" onclick="return confirm('Data akan dihapus?');">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </table>

                <div class="container">
                    <!-- Compact Pagination links -->
                    <nav style="margin: 10px;" aria-label="Page navigation example">
                        <ul class="pagination justify-content-center mt-4">
                            <?php
                            // Define the number of pages to show around the current page
                            $numPagesToShow = 2;

                            // Determine the range of pages to display
                            $startPage = max(1, $page - $numPagesToShow);
                            $endPage = min($totalPages, $page + $numPagesToShow);

                            // Display "Previous" link
                            if ($page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '&kategori=' . $kategoriFilter . '">&laquo;</a></li>';
                            }

                            // Display page links within the range
                            for ($p = $startPage; $p <= $endPage; $p++) :
                            ?>
                                <li class="page-item <?php echo ($p == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $p; ?>&kategori=<?php echo $kategoriFilter; ?>"><?php echo $p; ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Display "Next" link -->
                            <?php if ($page < $totalPages) : ?>
                                <li class="page-item"><a class="page-link" href="?page=<?php echo ($page + 1); ?>&kategori=<?php echo $kategoriFilter; ?>">&raquo;</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
