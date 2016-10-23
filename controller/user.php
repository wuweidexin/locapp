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
				$latitude = $_POST['latitude'];
				$precision = $_POST['precis'];
				$read = $_POST['status'];
				$now = time();
				$sql_stmt = 'INSERT INTO user (latitude, precis, status, createtime) VALUES (?, ?, ?, now())';
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
//				$id = $_GET['id'];
//				$start = 0;
//				$size = 10;
//				$sql_stmt = 'select * from user limit ?,?';
//				$stmt=$pdo->prepare($sql_stmt);
//				$stmt->bindParam(1, $start, PDO::PARAM_INT);
//				$stmt->bindParam(2, $size, PDO::PARAM_INT);
//				$stmt->execute();
//				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//				exit(json_encode($result));
				
				$pq_curPage = $_GET["pq_curpage"];
			    $pq_rPP=$_GET["pq_rpp"];
			    $sql_stmt = "Select count(*) from user";
			    $stmt=$pdo->prepare($sql_stmt);
			    $stmt->execute();
			    $total_Records = $stmt->fetchColumn();
			    $skip = ($pq_rPP * ($pq_curPage - 1));
			    if ($skip >= $total_Records)
			    {        
			        $pq_curPage = ceil($total_Records / $pq_rPP);
			        $skip = ($pq_rPP * ($pq_curPage - 1));
			    }
			    $stmt = "select * from user limit ".$skip." , ".$pq_rPP;
			    $stmt = $pdo->query($stmt); 
			    $stmt->execute();   
			    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
			    $sb = "{\"totalRecords\":" . $total_Records . ",\"curPage\":" . $pq_curPage . ",\"data\":".json_encode($products)."}";
				exit($sb);
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