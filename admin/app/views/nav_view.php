<?php if(logged_in()):?>
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














