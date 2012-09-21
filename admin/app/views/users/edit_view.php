<?php 
$login = array('name'=>'login', 'value'=>$user['login'],
		'autofocus'=>'autofocus');
$password = array('name'=>'password', 'type'=>'password', 'value'=>'');
$confirm_password = array('name'=>'confirm_password', 'type'=>'password', 
		'value'=>'');
?>

<?=form_open()?>

	<p>
		<?=form_label(lang('user_form_login') . ':' . br() .
				form_input($login))?>
		<?=form_error('login')?>
	</p>
	
	
	<p>
		<?=form_label(lang('user_form_password') . ':' . br() . 
				form_input($password))?>
		<?=form_error('password')?>
	</p>
	
	<p>
		<?=form_label(lang('user_form_confirm_password') . ':' . br() . 
				form_input($confirm_password))?>
		<?=form_error('confirm_password')?>
	</p>
	
	<p>
		<?=form_button(array('name'=>'submit', 'value'=>'submit', 
			'class'=>'buttons save',	'type'=>'submit', 
			'content'=>lang('form_submit')))?>
			
		<?php if($this->uri->segment(3)) : ?>
			<?=form_button(array('name'=>'delete', 'value'=>'delete', 
				'class'=>'buttons delete',	'type'=>'submit', 
				'content'=>lang('form_delete'),
				'onclick'=>'return confirm(\''.lang('are_you_sure').'\')'))?>
		<?php endif; ?>
	</p>

<?=form_close()?>
