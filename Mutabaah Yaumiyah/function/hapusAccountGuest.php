<?php

require 'function.php';

$id = $_GET["id"];

if( hapusAccountGuest($id) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = '../index-guest.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = '../index-guest.php';
		</script>
	";
}

?>