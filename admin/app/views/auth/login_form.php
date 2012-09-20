<?php 
$login = array('name'=>'login', 'value'=>set_value('login'),
		'style'=>'width:320px;', 'autofocus'=>'autofocus');
$password = array('name'=>'password', 'style'=>'width:320px;', 
		'type'=>'password');
$remember = array('name'=>'remember', 'value'=>1, 
		'checked'=>set_value('remember'));
?>

	
<?=form_open()?>

	<p>
		<?=form_label(lang('auth_form_login') . ':' . br() . 
				form_input($login))?>
	</p>
	
	<p>
		<?=form_label(lang('auth_form_password') . ':' . br() . 
				form_input($password))?>
	</p>
	
	<?=validation_errors('<div class="error_field" 
			onclick="this.style.display=\'none\'">', '</div>')?>
	
	<p>
		<?=form_button(array('name'=>'submit', 'value'=>'submit', 
				'class'=>'buttons save', 'type'=>'submit', 
				'content'=>lang('auth_form_submit')))?>
		<?=nbs(3)?>
		<?=form_label(form_checkbox($remember) . lang('auth_form_remember'))?>
	</p>
	
	<p><?=nbs()?></p>

<?=form_close()?>
