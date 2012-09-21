jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", "10px");
    this.css("left", Math.max(0, (($(window).width() - 
    	    this.outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}