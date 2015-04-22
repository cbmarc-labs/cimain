<script type="text/javascript">
<!--
	$(document).ready(function() {

		$('input[name="daterange"]').daterangepicker({
	        //startDate: moment().subtract(29, 'days'),
	        //endDate: moment(),
	        minDate: '01/01/2012',
	        maxDate: '12/31/2016',
	        //dateLimit: { days: 60 },
	        showDropdowns: true,
	        showWeekNumbers: true,
	        timePicker: false,
	        timePickerIncrement: 1,
	        timePicker12Hour: true,
	        ranges: {
	           'Hoy': [moment(), moment()],
	           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	           'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
	           'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
	           'Este mes': [moment().startOf('month'), moment().endOf('month')],
	           'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
	           'Últimos 3 meses': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        },
	        opens: 'left',
	        buttonClasses: ['btn btn-default'],
	        applyClass: 'btn-small btn-primary',
	        cancelClass: 'btn-small',
	        format: 'DD/MM/YYYY',
	        separator: ' hasta ',
	        locale: {
	            applyLabel: 'Aceptar',
	            cancelLabel: 'Anular',
	            fromLabel: 'Desde',
	            toLabel: 'Hasta',
	            customRangeLabel: 'Seleccionar rango',
	            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
	            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	            firstDay: 1
	        }
	     },function(start, end) {
	    	 updateData(start, end);
		 });

		 function updateData(start, end) {
	    	 $.cookie('balances_daterangepicker_start', start, { expires: 365, path: '/' });
	    	 $.cookie('balances_daterangepicker_end', end, { expires: 365, path: '/' });
	    	 
	    	 oTableGastos.fnFilter( start.format('YYYY-MM-DD') + '|' + end.format('YYYY-MM-DD') , 0 );
	    	 oTableVentas.fnFilter( start.format('YYYY-MM-DD') + '|' + end.format('YYYY-MM-DD') , 0 );
	    	 oTableProveedores.fnFilter( start.format('YYYY-MM-DD') + '|' + end.format('YYYY-MM-DD') , 0 );
	    	 oTableModelo347.fnFilter( start.format('YYYY-MM-DD') + '|' + end.format('YYYY-MM-DD') , 0 );			 
		 }

		$('#menuBalances a').click(function() {
		    $(this).addClass('btn-warning').siblings().removeClass('btn-warning');

		    $("#gastos").hide();
			$("#ventas").hide();
			$("#proveedores").hide();
			$("#modelo347").hide();
			
		    switch(this.hash.substr(1)) {
		    case 'general':
		    	$("#gastos").show();
				$("#ventas").show();
				break;
		    case 'proveedores':
		    	$("#proveedores").show();
				break;
		    case 'modelo347':
		    	$("#modelo347").show();
				break;
		    }

		    return false;
		});

		//$('input').val('08/10/2010');
		
		$("#proveedores").hide();
		$("#modelo347").hide();
		
		$('#daterange-clear').on('click', function(event){
			$('#daterange').val('');

			oTableGastos.fnFilter( '' , 0 );
			oTableVentas.fnFilter( '' , 0 );
			oTableProveedores.fnFilter( '' , 0 );
			oTableModelo347.fnFilter( '' , 0 );
			});
	});
//-->
</script>

<div class="row">
	<div class="form-group col-xs-7">
		<div class="btn-group" id="menuBalances">
			<a href="#general" class="btn btn-default btn-warning">
				<span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;General
			</a>
			<a href="#proveedores" class="btn btn-default">
				<span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Proveedores
			</a>
			<a href="#modelo347" class="btn btn-default">
				<span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Modelo 347
			</a>
		</div>
	</div>
	<div class="col-xs-5">
		<div class="form-group pull-right">
			<div class="input-group">
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
				<input style="cursor:pointer;" type="text" class="form-control" readonly name="daterange" id="daterange" />
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="daterange-clear">
						<span class="glyphicon glyphicon-remove"></span>
					</button>
				</span>
			</div>
		</div>
	</div>
</div>

<div class="well" id="gastos">
	<?=$this->load->view('balances/gastos_view')?>
</div>
	
<div class="well" id="ventas">
	<?=$this->load->view('balances/ventas_view')?>
</div>

<div class="well" id="proveedores">
	<?=$this->load->view('balances/proveedores_view')?>
</div>

<div class="well" id="modelo347">
	<?=$this->load->view('balances/modelo347_view')?>
</div>