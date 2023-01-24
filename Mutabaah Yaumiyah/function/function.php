<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "mutabaah");


function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}


//-----DEFAULT----------DEFAULT----------DEFAULT----------DEFAULT----------DEFAULT----------DEFAULT-----//
// Registrasi akun Student
function registrasiStudent($data){
	global $conn;
	$name = $data["name"];
	$username = strtolower(stripslashes($data["username"]));
	$email = $data["email"];
	$studentId = $data["student"];
	$position = "Student";
	$app = $data["App"];
	$pass = mysqli_real_escape_string($conn,$data["pass"]);
	$pass2 = mysqli_real_escape_string($conn,$data["passConf"]);

	$result= mysqli_query($conn,"SELECT *FROM `student`
			WHERE username ='$username'");
	$result2= mysqli_query($conn,"SELECT *FROM `guest`
			WHERE username ='$username'");
	$result3= mysqli_query($conn,"SELECT *FROM `admin`
			WHERE username ='$username'");
	$result4= mysqli_query($conn,"SELECT *FROM `teacher`
			WHERE username ='$username'");
 
	if(mysqli_fetch_assoc($result)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result2)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result3)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result4)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}

	if($app == 111111){
		$class = "Class 1";
	}
	else if($app == 222222){
		$class = "Class 2";
	}
	else if($app == 333333){
		$class = "Class 3";
	}
	else{
		echo"
		<script>
			alert('Anda Tidak Terdaftar sebagai siswa');
		</script>";
		return false;
	}

	//cek konfirmasi 
	if($pass !== $pass2){
		echo"
			<script>
				alert('pass wrong!!');
			</script>
		";	

		return false;
	}

	$pass = password_hash($pass,PASSWORD_DEFAULT);

	$query = "INSERT INTO `student`
			(`username`, `password`, `position`, `name`, `nis`, `class`, `email`) 
			VALUES ('$username','$pass','$position','$name','$studentId','$class','$email')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Registrasi akun Guest
function registrasiGuest($data){
	global $conn;
	$name = $data["name"];
	$username = strtolower(stripslashes($data["username"]));
	$email = $data["email"];
	$phone = $data["phone"];
	$position = "Guest";
	$pass = mysqli_real_escape_string($conn,$data["pass"]);
	$pass2 = mysqli_real_escape_string($conn,$data["passConf"]);

	$result= mysqli_query($conn,"SELECT *FROM `student`
			WHERE username ='$username'");
	$result2= mysqli_query($conn,"SELECT *FROM `guest`
			WHERE username ='$username'");
	$result3= mysqli_query($conn,"SELECT *FROM `admin`
			WHERE username ='$username'");
	$result4= mysqli_query($conn,"SELECT *FROM `teacher`
			WHERE username ='$username'");
 
	if(mysqli_fetch_assoc($result)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result2)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result3)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result4)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}

	//cek konfirmasi 
	if($pass !== $pass2){
		echo"
			<script>
				alert('pass wrong!!');
			</script>
		";	

		return false;
	}

	$pass = password_hash($pass,PASSWORD_DEFAULT);
	
	$query = "INSERT INTO `guest`
			(`username`, `password`, `position`, `name`, `email`, `number`) 
			VALUES ('$username','$pass','$position','$name','$email','$phone')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Registrasi akun Admin
function registrasiAdmin($data){
	global $conn;
	$name = $data["name"];
	$username = strtolower(stripslashes($data["username"]));
	$position = "Admin";
	$pass = mysqli_real_escape_string($conn,$data["pass"]);
	$pass2 = mysqli_real_escape_string($conn,$data["passConf"]);

	$result= mysqli_query($conn,"SELECT *FROM `student`
			WHERE username ='$username'");
	$result2= mysqli_query($conn,"SELECT *FROM `guest`
			WHERE username ='$username'");
	$result3= mysqli_query($conn,"SELECT *FROM `admin`
			WHERE username ='$username'");
	$result4= mysqli_query($conn,"SELECT *FROM `teacher`
			WHERE username ='$username'");
 
	if(mysqli_fetch_assoc($result)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result2)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result3)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result4)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}

	//cek konfirmasi 
	if($pass !== $pass2){
		echo"
			<script>
				alert('pass wrong!!');
			</script>
		";	

		return false;
	}

	$pass = password_hash($pass,PASSWORD_DEFAULT);
	
	$query = "INSERT INTO `admin`
			(`username`, `password`, `position`, `name`) 
			VALUES ('$username','$pass','$position','$name')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Registrasi akun Teacher
function registrasiTeacher($data){
	global $conn;
	$name = $data["name"];
	$username = strtolower(stripslashes($data["username"]));
	$nip = $data["nip"];
	$position = "Teacher";
	$pass = mysqli_real_escape_string($conn,$data["pass"]);
	$pass2 = mysqli_real_escape_string($conn,$data["passConf"]);

	$result= mysqli_query($conn,"SELECT *FROM `student`
			WHERE username ='$username'");
	$result2= mysqli_query($conn,"SELECT *FROM `guest`
			WHERE username ='$username'");
	$result3= mysqli_query($conn,"SELECT *FROM `admin`
			WHERE username ='$username'");
	$result4= mysqli_query($conn,"SELECT *FROM `teacher`
			WHERE username ='$username'");
 
	if(mysqli_fetch_assoc($result)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result2)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result3)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}
	if(mysqli_fetch_assoc($result4)){
		echo"
		<script>
			alert('Username Sudah ada');
		</script>";
		return false;
	}

	//cek konfirmasi 
	if($pass !== $pass2){
		echo"
			<script>
				alert('pass wrong!!');
			</script>
		";	

		return false;
	}

	$pass = password_hash($pass,PASSWORD_DEFAULT);
	
	$query = "INSERT INTO `teacher`
			(`username`, `password`, `nip`, `position`, `name`) 
			VALUES ('$username','$pass','$nip','$position','$name')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function access($data){
	global $conn;
	$acc = $data["App"];

	$rec = mysqli_query($conn,"SELECT *FROM access WHERE appid ='$acc'");

	if(mysqli_fetch_assoc($rec)){
		echo"
		<script>
			alert('Anda Tidak Terdaftar sebagai siswa');
		</script>";
		return false;
	}
}


//-----ADMIN----------ADMIN----------ADMIN----------ADMIN----------ADMIN----------ADMIN----------ADMIN-----//
// Hapus Akun --'admin'--
// Teacher
function hapusAccountTeacher($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `teacher` WHERE id = $id");
	return mysqli_affected_rows($conn);
}
// Student
function hapusAccountStudent($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `student` WHERE id = $id");
	return mysqli_affected_rows($conn);
}
// Guest
function hapusAccountGuest($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `guest` WHERE id = $id");
	return mysqli_affected_rows($conn);
}


//-----TEACHER----------TEACHER----------TEACHER----------TEACHER----------TEACHER----------TEACHER-----//
// Edit Profile Teacher --'teacher-profile'--
function editTeacherProfile($data) {
	global $conn;

	$id = $data["id"];
	$name = htmlspecialchars($data["name"]);
	$nip = htmlspecialchars($data["nip"]);
	$address = htmlspecialchars($data["address"]);
	$email = htmlspecialchars($data["email"]);
	$number = htmlspecialchars($data["number"]);
	
	$query = "UPDATE `teacher` SET 
			`name`='$name',
			`nip`='$nip',
			`address`='$address',
			`email`='$email',
			`number`='$number' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Tambah To Do List --'teacher-todolist.php'--
function tambahTeacherTDL($data) {
	global $conn;

	$username = htmlspecialchars($data["username"]);
	$program = htmlspecialchars($data["program"]);
	$checked = "Belum";

	$query = "INSERT INTO `teacher-todolist`(`username`, `program`, `checked`) 
			  VALUES ('$username','$program','$checked')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Ubah To Do List --'teacher-todolist.php'--
function ubahTeacherTDL($data) {
	global $conn;

	$id = $data["id"];
	$program = $data["program"];
	$query = "UPDATE `teacher-todolist` SET 
			`program`='$program' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Hapus To Do List --'teacher-todolist.php'--
function hapusTeacherTDL($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `teacher-todolist` WHERE id = $id");
	return mysqli_affected_rows($conn);
}

// Ubah Status TDL Belum ke Sudah --'teacher-todolist.php'--
function ubahStatusTeacherTDLS($id) {
	global $conn;

	$id = $id;
	$checked = "Sudah";
	$query = "UPDATE `teacher-todolist` SET `checked`='$checked' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
// Ubah Status TDL Sudah ke Belum --'teacher-todolist.php'--
function ubahStatusTeacherTDLB($id) {
	global $conn;

	$id = $id;
	$checked = "Belum";
	$query = "UPDATE `teacher-todolist` SET `checked`='$checked' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Tambah Task Class 1 --'teacher-class1.php'--
function tambahTaskClass1($data) {
	global $conn;

	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);

	$query = "INSERT INTO `class-1`(`subject-name`, `program1`, `program2`, `program3`, `program4`, `program5`) 
			  VALUES ('$name','$program1','$program2','$program3','$program4','$program5')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Ubah Task Class 1 --'teacher-edit.php'--
function ubahTaskClass1($data) {
	global $conn;

	$id = $data["id"];
	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);

	$query = "UPDATE `class-1` SET 
			`subject-name`='$name',
			`program1`='$program1',
			`program2`='$program2',
			`program3`='$program3',
			`program4`='$program4',
			`program5`='$program5' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Task Student Class 1 --'teacher-edit.php'--
function ubahTaskStudentClass1($data,$id) {
	global $conn;

	$id = $id;
	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);

	$query = "UPDATE `student-listwork` SET 
			`subject-name`='$name',
			`program1`='$program1',
			`program2`='$program2',
			`program3`='$program3',
			`program4`='$program4',
			`program5`='$program5' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Tambah Task Ke Semua Student Class 1 --'teacher-class1.php'--
function tambahTaskStudentClass1($data) {
	global $conn;

	$iniusername = $_SESSION["iniusername"];
	$username = $iniusername;
	$class = "Class 1";
	$allchecked = "Belum";
	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);
	$checked1 = "Belum";
	$checked2 = "Belum";
	$checked3 = "Belum";
	$checked4 = "Belum";
	$checked5 = "Belum";

	$query = "INSERT INTO `student-listwork`
			(`subject-name`, `username`, `class`, `allchecked`,
			`program1`, `checked1`, `program2`, `checked2`,
			`program3`, `checked3`, `program4`, `checked4`,
			`program5`, `checked5`) 
			VALUES ('$name','$username','$class','$allchecked',
			'$program1','$checked1','$program2','$checked2',
			'$program3','$checked3','$program4','$checked4',
			'$program5','$checked5')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
		
}

// Hapus Task Class 1 --'teacher-class1.php'--
function hapusTaskClass1($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `class-1` WHERE id = $id");
	return mysqli_affected_rows($conn);
}

// Hapus Task Student Class 1 --'teacher-class1.php'--
function hapusTaskStudentClass1($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `student-listwork` WHERE `id` = $id");
	return mysqli_affected_rows($conn);
}

// Tambah Task Class 2 --'teacher-class2.php'--
function tambahTaskClass2($data) {
	global $conn;

	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);

	$query = "INSERT INTO `class-2`(`subject-name`, `program1`, `program2`, `program3`, `program4`, `program5`) 
			  VALUES ('$name','$program1','$program2','$program3','$program4','$program5')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Ubah Task Class 2 --'teacher-edit.php'--
function ubahTaskClass2($data) {
	global $conn;

	$id = $data["id"];
	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);

	$query = "UPDATE `class-2` SET 
			`subject-name`='$name',
			`program1`='$program1',
			`program2`='$program2',
			`program3`='$program3',
			`program4`='$program4',
			`program5`='$program5' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Task Student Class 2 --'teacher-edit.php'--
function ubahTaskStudentClass2($data,$id) {
	global $conn;

	$id = $id;
	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);

	$query = "UPDATE `student-listwork` SET 
			`subject-name`='$name',
			`program1`='$program1',
			`program2`='$program2',
			`program3`='$program3',
			`program4`='$program4',
			`program5`='$program5' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Tambah Task Ke Semua Student Class 2 --'teacher-class1.php'--
function tambahTaskStudentClass2($data) {
	global $conn;

	$iniusername = $_SESSION["iniusername"];
	$username = $iniusername;
	$class = "Class 2";
	$allchecked = "Belum";
	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);
	$checked1 = "Belum";
	$checked2 = "Belum";
	$checked3 = "Belum";
	$checked4 = "Belum";
	$checked5 = "Belum";

	$query = "INSERT INTO `student-listwork`
			(`subject-name`, `username`, `class`, `allchecked`,
			`program1`, `checked1`, `program2`, `checked2`,
			`program3`, `checked3`, `program4`, `checked4`,
			`program5`, `checked5`) 
			VALUES ('$name','$username','$class','$allchecked',
			'$program1','$checked1','$program2','$checked2',
			'$program3','$checked3','$program4','$checked4',
			'$program5','$checked5')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
		
}

// Hapus Task Class 2 --'teacher-class2.php'--
function hapusTaskClass2($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `class-2` WHERE id = $id");
	return mysqli_affected_rows($conn);
}

// Hapus Task Student Class 2 --'teacher-class2.php'--
function hapusTaskStudentClass2($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `student-listwork` WHERE `id` = $id");
	return mysqli_affected_rows($conn);
}

// Tambah Task Class 3 --'teacher-class3.php'--
function tambahTaskClass3($data) {
	global $conn;

	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);

	$query = "INSERT INTO `class-3`(`subject-name`, `program1`, `program2`, `program3`, `program4`, `program5`) 
			  VALUES ('$name','$program1','$program2','$program3','$program4','$program5')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Ubah Task Class 3 --'teacher-edit3.php'--
function ubahTaskClass3($data) {
	global $conn;

	$id = $data["id"];
	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);

	$query = "UPDATE `class-3` SET 
			`subject-name`='$name',
			`program1`='$program1',
			`program2`='$program2',
			`program3`='$program3',
			`program4`='$program4',
			`program5`='$program5' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Task Student Class 3 --'teacher-edit.php'--
function ubahTaskStudentClass3($data,$id) {
	global $conn;

	$id = $id;
	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);

	$query = "UPDATE `student-listwork` SET 
			`subject-name`='$name',
			`program1`='$program1',
			`program2`='$program2',
			`program3`='$program3',
			`program4`='$program4',
			`program5`='$program5' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Tambah Task Ke Semua Student Class 3 --'teacher-class3.php'--
function tambahTaskStudentClass3($data) {
	global $conn;

	$iniusername = $_SESSION["iniusername"];
	$username = $iniusername;
	$class = "Class 3";
	$allchecked = "Belum";
	$name = htmlspecialchars($data["subject-name"]);
	$program1 = htmlspecialchars($data["program1"]);
	$program2 = htmlspecialchars($data["program2"]);
	$program3 = htmlspecialchars($data["program3"]);
	$program4 = htmlspecialchars($data["program4"]);
	$program5 = htmlspecialchars($data["program5"]);
	$checked1 = "Belum";
	$checked2 = "Belum";
	$checked3 = "Belum";
	$checked4 = "Belum";
	$checked5 = "Belum";

	$query = "INSERT INTO `student-listwork`
			(`subject-name`, `username`, `class`, `allchecked`,
			`program1`, `checked1`, `program2`, `checked2`,
			`program3`, `checked3`, `program4`, `checked4`,
			`program5`, `checked5`) 
			VALUES ('$name','$username','$class','$allchecked',
			'$program1','$checked1','$program2','$checked2',
			'$program3','$checked3','$program4','$checked4',
			'$program5','$checked5')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
		
}

// Hapus Task Class 3 --'teacher-class3.php'--
function hapusTaskClass3($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `class-3` WHERE id = $id");
	return mysqli_affected_rows($conn);
}


//-----STUDENT----------STUDENT----------STUDENT----------STUDENT----------STUDENT----------STUDENT-----//
// Edit Profile Student --'student-profile'--
function editStudentProfile($data) {
	global $conn;

	$id = $data["id"];
	$name = htmlspecialchars($data["name"]);
	$nis = htmlspecialchars($data["nis"]);
	$address = htmlspecialchars($data["address"]);
	$email = htmlspecialchars($data["email"]);
	$number = htmlspecialchars($data["number"]);
	$gender = htmlspecialchars($data["gender"]);
	
	$query = "UPDATE `student` SET 
			`name`='$name',
			`nis`='$nis',
			`address`='$address',
			`email`='$email',
			`number`='$number',
			`gender`='$gender' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Tambah To Do List --'student-todolist.php'--
function tambahStudentTDL($data) {
	global $conn;

	$username = htmlspecialchars($data["username"]);
	$program = htmlspecialchars($data["program"]);
	$checked = "Belum";

	$query = "INSERT INTO `student-todolist`(`username`, `program`, `checked`) 
			  VALUES ('$username','$program','$checked')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Ubah To Do List --'student-todolist.php'--
function ubahStudentTDL($data) {
	global $conn;

	$id = $data["id"];
	$program = $data["program"];
	$query = "UPDATE `student-todolist` SET 
			`program`='$program' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Hapus To Do List --'student-todolist.php'--
function hapusStudentTDL($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `student-todolist` WHERE id = $id");
	return mysqli_affected_rows($conn);
}

// Ubah Status TDL Belum ke Sudah --'student-todolist.php'--
function ubahStatusStudentTDLS($id) {
	global $conn;

	$id = $id;
	$checked = "Sudah";
	$query = "UPDATE `student-todolist` SET `checked`='$checked' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Status TDL Sudah ke Belum --'student-todolist.php'--
function ubahStatusStudentTDLB($id) {
	global $conn;

	$id = $id;
	$checked = "Belum";
	$query = "UPDATE `student-todolist` SET `checked`='$checked' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Status Checked1 Sudah ke Belum --'student-listwork.php'--
function ubahStatusChecked1B($id) {
	global $conn;

	$id = $id;
	$checked1 = "Belum";
	$query = "UPDATE `student-listwork` SET `checked1`='$checked1' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
// Ubah Status Checked1 Belum ke Sudah --'student-listwork.php'--
function ubahStatusChecked1S($id) {
	global $conn;

	$id = $id;
	$checked1 = "Sudah";
	$query = "UPDATE `student-listwork` SET `checked1`='$checked1' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Status Checked1 Sudah ke Belum --'student-listwork.php'--
function ubahStatusChecked2B($id) {
	global $conn;

	$id = $id;
	$checked2 = "Belum";
	$query = "UPDATE `student-listwork` SET `checked2`='$checked2' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
// Ubah Status Checked1 Belum ke Sudah --'student-listwork.php'--
function ubahStatusChecked2S($id) {
	global $conn;

	$id = $id;
	$checked2 = "Sudah";
	$query = "UPDATE `student-listwork` SET `checked2`='$checked2' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Status Checked1 Sudah ke Belum --'student-listwork.php'--
function ubahStatusChecked3B($id) {
	global $conn;

	$id = $id;
	$checked3 = "Belum";
	$query = "UPDATE `student-listwork` SET `checked3`='$checked3' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
// Ubah Status Checked1 Belum ke Sudah --'student-listwork.php'--
function ubahStatusChecked3S($id) {
	global $conn;

	$id = $id;
	$checked3 = "Sudah";
	$query = "UPDATE `student-listwork` SET `checked3`='$checked3' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Status Checked1 Sudah ke Belum --'student-listwork.php'--
function ubahStatusChecked4B($id) {
	global $conn;

	$id = $id;
	$checked4 = "Belum";
	$query = "UPDATE `student-listwork` SET `checked4`='$checked4' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
// Ubah Status Checked1 Belum ke Sudah --'student-listwork.php'--
function ubahStatusChecked4S($id) {
	global $conn;

	$id = $id;
	$checked4 = "Sudah";
	$query = "UPDATE `student-listwork` SET `checked4`='$checked4' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Status Checked1 Sudah ke Belum --'student-listwork.php'--
function ubahStatusChecked5B($id) {
	global $conn;

	$id = $id;
	$checked5 = "Belum";
	$query = "UPDATE `student-listwork` SET `checked5`='$checked5' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
// Ubah Status Checked1 Belum ke Sudah --'student-listwork.php'--
function ubahStatusChecked5S($id) {
	global $conn;

	$id = $id;
	$checked5 = "Sudah";
	$query = "UPDATE `student-listwork` SET `checked5`='$checked5' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Ubah Status Checked1 Sudah ke Belum --'student-listwork.php'--
function ubahStatusAllCheckedB($id) {
	global $conn;

	$id = $id;
	$allchecked = "Belum";
	$query = "UPDATE `student-listwork` SET `allchecked`='$allchecked' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
// Ubah Status Checked1 Belum ke Sudah --'student-listwork.php'--
function ubahStatusAllCheckedS($id) {
	global $conn;

	$id = $id;
	$allchecked = "Sudah";
	$query = "UPDATE `student-listwork` SET `allchecked`='$allchecked' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Insert Progress Student
function insertProgressStudent($id,$studentprogress){
	global $conn;

	$id = $id;
	$progress = $studentprogress;
	$query = "UPDATE `student` SET `progress`='$progress' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

//-----GUEST----------GUEST----------GUEST----------GUEST----------GUEST----------GUEST----------GUEST-----//
// Edit Guest Profile
function editGuestProfile($data) {
	global $conn;

	$id = $data["id"];
	$name = htmlspecialchars($data["name"]);
	$address = htmlspecialchars($data["address"]);
	$email = htmlspecialchars($data["email"]);
	$number = htmlspecialchars($data["number"]);
	
	$query = "UPDATE `guest` SET 
			`name`='$name',
			`address`='$address',
			`email`='$email',
			`number`='$number' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Insert Progress Guest TDL
function insertProgressGuestTDL($id,$guestprogress){
	global $conn;

	$id = $id;
	$progress = $guestprogress;
	$query = "UPDATE `guest` SET `progress`='$progress' WHERE `id`=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Tambah To Do List --'teacher-todolist.php'--
function tambahGuestTDL($data) {
	global $conn;

	$username = $data["username"];
	$program = htmlspecialchars($data["program"]);
	$checked = "Belum";

	$query = "INSERT INTO `guest-todolist`(`username`, `program`, `checked`) 
			  VALUES ('$username','$program','$checked')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Ubah To Do List --'teacher-todolist.php'--
function ubahGuestTDL($data) {
	global $conn;

	$id = $data["id"];
	$program = $data["program"];
	$query = "UPDATE `guest-todolist` SET 
			`program`='$program' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

// Hapus To Do List --'teacher-todolist.php'--
function hapusGuestTDL($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM `guest-todolist` WHERE id = $id");
	return mysqli_affected_rows($conn);
}

// Ubah Status TDL Belum ke Sudah --'teacher-todolist.php'--
function ubahStatusGuestTDLS($id) {
	global $conn;

	$id = $id;
	$checked = "Sudah";
	$query = "UPDATE `guest-todolist` SET `checked`='$checked' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
// Ubah Status TDL Sudah ke Belum --'teacher-todolist.php'--
function ubahStatusGuestTDLB($id) {
	global $conn;

	$id = $id;
	$checked = "Belum";
	$query = "UPDATE `guest-todolist` SET `checked`='$checked' WHERE id=$id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
?>