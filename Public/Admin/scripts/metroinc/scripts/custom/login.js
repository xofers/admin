var Login = function () {

	var handleLogin = function() {

		$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                username: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	                verify: {
	                    required: true
	                }
	            },

	            messages: {
	                username: {
	                    required: "<i class='fa fa-exclamation-triangle'></i> 用户名不能为空!"
	                },
	                password: {
	                    required: "<i class='fa fa-exclamation-triangle'></i> 密码不能为空!"
	                },
	                verify: {
	                	 required: "<i class='fa fa-exclamation-triangle'> 验证码不能为空!</i>"
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
//	                $('.alert-danger', $('.login-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	            	loginSubmit();
	            }
	        });

	        $('.login-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.login-form').validate().form()) {
	                	loginSubmit();
	                }else{
		                return false;
	                }
	            }
	        });
	        
	        function loginSubmit(){
	    		var self = $("form");
	    		$('.alert-danger', $('.login-form')).hide();
	    		$.post(self.attr("action"), self.serialize(), success, "json");
	    		return false;
	    		function success(data){
	    			if(data.status){
	    				window.location.href = data.url;
	    			} else {
	    				$('.alert-danger span').text(data.info);
	    				$('.alert-danger', $('.login-form')).show();
	    				//刷新验证码
	    				$(".reloadverify").click();
	    			}
	    		}
	        }
	}
	
    return {
        init: function () {
            handleLogin();
        }
    };
}();
