// Global Namespace
window.CORE = (window.CORE || {});

(function(window, document, $, undefined){

	this.settings = {
		"prefix" : ""
	};

	this.base_url = function(uri){
        return this.settings.base_url + this.settings.prefix + (uri || '');
    };

}).apply(window.CORE, [this, this.window, jQuery]);