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

   		$( ".bootstrap-table .search input" ).wrap('<div class="input-group" style="width:250px;">');
   		$( ".bootstrap-table .search input" ).after('<span class="input-group-btn"><button class="btn btn-default" type="button"><span class="glyphicon glyphicon-remove"></span></button></span>');
		
	});
//-->
</script>

<div class="row" style="margin-bottom: 10px;">
	<div class="col-xs-2">
		<!-- <a href="<?php echo site_url( 'users/add' ); ?>" class="btn btn-primary"> -->
		<a href="javascript:$.appAjax('<?php echo site_url( 'users/tes1t_ajax' ); ?>');" class="btn btn-primary">
			<span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;<?php echo lang( 'add' ); ?>
		</a>
	</div>
</div>

<div class="well">
	
	<div class="row">	
		<div class="col-xs-12">
			<table data-toggle="table" data-pagination="true" 
				data-search="true"
				data-side-pagination="server" data-url="<?php echo site_url( 'users/get_table1' ); ?>">
				<thead>
					<tr>
						<th data-field="id" data-sortable="true">Item ID</th>
						<th data-field="texto">Item Name</th>
						<th data-field="numero">Item Price</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th colspan="3">hola</th>
					</tr>
				</tfoot>
			</table>
		</div>
			
	</div>
</div>

<div class="well">
	<div class="row">
		<div class="col-xs-12">
			<table class="table table-hover table-bordered table-condensed" id="table_users" style="border-bottom:1px solid #f00;">
				<thead>
					<tr>
						<th>ID</th>
						<th><?php echo lang( 'table_header_username' ); ?></th>
						<th style="text-align:left;"><?php echo lang( 'table_header_password' ); ?></th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th colspan="3"></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>