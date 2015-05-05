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
			var css =
				'<style>'+
				'#app-alert {'+
				'position: fixed;'+
			    'top: 25px;'+
				'right: 0;'+
			    'left: 0;'+
				'z-index: 9999;}'+
				'#app-alert .alert {'+
				'box-shadow: 0px 2px 10px rgba(50, 50, 50, 0.5);}'+
				'</style>';
			
			var html = 
				'<div class="container" id="app-alert" style="visibility: hidden;">'+
				'<div class="row">'+
				'<div class="col-xs-12 col-lg-offset-8 col-lg-4" style="visibility: visible;">'+
				'<div class="alert alert-success clearfix" role="alert" style="margin-bottom:0px;">'+
				'<div class="glyphicon glyphicon-ok" style="float:left;width:9%;">&nbsp;</div>'+
				'<div style="float:left;width:89%;" class="message"></div>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>';
			
			$('head').append(css);
			$('body').append(html);
        }

        plugin.init();

    }

    $.appAlert.init = function (callback) {
        console.log($.data(document, 'appAlert'));
        callback();
    }

}(jQuery));