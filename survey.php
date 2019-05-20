<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><%= title %></title>
	<script src="/javascripts/jquery-2.1.3.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="/stylesheets/survey.css">
	<link rel="stylesheet" href="/stylesheets/grid.css">
	<link rel="stylesheet" href="/stylesheets/fonts.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
	<script>
	</script>
</head>
<body>
	<div class="wrapper">
		<h1 style="color:white;">自分の情報を入力してください。</h1>
		<form id="survey_form" action="/survey" method="POST">			
			<div class="survey-wrapper">
				<div class="survey-title">
					一日平均プレイ時間
				</div>
				<div class="survey-content">
					<select name="playing_hour_per_day" class="survey-select">
						<option value="1">約1時間未満</option>
						<%
						var i=0;
						for(i=2;i<=12;i++){%>
							<option value="<%= i %>"><%=i+"時間未満" %></option>
						<%
						}
						%>
						<option value="13">12時間以上</option>
					</select>
				</div>
			</div>
			<div class="survey-wrapper">
				<div class="survey-title">
					ゲーム歴
				</div>
				<div class="survey-content">
					<select name="game_history" class="survey-select">
						<option value="1">１年未満</option>
						<%
						for(i=2;i<=10;i++){
						%>
							<option value="<%= i %>"><%= i+"年未満" %></option>
						<%
						}
						%>
						<option value="11">10年以上</option>
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
						<option value="0">無課金</option>
						<%
						for(i=1;i<=10;i++){
						%>
							<option value="<%= i+1 %>"><%=i+"万円未満" %></option>
						<%
						}
						%>
						<option value="11">10万円以上</option>
					</select>
				</div>
			</div>
			<div>
				<table class="timesheet-grid" border="1" width="900px">
					<tr height="25px">
						<th width="25px"> </th>
						<th class="week" width="25px">月</th>
						<th class="week" width="25px">火</th>
						<th class="week" width="25px">水</th>
						<th class="week" width="25px">木</th>
						<th class="week" width="25px">金</th>
						<th class="week" width="25px">土</th>
						<th class="week" width="25px">日/祝</th>
					</tr>
					<%
					for(var i=0;i<=23;i++){
					%>
					<tr height="25px" align="center">
						<td><%= i+1 %></td>
						<td class="timesheet Mon" data-checked=false data-calnum="<%= Math.pow(2, i) %>"></td>
						<td class="timesheet Tue" data-checked=false data-calnum="<%= Math.pow(2, i) %>"></td>
						<td class="timesheet Wed" data-checked=false data-calnum="<%= Math.pow(2, i) %>"></td>
						<td class="timesheet Thu" data-checked=false data-calnum="<%= Math.pow(2, i) %>"></td>
						<td class="timesheet Fri" data-checked=false data-calnum="<%= Math.pow(2, i) %>"></td>
						<td class="timesheet Sat" data-checked=false data-calnum="<%= Math.pow(2, i) %>"></td>
						<td class="timesheet Sun" data-checked=false data-calnum="<%= Math.pow(2, i) %>"></td>
					</tr>
					<%
					}
					%>
				</table>
			</div>
			<input type="hidden" name="Mon" id="Mon" value="">
			<input type="hidden" name="Tue" id="Tue" value="">
			<input type="hidden" name="Wed" id="Wed" value="">
			<input type="hidden" name="Thu" id="Thu" value="">
			<input type="hidden" name="Fri" id="Fri" value="">
			<input type="hidden" name="Sat" id="Sat" value="">
			<input type="hidden" name="Sun" id="Sun" value="">
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
		var mouseStatus=false;
		var controlStatus=false;
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
		$(document).on('mousedown', '.timesheet', function() {
			mouseStatus=true;
			var check = $(this).data('checked');
			if(check== true){
				$(this).css('background', 'white');
				$(this).data('checked',false);
			}else{
				$(this).css('background', 'black');
				$(this).data('checked',true);
			}
		});
		
		$(document).on('keydown', '.timesheet', function(e) {
		 console.log(e.keyCode);
			if(e.keyCode==17){
				var check = $(this).data('checked');
				if(check== true){
					$(this).css('background', 'white');
					$(this).data('checked',false);
				}else{
					$(this).css('background', 'black');
					$(this).data('checked',true);
				}
			}
		});
		
		window.onmouseup = checkMouseUp;
		function checkMouseUp(){
			mouseStatus=false;
		};		
		window.onclick = checkMouseUp;

		window.onmousedown = checkMouseDown;
		function checkMouseDown(){
			mouseStatus=true;
		};

		$(document).on('mouseenter', '.timesheet', function() {
			if(controlStatus==true && mouseStatus==true){
				var check = $(this).data('checked');
				if(check== true){
					$(this).css('background', 'white');
					$(this).data('checked',false);
				}else{
					$(this).css('background', 'black');
					$(this).data('checked',true);
				}
			}
		});

		$(document).on('click', '#sub', function() {
			var Mon=0;
			var Tue=0;
			var Wed=0;
			var Thu=0;
			var Fri=0;
			var Sat=0;
			var Sun=0;
			$(".Mon").each(function(i) {
				if($(this).data('checked') == true){
					Mon = Mon + Number($(this).attr("data-calnum"));
				}
			});
			$(".Tue").each(function(i) {
				if($(this).data('checked') == true){
					Tue = Tue + Number($(this).attr("data-calnum"));
				}
			});
			$(".Wed").each(function(i) {
				if($(this).data('checked') == true){
					Wed = Wed + Number($(this).attr("data-calnum"));
				}
			});
			$(".Thu").each(function(i) {
				if($(this).data('checked') == true){
					Thu = Thu + Number($(this).attr("data-calnum"));
				}
			});
			$(".Fri").each(function(i) {
				if($(this).data('checked') == true){
					Fri = Fri + Number($(this).attr("data-calnum"));
				}
			});
			$(".Sat").each(function(i) {
				if($(this).data('checked') == true){
					Sat = Sat + Number($(this).attr("data-calnum"));
				}
			});
			$(".Sun").each(function(i) {
				if($(this).data('checked') == true){
					Sun = Sun + Number($(this).attr("data-calnum"));
				}
			});
			$('#Mon').val(Mon);
			$('#Tue').val(Tue);
			$('#Wed').val(Wed);
			$('#Thu').val(Thu);
			$('#Fri').val(Fri);
			$('#Sat').val(Sat);
			$('#Sun').val(Sun);
			console.log($('#Mon').val());
			console.log($('#Tue').val());
			console.log($('#Wed').val());
			console.log($('#Thu').val());
			console.log($('#Fri').val());
			console.log($('#Sat').val());
			console.log($('#Sun').val());
		});
		/*window.document.onkeydown = checkCTRLKey;
		function checkCTRLKey(){
			if (event.ctrlKey) console.log("Controlキーが押されました");
			if (event.button == 0) console.log("Controlキーが押されました");

		};	
		*/
		window.document.addEventListener('keydown',function(){
			if (event.ctrlKey) //console.log("Controlキーが押されました???");
			//console.log(event.keyCode);
			controlStatus=true;
		});
		window.document.addEventListener('keyup',function(){
			//console.log(event.keyCode);
			if (event.keyCode==17) //console.log("Controlキーが押さ");
			controlStatus=false;
		});

	</script>
</body>
</html>
