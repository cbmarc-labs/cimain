<?php 
$label_attributes = array('class'=>'control-label');
$name = array('id'=>'name', 'name'=>'name', 
		'value'=>$field['name'], 'class'=>'span6',
		'autofocus'=>'autofocus');
$email = array('id'=>'email', 'name'=>'email',
		'value'=>$field['email']);

$submit = array('name'=>'submit', 'value'=>'submit', 
		'class'=>'btn', 'type'=>'submit',
		'content'=>'<i class="icon-ok"></i> '.lang('form_submit'));
$delete = array('name'=>'delete', 'value'=>'delete', 
		'class'=>'btn btn-danger',	'type'=>'submit', 
		'content'=>'<i class="icon-remove icon-white"></i> '.lang('form_delete'),
		'onclick'=>'return confirm(\''.lang('are_you_sure').'\')');
?>

<?=form_open()?>

<div class="row">
	<div class="span4">
		<?php $error = form_error('name')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('customers_form_name') . ' *', 'name', 
					$label_attributes)?>
			<div class="controls">
				<?=form_input($name)?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="span4">
		<?php $error = form_error('email')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('customers_form_email'), 'email', 
					$label_attributes)?>
			<div class="controls">
				<?=form_input($email)?>
			</div>
		</div>
	</div>
</div>

<p class="muted">* Required field</p>

<div class="form-actions">
	<?=form_button($submit)?>

	<div class="span pull-right">
		<?php if($this->uri->rsegment(3)) : ?>
			<?=form_button($delete)?>
		<?php endif; ?>
	</div>
</div>

<?=form_close()?>
