<header class="navbar navbar-static-top bs-docs-nav navbar-inverse" id="top" role="banner">
	<div class="container">
		<div class="navbar-header">
		
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target=".navbar-collapse">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
					
			<a class="navbar-brand" href="#">
				App
			</a>
			
		</div>
		
		<div class="navbar-collapse collapse">
		
			<ul class="nav navbar-nav">
				
				<li class="<?php echo $this->uri->rsegment(1)=='clientes'?'active':''; ?>">
					<a href="<?php echo site_url( 'clientes' ); ?>"><span
						class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;
						Usuarios
					</a>
				</li>
			</ul>
			
		</div>
	</div>
</header>
