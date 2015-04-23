<br><br>

<?php echo form_open(); ?>

	<div class="row">
		<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
			<div class="well">
			
				<div class="page-header">
					<h3><?php echo $this->config->item('title'); ?></h3>
				</div>
				
				<div class="row">
					<div class="col-xs-offset-2 col-xs-8">
						<div class="form-group">
							<label for="login">Login</label>
							<input autocomplete="off" type="text" class="form-control" name="login" id="login" autofocus>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" id="password">
						</div>
						
						<br>
				
						<div class="form-group">
							<button class="btn btn-primary pull-right" type="submit">
								<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Log in
							</button>
						</div>
						
						<br>
						<br>
					</div>
				</div>
			
			</div>
		</div>
	</div>

<?php echo form_close(); ?>