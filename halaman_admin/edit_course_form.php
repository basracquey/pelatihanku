<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <!-- Add your stylesheets and other head content here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        label,td,th,h1,h2,h3,p {
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
        textarea {
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

.back-button:hover {
    background-color: #357ae8;
}

        .back-button {
            margin-right: 10px;
        }

        /* Style for the text area */
        textarea {
            resize: vertical; /* Allow vertical resizing */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Course</h2>
        <?php
        require '../halaman/functions.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the form data
            $id = $_POST['id'];
            $nama_pelatihan = $_POST['nama_pelatihan'];
            $deskripsi_pelatihan = $_POST['deskripsi_pelatihan'];
            $nama_website = $_POST['nama_website'];
            $harga_pelatihan = $_POST['harga_pelatihan'];
            $link_pelatihan = $_POST['link_pelatihan'];
            $gambar = $_POST['gambar'];
            $kategori = $_POST['kategori'];

            // Check if any actual update is performed
            if (updateCourse($id, $nama_pelatihan, $deskripsi_pelatihan, $nama_website, $harga_pelatihan, $link_pelatihan, $gambar, $kategori)) {
                // Redirect with a success parameter in the URL
                header("Location: edit_course_form.php?id=$id&success=true");
                exit;
            }
        }

        // If the form is not submitted, get the course data for the specified ID
        if (isset($_GET['id'])) {
            $courseId = $_GET['id'];
            $courseData = getCourseById($courseId);
        } else {
            // Redirect if the ID is not provided
            header("Location: admin_pelatihan.php");
            exit;
        }
        ?>
        <button class="back-button" onclick="goBack()">Back</button>

        <form method="post" action="edit_course_form.php">
            <!-- Include other form fields here -->
            <input type="hidden" name="id" value="<?php echo $courseData['id_pelatihan']; ?>">
            <label for="nama_pelatihan">Nama Pelatihan:</label>
            <input type="text" name="nama_pelatihan" value="<?php echo $courseData['nama_pelatihan']; ?>" required>

            <label for="deskripsi_pelatihan">Deskripsi Pelatihan:</label>
            <textarea name="deskripsi_pelatihan" required><?php echo $courseData['deskripsi_pelatihan']; ?></textarea>

            <label for="nama_website">Nama Website:</label>
            <input type="text" name="nama_website" value="<?php echo $courseData['nama_website']; ?>" required>

            <label for="harga_pelatihan">Harga Pelatihan:</label>
            <input type="number" name="harga_pelatihan" value="<?php echo $courseData['harga_pelatihan']; ?>" required>

            <label for="link_pelatihan">Link Pelatihan:</label>
            <input type="text" name="link_pelatihan" value="<?php echo $courseData['link_pelatihan']; ?>" required>

            <label for="gambar">Gambar:</label>
            <input type="text" name="gambar" value="<?php echo $courseData['gambar']; ?>" required>

            <label for="kategori">Kategori:</label>
            <input type="text" name="kategori" value="<?php echo $courseData['kategori']; ?>" required>

            <input type="submit" name="update" value="Update" class="btn btn-primary">
        </form>

        <!-- Add your JavaScript notification handling here -->
        <script>
            // JavaScript function to go back
            function goBack() {
                window.location.href = 'admin_pelatihan.php';
            }
        </script>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
