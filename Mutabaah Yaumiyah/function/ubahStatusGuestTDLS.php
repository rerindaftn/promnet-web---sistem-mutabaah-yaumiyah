<?php

require 'function.php';

$id = $_GET["id"];

if( ubahStatusGuestTDLS($id) > 0 ) {
	echo "
		<script>
			document.location.href = '../guest-todolist.php';
		</script>
	";
} else {
	echo "
		<script>
			document.location.href = '../guest-todolist.php';
		</script>
	";
}

?>