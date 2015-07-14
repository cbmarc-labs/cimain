<br><br>

<?php echo validation_errors(); ?>

<?php echo form_open(); ?>

	<div class="row">
		<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
			<div class="well">
			
				<div class="page-header">
					<h3><?php echo $this->config->item('title'); ?></h3>
				</div>
				
				<?php if( $this->ion_auth->errors() ) : ?>
				<div class="alert alert-danger">			
					<?php echo $this->ion_auth->errors(); ?>				
				</div>
				<?php endif; ?>
				
				<div class="row">
					<div class="col-xs-offset-2 col-xs-8">
						<div class="form-group">
							<label for="login"><?php echo lang( 'login_identity_label' ); ?>:</label>
							<input autocomplete="off" type="text" class="form-control" name="login" id="login" value="<?php echo $field['login']; ?>" autofocus>
						</div>
						<div class="form-group">
							<label for="password"><?php echo lang( 'login_password_label' ); ?>:</label>
							<input type="password" class="form-control" name="password" id="password" value="<?php echo $field['password']; ?>">
						</div>
						
						<br>
				
						<div class="form-group">
        					<label>
          						<?php echo form_checkbox( 'remember', $field['remember'], $field['remember'] == 1 ? TRUE : FALSE ); ?><?php echo lang( 'login_remember_label' ); ?>
        					</label>
							<button class="btn btn-primary pull-right" type="submit">
								<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;<?php echo lang( 'login_submit_btn' ); ?>
							</button>
						</div>
						
						<br>
						<br>
					</div>
				</div>
				
				<div class="form-group">
      </div>
			
			</div>
		</div>
	</div>

<?php echo form_close(); ?>