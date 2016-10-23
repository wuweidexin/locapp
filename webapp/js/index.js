$(document).ready(function() {
	$("#showindex").click(function() {
		window.open("/locapp/controller/indexcon.php");
	});
	$("#testGet").click(function() {
		$.get("/locapp/controller/user.php", {'action':'showuser', 'id':'101'}, function(result) {
			$("#testshow").html(result);
		});
	});
	$("#testAdd").click(function() {
		$.post("/locapp/controller/user.php", {'action':'adduser'}, function(result) {
			$("#testshow").html(result);
		});
	});
	$("#testDelete").click(function() {
		var val = $("#delId").val();
		$.post("/locapp/controller/user.php",{'action':'deleteuser', 'id':val},function(result){
		    $("#testshow").html(result);
		 });
	});
});