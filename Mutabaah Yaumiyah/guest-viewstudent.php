<?php
session_start();

if(!isset($_SESSION["login"])){
    header('Location:login.php');
}
if($_SESSION["data"]["position"] == "Admin"){
    header('Location:admin-index.php');
}
if($_SESSION["data"]["position"] == "Teacher"){
    header('Location:teacher-index.php');
}
if($_SESSION["data"]["position"] == "Student"){
    header('Location:student-index.php');
}
require 'function/function.php';
$data = query("SELECT * FROM `student`");

// Mengambil SESSION[ininis] dari guest-viewprogress.php
$ininis = $_SESSION["ininis"];

// Mengambil data student yang nantinya akan difilter berdasarkan nis yang ditulis
$student = query("SELECT * FROM `student`");
foreach($student as $view) :
    if($view["nis"] == $ininis) :
        // Membuat variable progress yang isinya adalah progress dari siswa yang dicari berdasarkan nis
        $progress = $view["progress"];
    endif;
endforeach;

// Mengambil data user yang saat ini sedang login
$guest = query("SELECT * FROM `guest`");
foreach($guest as $user) :
    if($user["id"] == $_SESSION["data"]["id"]) :
        $name       = $user["name"];
        $username   = $user["username"];
        $position   = $user["position"];
        $email      = $user["email"];
        $address    = $user["address"];
        $number     = $user["number"];
    endif;
endforeach;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mutaba'ah Yaumiyah</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="guest-index.php">Mutaba'ah Yaumiyah</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw me-1"></i><?= $name?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="guest-index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="guest-profile.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-square"></i></div>
                                Profile
                            </a>
                            <a class="nav-link" href="guest-todolist.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-pencil-square"></i></div>
                                To Do List
                            </a>
                            <a class="nav-link" href="guest-viewprogress.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-book"></i></div>
                                View Progress
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Guest
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><i class="bi bi-book me-3"></i>View Progress</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Looking student's progress!</li>
                        </ol>
                        
                        <div class="p-3">
                            <div class="row">
                                <div class="col-sm-3">
                                    <?php $i = 1; ?>
                                    <?php foreach( $data as $row ) : ?>
                                        <?php if($row["nis"] == $ininis) :?>
                                            <?php if($row["gender"] == "Male") :?>
                                                <div class="card p-3 h-100" style="background-color: #8b0707">
                                                <img src="img/male-student.png">
                                            <?php elseif($row["gender"] == "Female") :?>
                                                <div class="card p-3 h-100" style="background-color: #8b0707">
                                                <img src="img/female-student.png">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                </div>
                                </div>
                                <div class="col-sm-9 card p-1">
                                    <?php //if( $gender == "Male" ) : ?>
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach( $data as $row ) : ?>
                                                <?php if($row["nis"] == $ininis) :?>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td><?= $row["name"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIS</td>
                                                        <td><?= $row["nis"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender</td>
                                                        <td><?= $row["gender"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Class</td>
                                                        <td><?= $row["class"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td><?= $row["email"];?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php //endif; ?>

                                    <div class="card p-3 text-white" style="background-color: #7eb0cb">
                                    <h5><i class="bi bi-check-circle-fill pe-2"></i>Progress</h2>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?= $progress?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $progress?>%">
                                            <?= $progress?>%
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Mutaba'ah Yaumiyah</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
