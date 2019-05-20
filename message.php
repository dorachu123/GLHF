<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><%= title %></title>
	<script src="/javascripts/jquery-2.1.3.js"></script>
	<script src="/socket.io/socket.io.js"></script>
	<script src="/javascripts/drawer.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
	<!--Pagination-->
	<script src="/javascripts/jquery.simplePagination.js"></script>
	<!--<script src="/javascripts/chat.js"></script>-->
	<link rel="stylesheet" href="/stylesheets/vhs.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!--<script src="JS/textForm.js"></script>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
	<link rel="stylesheet" href="/stylesheets/drawer.css">
	<link rel="stylesheet" href="/stylesheets/default.css">
	<link rel="stylesheet" href="/stylesheets/message.css">
	<link rel="stylesheet" href="/stylesheets/chat.css">
</head>
<body class="drawer drawer--left">
  <header role="banner">
    <!-- ハンバーガーボタン -->
    <button type="button" class="drawer-toggle drawer-hamburger">
      <span class="sr-only">toggle navigation</span>
      <span class="drawer-hamburger-icon"></span>
    </button>
    <!-- ナビゲーションの中身 -->
    <nav class="drawer-nav" role="navigation">
      <ul class="drawer-menu">
        <li>
			<a href="/userInformation" >
				<div id="userImage">
					<img src="images/user.jpg"></img>
				</div>
				<div id="loginUser">
					<span><%= user.nick_name %></span>
				</div>
			</a>
		</li>
        <li>
			<div id="search">
				<p>さがす</p>
				<a href="/searchContents"><button type="button" id="searchbtn" class="cButton">相手を探す</button></a>
				<a href="/boards"><button type="button" id="boardbtn" class="cButton">掲示板</button></a>
			</div>
		</li>
        <li>
			<div id="good">
				<p>いいね</p>
				<a href="/fromYou"><button type="button" id="fromPersonbtn" class="cButton">相手からのいいね！</button></a>
				<a href="/fromMe"><button type="button" id="fromMebtn" class="cButton">自分からのいいね！</button></a>
				<a href="/myFavorite"><button type="button" id="favoritebtn" class="cButton">お気に入り</button></a>
			</div>
		</li>
        <li>
			<div id="matching">
				<p>マッチング</p>
				<button type="button" id="messagebtn" class="cButton">メッセージ</button>
			</div>
		</li>
        <li>
			<div id="footprint">
				<p>足あと</p>
				<a href="/footPrint"><button type="button" id="footprintbtn" class="cButton" >足あと</button></a>
			</div>
		</li>
        <li>
			<div id="logout">
				<a href="/logout"><button type="button" id="logoutbtn">LOGOUT</button></a>
			</div>
		</li>
      </ul>
    </nav>
  </header>
  <main role="main">
	<div id="main">
		<div class="contents" id="message">
			<div id="chatAreaWrapper">
				<div id="chatLogs">
				</div>
				<form class="form-inline" name="chatMessage" id="new-message">
					<div class="form-group">
						<label class="fileSelect" for="calendar_image">
							<span id="smallRadius"><span id="plus"></span><span id="length"></span></span>
							<input type="file" name="fname" class="form-control" id="calendar_image" style="display:none;">
						</label>
						<textarea name="text" class="form-control" id="msgForm" placeholder="メッセージを送信"></textarea>
					</div>
				</form>











				<div id="chatArea" style="display:none;">
					<div class="fromYouChat">
						<img src="images/title.jpg" class="circleImage"></img>
						<p class="chat">さいしんめっせ
							<span class="chatDate">10/03/16:19</span>
						</p>
					</div>
					<div class="fromMeChat">
						<p class="chat">さいしんめっせ
							<span class="chatDate">10/03/16:19</span>
						</p>
					</div>
				</div>
				<div id="messageInputArea" style="display:none;">
					<form action="" id="new-message" name="NM">
						<textarea id="message-text" name="text" onKeyPress="enter();"></textarea>

					</form>
				</div>
			</div>
			<div id="chatMemberArea">
				<%
				for(var i=0;i<matchList.length;i++){
					%>
					<div class="chatMember" data-user_id="<%= matchList[i].user_id %>">
						<div class="chatMemberImage">
							<img src="images/title.jpg" class="circleImage"></img>
							<!--	<img src="images/title.jpg" class="circleImage"></img> -->
						</div>
						<div class="chatMemberInfo">
							<p class="chatName"><%= matchList[i].nick_name %></p>
							<p class="latestChat">さいしんめっせ</p>
							<p class="latestChatDate">10/03/16:19</p>
						</div>
					</div>
					<%
				}
				%>
			</div>
		</div>
	</div>
  </main>
  
  <!-- ドロワーメニューの利用宣言 -->
  <script>
    $(document).ready(function() {
		$('.drawer').drawer();
	});
  </script>
