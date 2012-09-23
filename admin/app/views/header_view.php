<?=doctype('html5')?>
<html lang="en">
<head>
	<?=meta('Content-type', 'text/html; charset=utf-8', 'equiv')?>
	
	<title><?=$this->config->item('title')?></title>
	
	<?=link_tag('../assets/css/reset.css')?>
	<?=link_tag('../assets/css/formee-structure.css')?>
	<?=link_tag('../assets/css/formee-style.css')?>
	<?=link_tag('../assets/css/style.css')?>
	
	<script type="text/javascript" src="<?=base_url('../assets/js/jquery.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('../assets/js/jquery.dataTables.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('../assets/js/default.js')?>"></script>
</head>
<body>

<div id="container">
	
	<?=heading($title)?>

	<div id="body">
	