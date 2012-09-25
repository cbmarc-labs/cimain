<?php 
$label_attributes = array('class'=>'control-label');
$login = array('id'=>'login', 'name'=>'login', 'value'=>set_value('login'),
		'style'=>'', 'class'=>'span4', 'autofocus'=>'autofocus');
$password = array('id'=>'password', 'name'=>'password', 
		'style'=>'', 'class'=>'span4', 'type'=>'password');
$remember = array('id'=>'remember', 'name'=>'remember', 'value'=>1,
		'class'=>'', 'checked'=>set_value('remember', 1));
$submit = array('name'=>'submit', 'value'=>'submit', 
		'class'=>'btn btn-primary', 'type'=>'submit',
		'content'=>'<i class="icon-ok icon-white"></i> ' . lang('auth_form_submit'))
?>

<div class="row" style="margin-top:5em;">
	<div class="span4 well" style="margin:0px auto;float:none;">

		<?=form_open()?>
		 
		<fieldset>
			<legend>Login</legend>
			
			<div class="control-group">
				<?=form_label(lang('user_form_login'), 'login', $label_attributes)?>
				<div class="controls">
					<?=form_input($login)?>
				</div>
			</div>
	
			<div class="control-group">
				<?=form_label(lang('auth_form_password'), 'password', 
						$label_attributes)?>
				<div class="controls">
					<?=form_input($password)?>
				</div>
			</div>
			
			<?=validation_errors('<div class="control-group error" onclick="this.style.display=\'none\'"><label class="control-label">', '</label></div>')?>
			
			<div class="row">
				<div class="span2">
					<div class="control-group">
						<div class="controls">
							<?=form_label(form_checkbox($remember) . 
									lang('auth_form_remember'), 
									'remember', array('class'=>'checkbox'))?>
						</div>
					</div>
				</div>
				
				<div class="span2">
					<div class="control-group pull-right">
						<div class="controls">
							<?=form_button($submit)?>
						</div>
					</div>
				</div>
			</div>
		
		</fieldset>
		
		<?=form_close()?>
	
	</div>
</div>
