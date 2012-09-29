<?php 
$label_attributes = array('class'=>'control-label');
$name = array('id'=>'name', 'name'=>'name', 
		'value'=>$field['name'], 'class'=>'span4',
		'autofocus'=>'autofocus');
$description = array('id'=>'description', 'name'=>'description', 
		'value'=>$field['description'], 'class'=>'span6', 'rows'=>4);
$unit = array('id'=>'unit', 'name'=>'unit', 'value'=>$field['unit'],
		'class'=>'span2');
$price = array('id'=>'price', 'name'=>'price', 'value'=>$field['price'],
		'class'=>'span2');

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
			<?=form_label(lang('products_form_name') . ' *', 'name', 
					$label_attributes)?>
			<div class="controls">
				<?=form_input($name)?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="span4">
		<?php $error = form_error('description')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('products_form_description'), 'description', $label_attributes)?>
			<div class="controls">
				<?=form_textarea($description)?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="span2">
		<?php $error = form_error('unit')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('products_form_unit'), 'unit',
					$label_attributes)?>
			<div class="controls">
				<?=form_input($unit)?>
			</div>
		</div>
	</div>
	
	<div class="span2">
		<?php $error = form_error('price')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('products_form_price'), 'price',
					$label_attributes)?>
			<div class="controls">
				<?=form_input($price)?>
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
