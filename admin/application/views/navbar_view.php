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
		
			<ul class="nav navbar-nav">
				<li class="<?php echo $this->uri->rsegment( 1 ) == 'users' ? 'active' : ''; ?>">
					<a href="<?php echo site_url( 'users' ); ?>"><span
						class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;
						Users
					</a>
				</li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Admin
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url( '../auth/home/logout' ); ?>">
								<span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
			
		</div>
	</div>
</header>
