<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Privat Baseball Muhammad Tawakal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            transition: background-color 0.5s, color 0.5s;
        }
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .student-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .student-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Selamat Datang di Kursus Privat Baseball Muhammad Tawakal</h1>
        <p class="text-center">Kursus privat untuk berbagai jenjang usia dengan pelatih profesional.</p>

        <div class="row">
            <div class="col-md-12">
                <h3>Tentang Kami</h3>
                <p>"Kami di Kursus Baseball Muhammad Tawakal berkomitmen untuk membimbing Anda menguasai teknik dasar hingga strategi permainan tingkat lanjut, karena hasrat kami adalah melihat Anda sukses di lapangan."</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Sejarah</h3>
                <p>Berawal dari kecintaan mendalam terhadap olahraga baseball dan keinginan kuat untuk mengembangkan bakat-bakat muda di Indonesia, Muhammad Tawakal, seorang mantan pemain baseball nasional, mendirikan Kursus Baseball Muhammad Tawakal pada tahun 2020. Dengan bekal pengalaman bermain di liga profesional dan pengetahuan mendalam tentang seluk-beluk baseball, Muhammad Tawakal memulai kursus ini dengan sederhana. Ia menyewa sebuah lapangan kecil di daerah Bandung dan mengumpulkan beberapa anak muda yang memiliki minat yang sama terhadap olahraga ini.</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Pelatih</h3>
                <div class="row">
                    <div class="col-md-4">
                        <img src="assets/images/pelatih/b.jpeg" class="img-fluid rounded-circle" alt="Foto Jose Bautista">
                        <p>Jose Bautista: Mantan pemain tim nasional junior, spesialis posisi pitcher.</p>
                    </div>
                    <div class="col-md-4">
                        <img src="assets/images/pelatih/i.jpg" class="img-fluid rounded-circle" alt="Foto Mike Trout">
                        <p>Mike Trout: Mantan pelatih tim baseball universitas, spesialis teknik batting.</p>
                    </div>
                    <div class="col-md-4">
                        <img src="assets/images/pelatih/v.jpg" class="img-fluid rounded-circle" alt="Foto Chase Anderson">
                        <p>Chase Anderson: Mantan pemain softball nasional, spesialis posisi catcher.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Galeri Foto</h3>
                <div id="fotoCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#fotoCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#fotoCarousel" data-slide-to="1"></li>
                        <li data-target="#fotoCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/images/galeri/latihan1.jpg" class="d-block w-100" alt="Foto Latihan 1">
                            <div class="carousel-caption">
                                <h3>Latihan Dasar</h3>
                                <p>Peserta kursus sedang berlatih teknik dasar memukul bola.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/images/galeri/latihan2.jpg" class="d-block w-100" alt="Foto Latihan 2">
                            <div class="carousel-caption">
                                <h3>Pertandingan Persahabatan</h3>
                                <p>Tim kursus bertanding melawan tim lain dalam pertandingan persahabatan.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/images/galeri/latihan3.jpg" class="d-block w-100" alt="Foto Latihan 3">
                            <div class="carousel-caption">
                                <h3>Serunya Latihan Bersama</h3>
                                <p>Suasana latihan yang menyenangkan dan penuh semangat.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#fotoCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#fotoCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Formulir Pendaftaran</h3>
                <form action="proses_pendaftaran.php" method="post">
                    <!-- Form fields here -->
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Lokasi Kami</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.631883141285!2d107.62823631477008!3d-6.914781394991489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9adf177bf8d%3A0x437398556f9fa03!2sGedung%20Sate!5e0!3m2!1sid!2sid!4v1623711245084!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <h3>Bagikan di Media Sosial</h3>
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.jagoanhosting.com/blog/halaman-website/" target="_blank" class="btn btn-primary">
                    <i class="fab fa-facebook-f"></i> Bagikan di Facebook
                </a>
            </div>
        </div>
    </div>

    <div id="students" class="container mt-5">
        <h2>Daftar Siswa</h2>
        <div class="row">
            <?php
            include 'includes/db.php';
            $query = "SELECT * FROM students";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4'>";
                echo "<div class='student-card'>";
                echo "<img src='" . substr($row['photo'], 3) . "' alt='Foto Siswa' class='student-photo'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>Umur: " . $row['age'] . "</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
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
