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

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( editStudentProfile($_POST) > 0 ) {
		echo "
			<script>
				document.location.href = 'student-profile.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan!');
				document.location.href = 'student-profile.php';
			</script>
		";
	}
}

$data = query("SELECT * FROM `student`");
foreach($data as $user) :
    if($user["id"] == $_SESSION["data"]["id"]) :
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
                        <h1 class="mt-4"><i class="bi bi-person-square me-3"></i>Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Setting your profile!</li>
                        </ol>
                        <div class="card p-3">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Profile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-3">Name</td>
                                        <td class="col-9"><?= $name;?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?= $gender;?></td>
                                    </tr>
                                    <tr>
                                        <td>ID Student</td>
                                        <td><?= $nis;?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><?= $address;?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?= $email;?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?= $number;?></td>
                                    </tr>
                                  </tbody>
                            </table>
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editProfile">EDIT PROFILE</a>
                        </div>
                    </div>

                    <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form method="post">
                                <input type="hidden" id="id" name="id" value="<?php echo $_SESSION["data"]["id"];?>">
                                <div class="mb-3 form-group row">
                                    <label for="recipient-name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $name;?>">
                                    </div>
                                </div>
                                <div class="mb-3 form-group row">
                                    <label for="recipient-name" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="gender" name="gender" value="<?= $gender;?>">
                                    </div>
                                </div>
                                <div class="mb-3 form-group row">
                                    <label for="recipient-name" class="col-sm-2 col-form-label">ID Student</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nis" name="nis" value="<?= $nis;?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 form-group row">
                                    <label for="recipient-name" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address" name="address" value="<?= $address;?>">
                                    </div>
                                </div>
                                <div class="mb-3 form-group row">
                                    <label for="recipient-name" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $email;?>">
                                    </div>
                                </div>
                                <div class="mb-3 form-group row">
                                    <label for="recipient-name" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="number" name="number" value="<?= $number;?>">
                                    </div>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                <button type="submit" name="submit" class="btn btn-success ms-2">Edit Profile!</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
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
