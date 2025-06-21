<?php 
	$conn = mysqli_connect("localhost", "root", "", "pelatihanku_db");

	function query($query){
		global $conn;
		$result = mysqli_query($conn, $query);
	
		// Check for query execution errors
		if (!$result) {
			die("Query failed: " . mysqli_error($conn));
		}
	
		$rows = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
	
		return $rows;
	}

	function generateNavbar($activePage)
{
    $isLoggedIn = isset($_SESSION["login"]);

    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="indexadmin.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav custom-left-nav">
                    <a class="nav-link <?php echo ($activePage == 'admin_akun.php') ? 'active' : ''; ?>"
                       href="admin_akun.php">Akun</a>
                    <a class="nav-link <?php echo ($activePage == 'admin_pelatihan.php') ? 'active' : ''; ?>"
                       href="admin_pelatihan.php">Pelatihan</a>

                    <?php if (!$isLoggedIn) : ?>
                        <a class="nav-link" href="#">Wishlist</a>
                    <?php endif; ?>
                </div>
                <!-- Right-aligned Logout link -->
                <?php if ($isLoggedIn) : ?>
                    <div class="navbar-nav ml-auto">
                        <a class="nav-link <?php echo ($activePage == 'logout') ? 'active' : ''; ?>" href="../halaman/logout.php">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <style>
        /* Custom styling for the left navigation links */
        .custom-left-nav {
            margin-right: auto;
        }
    </style>
    <?php
}

function generateUserNavbar($activePage)
{
    $isLoggedIn = isset($_SESSION["login"]);

    echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link ' . ($activePage == 'tutorial' ? 'active' : '') . '" href="tutorial.php">Jelajahi</a>
                    <a class="nav-link ' . ($activePage == 'wishlist' ? 'active' : '') . '" href="#" onclick="checkLoginAndRedirect(event, ' . ($isLoggedIn ? 'true' : 'false') . ')">Wishlist</a>
                    <a class="nav-link ' . ($activePage == 'tentang' ? 'active' : '') . '" href="tentang.php">About</a>
                </div>';

    // Push remaining items to the right
    echo '<div class="ms-auto"></div>';

    // Right-aligned Login/Logout link
    echo '<div class="navbar-nav">';
    if ($isLoggedIn) {
        echo '<a class="nav-link" href="logout.php">Logout</a>';
    } else {
        echo '<a class="nav-link" href="login.php">Login</a>';
    }
    echo '</div>';

    echo '</div>
        </div>
    </nav>';

    // JavaScript for pop-up notification and redirection
    echo '
    <script>
    function checkLoginAndRedirect(event, isLoggedIn) {
        if (!isLoggedIn) {
            event.preventDefault();
            if (confirm("You need to log in to access the wishlist. Do you want to log in now?")) {
                window.location.href = "login.php";
            }
        } else {
            window.location.href = "wishlist.php";
        }
    }
    </script>
    ';
}

function hapus($id_pelatihan){
	global $conn;
	mysqli_query($conn, "DELETE FROM t_pelatihan WHERE id_pelatihan = $id_pelatihan");
	return mysqli_affected_rows($conn);
}

function hapuswishlist($id_wishlist, $user_id){
	global $conn;
	mysqli_query($conn, "DELETE FROM user_wishlist WHERE course_id = $id_wishlist AND user_id = $user_id");
	return mysqli_affected_rows($conn);
}

