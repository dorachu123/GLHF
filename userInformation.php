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
	<link rel="stylesheet" href="/stylesheets/vhs.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!--<script src="JS/textForm.js"></script>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
	<link rel="stylesheet" href="/stylesheets/drawer.css">
	<link rel="stylesheet" href="/stylesheets/default.css">
	<link rel="stylesheet" href="/stylesheets/fonts.css">
	<link rel="stylesheet" href="/stylesheets/userInformation.css">
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
			<form action="/userInformation" id="edit_form" method="POST">
				<div class="wrapper">
					<div id="imageArea">
						<img src="images/title.jpg" id="image"></img>
					</div>
					<div id="details">
						<%
						var gender="";
						switch(user.gender){
							case 1:gender="男";break;
							case 2:gender="女";break;
						}
						%>
						<p  id="nickname" class="nickname"><%= user.nick_name %></p>
						<input id="nickname_edit" class="nickname" name="nickname" value=<%= user.nick_name %> type="text"　required>
						<p id="userId"><span>user_id:</span><%= user.user_id %></p>
						<p class="disclose-information" id="age"><span>age:</span><%= user.age %><%if(user.age==null){%>非公開<%}%></p>
						<p class="disclose-information" id="birthday"><span>birthday:</span><%= user.birth_on %><%if(user.birth_on==null){%>非公開<%}%></p>
						<p class="disclose-information" id="gender"><span>gender:</span><%= gender %><%if(user.gender==null){%>非公開<%}%></p>
						<button type="button" id="openSettingButton" >公開設定</button>
						<button type="button" id="editButton" >編集</button>
					</div>
				</div>
				<div class="wrapper">
					<div class="introduction" >
						<p id="introduction"><%= user.self_introduction %></p>
					</div>
					<textarea class="introduction" id="introduction_edit" name="introduction"><%= user.self_introduction %></textarea>
					<button type="button" name="action" id="edit_change" class="disclose-button" value='change'>変更</button>
					<button type="button" id="edit_cancel" class="disclose-button" >キャンセル</button>
				</div>
			</form>
		</div>
	</div>
	<div class="modal">
	</div>
	<div class="modal-content">
		<form action="/userInformation" id="disclose_form" method="POST">
			<p class="modal-title GDHighwayGoJA">公開設定</p>
			<div class="switch">
				<%if(user.birth_on==null&&user.age==null&&user.gender==null){%>
				<span id="disclose_status" class="sushiki">非公開</span>
				<input id="cmn-toggle-4" name="disclose" id="disclose" class="cmn-toggle cmn-toggle-round-flat" type="checkbox" checked>
				<label for="cmn-toggle-4"></label>
				<%}else{%>
				<span id="disclose_status" class="sushiki">公開</span>
				<input id="cmn-toggle-4" name="disclose" id="disclose" class="cmn-toggle cmn-toggle-round-flat" type="checkbox">
				<label for="cmn-toggle-4"></label>
				<%}%>
			</div>
			<div id="discloseSettingArea">
				<div class="input-wrapper">
					<span class="sub-title">年齢</span>
					<input id="cmn-toggle-small-1" id="age" name="age" class="cmn-toggle-small cmn-toggle-round-flat-small" type="checkbox"<%if(user.age==null){%>checked<%}%>>
					<label class="toggle-small" for="cmn-toggle-small-1"></label>
				</div>
				<div class="input-wrapper">
					<span class="sub-title">誕生日</span>
					<input id="cmn-toggle-small-2" id="birthday" name="birthday" class="cmn-toggle-small cmn-toggle-round-flat-small" type="checkbox"<%if(user.birth_on==null){%>checked<%}%>>
					<label class="toggle-small" for="cmn-toggle-small-2"></label>
				</div>
				<div class="input-wrapper">
					<span class="sub-title">性別</span>
					<input id="cmn-toggle-small-3" id="gender" name="gender" class="cmn-toggle-small cmn-toggle-round-flat-small" type="checkbox"<%if(user.gender==null){%>checked<%}%>>
					<label class="toggle-small" for="cmn-toggle-small-3"></label>
				</div>
			</div>
			<div class="input-button-wrapper">
				<button type="button" name="action" id="disclose_change" class="disclose-button" value='change'>変更</button>
				<button type="button" id="disclose_cancel" class="disclose-button" >キャンセル</button>
			</div>
		</form>
	</div>
	<script>
	
		$(function(){
			var elements = document.getElementsByName('disclose') ;
			var radioval = $(this).val();
			var str = document.getElementById("introduction").innerHTML;
			var strReplace = str.replace(/\r?\n/g, "<br>");	
			console.log(strReplace);
			document.getElementById("introduction").innerHTML=strReplace;
			if(elements[0].checked == true){
				$('#discloseSettingArea').slideUp();
				$("#disclose").prop("checked", true);
				console.log(elements[0].checked);
				document.getElementById("disclose_status").innerHTML="非公開";
				
				$('#disclose_status').css('color','#a61a37');
			}else{
				$('#discloseSettingArea').slideDown();
				document.getElementById("disclose_status").innerHTML="公開";
				$('#disclose_status').css('color','#8ce196');
			}
		});
		
		$('#openSettingButton').on('click',function(){
			$('.modal').stop(true, true).fadeIn('500');
			$('.modal-content').show().stop(true, true).animate({
				top: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);
		});			
		$('#editButton').on('click',function(){
			$('.nickname').css('display','none');
			$('#nickname_edit').css('display','block');
			$('.introduction').css('display','none');
			$('#introduction_edit').css('display','block');
			$('#edit_cancel').stop(true, true).fadeIn('500');
			$('#edit_change').stop(true, true).fadeIn('500');
		});		
		
		$('#edit_cancel').on('click',function(){
			$('.nickname').css('display','block');
			$('#nickname_edit').css('display','none');
			$('.introduction').css('display','block');
			$('#introduction_edit').css('display','none');
			$('#edit_cancel').stop(true, true).fadeOut('500');
			$('#edit_change').stop(true, true).fadeOut('500');
		});	
		
		$('#edit_change').on('click',function(){
			var str = $('#nickname_edit').val();	
			if(str === "" || str === null || str === undefined || !str.match(/[^\s　]/)){
			//エラーメッセ
			}else{
				$('#edit_form').submit();
			}
			
			console.log(strReplace);
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
		
		$('#disclose_cancel').on('click',function(){
			$('.modal').stop(true, true).fadeOut('500');
			$('.modal-content').stop(true, true).animate({
				top: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content').hide();
			});
		});		
		
		$('#disclose_change').on('click',function(){
			$('.modal').stop(true, true).fadeOut('500');
			$('.modal-content').stop(true, true).animate({
				top: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content').hide();
				$('#disclose_form').submit();
			});
		});
		
		$( 'input[name="disclose"]:checkbox' ).change( function() {
			var elements = document.getElementsByName('disclose') ;
			var radioval = $(this).val();
			if(elements[0].checked == false){
				$('#discloseSettingArea').slideDown();
				document.getElementById("disclose_status").innerHTML="公開";
				$('#disclose_status').css('color','#8ce196');
				$('#disclose_change').stop(true, true).fadeIn('500');
			}else{
				//$(".cmn-toggle-small").prop("checked", true);
				$('#discloseSettingArea').slideUp();
				document.getElementById("disclose_status").innerHTML="非公開";
				$('#disclose_status').css('color','#a61a37');
				$('#disclose_change').stop(true, true).fadeIn('500');
			}
		});
		
		$( 'input[name="gender"]:checkbox' ).change( function() {
				$('#disclose_change').stop(true, true).fadeIn('500');
		}); 
		
		$( 'input[name="age"]:checkbox' ).change( function() {
				$('#disclose_change').stop(true, true).fadeIn('500');
		}); 
		
		$( 'input[name="birthday"]:checkbox' ).change( function() {
				$('#disclose_change').stop(true, true).fadeIn('500');
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
<body>

</body>
</html>
