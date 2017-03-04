$(document).on("click", "#update-profile-button", function(event){
	updateProfile();
});

function updateProfile(){
	
		var phone = $("#update-phone-input").val();
		var name = $("#update-name-input").val();
		var dob = $("#update-dob-input").val();
		var gender = $( "input[type=radio][name=gender]:checked" ).val();
		var country = $("#countries-select").val();
		var state = $("#states-select").val();
		var city = $("#cities-select").val();
		var postData = {phone:phone, name:name, dob:dob, gender:gender, country:country, state:state, city:city};
		var url = site_url+'/user/updateProfile';
		$.post(url, postData, function(data){
			console.log(data);
		})
		// console.log(postData);
	
}
//fetch states when country is changed
$("#countries-select").on("change", function(e){
	var country_id = $("#countries-select").val();
	var url = site_url+'/location/getStatesByCountry/'+country_id;
	var states_select = $("#states-select");
	states_select.html("");
	$.get(url, function(data){
		 data = JSON.parse(data);
		
		var states_dropdown = "<option value=''>State</option>";
		states_select.append(states_dropdown);
		for(i=0; i < data.length; i++){
			// console.log(data[i].name);
			states_select.append("<option value='"+data[i].id +"'>"+data[i].name+"</option>");
		}
	});
});
// fetch cities when state is changed
$(".form-group").on("change", "#states-select", function(e){
	var state_id = $("#states-select").val();
	var url = site_url+'/location/getCitiesByState/'+state_id;
	var cities_select = $("#cities-select");
	cities_select.html("");
	$.get(url, function(data){
		data = JSON.parse(data);
	
		cities_select.append("<option value=''>City</option>");
		for(i=0; i < data.length; i++){
			cities_select.append("<option value='"+data[i].id +"'>"+data[i].name+"</option>");
		}
	})
	
});

function uploadProfilePic(){
	var file_selector = $("#userfile");
	var fd = new FormData();
	fd.append('userfile', file_selector[0].files[0]);
	$.ajax({
		url: $("#pic-upload-form").attr("action"),
		data:fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(data){
			data = JSON.parse(data);
			$("#profile-pic-display").attr("src", base_url+'/uploads/profilepics/'+data.file_name);
			console.log(data.file_name);
		}
	});
}
$("#userfile").on("change", function(e){
	uploadProfilePic();	
})
