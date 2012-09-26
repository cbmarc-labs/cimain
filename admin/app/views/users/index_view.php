<script type="text/javascript">
<!--
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
				$.post(
					'<?=site_url()?>/users/edit_ajax/'+iId, 
					{ active:checked },
					function(data) {
						// error
						if(data.error)
							$target.attr("checked", checked?false:true);

						jQuery.msg(data.type, data.message);
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

<?=form_open('users/delete', array('id'=>'delete_form'), array('ids'=>''))?>
<?=form_close()?>

<div class="row">
	<div class="span">
		<?=anchor('users/add', '<i class="icon-ok"></i> ' .
			 lang('toolbar_add_item'), 'class="btn"')?>
			 
		<span id="toolbar_delete" class="btn btn-danger">
			<i class="icon-remove icon-white"></i>
			<?=lang('toolbar_delete_items')?>
		</span>
	</div>
</div>

<?=$table?>

