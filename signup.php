<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><%= title %></title>
		<script src="/javascripts/jquery-2.1.3.js"></script>
		<script src="/javascripts/check.js"></script>
		<link rel="stylesheet" href="/stylesheets/signup.css">

	</head>
	<body>
		<div class="login">
			<form id="loginForm" action="" method="POST">
			
				<div>
					<h2 class="login-header"></h2>
					<h2 class="login-header">新規登録</h2>
				</div>
				
				<div class="wrapper">
					<input type="text" id="user_id" name="userId" placeholder="User ID" value="">
					<span class="user_id check"></span>
				</div>				
				
				<div class="wrapper">
					<input type="text" id="user_name" name="userName" placeholder="Nick name" value="">
					<span class="user_name check"></span>
				</div>
				
				<div class="wrapper">
					<input type="password" id="password" name="password" value="" placeholder="Password">
					<span class="password check"></span>
				</div>		
				
				<div class="wrapper">
					<select id="year"  class="birth" name="year">
						<option value="">-</option>
						<%
						for(var i=year;i>=year-150;i--){
						%>
							<option value=<%= i %>><%= i %></option>
						<%};%>
					</select>　年
					<select id="month" class="birth" name="month">
						<option value="">-</option>
						<%
						for(var i=1;i<=12;i++){
						%>
							<option value=<%= i %>><%= i %></option>
						<%};%>
					</select>　月
					<select id="day" class="birth" name="day">
						<option value="">-</option>
						<%
						for(var i=1;i<=31;i++){
						%>
							<option value=<%= i %>><%= i %></option>
						<%};%>
					</select>　日
					<span class="birthOn check"></span>
				</div>			
				
				<div class="wrapper">
					<select id="sex" name="sex">
						<option value="">-</option>
							<option value="1">男</option>
							<option value="2">女</option>
					</select>　sex
					<span class="sex check"></span>
				</div>
				
				<div>
					<input type="submit" id="login" name="login" value="新規登録">
				</div>
			</form>	 
			<% if (typeof userIdExists !== 'undefined') { %>
				<p class="error"><%= userIdExists %></p>
			<% } %>
		</div>
	</body>
</html>