$(document).ready(function() {
	
	$('.tip').tooltip();
	
});

$.fn.dataTableInit = function (params) {
	this.dataTable(jQuery.extend({}, {
		"sDom":"<'row'<'col-xs-6'l><'col-xs-6 text-right'f>>tr<'row'<'col-xs-6'i><'col-xs-6 text-right'p>>",
		"oLanguage": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "_MENU_",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			//"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfo":           "_START_ - _END_ : _TOTAL_ (_MAX_ registros en total)",
			//"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoEmpty":      "0 registros (_MAX_ registros en total)",
			//"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoFiltered":   "",
			"sInfoPostFix":    "",
			"sSearch":         "",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    '<span class="glyphicon glyphicon-fast-backward"></span>',
				"sLast":     '<span class="glyphicon glyphicon-fast-forward"></span>',
				"sNext":     '<span class="glyphicon glyphicon-forward"></span>',
				"sPrevious": '<span class="glyphicon glyphicon-backward"></span>'
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		"bServerSide": true,
		"bStateSave": true,
		"sPaginationType": "full",
		"bAutoWidth" : false,
		"fnServerData": function ( sSource, aoData, fnCallback ) {
			$.appAjax(sSource, {
				data:aoData,
				success: function(json) {
					fnCallback(json);
				}
			});
		},
		"fnInitComplete": function() {
			var table = this;
			
			$( ".dataTables_filter input" ).wrap('<div class="input-group">');
       		$( ".dataTables_filter input" ).after('<span class="input-group-btn"><button class="btn btn-default input-sm" type="button"><span class="glyphicon glyphicon-remove"></span></button></span>');
			
			$('.dataTables_filter button').click(function(event){
				table.fnFilter('');
				
				$('.dataTables_filter input').css('background', 'white');
				$('.dataTables_filter input').focus();
			});
			
			if($('.dataTables_filter input').val().length)
		        $('.dataTables_filter input').css('background', 'yellow');
				
			$('.dataTables_filter input').on('keydown', function(){
				var field = $(this);
				
				setTimeout(function () {
					if (field.val().length == 0) {
						field.css('background', 'white');
					} else {
						field.css('background', 'yellow');
					}
				}, 1);
			});
		}
	}, params));
		
	return this;
};