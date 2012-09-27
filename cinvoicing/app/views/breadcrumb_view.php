<?php if(logged_in()): ?>	
	<ul class="breadcrumb">
		<?php $active=$this->uri->segment(1)?'':'active'?>
		<li class="<?=$active?>">
			<?php if($this->uri->segment(1)): ?>
			<a href="<?=site_url()?>">Home</a>
			<?php else: ?>
				<?=ucfirst('home')?>
			<?php endif; ?>
			<?php if($this->uri->segment(1)): ?> <span class="divider">/</span><?php endif; ?>
		</li>
		
		<?php if($this->uri->segment(1)): ?>
		<?php $active=$this->uri->segment(2)?'':'active'?>
		<li class="<?=$active?>">
			<?php if($this->uri->segment(2)): ?>
			<a href="<?=site_url($this->uri->segment(1))?>">
				<?=ucfirst($this->uri->segment(1))?></a> <span class="divider">/</span>
			<?php else: ?>
				<?=ucfirst($this->uri->segment(1))?>
			<?php endif; ?>
		</li>
		<?php endif; ?>
		
		<?php if($this->uri->segment(2)): ?>
		<?php $active=$this->uri->segment(3)?'':'active'?>
		<li class="<?=$active?>">
			<?php if($this->uri->segment(3)): ?>
			<a href="<?=site_url($this->router->fetch_directory() . $this->uri->segment(2))?>">
				<?=ucfirst($this->uri->segment(2))?></a> <span class="divider">/</span>
			<?php else: ?>
				<?=ucfirst($this->uri->segment(2))?>
			<?php endif; ?>
		</li>
		<?php endif; ?>
		
		<?php if($this->uri->segment(3)): ?>
		<li class="active"><?=ucfirst($this->uri->segment(3))?></li>
		<?php endif; ?>
	</ul>
<?php endif; ?>














