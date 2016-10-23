<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP的世界</title>
<link rel="stylesheet" href="ext/jqueryui/jquery-ui.min.css" />
<link rel="stylesheet" href="ext/pggrid/pqgrid.min.css">

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="ext/jqueryui/jquery-ui.min.js"></script>
<script src="ext/pggrid/pqgrid.min.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$username = $_POST['username'];
	$userpass = $_POST['userpass'];
	if(!$username == 'admin') {
		exit("用户名错误");
	}
	if(!$userpass == 'admin') {
		exit("密码错误");
	}
	?>
<div align="center">
<h2>你好!欢迎登录后台</h2>
<br>
<br>
<div id="grid_paging" style="margin: 5px auto;"></div>
<br>
<div><label>精度:</label><input id="precis" type="text"> <br>
<br>
<label>纬度:</label><input id="latitude" type="text"> <br>
<br>
<label>是否已读:</label><input id="status" type="checkbox"> <br>
<br>
<button id="testAdd">插入数据</button>
</div>

<br>
<br>
<div>
<label>ID:</label>
<input type="text" id="delId">
<button id="testDelete">删除数据</button>
</div>

<br>
<br>
<div id="testshow"></div>
</div>
	<?php
} else {
	?>
<div align="center">你的请求已经不在地球上!</div>
	<?php }?>

</body>
</html>
