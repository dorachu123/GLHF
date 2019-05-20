<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><%= otheruser.nick_name %></title>
	<script src="/javascripts/jquery-2.1.3.js"></script>
	<!--Pagination-->
	<script src="/javascripts/jquery.simplePagination.js"></script>
	<script src="/socket.io/socket.io.js"></script>
	<script src="/javascripts/drawer.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
	<link rel="stylesheet" href="/stylesheets/vhs.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!--<script src="JS/textForm.js"></script>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
	<link rel="stylesheet" href="/stylesheets/drawer.css">
	<link rel="stylesheet" href="/stylesheets/default.css">
	<link rel="stylesheet" href="/stylesheets/fonts.css">
	<link rel="stylesheet" href="/stylesheets/otheruserInformation.css">
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
					<img src="../images/user.jpg"></img>
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
		<div class="contents" id="userInformation">
				<div class="wrapper">
					<div id="imageArea">
						<img src="../images/title.jpg" id="image"></img>
					</div>
					<div id="details">
						<%
						var gender="";
						switch(otheruser.gender){
							case 1:gender="男";break;
							case 2:gender="女";break;
						}
						%>
						<p  id="nickname" class="nickname"><%= otheruser.nick_name %></p>
						
						<p id="userId"><span>user_id:</span><%= otheruser.user_id %></p>
						<p class="disclose-information" id="age"><span>age:</span><%= otheruser.age %><%if(otheruser.age==null){%>非公開<%}%></p>
						<p class="disclose-information" id="birthday"><span>birthday:</span><%= otheruser.birth_on %><%if(otheruser.birth_on==null){%>非公開<%}%></p>
						<p class="disclose-information" id="gender"><span>gender:</span><%= gender %><%if(otheruser.gender==null){%>非公開<%}%></p>
					</div>
				</div>
				<div class="wrapper">
					<div class="introduction" >
						<p id="introduction"><%= otheruser.self_introduction %></p>
					</div>
				</div>
				<div class="button-wrapper">
					<button id="follow_button">Follow</button>
					<button id="remove_button">Follow解除</button>
					<a href="/message"><button id="match_button">メッセージに移動</button></a>
				</div>
		</div>
	</div>
	<script>
	</script>
  </main>
  
  <!-- ドロワーメニューの利用宣言 -->
	<script>
	$(document).ready(function() {
		$('.drawer').drawer();
	});
	var check = '<%= check %>';
	var check2 = '<%= check2 %>';
	console.log(check2);
	if(check != 0){
		$('#follow_button').css('display','none');
		$('#match_button').css('display','none');
	}else if(check2 != 0){
		$('#remove_button').css('display','none');
		$('#follow_button').css('display','none');
	}else{
		$('#match_button').css('display','none');
		$('#remove_button').css('display','none');
	}
	var socket = io.connect(); // ソケットへの接続
	$('#follow_button').on('click',function(){
		socket.emit("follow", {sender : '<%= user.user_id %>', receiver : '<%= otheruser.user_id %>'});
		$('#follow_button').css('display','none');
		$('#remove_button').stop(true, true).fadeIn('500');
	});	
	$('#remove_button').on('click',function(){
		socket.emit("remove", {sender : '<%= user.user_id %>', receiver : '<%= otheruser.user_id %>'});
		$('#remove_button').css('display','none');
		$('#follow_button').stop(true, true).fadeIn('500');
	});
	</script>
</body>
<body>

</body>
</html>
