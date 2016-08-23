<?php
$pecah = explode('/', uri_string());
if ($pecah[1] == 'hapus_diary') {
	echo '<h3>Berhasil dihapus</h3>';
} else {
	echo '<h3>Berhasil disimpan</h3>';
}
?>
