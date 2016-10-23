$(document).ready(function() {
	$("#showindex").click(function() {
		window.open("/locapp/controller/indexcon.php");
	});
	$("#testGet").click(function() {
		$.get("/locapp/controller/user.php", {'action':'showuser', 'id':'101'}, function(result) {
			$("#testshow").html(result);
		});
	});
	$("#clean").click(function() {
		$("#userid").val('');
		$("#userpassid").val('');
	});
});