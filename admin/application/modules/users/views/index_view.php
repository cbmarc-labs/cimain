<script type="text/javascript">
<!--
	$(document).ready(function() {

		var table_users = $('#table_users').dataTableInit({
			"sAjaxSource": "<?php echo site_url( 'users/get_table' ); ?>",
			"aoColumns": [
				{"bVisible":false,"bSearchable": false},
				{"bVisible":true,"bSearchable":true,"bSortable":true,"sWidth":"50%"},
				{"bVisible":true,"bSearchable":true,"sClass":"text-right","bSortable":true,"sWidth":"50%"}
	        ]
		});
		
		table_users.on('click', 'tbody tr', function(event){
			var aData = table_users.fnGetData( this );
			var iId = aData[0];

			if($(event.target).is('td')) {
				window.location.href = "<?php echo site_url( 'users/edit' ); ?>/"+iId;
			}
		});
		
	});
//-->
</script>

<div class="row" style="margin-bottom: 10px;">
	<div class="col-xs-2">
		<a href="<?php echo site_url( 'users/add' ); ?>" class="btn btn-primary">
			<span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;<?php echo lang( 'add' ); ?>
		</a>
	</div>
</div>

<div class="well">
	<div class="row">
		<div class="col-xs-12">
			<table class="table table-hover table-bordered table-condensed" id="table_users">
				<thead>
					<tr>
						<th>ID</th>
						<th><?php echo lang( 'table_header_username' ); ?></th>
						<th style="text-align:left;"><?php echo lang( 'table_header_password' ); ?></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>