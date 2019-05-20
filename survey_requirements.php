<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><%= title %></title>
	<script src="/javascripts/jquery-2.1.3.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="/stylesheets/survey_requirements.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
	<script>
	</script>
</head>
<body>
	<div class="wrapper">
		<h1 style="color:white;">相手に求める情報を入力してください。</h1>
		<form id="survey_form" action="/survey_requirements" method="POST">			
			<div class="survey-wrapper">
				<div class="survey-title">
					一日平均プレイ時間
				</div>
				<div class="survey-content">
					<select name="playing_hour_per_day" class="survey-select">
						<option value=null>気にしない</option>
						<%
						var i=0;
						for(i=1;i<=12;i++){%>
							<option value="<%= i %>"><%=i+"時間未満" %></option>
						<%
						}
						%>
						<option value="above_30">12時間以上</option>
					</select>
				</div>
			</div>
			<div class="survey-wrapper">
				<div class="survey-title">
					ゲーム歴
				</div>
				<div class="survey-content">
					<select name="game_history" class="survey-select">
						<option value=null>気にしない</option>
						<%
						for(i=1;i<=10;i++){
						%>
							<option value="<%= i %>"><%=i+"年未満" %></option>
						<%
						}
						%>
						<option value="above_30">10年以上</option>
					</select>
				</div>
			</div>
			<div class="survey-wrapper">
				<div class="survey-title">
					プレイスタイル
				</div>
				<div class="survey-content">
					<span style="float:left;">エンジョイ</span>
					<input type="range" name="playing_policy" value="3" min="1" max="5" step="1" style="width:200px;margin-top:40px;float:left;">
					<span style="float:left;">ガチ</span>
				</div>
			</div>
			<div class="survey-wrapper">
				<div class="survey-title">
					月の平均課金額
				</div>
				<div class="survey-content">
					<select name="charging_amounts_per_months" class="survey-select">
						<option value=null>気にしない</option>
						<option value="0">無課金</option>
						<%
						for(i=1;i<=10;i++){
						%>
							<option value="<%= i %>"><%=i+"万円未満" %></option>
						<%
						}
						%>
						<option value="11">10万円以上</option>
					</select>
				</div>
			</div>
			<div class="survey-wrapper">
				<div class="survey-title">
					年齢
				</div>
				<div class="survey-content">
					<select name="age" class="survey-select">
						<option value=null>気にしない<op/tion>
						<%
						for(i=1;i<=6;i++){
						%>
							<option value="<%= i %>"><%=(i*10)+"歳未満" %></option>
						<%
						}
						%>
						<option value="7">60歳以上</option>
						<!--　気にしないを150　-->
					</select>
				</div>
			</div>
			<div class="survey-wrapper">
				<div class="survey-title">
					性別
				</div>
				<div class="survey-content">
					<select name="gender" class="survey-select">
						<option value=null>気にしない</option>
						<option value="1">男</option>
						<option value="2">女</option>
					</select>
				</div>
			</div>
		</form>
		<button id="sub" value='change' style="border:none;border-radius:10px;width:300px;background:white;">送信</button>
	</div>
		<div class="modal">
	</div>
	<div class="modal-content">
		<p class="modal-title ">この内容で送信してもよろしいですか?</p>
		<button id="modal-cancel">キャンセル</button>
		<button type="submit"  id="modal-submit">送信</button>
	</div>
	<script>
		$('#sub').on('click',function(){
			$('.modal').stop(true, true).fadeIn('500');
			$('.modal-content').show().stop(true, true).animate({
				top: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);
		});		
		$('.modal').on('click',function(){
			$('.modal').stop(true, true).fadeOut('500');
			$('.modal-content').stop(true, true).animate({
				top: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content').hide();
			});
		});	
		$('#modal-cancel').on('click',function(){
			$('.modal').stop(true, true).fadeOut('500');
			$('.modal-content').stop(true, true).animate({
				top: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content').hide();
			});
		});	
		$('#modal-submit').on('click',function(){
			$('.modal').stop(true, true).fadeOut('500');
			$('.modal-content').stop(true, true).animate({
				top: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content').hide();
				$('#survey_form').submit();
			});
		});
	</script>
</body>
</html>
