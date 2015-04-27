<?php echo doctype( 'html5' ); ?>
<html lang="es">
<head>
	<?php echo meta( 'Content-type', 'text/html; charset=utf-8', 'equiv' ); ?>
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- end: Mobile Specific -->
	
	<title><?php echo $this->config->item('title'); ?></title>
		
	<?php echo link_tag( 'assets/lib/bootstrap-3.3.4/css/bootstrap.min.css' ); ?>
	<?php echo link_tag( 'assets/css/style.css' ); ?>
	
	<script type="text/javascript" src="<?php echo base_url( 'assets/lib/jquery-2.1.3/jquery-2.1.3.min.js' ); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url( 'assets/lib/bootstrap-3.3.4/js/bootstrap.min.js' ); ?>"></script>
	
	<link rel="shortcut icon" href="<?php echo base_url( 'favicon.ico' ); ?>">
</head>
<body>

<?php echo $this->load->view( 'navbar_view' ); ?>

<div class="container-fluid">