<?php 
$login = array('name'=>'login', 'value'=>$user['login'],
	'style'=>'width:320px;', 'autofocus'=>'autofocus');
?>

<?=form_open()?>

	<p>
		<?=form_label(lang('user_form_login') . ':' . br() . 
				form_input($login))?>
	</p>
	
	<?=validation_errors('<div class="error_field" 
			onclick="this.style.display=\'none\'">', '</div>')?>
	
	<p>
		<?=form_button(array('name'=>'submit', 'value'=>'submit', 
			'class'=>'buttons save',	'type'=>'submit', 
			'content'=>lang('form_submit')))?>
			
		<?php if($this->uri->segment(3)) : ?>
			<?=form_button(array('name'=>'delete', 'value'=>'delete', 
				'class'=>'buttons delete',	'type'=>'submit', 
				'content'=>lang('form_delete')))?>
		<?php endif; ?>
	</p>

<?=form_close()?>
