<?php 
$login = array('name'=>'login', 'value'=>set_value('login'),
		'style'=>'width:320px;', 'autofocus'=>'autofocus');
$password = array('name'=>'password', 'style'=>'width:320px;', 
		'type'=>'password');
$remember = array('name'=>'remember', 'value'=>1, 
		'checked'=>set_value('remember'));
$submit = array('name'=>'submit', 'value'=>'submit', 
		'class'=>'formee-button save', 'type'=>'submit',
		'content'=>lang('auth_form_submit'))
?>

	
<?=form_open('', array('class'=>'formee'))?>

<div class="grid-12-12">
	<?=form_label(lang('auth_form_login'))?>
	<?=form_input($login)?>
</div>

<div class="grid-12-12">
	<?=form_label(lang('auth_form_password'))?>
	<?=form_input($password)?>
</div>

<div class="grid-12-12">
	<?=validation_errors('<div style="margin:10px 0;" onclick="this.style.display=\'none\'">
			<span class="error_field">', '</span></div>')?>
</div>

<div class="grid-6-12">
	<?=form_button($submit)?>
</div>

<div class="grid-6-12" style="vertical-align:middle;">
	<?=form_label(form_checkbox($remember) . lang('auth_form_remember'))?>
</div>

<div class="grid-12-12"><?=nbs()?></div>

<?=form_close()?>
