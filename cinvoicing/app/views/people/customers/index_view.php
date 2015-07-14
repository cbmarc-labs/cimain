<script type="text/javascript">
<!--
	$(document).ready(function() {
		/* Init DataTables */
		var oTable = $('#datatable_customers').dataTableInit().dataTableClick();
		
		/* Add events */
		oTable.on('click', 'tbody tr', function(event){
			var $target = $(event.target);

			if($target.is('td')) {
				if(oTable.getSelected().length > 0)
					$('#toolbar_delete').show();
				else
					$('#toolbar_delete').hide();
			}
		});

		$('#toolbar_delete').on('click', function (event) {
			if(confirm("<?=lang('are_you_sure')?>")) {
				$('input[name=ids]').val(oTable.getSelected());
				$('#delete_form').submit();
			}
		});

		$('div.dataTables_filter input').focus();
		$('#toolbar_delete').hide();
	});
//-->
</script>

<?=form_open(current_url().'/delete', array('id'=>'delete_form'), array('ids'=>''))?>
<?=form_close()?>

<div class="row">
	<div class="span">
		<?=anchor(current_url().'/add', '<i class="icon-plus"></i> ' .
			 lang('toolbar_add_item'), 'class="btn"')?>
			 
		<span id="toolbar_delete" class="btn btn-danger">
			<i class="icon-remove icon-white"></i>
			<?=lang('toolbar_delete_items')?>
		</span>
	</div>
</div>

<?=$table?>