<?php

require 'function.php';

$id = $_GET["id"];

$tugasClass = query("SELECT * FROM `class-2` WHERE `id` = $id");
$tugasStudent = query("SELECT * FROM `student-listwork` WHERE `class` = 'Class 2'");
foreach($tugasClass as $row) :
$subjectClass = $row["subject-name"];
	foreach($tugasStudent as $rows) :
		if($rows["subject-name"] == $subjectClass){
			$idTugas = $rows["id"];
			if( hapusTaskStudentClass2($idTugas) > 0 ) {
				echo "
					<script>
					document.location.href = '../teacher-class2.php';
					</script>
				";
			} else {
				echo "
					<script>
					alert('Data Gagal Ditambahkan!');
					document.location.href = '../teacher-class2.php';
					</script>
				";
			}
		}
	endforeach;
endforeach;

if( hapusTaskClass2($id) > 0 ) {
	echo "
		<script>
			document.location.href = '../teacher-class2.php';
		</script>
	";
} else {
	echo "
		<script>
			document.location.href = '../teacher-class2.php';
		</script>
	";
}

?>