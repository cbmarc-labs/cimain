<?php echo doctype( 'html5' ); ?>
<html lang="es">
<head>
	<?php echo meta( 'Content-type', 'text/html; charset=utf-8', 'equiv' ); ?>
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- end: Mobile Specific -->
	
	<title><?php echo $this->config->item('title'); ?></title>
		
	<?php echo link_tag( '../assets/lib/bootstrap-3.3.4/css/bootstrap.min.css' ); ?>
	<?php echo link_tag( 'assets/lib/bootstrap-table/dist/bootstrap-table.min.css' ); ?>
	<?php echo link_tag( 'assets/css/style.css' ); ?>
	
	<script type="text/javascript" src="<?php echo base_url( '../assets/lib/jquery-2.1.3/jquery-2.1.3.min.js' ); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url( '../assets/lib/jquery-ui-1.11.4/jquery-ui.min.js' ); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url( '../assets/lib/bootstrap-3.3.4/js/bootstrap.min.js' ); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url( 'assets/lib/DataTables-1.10.6/media/js/jquery.dataTables.min.js' ); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url( 'assets/js/dataTables.bootstrap.js' ); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url( 'assets/js/jquery.app-alert.js' ); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url( 'assets/js/jquery.app-ajax.js' ); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url( 'assets/lib/bootstrap-table/dist/bootstrap-table.min.js' ); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url( 'assets/js/default.js' ); ?>"></script>
	
	<link rel="shortcut icon" href="<?php echo base_url( 'favicon.ico' ); ?>">
</head>
<body>

<?php echo $this->load->view( 'navbar_view' ); ?>

<div class="container-fluid">
	<div class="row">
	
		<div class="hidden-xs hidden-sm col-md-1 hidden-print" role="navigation">
				<?php echo $this->load->view( 'toolbar_view' ); ?>
		</div>
		
		<div class="col-xs-12 col-xs-12 col-md-11">