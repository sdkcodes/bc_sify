
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/post.js') ?>"></script>
<script src="<?php echo base_url('assets/js/profile.js') ?>"></script>
<script src="<?php echo base_url('assets/js/authscript.js') ?>"></script>
<script>
	$(document).ready(function(){
		disablePostSubmitButton();
		$("#post-body").on("keyup", function(e){
			if ($(this).val().length > 0){
				enablePostSubmitButton();
			}
			else{
				disablePostSubmitButton();
			}
		});
	});
	function disablePostSubmitButton(){
		$("#submit-post-button").attr("disabled", true);
		$("#settargets").attr("disabled", true);
	}

	function enablePostSubmitButton(){
		$("#submit-post-button").attr("disabled", false);
		$("#settargets").attr("disabled", false);
	}
	$("#settings").on("click", function(event){
		var url = site_url+'/user/settings';
		$.get(url, function(data){
			$(".main").html(data);
		});
	});
	// $("#editprofile").on("click", function(event){
	// 	var url = site_url+'/user/editprofile';
	// 	$("body").css("opacity", "0.5");
	// 	$.get(url, function(data){
	// 		$(".post-area").html(data);
	// 		$("body").css("opacity", 1);
	// 	});
	// });
	$("#home").on("click", function(event){
		loadPosts();
	});
	$("#settargets").click(function(){
		var interests = [];
		var gender = [];
		var age_brackets = [];
		var post_content = $("#post-body").val();
		// var countries = [];
		var country;
		var states = [];
		
		$(".gender").on("change", function(e){
			if ($(this).is(":checked")){
				if (gender.indexOf($(this).val()) === -1){
					gender.push($(this).val());
				}
			}
			else{
				gender.splice(gender.indexOf($(this).val()), 1);
			}
			getTargetUsers(postData);
		});
		$("#countries-select").on("change", function(e){
			// if ($(this).is(":checked")){
				// if (countries.indexOf($(this).val()) === -1){
				// 	countries.push($(this).val());
				// }
			// }
			// else{
			// 	countries.splice(countries.indexOf($(this).val()), 1);
			// }
			country = $(this).val();
			postData.country = country;
			
			getTargetUsers(postData);
		});
		$("#states-select").on("change", function(e){
			// if ($(this).is(":checked")){
				if (states.indexOf($(this).val()) === -1){
					states.push($(this).val());
				}
			
			// }
			// else{
			// 	states.splice(states.indexOf($(this).val()), 1);
			// }
			getTargetUsers(postData);
		});
		$(".interests_box").on("change", function(e){
				
			if ($(this).is(":checked")){
				if (interests.indexOf($(this).val()) === -1){
					interests.push($(this).val());
				}

			}
			else{
				
				interests.splice(interests.indexOf($(this).val()), 1);
			}
			
			getTargetUsers(postData);

		});
		var postData = {interests:interests, gender:gender, age_brackets:age_brackets, body:post_content, country:country, state:states};
		$("#submit-post-button").on("click", function(){
			doPostSubmit(postData);
		})
		
	});

	function getTargetUsers(postData){
		var url = site_url+'/user/gettargetusers';
		
		
			$.post(url, postData, function(data){
				data = JSON.parse(data);
				console.log(data);

			$(".users-count-area").html("You can reach: " + data.users_count + " users");
		});
		
	}
	function doPostSubmit(postData){
		var url = site_url+'/post/newPost';
		$.post(url, postData, function (data){
			console.log(data);
			$("#post-body").val('');

		});
	}
	// function submitPost(){
	// 	$("#submit-post-button").on("click", function(){
			
	// 		var post_content = $("#post-body").val();
	// 		var url = site_url+'/post/newPost';
	// 		$.post(url, {body:post_content}, function (data){
				
	// 			$("#post-body").val('');

	// 		});
	// 	});
	// }

</script>

</body>
</html>