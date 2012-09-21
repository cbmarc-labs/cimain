<script type="text/javascript">
	var gaiSelected =  [];

	$(document).ready(function() {
		/* Init DataTables */
		var oTable = $('#datatable').dataTable({
			"sDom": '<"dataTables_top"lf>t<"dataTables_bottom"ip>',
			"bStateSave": true,
			"sPaginationType": "full_numbers",
			"aaSorting": [[ 1, "asc" ]],
			"oLanguage": {
				"sInfo": '<?=lang('datatable_sInfo')?>',
					"oPaginate": {
						"sFirst": '<?=lang('datatable_sFirst')?>',
						"sPrevious": '<?=lang('datatable_sPrevious')?>',
						"sNext": '<?=lang('datatable_sNext')?>',
						"sLast": '<?=lang('datatable_sLast')?>'
			    },
			    "sEmptyTable": '<?=lang('datatable_sEmptyTable')?>',
				"sLengthMenu": '<?=lang('datatable_sLengthMenu')?>',
				"sSearch": '<?=lang('datatable_sSearch')?>'
			}
		});

		oTable.fnSetColumnVis(0, false);

		/* Add events */
		$('#datatable tbody tr').live('click', function (event) {
			if(event.target.nodeName == "A")
				return;
				
	        var aData = oTable.fnGetData( this );
			var iId = aData[0];

			if ( jQuery.inArray(iId, gaiSelected) == -1 )
				gaiSelected[gaiSelected.length++] = iId;
			else
				gaiSelected = jQuery.grep(gaiSelected, function(value) {
					return value != iId;
				});
	        
			$(this).toggleClass('row_selected');

			if(gaiSelected.length>0)
				$('#delete').show();
			else
				$('#delete').hide();
		});

		$('#delete').live('click', function (event) {
			event.preventDefault();

			if(confirm("<?=lang('are_you_sure')?>")) {
				$('input[name=ids]').val(gaiSelected);
				$('#delete_form').submit();
			}
		});

		$('div.dataTables_filter input').focus();
		$('#delete').hide();
	});
</script>

<?=form_open('users/delete', array('id'=>'delete_form'), array('ids'=>''))?>
<?=form_close()?>

<div class="toolbar">
<?=anchor('users/add', lang('toolbar_add'), 'class="buttons add"')?>
<?=anchor('', lang('toolbar_delete'), 'id="delete" class="buttons delete"')?>
</div>

<?=$table?>

