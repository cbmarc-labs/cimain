<header class="navbar navbar-static-top bs-docs-nav navbar-inverse" id="top" role="banner">
	<div class="container">
		<div class="navbar-header">
		
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target=".navbar-collapse">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
					
			<a class="navbar-brand" href="<?php echo site_url(); ?>">
				<?php echo $this->config->item('title'); ?>
			</a>
			
		</div>
		
		<div class="navbar-collapse collapse">
			
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Language
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url( 'language/catalan' ); ?>">
								<span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Catalan
							</a>
						</li>
						<li>
							<a href="<?php echo site_url( '../auth/home/logout' ); ?>">
								<span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;English
							</a>
						</li>
					</ul>
				</li>
			</ul>
			
		</div>
	</div>
</header>
