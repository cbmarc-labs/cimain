$(document).ready(function() {
	
	$('.tip').tooltip();
	
});

$.fn.DataTableInit = function (params) {		
	this.dataTable(jQuery.extend({}, {
		"sDom": "<'row'<'col-sm-12'<'pull-right'f><'pull-left'l>r<'clearfix'>>>t<'row'<'col-sm-12'<'pull-left'i><'pull-right'p><'clearfix'>>>",
		/*"bProcessing": true,
		//"sPaginationType": "bs_four_button",
		"bAutoWidth" : false,
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
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		},
        "bServerSide": true,
        "sServerMethod": "GET",
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "aaSorting": [[0, 'asc']],
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
        	id = "default";
        	if($(this).attr('id'))
        		id = $(this).attr('id');
        	
        	localStorage.setItem( 'DT_' + id, JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
        	id = "default";
        	if($(this).attr('id'))
        		id = $(this).attr('id');
        	
        	storage = localStorage.getItem('DT_' + id);
        		        	
        	if(storage == null)
        		return null;
        	
        	return JSON.parse(storage);
        },
        "fnServerData": function ( sSource, aoData, fnCallback ) {
	        $.ajax({
	            'dataType':'json',
	            'type':'POST',
	            'url':sSource,
	            'data':aoData,
	            'success':function(json) {
	            	if(json.error == 10) {
	            		location.reload();
	            	} else {
	            		if (typeof json.errorMsg != 'undefined') {
	            			$.alert("error", json.errorMsg);
	            		}
	            		
	            		fnCallback(json);
	            		if (typeof app_fnCallback == 'function') { 
	            			app_fnCallback(json); 
	            		}
	            	}
	            },
	            'error': function() {
	            	$.alert("error", "No se ha retornado datos de tipo ajax.");
                }
	        });
        },
        "fnInitComplete": function() {
        	var table = this;
        	
        	//this.fnSetFilteringDelay();
        	
        	$( ".dataTables_length" ).addClass('hidden-xs');
        	$( ".dataTables_length select" ).addClass('form-control');

        	if($( ".dataTables_filter input" ).attr('class') != 'form-control') {
        		$( ".dataTables_filter input" ).addClass('form-control');
        		$( ".dataTables_filter input" ).wrap('<div class="input-group" style="width:250px;">');
        		$( ".dataTables_filter input" ).after('<span class="input-group-btn"><button class="btn btn-default" type="button"><span class="glyphicon glyphicon-remove"></span></button></span>');
        	}
			
			$('.dataTables_filter button').click(function(event){
				$('.dataTables_filter input').css('background', 'white');
				table.fnFilter('');
				$('.dataTables_filter input').focus();
			});
			
			if(!$(this).hasClass('noautofocus')) {
				$(".dataTables_filter input").focus();
				//$(".dataTables_filter input").select();
			}
	        
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
	    	
	    	if (typeof app_fnInitComplete == 'function') { 
	    		app_fnInitComplete(); 
    		}
        },
        "fnDrawCallback": function() {
        }*/
	}, params));
	
	return this;
};