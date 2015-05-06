(function ($) {
	
    $.appAjax = function (url) {

        var defaults = {},
            plugin = this,
            options = {}; //options || {};


        plugin.init = function (url) {
            var settings = $.extend({}, defaults, options);
            $.data(document, 'appAjax', settings);
			
			plugin.doAjax(url);
		}
		
		plugin.doAjax = function (url) {
			console.log("plugin.ajax");
			$.ajax({
				'dataType':'json',
				'type':'GET',
				'url':url,
				'success':function(json) {
					if(json.error == 10) {
						location.reload();
					}
					
					alert(json);
				},
				'error': function(xhr, status, error) {
					var err = eval("(" + xhr.responseText + ")");
					console.log(err.Message);
		            	
					$.appAlert("error", err.Message);
				}
			});
        }

        plugin.init(url);

    }

    $.appAjax.init = function (callback) {
        console.log($.data(document, 'appAjax'));
        callback();
    }

}(jQuery));