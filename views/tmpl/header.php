<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='utf-8' name='viewport' content='width=device-width, initial-scale=1'>
		<title>Aplikasi Diary</title>
		<!-- <link rel='stylesheet' type='text/css' href='<?php echo base_url()?>application/views/css/style.css'> -->
		<link rel='stylesheet' type='text/css' href='<?php echo base_url()?>bootstrap/css/bootstrap.min.css'>
		<script src='<?= base_url('/tinymce/tinymce.min.js')?>'></script>
		<script>
			tinymce.init({
				selector: 'textarea',
				menubar: false,
				toolbar: 'undo redo bold italic alignleft aligncenter alignjustify bullist numlist',
				statusbar: false,
				height: 300
			});
		</script>
	</head>
	<body>