</body>
<script>
$(function(){
	var userid = '<%= user.user_id %>';
	var socket = io.connect(); // ソケットへの接続
	var chatData = [];
	var count=0;
	var $form = $("#new-message");
	var $ta = $("#msgForm");
	
	$('.chatMember').on('click',function(){
		$("#chatLogs").empty();
		console.log($(this).data('user_id') + 'が押された');
		socket.emit("client_to_server_join", { user_id:userid, matched_user_id:$(this).data('user_id')});
		// client_to_server_broadcastイベント・データを送信する
		//  socket.emit("client_to_server_broadcast", {value : entryMessage});
		// client_to_server_personalイベント・データを送信する
		socket.emit("client_to_server_personal", {value : userid});
	});
	
	$(document).on("keypress", "#msgForm", function(e) {
		if (e.keyCode == 13) { // Enterが押された
			if (e.shiftKey) { // Shiftキーも押された
				$.noop();
				console.log("Shiftキーも押された");
			}else{
				e.preventDefault();
				var message = $("#msgForm").val();
				console.log($("#msgForm").val());
				$("#msgForm").val('');
				// client_to_serverイベント・データを送信する
				var dt=new Date();
				var year=dt.getFullYear();
				var month=dt.getMonth()+1;
				var day=dt.getDate();
				var hour=dt.getHours();
				var minute=dt.getMinutes();
				var second=dt.getSeconds();
				console.log("day;"+day);
				var nowDay=year+"/"+month+"/"+day;
				var nowTime=hour+"時"+minute+"分"+second+"秒";
				if(message!=''){
					socket.emit("client_to_server", {msg : message, date : nowDay, time : nowTime });
				}
				e.preventDefault();
				console.log("Enterが押された");
			}
		} else {
			$.noop();
		}
	});
	var entryMessage = "さんが入室しました。";
	// server_to_clientイベント・データを受信する
	socket.on('server_to_client', function(data){
		chatData[count] =  "<div class='content'><p class='memberName'>"+ data.username +"</p><span class='memberChat'>" + data.username + "</span></div>";
		count++;
		var str=data.content;
		str=str.replace(/\r?\n/g, "<br>");	
		console.log(data.postImage);
		if(data.postImage === "" || data.postImage === null || data.postImage === undefined){
			appendMsg("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><div class='memberChatWrapper' ><span class='memberChat'>" + str + "</span></div></div>");
		}else{
			appendMsg("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><img class='memberImage' src='http://localhost/OurGroupware/images/"+ data.postImage +"'></div>");
		}
	});
	// server_to_client_logイベント・データを受信する
	socket.on("server_to_client_log", function(data){
		var str=data.content;
		str=str.replace(/\r?\n/g, "<br>");
		if(data.postImage === "" || data.postImage === null || data.postImage === undefined){
			prependLog("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><div class='memberChatWrapper' ><span class='memberChat'>" + str + "</span></div></div>");
		}else{
			prependLog("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><img class='memberImage' src='http://localhost/OurGroupware/images/"+ data.postImage +"'></div>");
		}
		//console.log(data.user_id);
	});
	// server_to_client_addイベント・データを受信する
	socket.on("server_to_client_add", function(data){
		var str=data.content;
		str=str.replace(/\r?\n/g, "<br>");
		if(data.postImage === "" || data.postImage === null || data.postImage === undefined){
			prependAdd("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><div class='memberChatWrapper' ><span class='memberChat'>" + str + "</span></div></div>");
		}else{
			prependAdd("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><img class='memberImage' src='http://localhost/OurGroupware/images/"+ data.postImage +"'></div>");
		}
		//console.log(data.user_id);
	});

	function appendMsg(text) {		//chatLogsに追加
		$("#chatLogs").append(text);
		$('#chatLogs').animate({scrollTop: $('#chatLogs')[0].scrollHeight}, 'fast');
	}
	function prependLog(text) {		//addChatLogsに追加
		var speed = 0;
		$("#chatLogs").prepend(text);
		$('#chatLogs').animate({scrollTop: $('#chatLogs')[0].scrollHeight},  speed, 'swing');
	}
	function prependAdd(text) {		//addChatLogsに追加
		$("#chatLogs").prepend(text);
		var speed = 0;
		var nowHeight=$('#chatLogs').get(0).scrollHeight;
		var minusHeight= nowHeight - beforeHeight;
		$('#chatLogs').animate({scrollTop:minusHeight}, speed, 'swing');
		gotRequestSuccessfully = true;
	}
	// データを受け取ったかどうか制御する変数
	var gotRequestSuccessfully = false;

	var beforeHeight;
	// 最上部にスクロールした時に発生するイベント
	$('#chatLogs').bind("scroll", function() {
		scrollHeight = $('#chatLogs').height();
		scrollPosition = $('#chatLogs').height() + $('#chatLogs').scrollTop();
		//console.log("ポシション:" + scrollPosition);
		//console.log("ポシション1:" + $('#chatLogs').height());
		//console.log("ポシション2:" + $('#chatLogs').scrollTop());
		//console.log("ポシション;"+(scrollHeight - scrollPosition) / scrollHeight);

		if ( (scrollHeight - scrollPosition) / scrollHeight >= 0) {
			//スクロールの位置が下部1%の範囲に来た場合
			// 元の高さ
		//	console.log("ポシションtest1:" + $('#chatLogs').get(0).scrollHeight);
			beforeHeight = $('#chatLogs').get(0).scrollHeight;
			// 表示されている高さ
		//	console.log("ポシションtest1:" + $('#chatLogs').get(0).offsetHeight);
			console.log('最上部');
			if(gotRequestSuccessfully == false){
				getData();    // データを取りに行く
			}
		} else {
			//それ以外のスクロールの位置の場合
			gotRequestSuccessfully = false;
		}
	});
	var countLog=1;
	var limit=0;
	function getData() {
		limit=countLog*10;
		console.log("リミット;"+(limit));
		socket.emit("client_to_server_addLog", {value :limit});
		countLog++;
	}
	$(document).ready(function(){
		$("#calendar_image").change(function(event){
			console.log("change??????????");
			var file = event.target.files[0];
			upload(file);//ファイルを送る関数

		});

	});
	function upload(file){

		var fileReader = new FileReader();
		var send_file = file;
		//var type = send_file.type;//♪L( ՞ਊ ՞)┘└( ՞ਊ ՞)」♪
		var data = {};
		var dt=new Date();
		var year=dt.getFullYear();
		var month=dt.getMonth()+1;
		var day=dt.getDate();
		var hour=dt.getHours();
		var minute=dt.getMinutes();
		var second=dt.getSeconds();
		var nowDay=year+"/"+month+"/"+day;
		var nowTime=hour+"時"+minute+"分";
		var imageName=checkImage();

		fileReader.readAsBinaryString(send_file);

		fileReader.onload = function(event) {

			data.file = event.target.result;
			data.name = imageName;
			console.log(imageName);
			//data.type = type;//♪L( ՞ਊ ՞)┘└( ՞ਊ ՞)」♪

			socket.emit('upload',data);
			socket.emit("client_to_server_image", {imageName : imageName, date : nowDay, time : nowTime});

		}

	}
	input_file.onchange = function (){
		// ファイルが選択されたか
		if(input_file.value){

			console.log("ファイルが選択された:" + input_file.value);
			var dt=new Date();
			var year=dt.getFullYear();
			var month=dt.getMonth()+1;
			var day=dt.getDate();
			var hour=dt.getHours();
			var minute=dt.getMinutes();
			var second=dt.getSeconds();
			var nowDay=year+"/"+month+"/"+day;
			var nowTime=hour+"時"+minute+"分";
			var imageName=checkImage();

			//socket.emit("client_to_server_image", {imageName : imageName, date : nowDay, time : nowTime});
		}else{
			console.log("ファイルが未選択");
		}

	};
	function checkImage(){
		var fileList = document.getElementById("calendar_image").files;
		var list = "";
		for(var i=0; i<fileList.length; i++){
			list += fileList[i].name ;
		}
		return list;
	}
});
</script>
</html>
