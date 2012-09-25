<?=doctype('html5')?>
<html lang="en">
<head>
	<?=meta('Content-type', 'text/html; charset=utf-8', 'equiv')?>
	
	<title><?=$this->config->item('title')?></title>
	
	<?=link_tag('assets/css/bootstrap.min.css')?>
	<?=link_tag('assets/css/style.css')?>
	
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.multiSelect.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/default.js')?>"></script>
</head>
<body>

<div class="container">

	<?php if(logged_in()):?>
	<div class="page-header">
	  <h1>CIMAIN</h1>
	</div>
	
	<div class="navbar">
		<div class="navbar-inner">
			<ul class="nav">
				<?php $active=$this->uri->segment(1)=='users'?'active':''; ?>
				<li class="<?=$active?>"><a href="<?=site_url('users')?>">Users</a></li>
				
				<?php $active=$this->uri->segment(1)=='messages'?'active':''; ?>
				<li class="<?=$active?>"><a href="<?=site_url('messages')?>">Messages</a></li>
			</ul>
			<ul class="nav pull-right">
				<li><a href="<?=site_url('auth/logout')?>">Logout</a></li>
			</ul>
		</div>
	</div>
	<?php endif ?>