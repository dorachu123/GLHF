$(function(){
	var socket = io.connect(); // ソケットへの接続
	var chatData = [];
	var count=0;
	var $form = $("#new-message");
	var $ta = $("#msgForm");
	$(document).on("keypress", "#msgForm", function(e) {
		if (e.keyCode == 13) { // Enterが押された
			if (e.shiftKey) { // Shiftキーも押された
				$.noop();
				console.log("Shiftキーも押された");
			} else{
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
				var nowTime=hour+"時"+minute+"分";
				socket.emit("client_to_server", {msg : message, date : nowDay, time : nowTime });
				e.preventDefault();
				console.log("Enterが押された");
			}
		} else {
			$.noop();
		}
	});
	// server_to_clientイベント・データを受信する
	socket.on('server_to_client', function(data){
		console.log("ぬああああああああああああああああああああああああ");
		chatData[count] =  "<div class='content'><p class='memberName'>"+ data.username +"</p><br><span class='memberChat'>" + data.username + "</span></div>";
		count++;
		console.log(data.postImage);
		if(data.postImage === "" || data.postImage === null || data.postImage === undefined){
			appendMsg("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><br><span class='memberChat'>" + data.content + "</span></div>");
		}else{
			appendMsg("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><br><img class='memberImage' src='http://localhost/OurGroupware/images/"+ data.postImage +"'></div>");
		}
	});
	/*
	// server_to_client_logイベント・データを受信する
	socket.on("server_to_client_log", function(data){
	if(data.postImage === "" || data.postImage === null || data.postImage === undefined){
	prependLog("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><br><span class='memberChat'>" + data.content + "</span></div>");
}else{
prependLog("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><br><img class='memberImage' src='http://localhost/OurGroupware/images/"+ data.postImage +"'></div>");
}
//console.log(data.user_id);
});
// server_to_client_addイベント・データを受信する
socket.on("server_to_client_add", function(data){
if(data.postImage === "" || data.postImage === null || data.postImage === undefined){
prependAdd("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><br><span class='memberChat'>" + data.content + "</span></div>");
}else{
prependAdd("<div class='content'><p class='memberName'><a href=# class='btn btn-default' id='radius'　 style='background-image:url(" + data.image + ");' ></a>"+ data.username +"<span class='dateTime'>"+ data.date +" "+data.time+"</span></p><br><img class='memberImage' src='http://localhost/OurGroupware/images/"+ data.postImage +"'></div>");
}
//console.log(data.user_id);
});
var entryMessage = "さんが入室しました。";
socket.emit("client_to_server_join", {calendar_id:calendar_id, user_id:user_id});
// client_to_server_broadcastイベント・データを送信する
//  socket.emit("client_to_server_broadcast", {value : entryMessage});
// client_to_server_personalイベント・データを送信する
socket.emit("client_to_server_personal", {value : user_id});
function appendMsg(text) {		//chatLogsに追加
$("#chatLogs").append(text);
$('#chatLogs').animate({scrollTop: $('#chatLogs')[0].scrollHeight}, 'fast');
}
function prependLog(text) {		//addChatLogsに追加
var speed = 0;
$("#addChatLogs").prepend(text);
$('#chatLogs').animate({scrollTop: $('#chatLogs')[0].scrollHeight},  speed, 'swing');
}
function prependAdd(text) {		//addChatLogsに追加
$("#addChatLogs").prepend(text);
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
console.log("ポシション2:" + $('#chatLogs').scrollTop());
console.log("ポシション;"+(scrollHeight - scrollPosition) / scrollHeight);

if ( (scrollHeight - scrollPosition) / scrollHeight >= 0) {
//スクロールの位置が下部1%の範囲に来た場合
// 元の高さ
console.log("ポシションtest1:" + $('#chatLogs').get(0).scrollHeight);
beforeHeight = $('#chatLogs').get(0).scrollHeight;
// 表示されている高さ
console.log("ポシションtest1:" + $('#chatLogs').get(0).offsetHeight);
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
*/
});
