<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><%= title %></title>
	<script src="/javascripts/jquery-2.1.3.js"></script>
	<!--Pagination-->
	<script src="/socket.io/socket.io.js"></script>
	<script src="/javascripts/jquery.simplePagination.js"></script>
	<script src="/javascripts/drawer.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!--<script src="JS/textForm.js"></script>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
	<link rel="stylesheet" href="/stylesheets/drawer.css">
	<link rel="stylesheet" href="/stylesheets/default.css">
	<link rel="stylesheet" href="/stylesheets/fromMe.css">
	<script>
	$(function(){
		$(".pagination").pagination({
			items: 8,
			displayedPages: 3,
			cssStyle: 'light-theme',
			onPageClick: function(currentPageNumber){
				showPage(currentPageNumber);
			}
		})
	});

	function showPage(currentPageNumber){
		var page="#page-" + currentPageNumber;
		$('.selection').hide();
		$(page).show();
	}
		$(document).ready(function() {
			$('.drawer').drawer();
		});
	</script>
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
				<button type="button" id="fromMebtn" class="cButton">自分からのいいね！</button>
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
		<div class="contents" id="fromYou">
			<p class="main-title">Follow済み</p>
			<%
			var cnt=0;
			while(true){
				if(userList.length == cnt ){
					break;
				}
			%>
			<div class="fromYouUser" id="<%= userList[cnt].user_id %>">
				<div class="userInformation">
					<div class="userPhoto">
						<img src="images/title.jpg"></img>
					</div>
					<div class="userSammary">
						<p class="userActionTime" text-align="right">2018/10/02</p>
						<p class="userInfo">
							<a href=""><%= userList[cnt].nick_name %></a>
						</p>
						<p class="userTweet">
							<%= userList[cnt].introduction %>
						</p>
					</div>
				</div>
				<div class="buttonWrapper">
					<button type="button" class="rButton" data-user_id=<%= userList[cnt].user_id %>>Follow解除</button>
				</div>
			</div>
			<%
				cnt++;
			}
			if(userList.length == 0){
			%>
				<div class="empty-contents">
					<p class="empty-contents-title">誰もフォローしていません。</p>
				</div>
			<%}%>
		</div>
	</div>
  </main>
  <!-- ドロワーメニューの利用宣言 -->
	<script>
		var socket = io.connect(); // ソケットへの接続
		$('.rButton').on('click',function(){
			console.log($(this).data('user_id'));
			socket.emit("remove", {sender :'<%= user.user_id %>' , receiver :$(this).data('user_id') });
			$('#' + $(this).data('user_id')).fadeOut(100);
		});	
	</script>
</body>
</html>
