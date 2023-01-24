<?php
session_start();

if(!isset($_SESSION["login"])){
  header('Location:login.php');
}
if($_SESSION["data"]["position"] == "Admin"){
    header('Location:admin-index.php');
}
if($_SESSION["data"]["position"] == "Student"){
    header('Location:student-index.php');
}
if($_SESSION["data"]["position"] == "Guest"){
    header('Location:guest-index.php');
}
require 'function/function.php';

$id = $_GET["id"];

$data = query("SELECT * FROM `class-3` WHERE id=$id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["edit"]) ) {

    $tugasClass = query("SELECT * FROM `class-3` WHERE `id` = $id");
    $tugasStudent = query("SELECT * FROM `student-listwork` WHERE `class` = 'Class 3'");
    foreach($tugasClass as $row) :
    $subjectClass = $row["subject-name"];
        foreach($tugasStudent as $rows) :
            if($rows["subject-name"] == $subjectClass){
                $idTugas = $rows["id"];
                if( ubahTaskStudentClass1($_POST,$idTugas) > 0 ) {
                    echo "
                        <script>
                        document.location.href = 'teacher-class3.php';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                        alert('Data Gagal Ditambahkan!');
                        document.location.href = 'teacher-class3.php';
                        </script>
                    ";
                }
            }
        endforeach;
    endforeach;
	
	// cek apakah data berhasil diubah atau tidak
	if( ubahTaskClass3($_POST) > 0 ) {
		echo "
			<script>
				document.location.href = 'teacher-class3.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Diubah!');
				document.location.href = 'teacher-class3.php';
			</script>
		";
	}
}
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
            <a class="navbar-brand ps-3" href="teacher-index.php">Mutaba'ah Yaumiyah</a>
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
                        <i class="fas fa-user fa-fw me-1"></i>Herdy Gumilang Jati
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
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
                            <a class="nav-link" href="teacher-index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="teacher-profile.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-square"></i></div>
                                Profile
                            </a>
                            <a class="nav-link" href="teacher-todolist.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-pencil-square"></i></div>
                                To Do List
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Manage Class
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="teacher-class1.php">Class 1</a>
                                    <a class="nav-link" href="teacher-class2.php">Class 2</a>
                                    <a class="nav-link" href="teacher-class3.php">Class 3</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Teacher
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><i class="bi bi-columns-gap me-3"></i>Edit Task</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Edit the selected task!</li>
                        </ol>

                        <div class="card p-3">
                          <form method="post">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Subject-Name</span></div>
                              <input type="text" class="form-control" id="subject-name" name="subject-name" value="<?= $data["subject-name"]; ?>">
                            </div>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Program 1</span></div>
                              <input type="text" class="form-control" id="program1" name="program1" value="<?= $data["program1"]; ?>">
                            </div>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Program 2</span></div>
                              <input type="text" class="form-control" id="program2" name="program2" value="<?= $data["program2"]; ?>">
                            </div>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Program 3</span></div>
                              <input type="text" class="form-control" id="program3" name="program3" value="<?= $data["program3"]; ?>">
                            </div>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Program 4</span></div>
                              <input type="text" class="form-control" id="program4" name="program4" value="<?= $data["program4"]; ?>">
                            </div>
                            <div class="input-group mb-4">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Program 5</span></div>
                              <input type="text" class="form-control" id="program5" name="program5" value="<?= $data["program5"]; ?>">
                            </div>
                            <input type="hidden" id="id" name="id" value="<?= $data["id"]; ?>">
                            <div class="d-flex flex-row-reverse">
                              <button type="submit" name="edit" class="btn btn-success ms-2">Edit Task!</button>
                              <a href="teacher-class1.php" class="btn btn-secondary">Close</a>
                            </div>
                          </div>
                        </form>
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
