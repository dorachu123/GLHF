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
	<link rel="stylesheet" href="/stylesheets/board.css">
	<script>
	$(function(){
		$(".pagination").pagination({
			items: <%= Math.ceil(boardList.length/15) %>,
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
				<button type="button" id="boardbtn" class="cButton">掲示板</button>
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
		<div class="contents" id="board">
			<p class="main-title">掲示板</p>
			<div id="threadBoard">
				<%
				var pagecnt=1;
				var threadcnt=0;
				while(pagecnt<=(Math.ceil(boardList.length/15))){
					%>
					<div class="selection" id="page-<%= pagecnt%>">
						<%
						for(threadcnt;threadcnt<boardList.length;threadcnt++){
							if(threadcnt%14==0&&threadcnt!=0){
								break;
							}
							%><div><a href="/board/<%= boardList[threadcnt].board_id %>"><%= boardList[threadcnt].board_name %></a></div><%
						};
							threadcnt++;
							pagecnt++;
						%></div>
						<% } %>
						<div class="pagination-holder clearfix">
							<div id="light-pagination" class="pager"><ul class="pagination"></ul></div>
						</div>
					</div>
					<div id="threadForm">
						<form action="/boards" method="POST">
							<a name="new_thread"></a>
							<p style="margin: 0 0 0 2em; font-size: 0.75em;">
								<input name="submit" type="submit" value="新規スレッド作成"><br>
								スレッドタイトル：<input name="title" style="width: 24em;" type="text"　required><br>
								<textarea id="threadMessage" name="comment" rows="4" cols="12"></textarea>
							</p>
						</form>
					</div>
					
		</div>
	</div>
	<div class="modal">
	</div>
	<div class="modal-content">
		<h1>〇〇さんの評価をしてください。</h1>
		<img src="images/good.svg" id="thumbsdown" width="100px" height="100px">
		<img src="images/good.svg" id="thumbsup" width="100px" height="100px">
		<img src="images/kao.svg" id="kao" width="100px" height="100px">
		<div class="modal-surveys">
			<button type="button" class="survey" value="0"> 1
			<button type="button" class="survey" value="1"> 2
			<button type="button" class="survey" value="2"> 3
			<button type="button" class="survey" value="3"> 4
			<button type="button" class="survey" value="4"> 5
			<button type="button" class="survey" value="5"> 6
			<button type="button" class="survey" value="6"> 7
			<button type="button" class="survey" value="7"> 8
			<button type="button" class="survey" value="8"> 9
			<button type="button" class="survey" value="9"> 10
		</div>
	</div>
	<button type="button" id="mb" >modal</button>
	<script>
		$('#mb').on('click',function(){
			$('.modal').stop(true, true).fadeIn('500');
			$('.modal-content').show().stop(true, true).animate({
				top: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);
		});		
		$('.survey').on('click',function(){
			$('.modal').stop(true, true).fadeOut('500');
			$('.modal-content').stop(true, true).animate({
				top: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content').hide();
			});
		});
	</script>
  </main>
  
  <!-- ドロワーメニューの利用宣言 -->
  <script>
    $(document).ready(function() {
    $('.drawer').drawer();
  });
  </script>
</body>
</html>
