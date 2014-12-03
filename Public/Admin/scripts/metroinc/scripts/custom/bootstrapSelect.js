var BootstrapSelect = function () {
	
    var handleBootstrapSelect = function() {
        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });
    }


    return {
        init: function () {            
            handleBootstrapSelect();
        }
    };

}();