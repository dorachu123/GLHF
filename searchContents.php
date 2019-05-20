<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><%= title %></title>
	<script src="/javascripts/jquery-2.1.3.js"></script>
	<!--Pagination-->
	<script src="/socket.io/socket.io.js"></script>
	<script src="/javascripts/drawer.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!--<script src="JS/textForm.js"></script>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
	<link rel="stylesheet" href="/stylesheets/drawer.css">
	<link rel="stylesheet" href="/stylesheets/default.css">
	<link rel="stylesheet" href="/stylesheets/searchContents.css">
	<script>
    $(document).ready(function() {
		$('.drawer').drawer();
	});
	</script>
</head>
<body>
<div class="drawer drawer--left">
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
				<button type="button" id="searchbtn" class="cButton">相手を探す</button>
				<a href="/boards"><button type="button" id="boardbtn" class="cButton">掲示板</button></a>
			</div>
		</li>
        <li>
			<div id="good">
				<p>いいね</p>
				<a href="/fromYou"><button type="button" id="fromPersonbtn" class="cButton">相手からのいいね！</button></a>
				<a href="/fromMe"><button type="button" id="fromMebtn" class="cButton">自分からのいいね！</button></a>
				<a href="/Myfavorite"><button type="button" id="favoritebtn" class="cButton">お気に入り</button></a>
			</div>
		</li>
        <li>
			<div id="matching">
				<p>マッチング</p>
				<a href="/message"><button type="button" id="messagebtn" class="cButton">メッセージ</button></a>
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
		<div class="contents" id="searchContents">
	<!--		<div id="contentsSetting">
				<input id="searchArea"　name="searchArea" type="text">
				<button type="button" id="searchConditionsbtn" class="cButton" >検索条件</button>
			</div>
			<div id="contentsSetting2">
			</div>
	-->
			<div class="section" id="roadArea">
			</div>
		</div>
	</div>
  </main>
	<script>
		var socket = io.connect(); // ソケットへの接続
		socket.emit("recommend", {sender : '<%= user.user_id %>'});
		socket.on("server_to_client_recommend", function(data){
			appendLog("<div class='user'><a href='/otheruserInformation/"+ data.user_id +"' class='users-header-images'><img src='images/header.jpg'></img></a><a href='/otheruserInformation/"+ data.user_id +"' class='users-top-images'><img src='images/user.jpg'></img></a><div class='users-information'><div><a class='users-name'>"+ escapeHtml(data.nick_name) +"</a></div><span class='users-id'>"+ data.user_id +"</span><div class='users-self-introduction'><p>"+ data.self_introduction %> +"</p></div></div></div>");
		});
		socket.on("server_to_client_recommend_add", function(data){
			appendLog("<div class='user'><a href='/otheruserInformation/"+ data.user_id +"' class='users-header-images'><img src='images/header.jpg'></img></a><a href='/otheruserInformation/"+ data.user_id +"' class='users-top-images'><img src='images/user.jpg'></img></a><div class='users-information'><div><a class='users-name'>"+ escapeHtml(data.nick_name) +"</a></div><span class='users-id'>"+ data.user_id +"</span><div class='users-self-introduction'><p>"+ data.self_introduction %> +"</p></div></div></div>");
		});
		function appendLog(text) {		//addChatLogsに追加
			var speed = 0;
			$("#roadArea").append(text);
			$('#roadArea').animate({scrollTop: $('#roadArea')[0].scrollHeight},  speed, 'swing');
		}
		function escapeHtml(str){
		  str = str.replace(/&/g, '&amp;');
		  str = str.replace(/>/g, '&gt;');
		  str = str.replace(/</g, '&lt;');
		  str = str.replace(/"/g, '&quot;');
		  str = str.replace(/'/g, '&#x27;');
		  str = str.replace(/`/g, '&#x60;');
		  return str;
		}
		$(function () {

			var $parent = $(window);
			var $child = $(document);
			var timerID;

			$parent.bind('scroll', function () {
				if (timerID != null) {
					clearTimeout(timerID);
				}
				timerID = setTimeout(function () {
					var child_height = $child.height();
					var parent_scroll = ($parent.scrollTop() + $parent.height());

					if (child_height*0.95 <= parent_scroll) {
						reach_scroll_last();
					}
				}, 100);
			});
		});
		var countLog=1;
		var limit=0;
		function reach_scroll_last() {
			limit=countLog*12;
			console.log("リミット;"+(limit));
			console.log("最底辺！");
			countLog++;
			socket.emit("recommend_add", {value :limit});
		}
	</script>
</div>
</body>
</html>
