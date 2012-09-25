<script type="text/javascript">
	$(document).ready(function() {
		/* Init DataTables */
		var oTable = $('#datatable_messages').dataTableInit({
			"aaSorting": [[ 0, "desc" ]],
			"aoColumnDefs": []
			});
		
		$('div.dataTables_filter input').focus();
	});
</script>

<div class="nav">
	<?=anchor('messages/delete', '<i class="icon-remove icon-white"></i> ' .
		lang('toolbar_delete_all'), 
		array('class'=>'btn btn-danger',
				'onclick'=>'return confirm(\''.lang('are_you_sure').'\')'))?>
</div>

<?=$table?>

