<?php 
$label_attributes = array('class'=>'control-label');
$login = array('id'=>'login', 'name'=>'login', 'value'=>$field['login'],
		'autofocus'=>'autofocus');
$password = array('id'=>'password', 'name'=>'password', 'type'=>'password', 
		'value'=>'');
$confirm_password = array('id'=>'confirm_password', 'name'=>'confirm_password', 
		'type'=>'password', 'value'=>'');
$active = array('name'=>'active', 'id'=>'active', 'value'=>1, 
		'checked'=>$field['active']);
$sex = array(0=>lang('user_form_sex_0'), 1=>lang('user_form_sex_1'), 
		2=>lang('user_form_sex_2'), 3=>lang('user_form_sex_3'));
$color = array(1=>lang('user_form_color_1'), 2=>lang('user_form_color_2'),
		3=>lang('user_form_color_3'),4=>lang('user_form_color_4'),
		5=>lang('user_form_color_5'),6=>lang('user_form_color_6'),
		7=>lang('user_form_color_7'),8=>lang('user_form_color_8'),
		9=>lang('user_form_color_9'),10=>lang('user_form_color_10'));
$description = array('name'=>'description', 'value'=>$field['description'], 'rows'=>4, 
		'class'=>'span8');
$submit = array('name'=>'submit', 'value'=>'submit', 
		'class'=>'btn', 'type'=>'submit',
		'content'=>'<i class="icon-ok"></i> '.lang('form_submit'));
$delete = array('name'=>'delete', 'value'=>'delete', 
		'class'=>'btn btn-danger',	'type'=>'submit', 
		'content'=>'<i class="icon-remove icon-white"></i> '.lang('form_delete'),
		'onclick'=>'return confirm(\''.lang('are_you_sure').'\')');
?>

<?=form_open()?>

<fieldset>
<legend><?=$section?></legend>

<div class="row">
	<div class="span4">
		<?php $error = form_error('login')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('user_form_login') . ' *' . form_error('login'), 'login', $label_attributes)?>
			<div class="controls">
				<?=form_input($login)?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="span4">
		<?php $error = form_error('password')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('user_form_password') . ' *' . form_error('password'), 'password', $label_attributes)?>
			<div class="controls">
				<?=form_input($password)?>
			</div>
		</div>
	</div>
	<div class="span4">
		<?php $error = form_error('confirm_password')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('user_form_confirm_password') . ' *' . form_error('confirm_password'), 'confirm_password', $label_attributes)?>
			<div class="controls">
				<?=form_input($confirm_password)?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="span4">
		<?php $error = form_error('sex')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('user_form_sex') . ' *' . form_error('sex'), 'sex', $label_attributes)?>
			<div class="controls">
				<?=form_dropdown('sex', $sex, $field['sex'], 'id="sex" class="removefirstelement"')?>
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="control-group">
			<?=form_label(lang('user_form_color'))?>
			<div class="controls">
				<?=form_hidden('color', '')?>
				<?=form_dropdown('color', $color, $field['color'], 'id="color" multiple="multiple"')?>
			</div>
		</div>
	</div>
</div>

<?php $error = form_error('description')?'error':'' ?>
<div class="control-group <?=$error?>">
	<?=form_label(lang('user_form_description') . form_error('description'), 'description', $label_attributes)?>
	<div class="controls">
		<?=form_textarea($description)?>
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<?=form_hidden('active', '0')?>
		<?=form_label(form_checkbox($active) . ' ' . lang('user_form_active'), 'active', array('class'=>'checkbox'))?>
	</div>
</div>

<p class="muted">* Required field</p>

<div class="form-actions">
	<?=form_button($submit)?>

	<div class="span pull-right">
		<?php if($this->uri->segment(3)) : ?>
			<?=form_button($delete)?>
		<?php endif; ?>
	</div>
</div>

</fieldset>
<?=form_close()?>

<script type="text/javascript">
<!--
$(document).ready(function() {
	$('.removefirstelement option:nth-child(1)').attr('hidden', 'hidden');
	$("#color").multiSelect({
    	selectAll: false,
    	noneSelected: '<?=lang('user_form_color_0')?>',
    	oneOrMoreSelected: '% <?=lang('form_multiselect')?>'
	});
	$("[rel=tooltip]").tooltip();
});
//-->
</script>
