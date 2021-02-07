$(document).ready(function()
{
        $.validator.addMethod('alphanumericformat', function(value, element, param)
        {
            var _URL = window.URL;
            var  pattern=/^[A-z a-z 0-9.]+$/;
            var $el=$(element);
            return $el.val().match(pattern);          
        });
        
        $.validator.addMethod('passwordValidate', function(value, element, param)
        {
            var regex = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[_!@#$%^&*?]).{8,}$");
            var $el=$(element);
            return regex.test($el.val());          
        });
        
	$("#registerFrm").validate
	({
		rules: 
		{
			invensis_users_name: {
                            required: true,
                            alphanumericformat: true
                        },
                        invensis_users_email:
			{
				required: true,
				email: true
			},
			invensis_users_password:
			{
				required: true,
                                minlength: 8,
                                passwordValidate: true
			},
                        invensis_users_confirm_password:
                        {        
                            required: true,
                            equalTo: "#invensis_users_password"
                        },
                        customCheckRegister: {
                            required : true
                        }
		},
		messages: 
		{
                        invensis_users_name: {
                            required: "Please enter user name",
                            alphanumericformat: "Please enter user name in characters only and . is allowed"  
                        },
			invensis_users_email: 
			{
                            required: "Please enter valid user email",
                            email: "Please enter valid email"
				
			},
			invensis_users_password: 
			{
                            required: "Please enter password",
                            minlength: "Password should be minimum 8 characters long",
                            passwordValidate: "Password should have 1 capital, 1 lower, 1 numerical and 1 special character letter"
			},
                        invensis_users_confirm_password:
                        {
                            required: "Please enter confirm password",
                            equalTo: "Confirm password should be equal to password"
                        },
                        customCheckRegister : {
                            required: "Please check privacy policy"
                        }
		},
		errorElement: 'span',
		errorElementClass: 'pdt_error_class_validate',
		errorClass: 'pdt_error_class_validate',
		errorPlacement: function(error, element) {},
		highlight: function(element, errorClass, validClass) {
                        if(!$(element).is(":checkbox")) {
                            $(element).addClass(this.settings.errorElementClass).removeClass(errorClass);
                            $(element).parent().removeClass("is-valid");
                            $(element).parent().addClass("is-invalid");
                        }
                    
		},
		unhighlight: function(element, errorClass, validClass) {
                    if(!$(element).is(":checkbox")) {
                        $(element).addClass(this.settings.errorElementClass).removeClass(errorClass);
                        $(element).parent().removeClass("is-invalid");
                        $(element).parent().addClass("is-valid");
                    }
		},
//		onkeyup: false,
//		onclick: false,
//		onfocusout: false,
		errorPlacement: function (error, element) { if ( element.is(":checkbox") ) { error.insertAfter(".customCheckRegister"); } else {  error.insertAfter(element.parent()); } }
	});

	if(document.getElementById("alert")!=null)
	{
            setTimeout(function(){ $("#alert").fadeOut(); }, 3000);
	}	
	
});
	
$("#registerFrm").on("submit", function(e)
{
    //e.preventDefault();
        
    if(!$(".loginBtn").hasClass("disabled")) {

        if ($('#registerFrm').valid())
        {
            //$("#loginfrm").submit();
            $(".registerBtn").addClass("disabled");
            $(".registerBtn").attr("disabled", true);
            $(".registerBtn").show();
        }
    }
});
	
$(document).keyup(function(e)
{
	if (e.which == 13) 
	{
		$(".loginbtn").trigger("click");
	}
});