<script type="text/javascript">
<!--
	$(document).ready(function() {

		$('#table_users').DataTable({
			"sAjaxSource": "<?php echo site_url( 'users/get_table' ); ?>"
		});
		
	});
//-->
</script>

<div class="well">
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-hover table-bordered" id="table_users">
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>