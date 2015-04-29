<?php echo form_open(); ?>

<div class="well">

	<div class="page-header" style="margin: 0 0 20px 0;">
		<div class="row">
			<div class="col-xs-6">
				<h3 style="margin: 0;">
					<?php if( $this->uri->rsegment( 3 ) ) : ?>
					<span class="glyphicon glyphicon-edit"></span>&nbsp;<?php echo lang( 'edit' ); ?>
					<?php else : ?>
					<span class="glyphicon glyphicon-plus"></span>&nbsp;<?php echo lang( 'add' ); ?>
					<?php endif; ?>
				</h3>
			</div>
			<div class="col-xs-6 text-right">
				<?php if( $validation_errors = validation_errors() ): ?>
				<button type="button" class="btn btn-danger" onclick="$('#validation_errors').toggle();">
					<span class="glyphicon glyphicon-warning-sign"></span>
				</button>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div id="validation_errors" class="alert alert-danger" style="cursor: pointer; display: none;"
				onclick="$('#validation_errors').toggle();">
				<?php echo $validation_errors; ?>
			</div>
		</div>
	</div>

	<div class="row">
		<?php $error = form_error( 'username' ) ? 'has-error' : ''; ?>
		<div class="form-group <?php echo $error; ?> col-sm-4">
			<label for="username" class="control-label"><?php echo lang( 'form_label_username' ); ?>&nbsp;*</label>
			<input maxlength="50" required class="form-control" type="text"
				name="username" value="<?php echo $field['username']; ?>" autofocus>
		</div>
		
		<?php $error = form_error( 'password' ) ? 'has-error' : '' ?>
		<div class="form-group <?php echo $error; ?> col-sm-4">
			<label for="password" class="control-label"><?php echo lang( 'form_label_password' ); ?></label>					
			<input class="form-control" type="text" name="password" value="<?php echo $field['password']; ?>">
		</div>
	</div>
	
	<hr style="margin: 0 0 15px 0;">
	
	<div class="row">
		<div class="form-group col-xs-6">
			<div class="form-inline">
				<div class="form-group">
					<button name="submit" type="submit" value="submit"
						class="btn btn-primary">
						<span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo lang( 'form_button_submit' ); ?>
					</button>
				</div>
				<div class="form-group">
					<a class="btn btn-default" href="javascript:$.appAlert.show();">
						<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;<?php echo lang( 'form_button_back' ); ?>
					</a>
				</div>
			</div>
		</div>
		
		<?php if( $this->uri->rsegment( 3 ) ) : ?>
		<div class="form-group col-xs-6">
			<div class="form-group pull-right">
				<button name="delete" type="submit" value="delete"
					class="btn btn-danger" onclick="return confirm('<?php echo lang( 'are_you_sure' ); ?>')">
					<span class="glyphicon glyphicon-remove"></span>&nbsp;<?php echo lang( 'form_button_delete' ); ?>
				</button>
			</div>
		</div>
		<?php endif; ?>
	</div>
	
</div>

<?php echo form_close(); ?>