<?=doctype('html5')?>
<html lang="en">
<head>
	<?=meta('Content-type', 'text/html; charset=utf-8', 'equiv')?>
	
	<title><?=$this->config->item('title')?></title>
	
	<?=link_tag('../assets/css/reset.css')?>
	<?=link_tag('../assets/css/formee-structure.css')?>
	<?=link_tag('../assets/css/formee-style.css')?>
	<?=link_tag('../assets/css/style.css')?>
	
</head>
<body>

<div id="container" style="width:370px;">
	
	<?=heading($title)?>

	<div id="body">