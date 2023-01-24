<?php

require 'function.php';

$id = $_GET["id"];

if( hapusTeacherTDL($id) > 0 ) {
	echo "
		<script>
			document.location.href = '../teacher-todolist.php';
		</script>
	";
} else {
	echo "
		<script>
			document.location.href = '../teacher-todolist.php';
		</script>
	";
}

?>