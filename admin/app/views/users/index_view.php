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
			},
			"aoColumnDefs": [ { "bVisible": false, "aTargets": [ 0 ] }]
		});

		/* Add events */
		$('#datatable tbody tr').live('click', function (event) {
	        var aData = oTable.fnGetData( this );
			var iId = aData[0];
			var $target = $(event.target);
			var checked = $target.attr("checked")?1:0;
			
			if($target.is('input')) {
				$.post('users/update', { id:iId, active:checked },
					function(data) {
						
						if(!data.msg_value)
							return;

						$target.attr("checked", checked?false:true);
						
						if($("#msg").length == 0)
							$('<div class="' + data.msg_type + '" id="msg">' 
									+ data.msg_value + '</div>')
								.appendTo('body');
							
						$("#msg").css({top: -$('#msg').outerHeight(), 
								left:($(window).width() - $('#msg').outerWidth())/2})
							.animate({ top: "-2px" }, 250 )
							.click(function(){$(this).fadeOut(250,
									function(){$(this).remove();})});
					});
			}

			if(!$target.is('td'))
				return;

			if ( jQuery.inArray(iId, gaiSelected) == -1 )
				gaiSelected[gaiSelected.length++] = iId;
			else
				gaiSelected = jQuery.grep(gaiSelected, function(value) {
					return value != iId;
				});
	        
			$(this).toggleClass('row_selected');

			if(gaiSelected.length>0)
				$('#toolbar_delete').show();
			else
				$('#toolbar_delete').hide();
		});

		$('#toolbar_delete').live('click', function (event) {
			event.preventDefault();

			if(confirm("<?=lang('are_you_sure')?>")) {
				$('input[name=ids]').val(gaiSelected);
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
<?=anchor('users/add', lang('toolbar_add'), 'class="buttons add"')?>
<?=anchor('', lang('toolbar_delete'), 'id="toolbar_delete" class="buttons delete"')?>
</div>

<?=$table?>

