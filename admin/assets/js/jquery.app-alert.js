(function ($) {
	
    $.appAlert = function (type, message) {
		
        var defaults = {},
            plugin = this,
            options = {}; //options || {};
			
        plugin.init = function (type, message) {
            var settings = $.extend({}, defaults, options);
            $.data(document, 'appAlert', settings);
			
			if (!$('#app-alert').length) {
				plugin.create();
			}
			
			switch (type) {
				case "success":
					plugin.success(message);
					break;
				case "warning":
					plugin.warning(message);
					break;
				case "error":
					plugin.error(message);
					break;
				default:
					plugin.info(message);
			}
		}
		
		plugin.create = function () {
			var css =
				'<style>'+
				'#app-alert {position: fixed;top: 25px;right: 0;left: 0;z-index: 9999;}'+
				'#app-alert .alert {box-shadow: 0px 2px 10px rgba(50, 50, 50, 0.5);}'+
				'</style>';
			
			var html = 
				'<div class="container" id="app-alert" style="visibility: hidden;">'+
				'<div class="row">'+
				'<div class="col-xs-12 col-lg-offset-8 col-lg-4" style="visibility: visible;">'+
				'<div id="app-alert-container" role="alert" style="margin-bottom:0px;">'+
				'<div id="app-alert-icon" style="float:left;width:9%;">&nbsp;</div>'+
				'<div id="app-alert-msg" style="float:left;width:89%;"></div>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>';
			
			$('head').append(css);
			$('body').append(html);
			
			$('html').click(function(e) {
				$('#app-alert').hide();
			});
        }
		
		plugin.success = function(message) {
			$('#app-alert-container').attr('class', 'alert alert-success clearfix');
			$('#app-alert-icon').attr('class', 'glyphicon glyphicon-ok');
			$('#app-alert-msg').html(message);
			
			$('#app-alert').effect('pulsate', {}, 800);
		}
		
		plugin.warning = function(message) {
			$('#app-alert-container').attr('class', 'alert alert-warning clearfix');
			$('#app-alert-icon').attr('class', 'glyphicon glyphicon-warning-sign');
			$('#app-alert-msg').html(message);
			
			$('#app-alert').effect('pulsate', {}, 800);
		}
		
		plugin.error = function(message) {
			$('#app-alert-container').attr('class', 'alert alert-danger clearfix');
			$('#app-alert-icon').attr('class', 'glyphicon glyphicon-remove');
			$('#app-alert-msg').html(message);
			
			$('#app-alert').effect('pulsate', {}, 800);
		}
		
		plugin.info = function(message) {
			$('#app-alert-container').attr('class', 'alert alert-info clearfix');
			$('#app-alert-icon').attr('class', 'glyphicon glyphicon-info-sign');
			$('#app-alert-msg').html(message);
			
			$('#app-alert').effect('pulsate', {}, 800);
		}

        plugin.init(type, message);

    }

    $.appAlert.init = function (callback) {
        console.log($.data(document, 'appAlert'));
        callback();
    }

}(jQuery));