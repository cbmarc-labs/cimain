<?php if(logged_in()): ?>	
	<ul class="breadcrumb">
		<li>
			<a href="<?=site_url()?>">Home</a>
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
		<li class="active"><?=ucfirst($this->uri->segment(2))?></li>
		<?php endif; ?>
	</ul>
<?php endif; ?>














