(function ($) {
	
    $.appAlert = function (options) {

        var defaults = {
                username: '',
                password: ''
            },
            plugin = this,
            options = options || {};


        plugin.init = function () {
            var settings = $.extend({}, defaults, options);
            $.data(document, 'appAlert', settings);
			
			if (!$('#app-alert').length) {
				plugin.create();
			}
		}
		
		plugin.create = function () {		
			var html = 
				'<div class="container" id="app-alert" style="visibility: hidden;">'
				'<div class="row">'
				'<div class="col-xs-12 col-lg-offset-8 col-lg-4" style="visibility: visible;">'
				'<div class="alert alert-success clearfix" role="alert" style="margin-bottom:0px;">'
				'<div class="glyphicon glyphicon-ok" style="float:left;width:9%;">&nbsp;</div>'
				'<div style="float:left;width:89%;" class="message"></div>'
				'</div>'
				'</div>'
				'</div>'
				'</div>';
			
			$('body').append(html);
        }

        plugin.init();

    }

    $.appAlert.init = function (callback) {
        console.log($.data(document, 'appAlert'));
        callback();
    }

}(jQuery));