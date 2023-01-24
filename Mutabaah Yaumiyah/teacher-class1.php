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

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// Untuk nambah database class-1
	if( tambahTaskClass1($_POST) > 0 ) {
		echo "
			<script>
				document.location.href = 'teacher-class1.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan!');
				document.location.href = 'teacher-class1.php';
			</script>
		";
	}

  // Untuk nambah database student-listwork
  $siswa = query("SELECT * FROM `student` WHERE `class` = 'Class 1'");
  foreach($siswa as $row) :
    $_SESSION["iniusername"] = $row["username"];
    if( tambahTaskStudentClass1($_POST) > 0 ) {
      echo "
        <script>
          document.location.href = 'teacher-class1.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data Gagal Ditambahkan!');
          document.location.href = 'teacher-class1.php';
        </script>
      ";
    }
  endforeach;
}
  


$teacher = query("SELECT * FROM `teacher`");
foreach($teacher as $user) :
  if($user["id"] == $_SESSION["data"]["id"]) :
    $name       = $user["name"];
    $username   = $user["username"];
    $position   = $user["position"];
    $nip        = $user["nip"];
    $address    = $user["address"];
    $number     = $user["number"];
    $email      = $user["email"];
  endif;
endforeach;

//Select
$data = query("SELECT * FROM `class-1`");
$siswa = query("SELECT * FROM `student`");
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
                        <i class="fas fa-user fa-fw me-1"></i><?= $name;?>
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
                        <h1 class="mt-4"><i class="bi bi-columns-gap me-3"></i>Class 1</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage your class 1!</li>
                        </ol>

                        <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add Task</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">

                                <form method="post">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Subject Name</span>
                                    </div>
                                    <input type="text" class="form-control" id="subject-name" name="subject-name">
                                  </div>
                                  <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Program 1</span>
                                    </div>
                                    <input type="text" class="form-control" id="program1" name="program1">
                                  </div>
                                  <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Program 2</span>
                                    </div>
                                    <input type="text" class="form-control" id="program1" name="program2">
                                  </div>
                                  <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Program 3</span>
                                    </div>
                                    <input type="text" class="form-control" id="program1" name="program3">
                                  </div>
                                  <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Program 4</span>
                                    </div>
                                    <input type="text" class="form-control" id="program1" name="program4">
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Program 5</span>
                                    </div>
                                    <input type="text" class="form-control" id="program1" name="program5">
                                  </div>
                                  <div class="d-flex flex-row-reverse">
                                    <button type="submit" name="submit" class="btn btn-success ms-2">Tambah Task!</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  </div>
                                </form>

                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                            <?php $i = 1; ?>
	                          <?php foreach( $data as $row ) : ?>
                            <div class="col-xl-3 col-md-6 mb-2">
                                <div class="card mb-3 bg-primary">
                                    <div class="card-header" style="background-color: #7eb0cb">
                                    <center><i class="bi bi-journal-bookmark-fill p-1" style="font-size:3rem; color:#1c4046; "></i>
                                    <h5 class="card-title text-white"><?= $row["subject-name"];?></h5></center>
                                    </div>
                                    <div class="card-body" style="background-color: #cfdee3">
                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i><span class="p-2"><?= $row["program1"];?></span></p>
                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i><span class="p-2"><?= $row["program2"];?></span></p>
                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i><span class="p-2"><?= $row["program3"];?></span></p>
                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i><span class="p-2"><?= $row["program4"];?></span></p>
                                        <p class="card-text mb-1" style="color:#1c4046"><i class="bi bi-bookmarks"></i><span class="p-2"><?= $row["program5"];?></span></p>
                                    </div>
                                    <div class="card-footer" style="background-color: #7eb0cb">
                                    <center>
                                        <a href="teacher-edit1.php?id=<?= $row["id"];?>" class="btn text-black me-2" style="background-color:#dee094">
                                           <i class="fas fa-pencil-alt me-2"></i><span>Edit</span>
                                        </a>
                                        <a href="function/hapusTaskClass1.php?id=<?= $row["id"];?>" class="btn text-black" style="background-color:#fe5757"
                                           onclick="return confirm('Apakah yakin ingin menghapus?');">
                                           <i class="bi bi-trash-fill me-2"></i><span>DELETE</span>
                                        </a></center>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
	                          <?php endforeach; ?>
                        </div>

                        <div class="card mb-4">
                          <div class="card-header">
                              <i class="fas fa-table me-1"></i>
                              List Student Class 1
                          </div>
                          <div class="card-body">
                              <table id="datatablesSimple">
                                  <thead>
                                      <tr>
                                          <th>Name</th>
                                          <th>Gender</th>
                                          <th>Email</th>
                                          <th>Phone Number</th>
                                          <th>Progress</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th>Name</th>
                                          <th>Gender</th>
                                          <th>Email</th>
                                          <th>Phone Number</th>
                                          <th>Progress</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php $i = 1; ?>
	                                  <?php foreach( $siswa as $row ) : ?>
                                      <?php if($row["class"] == "Class 1") : ?>
                                      <tr>
                                          <td><?= $row["name"]; ?></td>
                                          <td><?= $row["gender"]; ?></td>
                                          <td><?= $row["email"]; ?></td>
                                          <td><?= $row["number"]; ?></td>
                                          <td><?= $row["progress"]; ?></td>
                                      </tr>
                                      <?php endif; ?>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                  </tbody>
                              </table>
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
