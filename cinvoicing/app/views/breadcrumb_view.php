<ul class="breadcrumb">
	<li>
		<a href="<?=site_url()?>">Home</a>
		<?php if($this->uri->segment(1)): ?> <span class="divider">/</span><?php endif; ?>
	</li>
	
	<?php if($this->uri->segment(2)): ?>
	<li>
		<a href="<?=site_url($this->router->fetch_directory() . $this->uri->segment(2))?>">
			<?=ucfirst($this->uri->segment(2))?></a>
		<?php if($this->uri->segment(3)): ?>
		 <span class="divider">/</span>
		 <?php endif; ?>
	</li>
	<?php endif; ?>
	
	<?php if($this->uri->segment(3)): ?>
	<li class="active"><?=ucfirst($this->uri->segment(3))?></li>
	<?php endif; ?>
	
	<?php if(validation_errors()): ?>
	<li class="pull-right alert-icon" style="cursor:pointer;color:#B94A48;" 
		onclick="$('#validation_errors').toggle();"></li>
	<?php endif; ?>
</ul>