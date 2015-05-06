(function ($) {
	
    $.appAjax = function (options) {

        var defaults = {
            },
            plugin = this,
            options = options || {};


        plugin.init = function () {
            var settings = $.extend({}, defaults, options);
            $.data(document, 'appAjax', settings);
			
			plugin.ajax();
		}
		
		plugin.ajax = function () {
			console.log("Doing ajax");
        }

        plugin.init();

    }

    $.appAjax.init = function (callback) {
        console.log($.data(document, 'appAjax'));
        callback();
    }

}(jQuery));