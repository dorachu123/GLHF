<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><%= title %></title>
	<script src="/javascripts/jquery-2.1.3.js"></script>
	<!--Pagination-->
	<script src="/javascripts/jquery.simplePagination.js"></script>
	<script src="/javascripts/drawer.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!--<script src="JS/textForm.js"></script>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
	<link rel="stylesheet" href="/stylesheets/drawer.css">
	<link rel="stylesheet" href="/stylesheets/default.css">
	<link rel="stylesheet" href="/stylesheets/myFavorite.css">
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
				<button type="button" id="favoritebtn" class="cButton">お気に入り</button>
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
		<div class="contents" id="myFavorite">

			<!--　見本　　-->
			<div class="fromYouUser">
				<div class="userInformation">
					<div class="userPhoto">
						<img src="images/title.jpg"></img>
					</div>
					<div class="userSammary">
						<p class="userActionTime" text-align="right">2018/10/02</p>
						<p class="userInfo">
							<a href="">grad</a>
						</p>
						<p class="userTweet">
							EG
						</p>
					</div>
				</div>
				<div class="buttonWrapper">
					<button type="button" class="fButton" >FollowBack</button>
				</div>
			</div>
			<div class="fromYouUser">
				<div class="userInformation">
					<div class="userPhoto">
						<img src="images/title.jpg"></img>
					</div>
					<div class="userSammary">
						<p class="userActionTime" text-align="right">2018/10/02</p>
						<p class="userInfo">
							<a href="">grad</a>
						</p>
						<p class="userTweet">
							EG
						</p>
					</div>
				</div>
				<div class="buttonWrapper">
					<button type="button" class="fButton" >FollowBack</button>
				</div>
			</div>
			<div class="fromYouUser">
				<div class="userInformation">
					<div class="userPhoto">
						<img src="images/title.jpg"></img>
					</div>
					<div class="userSammary">
						<p class="userActionTime" text-align="right">2018/10/02</p>
						<p class="userInfo">
							<a href="">grad</a>
						</p>
						<p class="userTweet">
							EG
						</p>
					</div>
				</div>
				<div class="buttonWrapper">
					<button type="button" class="fButton" >FollowBack</button>
				</div>
			</div>
			<!--　見本　-->
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
</html>
