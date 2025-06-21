-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 05:41 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelatihanku_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_users`
--

CREATE TABLE `db_users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(73) NOT NULL,
  `user_level` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_users`
--

INSERT INTO `db_users` (`id`, `username`, `password`, `user_level`) VALUES
(17, 'admin', '$2y$10$h5Vb05iE/Ai0Mg7CYD9oseiF6RcZXk8DOtOjbauGkpztmNpYZgS1q', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `t_pelatihan`
--

CREATE TABLE `t_pelatihan` (
  `id_pelatihan` int(11) NOT NULL,
  `nama_pelatihan` varchar(64) NOT NULL,
  `deskripsi_pelatihan` varchar(800) NOT NULL,
  `nama_website` varchar(20) NOT NULL,
  `harga_pelatihan` int(12) NOT NULL,
  `link_pelatihan` varchar(2048) NOT NULL,
  `gambar` varchar(64) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pelatihan`
--

INSERT INTO `t_pelatihan` (`id_pelatihan`, `nama_pelatihan`, `deskripsi_pelatihan`, `nama_website`, `harga_pelatihan`, `link_pelatihan`, `gambar`, `kategori`) VALUES
(1, 'Database MySQL : Pemula sampai Mahir', 'Belajar database MySQL dari pemula sampai mahir disertai studi kasus. Materi akan selalu di-update secara berkala', 'udemy', 129000, 'https://www.udemy.com/course/database-mysql-pemula-sampai-mahir/?utm_source=adwords&utm_medium=udemyads&utm_campaign=SQL_v.PROF_la.ID_cc.ID_ti.7862&utm_content=deal4584&utm_term=_._ag_120360604955_._ad_589984450933_._kw_belajar+sql_._de_c_._dm__._pl__._ti_kwd-834995820453_._li_1007716_._pd__._&matchtype=e&gclid=EAIaIQobChMIvb6805H2-AIVo5NmAh0dEQdkEAAYASAAEgJ9GPD_BwE', 'logo-udemy.svg', 'Data'),
(2, 'Learn SQL Basics for Data Science Specialization', 'This Specialization is intended for a learner with no previous coding experience seeking to develop SQL query fluency. Through four progressively more difficult SQL projects with data science applications, you will cover topics such as SQL basics, data wrangling, SQL analysis, AB testing, distributed computing using Apache Spark, Delta Lake and more. These topics will prepare you to apply SQL creatively to analyze and explore data; demonstrate efficiency in writing queries; create data analysis datasets; conduct feature engineering, use SQL with other data analysis and machine learning toolsets; and use SQL with unstructured data sets.', 'coursera', 0, 'https://www.coursera.org/specializations/learn-sql-basics-data-science?utm_source=gg&utm_medium=sem&utm_campaign=38-SQL-Basics-Data-Science-UCD-ROW&utm_content=B2C&campaignid=13875429786&adgroupid=122574361097&device=c&keyword=sql%20for%20data%20analysis&matchtype=b&network=g&devicemodel=&adpostion=&creativeid=533083670829&hide_mobile_promo&gclid=EAIaIQobChMIvb6805H2-AIVo5NmAh0dEQdkEAAYBCAAEgJo0vD_BwE', 'coursera.svg', 'Data'),
(13, 'SKILL ACCELERATOR BOOTCAMP  Data Analytics', 'Kuasai analisis dan visualisasi data dalam \r\n8 minggu!\r\n\r\nMelalui program ini, Anda akan mempelajari analisis data dengan penerapan visualisasi yang tepat untuk membantu memajukan profesi Anda saat ini.', 'Purwadhika', 0, 'https://purwadhika.com/skill-accelerator/data-analytics', 'purwadhika.png', 'Data Analytics'),
(14, 'Python Komplet: Dari Nol Sampai Bisa!', 'ini adalah online course yang paling lengkap, to-the point, dan mudah dipahami untuk bahasa pemrograman Python di Udemy! Tidak peduli apakah Anda belum pernah mempelajari bahasa pemrograman apapun sebelumnya, atau sudah mengetahui berbagai macam sintaks dasar, atau ingin mempelajari  fitur-fitur canggih Python, video course ini dirancang tentu saja untuk Anda! Dalam kursus ini, kami akan mengajari Anda pemrograman Python secara efektif!', 'udemy', 279000, 'https://www.udemy.com/course/python-komplet/', 'logo-udemy.svg', 'Pemrograman'),
(16, 'ITBOX : Data Analyst Complete Bundle', 'Kursus Data Analyst Online Bersertifikasi & Akses Selamanya\r\nBelajar dari basic sampai tingkat advanced\r\nsecara fleksibel dimana aja dan kapan aja!', 'ITBOX', 629000, 'https://itbox.id/belajar-data-analyst/', 'logoitbox.webp', 'Data'),
(17, 'The Data Science Course: Complete Data Science Bootcamp 2024', 'Complete Data Science Training: Math, Statistics, Python, Advanced Statistics in Python, Machine and Deep Learning', 'udemy', 649000, 'https://www.udemy.com/course/the-data-science-course-complete-data-science-bootcamp/?couponCode=LETSLEARNNOWPP', 'logo-udemy.svg', 'Data'),
(18, 'DATA ANALYSIS: FULLSTACK INTENSIVE BOOTCAMP', 'Upgrade skill mulai dari memahami konsep, analisa studi kasus, hingga praktik untuk optimalisasinya. Kuasai berbagai skill dan tools di bidang Data Analyst untuk perkembangan karier maupun bisnis kamu.', 'myskill.id', 590000, 'https://myskill.id/bootcamp/data-analysis', 'myskill-logo.webp', 'Data Analytics'),
(20, 'Bootcamp Frontend Web Development Batch 17', 'Pelajari cara membangun tampilan website menggunakan HTML, CSS, Bootstrap, Redux, React atau Next js selama 5+ bulan yang akan dibimbing langsung oleh para praktisi digital berpengalaman.', 'dibimbing.id', 7999000, 'https://dibimbing.id/layanan/bootcamp/front-end-web-development', 'logo-dibimbing.svg', 'Frontend'),
(21, 'Progate - Git', 'pelajari sebuah sistem kontrol versi paling populer yang para pengembang gunakan untuk melacak dan membagikan code.', 'Progate', 99000, 'https://progate.com/courses/git', 'progate.png', 'git');

-- --------------------------------------------------------

--
-- Table structure for table `user_wishlist`
--

CREATE TABLE `user_wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_users`
--
ALTER TABLE `db_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pelatihan`
--
ALTER TABLE `t_pelatihan`
  ADD PRIMARY KEY (`id_pelatihan`);

--
-- Indexes for table `user_wishlist`
--
ALTER TABLE `user_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_wishlist_user` (`user_id`),
  ADD KEY `fk_user_wishlist_course` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_users`
--
ALTER TABLE `db_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_pelatihan`
--
ALTER TABLE `t_pelatihan`
  MODIFY `id_pelatihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_wishlist`
--
ALTER TABLE `user_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_wishlist`
--
ALTER TABLE `user_wishlist`
  ADD CONSTRAINT `fk_user_wishlist_course` FOREIGN KEY (`course_id`) REFERENCES `t_pelatihan` (`id_pelatihan`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_wishlist_user` FOREIGN KEY (`user_id`) REFERENCES `db_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
