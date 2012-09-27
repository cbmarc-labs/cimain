<?php 
$label_attributes = array('class'=>'control-label');
$description = array('id'=>'description', 'name'=>'description', 
		'value'=>$field['description'],	'class'=>'span6',
		'autofocus'=>'autofocus');
$rate = array('id'=>'rate', 'name'=>'rate', 'class'=>'span2', 
		'value'=>$field['rate']);

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
		<?php $error = form_error('description')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('tax_form_description') . 
					' *' . form_error('description'), 'description', 
					$label_attributes)?>
			<div class="controls">
				<?=form_input($description)?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="span4">
		<?php $error = form_error('rate')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('tax_form_rate') . form_error('rate'), 'rate', $label_attributes)?>
			<div class="controls">
				<?=form_input($rate)?>
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
