# Online E-Course Aggregator

An online platform built to aggregate and display e-courses from various sources. This was developed as a university project.

## 🚀 Features

- User registration and login system with bcrypt password hashing.
- Browse a catalog of courses.
- Search and filter courses by category.
- Wishlist functionality (add/remove courses).
- Admin panel for managing courses (CRUD operations).

## 🛠️ Technology Stack

- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS
- **Password Hashing:** bcrypt

## ⚙️ Installation & Setup

To run this project locally, follow these steps:

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/basracquey/pelatihanku.git
    cd pelatihanku
    ```

2.  **Set up the database:**

    - Create a new MySQL database (e.g., `pelatihanku_db`).
    - Import the `pelatihanonline.sql` file into the database using phpMyAdmin or MySQL CLI.

3.  **Configure your environment:**

    Open `functions.php` and update the database credentials:

    ```php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "pelatihanku_db";

    $conn = new mysqli($host, $user, $pass, $db);

    ```

4.  **Run the project:**
    - Move the project folder in your web server's root directory (e.g., `htdocs` for XAMPP).
    - Open your web browser and navigate to `http://localhost/pelatihanku`.
5.  ## 🔐 Demo Login


    To access the admin panel:

    - **Username:** admin
    - **Password:** admin123 (hashed in database)

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.
