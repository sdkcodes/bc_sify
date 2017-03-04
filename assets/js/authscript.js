$("#login-button").click(function(){
	var email = $("#login-email-input").val();
	var password = $("#login-password-input").val();
	var loginUrl = site_url+'/auth/doLogin';

	$.post(loginUrl, {email:email, password: password}, function(data){
		data = JSON.parse(data);
		console.log(data);
		if (data.status === "form_error"){
			$("#login-error-area").html("");
			$.each(data, function (key, value){
				if (value !== ""){
					console.log(value);
					//$("#error_area").html(value);
					$(value).appendTo($("#login-error-area"));
				}
			});
		}
		else{
			$("#login-error-area").html("");
		}
	});
});

$("#signup-button").click(function(){

	var email = $("#signup-email-input").val();
	var name = $("#signup-name-input").val();
	var phone = $("#signup-phone-input").val();
	var password = $("#signup-password-input").val();
	var signupUrl = site_url+'/auth/doSignup';

	$.post(signupUrl, {email:email, password: password, name:name, phone:phone}, function(data){
		data = JSON.parse(data);
		console.log(data);
		if (data.status === "form_error"){
			$("#signup-error-area").html("");
			$.each(data, function(key, value){
				if (value !== ""){
					console.log(value);
					$(value).appendTo($("#signup-error-area"));
				}
			});
		}
		else{
			$("#signup-error-area").html("");
		}
	});
});

$("#signup-email-input").keyup(function(){
	var email = $("#signup-email-input").val();
	var url = site_url+'/auth/checkEmail';
	if (email.length > 0){
		$.post(url, {email:email}, function(data){
			data = JSON.parse(data);
			
			$("#email-text-area").html("<span class='text-danger'>" + data.message + "</span>");
		});
	}
	
});

$("#no-account").click(function(){
	// $(".login-screen").css("visibility", "hidden");
	$(".login-screen").hide();
	$(".signup-screen").show();
	// $(".signup-screen").css("visibility", "visible");
});
$("#have-account").click(function(){
	// $(".login-screen").css("visibility", "hidden");
	$(".login-screen").show();
	$(".signup-screen").hide();
	// $(".signup-screen").css("visibility", "visible");
});