function tambahwishlist($id_pelatihan){
    global $conn;
    $id_pelatihan = $_GET["id_pelatihan"];
    // query insert data
    mysqli_query($conn, "INSERT INTO t_wishlist SELECT * FROM t_pelatihan WHERE id_pelatihan=$id_pelatihan");

    // Check for query execution errors
    if (mysqli_error($conn)) {
        die("Query failed: " . mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

	function registrasi($data){
		global $conn;
		$username = strtolower(stripslashes($data["username"]));
		$password = mysqli_real_escape_string($conn,$data["password"]);
		$password2 = mysqli_real_escape_string($conn,$data["password2"]);

		//cek username sudah ada atau belum
		$result = mysqli_query($conn, "SELECT username FROM db_users WHERE username = '$username'");
		if (mysqli_fetch_assoc($result)){
			echo"<script>
			alert('username sudah terdaftar,gunakan username lain')
			</script>";
			return false;
		}

		//cek konfirmasi password
		if ($password !== $password2) {
			echo "<script>
			alert('konfirmasi password tidak sesuai');
			</script>";
			return false;
		}
		// enkripsi password
		$password = password_hash($password, PASSWORD_DEFAULT);

		//tambahkan user baru ke database
		mysqli_query($conn, "INSERT INTO db_users VALUES('', '$username', '$password','user')");
		return mysqli_affected_rows($conn);
	}
	function add_to_wishlist($id_pelatihan){
		global $conn;
		
	}


	function getAllUserData() {
		global $conn;
		$result = mysqli_query($conn, "SELECT * FROM db_users");
		
		// Fetch all user data as an associative array
		$userData = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
		return $userData;
	}
	
	function createUser($username, $password, $userLevel) {
		global $conn;
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	
		$query = "INSERT INTO db_users (username, password, user_level) VALUES ('$username', '$hashedPassword', '$userLevel')";
		mysqli_query($conn, $query);
	}
	
	function updateUser($userId, $newUsername, $newPassword, $newUserLevel)
{
    global $conn;

    $userId = mysqli_real_escape_string($conn, $userId);
    $newUsername = mysqli_real_escape_string($conn, $newUsername);
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $newUserLevel = mysqli_real_escape_string($conn, $newUserLevel);

    $query = "UPDATE db_users SET username = '$newUsername', password = '$newPasswordHash', user_level = '$newUserLevel' WHERE id = '$userId'";
    mysqli_query($conn, $query);
}

	
	function deleteUser($id) {
		global $conn;
		$query = "DELETE FROM db_users WHERE id=$id";
		mysqli_query($conn, $query);
	}
function getUserById($userId)
{
    global $conn;

    $userId = mysqli_real_escape_string($conn, $userId);

    $query = "SELECT * FROM db_users WHERE id = '$userId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}
//functions untuk halaman edit pelatihan
// Get all course data
function getAllCourseData() {
    global $conn;
    $query = "SELECT * FROM t_pelatihan";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Get course data by ID
function getCourseById($id) {
    global $conn;
    $query = "SELECT * FROM t_pelatihan WHERE id_pelatihan = '$id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// Create a new course
function createCourse($nama_pelatihan, $deskripsi_pelatihan, $nama_website, $harga_pelatihan, $link_pelatihan, $gambar, $kategori) {
    global $conn;
    $query = "INSERT INTO t_pelatihan (nama_pelatihan, deskripsi_pelatihan, nama_website, harga_pelatihan, link_pelatihan, gambar,kategori) 
              VALUES ('$nama_pelatihan', '$deskripsi_pelatihan', '$nama_website', $harga_pelatihan, '$link_pelatihan', '$gambar','$kategori')";
    mysqli_query($conn, $query);
}

// Update course by ID
function updateCourse($id, $nama_pelatihan, $deskripsi_pelatihan, $nama_website, $harga_pelatihan, $link_pelatihan, $gambar, $kategori) {
    global $conn;
    $query = "UPDATE t_pelatihan 
              SET nama_pelatihan = '$nama_pelatihan', deskripsi_pelatihan = '$deskripsi_pelatihan', 
                  nama_website = '$nama_website', harga_pelatihan = $harga_pelatihan, 
                  link_pelatihan = '$link_pelatihan', gambar = '$gambar', kategori='$kategori'
              WHERE id_pelatihan = '$id'";
    mysqli_query($conn, $query);
}

// Delete course by ID
function deleteCourse($id) {
    global $conn;
    $query = "DELETE FROM t_pelatihan WHERE id_pelatihan = '$id'";
    mysqli_query($conn, $query);
}

//functions for indexadmin.php
function getTotalCourses() {
    global $conn;
    $query = "SELECT COUNT(*) AS total_courses FROM t_pelatihan";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    return $row['total_courses'];
}

function getTotalUsers() {
    global $conn;
    $query = "SELECT COUNT(*) AS total_users FROM db_users";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    return $row['total_users'];
}
 ?>