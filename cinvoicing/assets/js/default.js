if (typeof jQuery != 'undefined') {

/**
 * GLOBAL FUNCTIONS
 */
jQuery.fn.centerWidth = function () {
    this.css({top: -this.outerHeight() + "px",
    	left:Math.max(0, (($(window).width() - this.outerWidth()) / 2) + 
    			$(window).scrollLeft()) + "px"});

    return this;
}

/*
 * DATATABLE EXTENSION FUNCTIONS
 */
if(typeof dataTableLanguage == 'undefined')
	dataTableLanguage = {};

jQuery.fn.dataTableInit = function (params) {		
	this.dataTable(jQuery.extend({}, {
		"sDom": '<"dataTables_top"lf>t<"dataTables_bottom"ip>',
		"bStateSave": false,
		"sPaginationType": "full_numbers",
		"aaSorting": [[ 1, "asc" ]],
		"oLanguage": dataTableLanguage,
		"aoColumnDefs": [ { "bVisible": false, "aTargets": [ 0 ] } ]
	}, params));
	
	return this;
}

jQuery.fn.dataTableClick = function() {
	var table = this;
	var selected = [];
	
	this.on('click', 'tbody tr', function(event){
		var $target = $(event.target);
		
		if($target.is('td')) {
			var aData = table.fnGetData(this);
			
			if(aData) {
				var iId = aData[0];
				
				if ( jQuery.inArray(iId, selected) == -1 )
					selected[selected.length++] = iId;
				else
					selected = jQuery.grep(selected, function(value) {
						return value != iId;
					});
				
				$(this).toggleClass('row_selected');
			}
		}
	});
	
	this.getSelected = function() {return selected;};
	
	return this;
}

/* MESSAGE */
jQuery.extend({
	message: function(type, message) {
		
	if($('#message').length == 0)
		$('<div id="message">&nbsp;&nbsp;&nbsp;' + message + '</div>')
			.appendTo('body');

	$('#message')
		.addClass('alert alert-' + type + ' ' + type + '-icon')
		.css({'cursor':'pointer','position':'absolute','padding-left':'30px'})
		.centerWidth()
		.animate({top:"-2px"},250)
		.click(function(){
			$(this).fadeOut(250,function(){
				$(this).remove();
			})
		})
		.show();
	}
});



}