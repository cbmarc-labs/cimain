(function ($) {

	$.appAjax = function (url, params) {
		
		$.ajax($.extend({}, {
			dataType:'json',
			type:'GET',
			url:url,
			success: function(json) {				
				// session expired
				if(json.error == 10) {
					location.reload();
				}
				
				if (typeof params.success == 'function') { 
					params.success(json);
				}
			},
			complete: function() {
			},
			error: function (xhr, textStatus, errorThrown) {
				errorMsg = url+': Not json response.';
				if(xhr.status==404) {
					errorMsg = url+': '+xhr.status+' '+xhr.statusText;
				}
				
				$.appAlert("error", errorMsg);
			}
		}, params));
		
		return this;
	};

}(jQuery));