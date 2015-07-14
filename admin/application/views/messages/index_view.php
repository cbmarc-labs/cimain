<script type="text/javascript">
	$(document).ready(function() {
		/* Init DataTables */
		var oTable = $('#datatable_messages').dataTableInit({
			"aaSorting": [[ 0, "desc" ]],
			"aoColumnDefs": []
			});

		$("#allbtn").click(function() {oTable.fnFilter('')});
		$("#infobtn").click(function() {oTable.fnFilter('info')});
		$("#successbtn").click(function() {oTable.fnFilter('success')});
		$("#warningbtn").click(function() {oTable.fnFilter('warning')});
		$("#errorbtn").click(function() {oTable.fnFilter('error')});
		
		$('div.dataTables_filter input').focus();
	});
</script>

<div class="row">
	<div class="span">
		<?=anchor(current_url().'/delete', '<i class="icon-remove icon-white"></i> ' .
			lang('toolbar_delete_all'), 
			array('class'=>'btn btn-danger',
				'onclick'=>'return confirm(\''.lang('are_you_sure').'\')'))?>
	</div>
	<div class="span">
		<div class="btn-group">
			<span id="allbtn" class="btn">all</span>
			<span id="infobtn" class="btn">info</span>
			<span id="successbtn" class="btn">success</span>
			<span id="warningbtn" class="btn">warning</span>
			<span id="errorbtn" class="btn">error</span>
		</div>
	</div>
</div>

<?=$table?>

