<?php
session_start();
include 'includes/db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Ambil data siswa
$query_students = "SELECT * FROM students WHERE name LIKE ?";
$search_param = "%" . $search . "%";
$stmt_students = $conn->prepare($query_students);
$stmt_students->bind_param("s", $search_param);
$stmt_students->execute();
$result_students = $stmt_students->get_result();

if (!$result_students) {
    die("Query error: " . $conn->error);
}

// Ambil data pelatih
$query_coaches = "SELECT * FROM coaches WHERE name LIKE ?";
$stmt_coaches = $conn->prepare($query_coaches);
$stmt_coaches->bind_param("s", $search_param);
$stmt_coaches->execute();
$result_coaches = $stmt_coaches->get_result();

if (!$result_coaches) {
    die("Query error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Privat Baseball Muhammad Tawakal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            transition: background-color 0.5s, color 0.5s;
            background-color: #f0f8ff; /* Light blue background color */
            color: #333;
        }
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .section {
            padding: 60px 0;
        }
        .student-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff; /* White background for student cards */
        }
        .student-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .coach-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        h1, h3 {
            color: #0056b3; /* Dark blue color for headings */
        }
        .carousel-caption h3 {
            color: #fff; /* White color for carousel captions */
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-5">
        <input type="text" id="search" class="form-control mb-3" placeholder="Search">
        
        <h1 class="text-center section">Selamat Datang di Kursus Privat Baseball Muhammad Tawakal</h1>
        <p class="text-center">Kursus privat untuk berbagai jenjang usia dengan pelatih profesional.</p>

        <div id="tentang" class="row section">
            <div class="col-md-12">
                <h3>Tentang Kami</h3>
                <p>"Kami di Kursus Baseball Muhammad Tawakal berkomitmen untuk membimbing Anda menguasai teknik dasar hingga strategi permainan tingkat lanjut, karena hasrat kami adalah melihat Anda sukses di lapangan."</p>
            </div>
        </div>

        <div id="sejarah" class="row section">
            <div class="col-md-12">
                <h3>Sejarah</h3>
                <p>Berawal dari kecintaan mendalam terhadap olahraga baseball dan keinginan kuat untuk mengembangkan bakat-bakat muda di Indonesia, Muhammad Tawakal, seorang mantan pemain baseball nasional, mendirikan Kursus Baseball Muhammad Tawakal pada tahun 2020. Dengan bekal pengalaman bermain di liga profesional dan pengetahuan mendalam tentang seluk-beluk baseball, Muhammad Tawakal memulai kursus ini dengan sederhana. Ia menyewa sebuah lapangan kecil di daerah Bandung dan mengumpulkan beberapa anak muda yang memiliki minat yang sama terhadap olahraga ini.</p>
            </div>
        </div>

        <div id="pelatih" class="row section">
            <div class="col-md-12">
                <h3>Pelatih</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result_coaches->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['position'] . "</td>";
                                echo "<td><img src='" . substr($row['photo'], 3) . "' alt='Foto Pelatih' class='coach-photo'></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="students" class="row section">
            <div class="col-md-12">
                <h3>Daftar Siswa</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result_students->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['age'] . "</td>";
                                echo "<td><img src='" . substr($row['photo'], 3) . "' alt='Foto Siswa' class='student-photo'></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Lokasi -->
        <div id="lokasi" class="row section">
            <div class="col-md-12">
                <h3>Lokasi</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.972148389384!2d106.82838731535741!3d-6.175392995502571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f46b6e9e9345%3A0x4e54fb6b18a7b080!2sMonumen%20Nasional!5e0!3m2!1sen!2sid!4v1623136150919!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <!-- Galeri Foto -->
        <!-- Galeri Foto -->
<div id="galeri" class="row section">
    <div class="col-md-12">
        <h3>Galeri Foto</h3>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/galeri/latihan1.jpg" class="d-block w-100" alt="Gallery 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Latihan memukul bola baseball</h5>
                        <p>Deskripsi singkat foto 1.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/galeri/latihan2.jpg" class="d-block w-100" alt="Gallery 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>siswa sedang uji tanding persahabatan</h5>
                        <p>Deskripsi singkat foto 2.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/galeri/latihan3.jpg" class="d-block w-100" alt="Gallery 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Serunya suasana latihan</h5>
                        <p>Deskripsi singkat foto 3.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>


        <div id="sosial" class="
        row section">
            <div class="col-md-12 text-center">
                <h3>Bagikan di Media Sosial</h3>
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.jagoanhosting.com/blog/halaman-website/" target="_blank" class="btn btn-primary">
                    <i class="fab fa-facebook-f"></i> Bagikan di Facebook
                </a>
            </div>
        </div>

        <div id="formulir" class="row section">
            <div class="col-md-12 text-center">
                <h3>Formulir Pendaftaran</h3>
                <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20mendaftar%20kursus%20baseball" target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp"></i> Daftar via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
</body>
</html>


