<?php
session_start();
require '../halaman/functions.php';

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION["login"]) || $_SESSION["user_level"] !== "admin") {
    header("Location: ../index.php");
    exit;
}

// Include the navbar
generateNavbar('admin_pelatihan.php');

// Check if the form is submitted for creating a new course
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    // Validate and sanitize form data
    $newNamaPelatihan = mysqli_real_escape_string($conn, $_POST["new_nama_pelatihan"]);
    $newDeskripsiPelatihan = mysqli_real_escape_string($conn, $_POST["new_deskripsi_pelatihan"]);
    $newNamaWebsite = mysqli_real_escape_string($conn, $_POST["new_nama_website"]);
    $newHargaPelatihan = (int)$_POST["new_harga_pelatihan"];
    $newLinkPelatihan = mysqli_real_escape_string($conn, $_POST["new_link_pelatihan"]);
    $newGambar = mysqli_real_escape_string($conn, $_POST["new_gambar"]);
    $newKategori = mysqli_real_escape_string($conn, $_POST["new_kategori"]);

    // Create the new course
    createCourse($newNamaPelatihan, $newDeskripsiPelatihan, $newNamaWebsite, $newHargaPelatihan, $newLinkPelatihan, $newGambar, $newKategori);

    // Redirect to prevent form resubmission
    header("Location: admin_pelatihan.php");
    exit;
}

// Check if the delete button is clicked
if (isset($_GET["delete"])) {
    $courseIdToDelete = mysqli_real_escape_string($conn, $_GET["delete"]);
    
    // Delete the course
    deleteCourse($courseIdToDelete);

    // Redirect to prevent resubmission
    header("Location: admin_pelatihan.php");
    exit;
}

// Get all course data
$courseData = getAllCourseData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - Pelatihanqu</title>
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <style>
        label, td, th, h1, h2, h3, p {
            color: #f0edee;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
</head>

<body style="background-color:#07393c;padding:20px;">


    <div class="container mt-4">
        <p>Selamat datang di halaman edit pelatihan</p>

        <!-- Display course data -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pelatihan</th>
                        <th>Deskripsi Pelatihan</th>
                        <th>Nama Website</th>
                        <th>Harga Pelatihan</th>
                        <th>Link Pelatihan</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($courseData as $course) : ?>
                        <tr >
                            <td><?php echo $course['id_pelatihan']; ?></td>
                            <td><?php echo $course['nama_pelatihan']; ?></td>
                            <td><?php echo (strlen($course['deskripsi_pelatihan']) > 50) ? substr($course['deskripsi_pelatihan'], 0, 50) . '...' : $course['deskripsi_pelatihan']; ?></td>
                            <td><?php echo $course['nama_website']; ?></td>
                            <td><?php echo $course['harga_pelatihan']; ?></td>
                            <td><a href="<?php echo $course['link_pelatihan']; ?>" style="color: var(--bs-dark-text-emphasis);" ><?php echo (strlen($course['link_pelatihan']) > 50) ? substr($course['link_pelatihan'], 0, 50) . '...' : $course['link_pelatihan']; ?></a></td>
                            <td><img src="../img/<?php echo $course["gambar"]; ?>" class="card-img-top" alt="Course Image"></td>
                            <td><?php echo $course['kategori']; ?></td>
                            <td>
                                <a style="margin : 5px;" href="edit_course_form.php?id=<?php echo $course['id_pelatihan']; ?>"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <a style="margin : 5px;" href="admin_pelatihan.php?delete=<?php echo $course['id_pelatihan']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Form for create action -->
        <div class="mt-4">
            <h2>Create New Course</h2>
            <form method="post" action="admin_pelatihan.php">
                <div class="mb-3">
                    <label for="new_nama_pelatihan" class="form-label">Nama Pelatihan:</label>
                    <input type="text" class="form-control" name="new_nama_pelatihan" required placeholder="Enter Nama Pelatihan">
                </div>

                <div class="mb-3">
                    <label for="new_deskripsi_pelatihan" class="form-label">Deskripsi Pelatihan:</label>
                    <input type="text" class="form-control" name="new_deskripsi_pelatihan" required placeholder="Enter deskripsi pelatihan">
                </div>

                <div class="mb-3">
                    <label for="new_nama_website" class="form-label">Nama Website:</label>
                    <input type="text" class="form-control" name="new_nama_website" required placeholder="Enter nama website">
                </div>

                <div class="mb-3">
                    <label for="new_harga_pelatihan" class="form-label">Harga Pelatihan:</label>
                    <input type="number" class="form-control" name="new_harga_pelatihan" required placeholder="Enter harga pelatihan">
                </div>

                <div class="mb-3">
                    <label for="new_link_pelatihan" class="form-label">Link Pelatihan:</label>
                    <input type="text" class="form-control" name="new_link_pelatihan" required placeholder="Enter link pelatihan">
                </div>

                <div class="mb-3">
                    <label for="new_gambar" class="form-label">Gambar:</label>
                    <input type="text" class="form-control" name="new_gambar" required placeholder="gambar">
                </div>

                <div class="mb-3">
                    <label for="new_kategori" class="form-label">Kategori:</label>
                    <input type="text" class="form-control" name="new_kategori" required placeholder="kategori">
                </div>

                <button type="submit" class="btn btn-primary" name="create">Create</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>

</html>
