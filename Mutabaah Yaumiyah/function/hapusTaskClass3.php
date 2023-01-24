<?php

require 'function.php';

$id = $_GET["id"];

$tugasClass = query("SELECT * FROM `class-3` WHERE `id` = $id");
$tugasStudent = query("SELECT * FROM `student-listwork` WHERE `class` = 'Class 3'");
foreach($tugasClass as $row) :
$subjectClass = $row["subject-name"];
	foreach($tugasStudent as $rows) :
		if($rows["subject-name"] == $subjectClass){
			$idTugas = $rows["id"];
			if( hapusTaskStudentClass1($idTugas) > 0 ) {
				echo "
					<script>
					document.location.href = '../teacher-class3.php';
					</script>
				";
			} else {
				echo "
					<script>
					alert('Data Gagal Ditambahkan!');
					document.location.href = '../teacher-class3.php';
					</script>
				";
			}
		}
	endforeach;
endforeach;

if( hapusTaskClass3($id) > 0 ) {
	echo "
		<script>
			document.location.href = '../teacher-class3.php';
		</script>
	";
} else {
	echo "
		<script>
			document.location.href = '../teacher-class3.php';
		</script>
	";
}

?>