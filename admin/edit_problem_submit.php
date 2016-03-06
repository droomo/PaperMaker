<?php
	require "../include/db_connect.php";

	if (isset($_GET['delete'])){
		
		$problem_id = stripslashes($_GET['problem_id']);
		$sql = "DELETE FROM `problem` WHERE `problem_id`=$problem_id";
		$result = $db->exec($sql);
		if ($result == 1)
			echo "删除成功！";
		else 
			echo "删除失败，请重试";

	}

	if (isset($_POST)){
		if (!isset($_POST['editorValue'])) {
			echo "请填写题目描述";
			exit;
		}
		$problem_id = stripslashes($_POST['problem_id']);
		$problem_type = stripslashes($_POST['problem_type']);
		$problem_desc = stripslashes($_POST['problem_desc']);
		$problem_content = stripslashes($_POST['editorValue']);
		
		$sql = "UPDATE `problem` SET
		`problem_type`=$problem_type, `problem_desc`='$problem_desc', 
		`problem_content`='$problem_content'
		WHERE
		`problem_id`=$problem_id";
			
		$result = $db->exec($sql);
		
		$db = null;
	}else{
		exit;
	}
?>

<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
	<p>编辑成功</p>
	<br>
	<a href='edit_problem.php?problem_id=<?php echo $problem_id?>'>查看题目</a>
</body>
