$(document).ready(function()
{
	$("#loginFrm").validate
	({
		rules: 
		{
			cashier_stripe_users_userid:
			{
				required: true,
				email: true
			},
			cashier_stripe_users_password:
			{
				required: true
			}
		},
		messages: 
		{
			cashier_stripe_users_userid: 
			{
                            required: "Please enter valid user id",
                            email: "Please enter valid email"
				
			},
			cashier_stripe_users_password: 
			{
                            required: "Please enter password",						
			}
		},
		errorElement: 'span',
		errorElementClass: 'pdt_error_class_validate',
		errorClass: 'pdt_error_class_validate',
		errorPlacement: function(error, element) {},
		highlight: function(element, errorClass, validClass) {
                    $(element).addClass(this.settings.errorElementClass).removeClass(errorClass);
                    $(element).parent().removeClass("is-valid");
                    $(element).parent().addClass("is-invalid");
		},
		unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass(this.settings.errorElementClass).removeClass(errorClass);
                    $(element).parent().removeClass("is-invalid");
                    $(element).parent().addClass("is-valid");
		},
//		onkeyup: false,
//		onclick: false,
//		onfocusout: false,
		errorPlacement: function (error, element) {  error.insertAfter(element.parent()); }
	});

	if(document.getElementById("alert")!=null)
	{
            setTimeout(function(){ $("#alert").fadeOut(); }, 3000);
	}	
	
});
	
$("#loginFrm").on("submit", function(e)
{
    //e.preventDefault();
        
    if(!$(".loginBtn").hasClass("disabled")) {

        if ($('#loginFrm').valid())
        {
            //$("#loginfrm").submit();
            $(".loginBtn").addClass("disabled");
            $(".loginBtn").attr("disabled", true);
            $(".loginBtn").show();
        }
    }
});
	
$(document).keyup(function(e)
{
	if (e.which == 13) 
	{
		$(".loginBtn").trigger("click");
	}
});