<?php
header('Content-Type:text/html;charset=utf-8');
try{
	$dbms='mysql';
	$dbname='loc';
	$user='loc';
	$pwd='locqweasd';
	$host='localhost';
	$dsn="$dbms:host=$host;dbname=$dbname";
	$pdo = new PDO($dsn,$user,$pwd,array(PDO::ATTR_PERSISTENT => true));
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$paction = $_POST['action'];
		switch ($paction) {
			case "adduser";
			{
				$latitude = 23.23;
				$precision = 25.88;
				$read = 0;
				$sql_stmt = 'INSERT INTO user (latitude, precis, status) VALUES (?, ?, ?)';
				$stmt = $pdo->prepare($sql_stmt);
				$stmt->bindParam(1, $latitude);
				$stmt->bindParam(2, $precision);
				$stmt->bindParam(3, $read, PDO::PARAM_INT);
				$stmt->execute();
				exit("执行成功");
			}
			break;
			case "deleteuser";
			{
				$id = $_POST['id'];;
				$sql_stmt = 'DELETE FROM  user where id= ?';
				$stmt = $pdo->prepare($sql_stmt);
				$stmt->bindParam(1, $id, PDO::PARAM_INT);
				$stmt->execute();
				exit("执行成功");
			}
			break;
			default:
				exit(json_encode(error));
		}
	} else {
		$gaction = $_GET['action'];
		switch ($gaction) {
			case "showuser";
			{
				$id = $_GET['id'];
				$start = 0;
				$size = 10;
				$sql_stmt = 'select * from user limit ?,?';
				$stmt=$pdo->prepare($sql_stmt);
				$stmt->bindParam(1, $start, PDO::PARAM_INT);
				$stmt->bindParam(2, $size, PDO::PARAM_INT);
				$stmt->execute();
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				exit(json_encode($result));

			}
			break;
			default:
				exit(json_encode(error));

		};
	}

}catch(Exception $exception){
	exit ($exception->getMessage());
}
?>