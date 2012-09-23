<script type="text/javascript">
	$(document).ready(function() {
		/* Init DataTables */
		var oTable = $('#datatable_users').dataTableInit().dataTableClick();
		
		/* Add events */
		oTable.on('click', 'tbody tr', function(event){
	        var aData = oTable.fnGetData( this );
			var iId = aData[0];
			var $target = $(event.target);
			var checked = $target.attr("checked")?1:0;
			
			if($target.is('input')) {
				$.post('users/update', { id:iId, active:checked },
					function(data) {
						// error
						if(data.msg_value) {
							$target.attr("checked", checked?false:true);
							jQuery.msg(data.msg_type, data.msg_value);
						}
					});
			}

			if($target.is('td')) {
				if(oTable.getSelected().length>0)
					$('#toolbar_delete').show();
				else
					$('#toolbar_delete').hide();
			}
		});

		$('#toolbar_delete').on('click', function (event) {
			event.preventDefault();
			
			if(confirm("<?=lang('are_you_sure')?>")) {
				$('input[name=ids]').val(oTable.getSelected());
				$('#delete_form').submit();
			}
		});

		$('div.dataTables_filter input').focus();
		$('#toolbar_delete').hide();
	});
</script>

<?=form_open('users/delete', array('id'=>'delete_form'), array('ids'=>''))?>
<?=form_close()?>

<div class="toolbar">
	<?=anchor('users/add', lang('toolbar_add_item'), 'class="formee-button add"')?>
	<?=anchor('', lang('toolbar_delete_items'), 'id="toolbar_delete" class="formee-button delete danger"')?>
</div>

<?=$table?>

