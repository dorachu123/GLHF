<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><%= title %></title>

	<link rel="stylesheet" href="/stylesheets/test.css">
	<link rel="stylesheet" href="/stylesheets/fonts.css">
</head>
<body>
	<script src="/javascripts/jquery-2.1.3.js"></script>
	

	<script>
	
	var mouseStatus=false;
	var controlStatus=false;
	
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
			console.log("downad");
		}
	});
	
	window.onmouseup = checkMouseUp;
	function checkMouseUp(){
		mouseStatus=false;
		console.log("UP");
	};		
	window.onclick = checkMouseUp;

	window.onmousedown = checkMouseDown;
	function checkMouseDown(){
		mouseStatus=true;
	};

	$(document).on('mouseenter', '.timesheet', function() {
		if(controlStatus==true){
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

		console.log(Mon);
		console.log(Tue);
		console.log(Wed);
		console.log(Thu);
		console.log(Fri);
		console.log(Sat);
		console.log(Sun);
	});
	/*window.document.onkeydown = checkCTRLKey;
	function checkCTRLKey(){
		if (event.ctrlKey) console.log("Controlキーが押されました");
		if (event.button == 0) console.log("Controlキーが押されました");

	};	
	*/
	window.document.addEventListener('keydown',function(){
		if (event.ctrlKey) console.log("Controlキーが押されました???");
		console.log(event.keyCode);
		controlStatus=true;
	});
	window.document.addEventListener('keyup',function(){
		console.log(event.keyCode);
		if (event.keyCode==17) console.log("Controlキーが押さ");
		controlStatus=false;
	});

	</script>
	
	
	<div style="margin-top:200px;">
		<table border="1" width="900px">
			<tr height="25px">
				<th width="25px"> </th>
				<th class="week" width="25px">月</th>
				<th class="week" width="25px">火</th>
				<th class="week" width="25px">水</th>
				<th class="week" width="25px">木</th>
				<th class="week" width="25px">金</th>
				<th class="week" width="25px">土</th>
				<th class="week" width="25px">日/祝</th>
				<th width="25px"> </th>
			</tr>
			<%
			var cnt=1;
			for(var i=0;i<=23;i++){
			%>
			<tr height="25px" align="center">
				<td></td>
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
	<button id="sub">GO</button>
</body>
</html>
