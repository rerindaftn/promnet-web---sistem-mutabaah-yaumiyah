<?php    
require 'function/function.php';

if( isset($_POST["reg"])){
    if(registrasiGuest($_POST) > 0){
        echo "
            <script>
                alert('Account Berhasil Ditambahkan');
                
            </script>
        ";
        header('Location:login.php');
    }
    else{
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="For Login/style.css">
    <link href="For Login/Login_asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="For Login/Login_asset/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="For Login/Login_asset/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
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

<!-- Navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container">
            <!-- Navbar Brand -->
            <a href="#" class="navbar-brand">
               
            </a>
        </div>
    </nav>
</header>

<div class="container">
    <div class="row py-5 mt-4 align-items-center">

        <!-- For Demo Purpose -->
        <div class="col-md-3 col-lg-6 pr-lg-5 mb-5 mb-md-0">
            <div class="pb-5 pr-5 mb-5">
                <center>
                <i class="bi bi-people-fill" style="font-size: 300px; color: #008080;"></i></center>
            </div>
        </div>

        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form action="#" method="post">
                <div class="row">

                    <!-- First Name -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="name" type="text" name="name" placeholder="Full Name" class="form-control bg-white border-left-0 border-md">
                    </div>
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="username" type="text" name="username" placeholder="Username" class="form-control bg-white border-left-0 border-md">
                    </div>
                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email" name="email" placeholder="Email Address" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Phone Number -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>
                        <input id="phone" type="tel" name="phone" placeholder="Phone Number" class="form-control bg-white border-md border-left-0 pl-3">
                    </div>

                 
                    <!-- Password -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="pass" type="password" name="pass" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Password Confirmation -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="passConf" type="text" name="passConf" placeholder="Confirm Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button class="btn btn-primary btn-block py-2 font-weight-bold" type="submit" name="reg" style="background-color:   #008080;">Register</button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
        
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Social Login -->
                    

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Already Registered? <a href="login.php" class="text-primary ml-2">Login</a></p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

    </html>