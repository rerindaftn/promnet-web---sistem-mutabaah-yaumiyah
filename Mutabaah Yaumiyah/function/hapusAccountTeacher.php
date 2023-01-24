<?php

require 'function.php';

$id = $_GET["id"];

if( hapusAccountTeacher($id) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = '../index-teacher.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = '../index-teacher.php';
		</script>
	";
}

?>