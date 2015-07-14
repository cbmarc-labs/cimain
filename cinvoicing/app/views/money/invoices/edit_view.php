<?php 
$label_attributes = array('class'=>'control-label');

$submit = array('name'=>'submit', 'value'=>'submit', 
		'class'=>'btn', 'type'=>'submit',
		'content'=>'<i class="icon-ok"></i> '.lang('form_submit'));
$delete = array('name'=>'delete', 'value'=>'delete', 
		'class'=>'btn btn-danger',	'type'=>'submit', 
		'content'=>'<i class="icon-remove icon-white"></i> '.lang('form_delete'),
		'onclick'=>'return confirm(\''.lang('are_you_sure').'\')');
?>

<script type="text/javascript">
<!--
	$(document).ready(function() {
		/* Init DataTables */
		var oTableLines = $('#datatable_invoices_lines').dataTableInit({
			"aaSorting": [],
			"bAutoWidth": false,
			"aoColumnDefs": [  
			     	{ "bVisible": false, "aTargets": [ 0 ] },
			     	{ "bSortable": false, "aTargets": [ 1,2,3,4 ]  },
			     	{ "sWidth": "68%", "aTargets": [ 2 ] },
			     	{ "sWidth": "10%", "aTargets": [ 1,3,4 ] } 
			]
			}).dataTableClick();

		var oTableProducts = $('#datatable_products').dataTableInit({
			"aaSorting": [[ 1, "desc" ]],
			"bAutoWidth": false,
			"aoColumnDefs": [
				{ "bVisible": false, "aTargets": [ 0 ] },
		     	{ "sWidth": "68%", "aTargets": [ 2 ] },
		     	{ "sWidth": "10%", "aTargets": [ 1,3,4 ] } 
			]
			});

		oTableProducts.on('click', 'tbody tr', function(event){
			data = oTableProducts.fnGetData(this);
			
			oTableLines.fnAddData([data[0], data[1], data[2], 
				'<input type="text" style="margin:0;padding:0;width:50px" value="1"/>', data[4]]);

			total = 0;
			$(oTableLines.fnGetNodes()).each(function(){
				total += parseFloat($(this).find("td:eq(3)").text());
				});

			$('#total').text(total);
			
			$('.products').toggle();
			jQuery.message('success', 'item added');
			});

		oTableLines.on('click', 'tbody tr', function(event){
				var $target = $(event.target);
				if($target.is('td')) {
					if(oTableLines.getSelected().length)
						$('#toolbar_delete').show();
					else
						$('#toolbar_delete').hide();
				}
			});

		$('#toolbar_delete').click(function(){
				var aTrs = oTableLines.fnGetNodes();
				for ( var i=0 ; i<aTrs.length ; i++ ) {
					if ( $(aTrs[i]).hasClass('row_selected') )
						oTableLines.fnDeleteRow(aTrs[i]);
				}
				$('#toolbar_delete').hide();
			});

		$('#toolbar_add').click(function(){$('.products').toggle();});
		$('#toolbar_return').click(function(){$('.products').toggle();});
	});
//-->
</script>

<?=form_open()?>

<div class="row">
	<div class="span4">
		<?php $error = form_error('customer_id')?'error':'' ?>
		<div class="control-group <?=$error?>">
			<?=form_label(lang('invoices_form_customer') . ' *', 'customer', 
					$label_attributes)?>
			<div class="controls">
				<?=form_dropdown('customer_id', $field['customers'], 
						$field['customer_id'])?>
			</div>
		</div>
	</div>
</div>

<label>Products</label>
<div class="container-fluid well products">
	<div class="row">
		<div class="span">
			<span id="toolbar_add" class="btn">
				<i class="icon-plus"></i>
				<?=lang('toolbar_add_item')?>
			</span>
			<span id="toolbar_delete" class="btn btn-danger hide">
				<i class="icon-remove icon-white"></i>
				<?=lang('toolbar_delete_items')?>
			</span>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span">
			<table class="table table-condensed table-hover" id="datatable_invoices_lines">
				<thead>
					<tr>
						<th>id</th><th>Name</th><th>Description</th><th>Quantity</th><th>Price</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<td></td><td></td><td></td><td></td><td id="total" style="font-weight:bolder;">0.00</td>
					</tr>
				</tfoot>
			</table>

		</div>
	</div>
</div>

<div class="container-fluid well products hide">
	<div class="row-fluid">
		<div class="span">
			<span id="toolbar_return" class="btn">
				<i class="icon-arrow-left"></i>
				Return
			</span>
			<?=$products?>
		</div>
	</div>
</div>





Notes<br>
<textarea></textarea>









<p class="muted">* Required field</p>

<div class="form-actions">
	<?=form_button($submit)?>

	<div class="span pull-right">
		<?php if($this->uri->rsegment(3)) : ?>
			<?=form_button($delete)?>
		<?php endif; ?>
	</div>
</div>

<?=form_close()?>
