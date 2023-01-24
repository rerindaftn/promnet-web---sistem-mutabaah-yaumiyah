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
if($_SESSION["data"]["position"] == "Guest"){
  header('Location:guest-index.php');
}
require 'function/function.php';

$student = query("SELECT * FROM `student`");
foreach($student as $user) :
    if($user["id"] == $_SESSION["data"]["id"]) :
        $id         = $user["id"];
        $name       = $user["name"];
        $username   = $user["username"];
        $nis        = $user["nis"];
        $gender     = $user["gender"];
        $class      = $user["class"];
        $address    = $user["address"];
        $email      = $user["email"];
        $number     = $user["number"];
    endif;
endforeach;

$data = query("SELECT * FROM `student-listwork`");

$i = 1;
$x = 0; // Pembilang (todolist yang udah)
$y = 0; // Penyebut (banyaknya todolist)
foreach($data as $row) :
    if($row["username"] == $username) :
        $y++; 
        if($row["allchecked"] == "Sudah") :
            $x++;
        endif;
        $_SESSION["studentprogress"] = $x / $y * 100;
    endif;
endforeach;

$studentprogress = $_SESSION["studentprogress"];
insertProgressStudent($id,$studentprogress);
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
      </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="student-index.php">Mutaba'ah Yaumiyah</a>
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
                            <a class="nav-link" href="student-index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="student-profile.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-square"></i></div>
                                Profile
                            </a>
                            <a class="nav-link" href="student-todolist.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-pencil-square"></i></div>
                                To Do List
                            </a>
                            <a class="nav-link" href="student-listwork.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-book"></i></div>
                                List Work
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Student
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><i class="bi bi-book me-3"></i>List Work</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage your work and view progress!</li>
                        </ol>
                        
                        <div class="row">
	                        <?php foreach( $data as $row ) : ?>
                            <?php if( $row["username"] == $username ) : ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4 bg-primary">
                                    <div class="card-header" style="background-color: #7eb0cb">
                                    <center><i class="bi bi-journal-bookmark-fill p-1" style="font-size:3rem; color:#1c4046; "></i>
                                    <h5 class="card-title text-white"><?= $row["subject-name"];?></h5></center>
                                    </div>
                                    <div class="card-body" style="background-color: #cfdee3">
                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i>
                                          <span class="p-2"><?= $row["program1"];?></span>
                                          <?php if( $row["checked1"] == "Sudah" ) : ?>
                                            <a href="function/ubahStatusChecked1B.php?id=<?= $row["id"];?>" 
                                               class="btn btn-success text-white p-1" style="float: right; font-size: 11px">Sudah</a>
                                          <?php else : ?>
                                            <a href="function/ubahStatusChecked1S.php?id=<?= $row["id"];?>"
                                               class="btn btn-danger text-white p-1" style="float: right; font-size: 11px">Belum</a>
                                          <?php endif; ?>
                                        </p>

                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i>
                                          <span class="p-2"><?= $row["program2"];?></span>
                                          <?php if( $row["checked2"] == "Sudah" ) : ?>
                                            <a href="function/ubahStatusChecked2B.php?id=<?= $row["id"];?>" 
                                               class="btn btn-success text-white p-1" style="float: right; font-size: 11px">Sudah</a>
                                          <?php else : ?>
                                            <a href="function/ubahStatusChecked2S.php?id=<?= $row["id"];?>"
                                               class="btn btn-danger text-white p-1" style="float: right; font-size: 11px">Belum</a>
                                          <?php endif; ?>
                                        </p>

                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i>
                                          <span class="p-2"><?= $row["program3"];?></span>
                                          <?php if( $row["checked3"] == "Sudah" ) : ?>
                                            <a href="function/ubahStatusChecked3B.php?id=<?= $row["id"];?>" 
                                               class="btn btn-success text-white p-1" style="float: right; font-size: 11px">Sudah</a>
                                          <?php else : ?>
                                            <a href="function/ubahStatusChecked3S.php?id=<?= $row["id"];?>"
                                               class="btn btn-danger text-white p-1" style="float: right; font-size: 11px">Belum</a>
                                          <?php endif; ?>
                                        </p>

                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i>
                                          <span class="p-2"><?= $row["program4"];?></span>
                                          <?php if( $row["checked4"] == "Sudah" ) : ?>
                                            <a href="function/ubahStatusChecked4B.php?id=<?= $row["id"];?>" 
                                               class="btn btn-success text-white p-1" style="float: right; font-size: 11px">Sudah</a>
                                          <?php else : ?>
                                            <a href="function/ubahStatusChecked4S.php?id=<?= $row["id"];?>"
                                               class="btn btn-danger text-white p-1" style="float: right; font-size: 11px">Belum</a>
                                          <?php endif; ?>
                                        </p>

                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i>
                                          <span class="p-2"><?= $row["program5"];?></span>
                                          <?php if( $row["checked5"] == "Sudah" ) : ?>
                                            <a href="function/ubahStatusChecked5B.php?id=<?= $row["id"];?>" 
                                               class="btn btn-success text-white p-1" style="float: right; font-size: 11px">Sudah</a>
                                          <?php else : ?>
                                            <a href="function/ubahStatusChecked5S.php?id=<?= $row["id"];?>"
                                               class="btn btn-danger text-white p-1" style="float: right; font-size: 11px">Belum</a>
                                          <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="card-footer" style="background-color: #7eb0cb">
                                      <?php if( $row["allchecked"] == "Sudah" ) : ?>
                                        <center>
                                        <a href="function/ubahStatusAllCheckedB.php?id=<?= $row["id"];?>" class="btn text-white bg-success">
                                            <i class="bi bi-check-circle me-2"></i><span>Sudah</span>
                                        </a></center>
                                      <?php else : ?>
                                        <center>
                                        <a href="function/ubahStatusAllCheckedS.php?id=<?= $row["id"];?>" class="btn text-white bg-secondary">
                                            <i class="bi bi-x-circle me-2"></i><span>Belum</span>
                                        </a></center>
                                      <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
	                        <?php endforeach; ?>
                        </div>

                        <div class="card p-3 text-white mb-4" style="background-color: #7eb0cb">
                          <h2><i class="bi bi-check-circle-fill pe-2"></i>Progress</h2>
                          <p style="margin-left: 40px">Your work progress!</p> 
                          <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?= $studentprogress?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $studentprogress?>%">
                              <?= $studentprogress?>%
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
