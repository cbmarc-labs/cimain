<script type="text/javascript">
	$(document).ready(function() {
		/* Init DataTables */
		var oTable = $('#datatable').dataTable({
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
		$('#datatable tbody tr').live('click', function () {
	        var aPos = oTable.fnGetPosition( this );
	        var aData = oTable.fnGetData(aPos)[0];
	        var newurl = "<?=site_url('users/edit/')?>/"+aData;

	        window.location = newurl; // redirect
		});

		$('div.dataTables_filter input').focus()
	});
</script>
<p><?=anchor('users/edit', 'Add New Item', 'class="buttons add"')?></p>
<?=$table?>