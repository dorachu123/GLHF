$(function(){
	var determine1 = false;
	var determine2 = false;
	var determine3 = false;
	var determine4 = false;
	var determine5 = false;
	var determine6 = false;
	var determine7 = false;
	//user_idのチェック
	$("#user_id").on("input", function() {
		var str=$(this).val();
		$('.user_id.check').hide().empty();
		if($(this).val() == ""){
			$('.user_id.check').fadeIn("fast").append("必須項目です<br>");
			$('.user_id.check').addClass('error');
			$('#user_id').css('background', '#ffb3b3');
			determine1= false;
		}else if(str.length <= 5) {
			$('.user_id.check').fadeIn("fast").append("文字数が足りません<br>");
			$('.user_id.check').addClass('error');
			$('#user_id').css('background', '#ffb3b3');
			determine1= false;
		}else if(str.length >= 24){
			$('.user_id.check').fadeIn("fast").append("文字数が多いです<br>");
			$('.user_id.check').addClass('error');
			$('#user_id').css('background', '#ffb3b3');
			determine1= false;
		}else if(!str.match(/^[A-Za-z0-9]+$/)){
			$('.user_id.check').fadeIn("fast").append("英数字を入力してください<br>");
			$('.user_id.check').addClass('error');
			$('#user_id').css('background', '#ffb3b3');
			determine1= false;
		}else{

			$.get("/check",{'userId' : $(this).val()},function(data){

				if(data){
					$('.user_id.check').empty();
					$('.user_id.check').fadeIn("fast").append("すでに存在しています");
					$('.user_id.check').addClass('error');
					$('#user_id').css('background', '#ffb3b3');
					determine1= false ;
				}else{
					console.log("www");
					$('.user_id.check').hide().empty();
					$('#user_id').css('background', '#ffffff');
					determine1= true ;
				}
			});
		};

	});

	//user_nameのチェック
	$("#user_name").on("input", function() {
		$('.user_name.check').hide().empty();
		if($(this).val() == ""){
			$('.user_name.check').fadeIn("fast").append("必須項目です<br>");
			$('.user_name.check').addClass('error');
			$('#user_name').css('background', '#ffb3b3');
			determine7= false;
		}else if ($(this).val().length < 2) {
			$('.user_name.check').fadeIn("fast").append("文字数が足りません<br>");
			$('.user_name.check').addClass('error');
			$('#user_name').css('background', '#ffb3b3');
			determine7= false;
		}else if($(this).val().length > 24){
			$('.user_name.check').fadeIn("fast").append("文字数が多いです<br>");
			$('.user_name.check').addClass('error');
			$('#user_name').css('background', '#ffb3b3');
			determine7= false;
		}else{
			$('.user_name.check').hide().empty();
			$('#user_name').css('background', 'white');
			determine7= true ;
		}
	});

	//passwordのチェック
	$("#password").on("input", function() {
		var str=$(this).val();
		$('.password.check').hide().empty();
		if($(this).val() == ""){
			$('.password.check').fadeIn("fast").append("必須項目です<br>");
			$('.password.check').addClass('error');
			$('#password').css('background', '#ffb3b3');
			determine2= false ;
		}else if ($(this).val().length <= 5) {
			$('.password.check').fadeIn("fast").append("文字数が足りません<br>");
			$('.password.check').addClass('error');
			$('#password').css('background', '#ffb3b3');
			determine2= false ;
		}else if($(this).val().length >= 255 ){
			$('.password.check').fadeIn("fast").append("文字数が多いです<br>");
			$('.password.check').addClass('error');
			$('#password').css('background', '#ffb3b3');
			determine2= false ;
		}else if(!str.match(/^[A-Za-z0-9]+$/)){
			$('.password.check').fadeIn("fast").append("英数字を入力してください<br>");
			$('.password.check').addClass('error');
			$('#password').css('background', '#ffb3b3');
			determine2= false;
		}else{
			$('.password.check').hide().empty();
			$('#password').css('background', 'white');
			determine2= true ;
		}
	});
	$("#year").change(function() {
		$('.birthOn.check').hide().empty();
		if($(this).val() == ""){
			$('.birthOn.check').fadeIn("fast").append("必須項目です<br>");
			$('.birthOn.check').addClass('error');
			$('.birth').css('background', '#ffb3b3');
			determine3= false ;
		}else{
			$('.biethOn.check').hide().empty();
			$('.birth').css('background', 'white');
			determine3= true ;
		}

	});
	$("#month").change(function() {
		$('.birthOn.check').hide().empty();
		if($(this).val() == ""){
			$('.birthOn.check').fadeIn("fast").append("必須項目です<br>");
			$('.birthOn.check').addClass('error');
			$('.birth').css('background', '#ffb3b3');
			determine4= false ;
		}else{
			$('.biethOn.check').hide().empty();
			$('.birth').css('background', 'white');
			determine4= true ;
		}

	});
	$("#day").change(function() {
		$('.birthOn.check').hide().empty();
		if($(this).val() == ""){
			$('.birthOn.check').fadeIn("fast").append("必須項目です<br>");
			$('.birthOn.check').addClass('error');
			$('.birth').css('background', '#ffb3b3');
			determine5= false ;
		}else{
			$('.biethOn.check').hide().empty();
			$('.birth').css('background', 'white');
			determine5= true ;
		}

	});
	$("#sex").change(function() {
		$('.birthOn.check').hide().empty();
		if($(this).val() == ""){
			$('.sex.check').fadeIn("fast").append("必須項目です<br>");
			$('.sex.check').addClass('error');
			$('#sex').css('background', '#ffb3b3');
			determine6= false ;
		}else{
			$('.sex.check').hide().empty();
			$('#sex').css('background', 'white');
			determine6= true ;
		}

	});



	$("#loginForm").on("submit", function () {
		console.log("1:"+determine1);
		console.log("2:"+determine2);
		console.log("3:"+determine3);
		console.log("4:"+determine4);
		console.log("5:"+determine5);
		console.log("6:"+determine6);
		console.log("7:"+determine7);
		if(determine1==false || determine2==false || determine3==false || determine4==false || determine5==false || determine6==false || determine7==false){
			return false;
		}
	});
});
