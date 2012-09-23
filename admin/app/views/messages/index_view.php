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

<div class="toolbar">
	<?=anchor('messages/delete', lang('toolbar_delete_all'), 'class="formee-button delete danger"')?>
</div>

<?=$table?>

