<?php 
$login = array('name'=>'login', 'value'=>$user['login'],
		'autofocus'=>'autofocus');
$password = array('name'=>'password', 'type'=>'password', 'value'=>'');
$confirm_password = array('name'=>'confirm_password', 'type'=>'password', 
		'value'=>'');
$active = array('name'=>'active', 'value'=>1, 'checked'=>$user['active']);
$submit = array('name'=>'submit', 'value'=>'submit', 
		'class'=>'formee-button save', 'type'=>'submit',
		'content'=>lang('form_submit'));
$delete = array('name'=>'delete', 'value'=>'delete', 
		'class'=>'formee-button delete danger',	'type'=>'submit', 
		'content'=>lang('form_delete'),
		'onclick'=>'return confirm(\''.lang('are_you_sure').'\')');
?>

<?=form_open('', array('class'=>'formee'))?>

<fieldset>
    <legend><?=$section_title?></legend>
	<div class="grid-6-12">
		<?=form_label(lang('user_form_login') . ' <em class="formee-req">*'.form_error('login').'</em>')?>
		<?=form_input($login)?>
	</div>
	<div class="grid-6-12 clear">
		<?=form_label(lang('user_form_password') . ' <em class="formee-req">*'.form_error('password').'</em>')?>
		<?=form_input($password)?>
	</div>
	<div class="grid-6-12">
		<?=form_label(lang('user_form_confirm_password') . ' <em class="formee-req">*'.form_error('confirm_password').'</em>')?>
		<?=form_input($confirm_password)?>
	</div>
	<div class="grid-12-12 clear">
		<?=form_label(form_checkbox($active) . lang('user_form_active'))?>
	</div>
	<div class="grid-12-12 clear">
		<?=form_button($submit)?>
			
		<?php if($this->uri->segment(3)) : ?>
			<?=form_button($delete)?>
		<?php endif; ?>
	</div>
</fieldset>

<?=form_close()?>
