$(document).ready(function(){

	/*  ------DETERMINE IF USER IS LOGGED IN------ */
	$.ajax({
		method : "POST",
		url : "http://theforge.me/friends4ever/includes/fetch/fetchAccountData.php",
		success : function(input){
			if (input == "FAILED"){
				$(".loader").hide();
				$("#login").show();
			}
			else {
				$("#login").hide();
				$(".loader").hide();
				$("#mainPage").show();
				appendHtmlData(input);
			}
		}
	})


	/*  ------LOGIN SUBMIT BUTTON------ */
	$("body").on("click", "#logSubmit", function(){
		$.ajax({
			method : "POST",
			url : "http://theforge.me/friends4ever/includes/login/login.php",
			data : { username: $("#username").val(), password : $("#password").val()},
			success : function(input){
				$.ajax({
					method : "POST",
					url : "http://theforge.me/friends4ever/includes/fetch/fetchAccountData.php",
					data : {input},
					success : function(input){
						if (input == "FAILED"){
							$(".loader").hide();
							$("#login").show();
						}
						else {
							$("#login").hide();
							$(".loader").hide();
							$("#mainPage").show();
							appendHtmlData(input);
						}
					}
				})
				console.log(input);
			}
		})

	})

	/*  -------APPEND THE DATA RESPONSE TO THE HOME PAGE------ */
	function appendHtmlData(input){
		//console.log(input);
		var htmlData = JSON.parse(input);
		for(i=0; htmlData.length - 1 > i; i++){
			 var thisDiv = "<div class='instaCont'> <img src='" + htmlData[0].pic_url +  "'> <p class='username'>" + htmlData[i].username + "</p> <p class='paidtill'>" + htmlData[i].paid_until + "</p> <button>Accept</button></div>";
			 $("#homeMain").append(thisDiv)
		}
		$("#homeMain").append(htmlData[htmlData.length - 1].slot);
		console.log(htmlData[htmlData.length - 1].slot)
	}

	/*  -------SIGN UP DROP DOWN------ */
	$("#signUp").click(function(){
		$( "#signUpInput" ).slideToggle( "slow", function() {

  		});
	})


	/*  -------ADD AN INSTAGRAM USER TO PAGE------ */
	$("body").on("click", ".slot", function(){
		window.location.replace("https://api.instagram.com/oauth/authorize/?client_id=e8930e161868409797f0b3f4b19665d2&redirect_uri=http://theforge.me/friends4ever/splash.html&response_type=code&scope=likes+public_content+follower_list+comments+relationships+likes");
	})

	
	/*  -------LOGOUT BUTTON------ */
	$("body").on("click", "#logout", function(){
		$.ajax({
			method : "POST",
			url : "http://theforge.me/friends4ever/includes/login/logout.php",
			success : function(){
				location.reload();
			}
		})
	})

	/*-----SIGN UP EMAIL VALIDATION------*/
	function validateEmail(email) {
    	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    	return re.test(email);
	}
	
	$( "#email" ).keyup(function() { validateReg() });
	$("#signPassword").keyup(function() {validateReg() });

	function validateReg(){
		console.log($("#signPassword").val().length)
		if (validateEmail($("#email").val()) == true && $("#signPassword").val().length > 7){
			$("#confirm").show();
			console.log(validateEmail($("#email").val()))
		}
		else {
			$("#confirm").hide();
		}
	}

	/*----SUBMIT SIGN UP DATA ------*/
	$("body").on("click", "#confirm", function(){
		$.ajax({
			method : "POST",
			url : "http://theforge.me/friends4ever/includes/post/signup.php",
			success : function(input){
				console.log($("#email").val());
				console.log($("#username").val());

				$.ajax({
					method : "POST",
					url : "http://theforge.me/friends4ever/includes/post/signup.php",
					data : {email  : $("#email").val(), password : $("#signPassword").val()},
					success : function(input){
						if(input == "FAILED"){

						}
						else{
							$("#login").hide();
							$(".loader").hide();
							$("#mainPage").show();
							appendHtmlData(input);
						}
					}
				})
			}
		})
	})

	/*-----DISPLAY REFERAL-----*/
	$("body").on("click", "#referalLink", function(){
		$.ajax({
			method : "POST",
			url : "http://theforge.me/friends4ever/includes/fetch/fetchReferal.php",
			success : function(input){
				var refData = JSON.parse(input);
				$("#theLink").text(refData.referal_link);
				if (refData.payout == null){
					var payout = 0;
				}
				else {
					var payout = refData.payout;
				}
				$("#referal").children("button").text("$ " + payout);
				console.log(input);
			}
		})
		$("#referal").show();
	})

	//--------------ACCEPT BUTTON HANDLING---------------
	$("body").on("click", ".instaCont > button:nth-child(4)", function(){
		$.ajax({
			method : "POST",
			url : "http://theforge.me:4000",
			data : {username : $(this).parent().children("p:first").text()},
			success : function(data, status, xhr){
				console.log(input);
			}
		})
		console.log($(this).parent().children("p:first").text());
	})
})