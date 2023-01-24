<?php
require 'function/function.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home|Register</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->

  <link href="For Login/Login_asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="For Login/Login_asset/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="For Login/Login_asset/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Template Main CSS File -->
  <link href="For Login/Login_asset/css/style.css" rel="stylesheet">


</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top" style="background-color:   #008080;">
      <div class="container">
        <a class="navbar-brand" href="utama.php">
          <img src="https://seeklogo.com/images/H/halqat-alquran-alkarim-logo-1B8224BAF3-seeklogo.com.png" alt="" width="40" height="40" />
        </a>
        <a class="navbar-brand" href="utama.php">PESANTREN DAARUT TAUHID</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <!--mepet kanan-->
            <li class="nav-item">
              <a class="nav-link"  href="utama.php#jumbotron">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="utama.php#harapan">Vision & Mission</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="utama.php#program">Featured Program</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="utama.php#addresses">Addresses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register_home.php">Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Sign In</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--Navbar last-->
	<section id="services" class="services" style="margin-top: 70px;">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Sign Up as</h2>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6 d-flex align-items-center mx-auto" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box iconbox-blue">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                </svg>
                <i class="fas fa-user-graduate"></i>
              </div>
              <h4><a href="register_student.php">Student</a></h4>
              <p>This Page for registration student only</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-center mx-auto" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box iconbox-orange ">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                </svg>
                <i class="fas fa-user-secret"></i>
              </div>
              <h4><a href="register_guest.php">Guest</a></h4>
              <p>if you Guest you can register in this page</p>
            </div>
          </div>

  <!-- Template Main JS File -->
  <script src="Login_asset/js/main.js"></script>
</body>
</html>