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
if( isset($_POST["add"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambahTeacherTDL($_POST) > 0 ) {
		echo "
			<script>
				document.location.href = 'teacher-todolist.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan!');
				document.location.href = 'teacher-todolist.php';
			</script>
		";
	}
}

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["edit"]) ) {
	
	// cek apakah data berhasil diubah atau tidak
	if( ubahTeacherTDL($_POST) > 0 ) {
		echo "
			<script>
				document.location.href = 'teacher-todolist.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'teacher-todolist.php';
			</script>
		";
	}
}

//Select
$data = query("SELECT * FROM `teacher-todolist`");
$teacher = query("SELECT * FROM `teacher`");
foreach($teacher as $user) :
  if($user["id"] == $_SESSION["data"]["id"]) :
      $name       = $user["name"];
      $username   = $user["username"];
      $nip        = $user["nip"];
      $address    = $user["address"];
      $email      = $user["email"];
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
                        <h1 class="mt-4"><i class="bi bi-pencil-square me-3"></i>To Do List</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Create your own to do list!</li>
                        </ol>
                        
                        <section>
                            <div class="container h-100">
                              <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col">
                                  <div class="card mb-4" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                                    <div class="card-body py-4 px-4 px-md-5">
                          
                                      <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                                        <i class="fas fa-check-square me-1"></i>
                                        <u>To Do List</u>
                                      </p>
                          
                                      <div class="pb-2 row">
                                        <div class="card col-md-12">
                                          <div class="p-2">
                                            <form method="post">
                                              <div class="p-2 input-group">
                                                <input type="hidden" id="username" name="username" value="<?= $username;?>">
                                                <input type="text" class="form-control form-control-label" id="program" name="program"
                                                       placeholder="Add new...">
                                                <button type="submit" name="add" class="btn btn-primary">Add</button>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>

                                      <hr class="my-4">

                                      <?php $i = 1; ?>
                                      <?php $x = 0; ?>
	                                    <?php foreach( $data as $row ) : ?>
                                        <?php if($row["username"] == $username) :?>
                                        <?php $x++; ?>
                                        <?php if($x == 1) :?>
                                          <ul class="list-group list-group-horizontal rounded-0 bg-transparent" style="border-bottom: 2px dashed; border-top: 2px dashed;">
                                        <?php else :?>
                                          <ul class="list-group list-group-horizontal rounded-0 bg-transparent" style="border-bottom: 2px dashed">
                                        <?php endif; ?>
                                            <?php if($row["checked"] == "Sudah") :?>
                                              <li class="list-group-item d-flex align-items-center ps-1 pe-3 py-1 rounded-0 border-0 bg-transparent">
                                                <a href="function/ubahStatusTeacherTDLB.php?id=<?= $row["id"];?>"
                                                   class="btn bg-success p-2 text-white"><i class="bi bi-check-circle me-2"></i><?= $row["checked"];?></a>
                                              </li>
                                            <?php elseif($row["checked"] == "Belum") : ?>
                                              <li class="list-group-item d-flex align-items-center ps-1 pe-3 py-1 rounded-0 border-0 bg-transparent">
                                                <a href="function/ubahStatusTeacherTDLS.php?id=<?= $row["id"];?>"
                                                   class="btn bg-secondary p-2 text-white"><i class="bi bi-x-circle me-2"></i><?= $row["checked"];?></a>
                                              </li>
                                            <?php endif; ?>
                                            <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                                              <p class="lead fw-bold mb-0"><?= $row["program"];?></p>
                                            </li>
                                            <li class="list-group-item py-2 pe-0 d-flex align-items-center flex-grow-2 border-0 bg-transparent">
                                              <button class="btn bg-warning p-2" data-bs-toggle="modal" data-bs-target="#editToDo<?php echo $row['id'];?>">
                                                      <i class="bi bi-pen me-2"></i>EDIT</button>
                                            </li>
                                            <li class="list-group-item py-2 pe-1 d-flex align-items-center flex-grow-2 border-0 bg-transparent">
                                              <a href="function/hapusTeacherTDL.php?id=<?= $row["id"];?>" class="btn bg-danger p-2 text-white"
                                                 onclick="return confirm('Apakah yakin ingin menghapus?');"><i class="bi bi-trash me-2"></i>DELETE</a>
                                            </li>
                                          </ul>
                                        <?php endif; ?>

                                        <div class="modal fade" id="editToDo<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit To Do List</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <form method="post">
                                              <?php $i = 1; ?>
                                              <?php foreach( $data as $rows ) : ?>
                                                <?php if($rows["id"] == $row["id"]) :?>
                                                  <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">Name</span>
                                                    </div>
                                                    <input type="hidden" value="<?= $row["id"];?>" name="id">
                                                    <input type="text" class="form-control me-3" value="<?= $rows["program"];?>" name="program">
                                                    <div class="input-group-prepend">
                                                      <button class="btn btn-success me-1" type="submit" name="edit">CHANGE</button>
                                                    </div>
                                                  </div>
                                                <?php endif; ?>
                                              <?php $i++; ?>
	                                            <?php endforeach; ?>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <?php $i++; ?>
	                                    <?php endforeach; ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </section>
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
