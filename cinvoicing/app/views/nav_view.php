<div class="navbar">
	<div class="navbar-inner">
		<ul class="nav">				
			<li class="dropdown">
				<a class="dropdown-toggle disabled" data-toggle="dropdown">Money
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?=site_url('money/invoices')?>">Invoices</a></li>
					<li><a href="<?=site_url('money/payments')?>">Payments</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a class="dropdown-toggle disabled" data-toggle="dropdown">Stock
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?=site_url('stock/products')?>">Products</a></li>
					<li><a href="<?=site_url('stock/taxes')?>">Taxes</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a class="dropdown-toggle disabled" data-toggle="dropdown">People
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?=site_url('people/customers')?>">Customers</a></li>
					<li><a href="<?=site_url('people/users')?>">Users</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a class="dropdown-toggle disabled" data-toggle="dropdown">Settings
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?=site_url('settings/messages')?>">Messages</a></li>
				</ul>
			</li>
		</ul>
		<ul class="nav pull-right">
			<li><a href="<?=site_url('auth/logout')?>">Logout</a></li>
		</ul>
	</div>
</div>