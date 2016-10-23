<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP的世界</title>
<script type="text/javascript" src="webapp/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="webapp/js/index.js"></script>
</head>
<body>
<div style="margin-left: 400px;margin-top: 100px;">
<form id="formid" name="myform" method='post'
	action='/locapp/webapp/main.php'
	onsubmit="return checkUser();">
<table width="100%" border="0">
	<tr>
		<td width="60" height="40" align="right">用户名&nbsp;</td>
		<td><input type="text" value="" class="text2" name="username"
			id="userid" /></td>
	</tr>
	<tr>
		<td width="60" height="40" align="right">密&nbsp;码&nbsp;</td>
		<td><input type="password" value="" class="text2" name="userpass"
			id="userpassid" /></td>
	</tr>
	<tr>
		<td width="60" height="40" align="right">&nbsp;</td>
		<td>
		<div class="c4"><input id="clean" type="button" value="清除" class="btn2" />&nbsp;
		<input type="submit" class="btn2" /></div>
		</td>
	</tr>
</table>
</form>
</div>
</body>
</html>
