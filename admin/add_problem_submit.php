<?php

if (isset($_POST)){
	if (!isset($_POST['editorValue'])) {
		echo "请填写题目描述";
		exit;
	}
	$problem_type = stripslashes($_POST['problem_type']);
	$problem_desc = stripslashes($_POST['problem_desc']);
	$problem_content = stripslashes($_POST['editorValue']);
	
	$sql = "INSERT INTO `problem` 
	(`problem_type`, `problem_desc`, `problem_content`, `create_time`) VALUES
	($problem_type, '$problem_desc', '$problem_content', NOW());";
	
	require "../include/db_connect.php";
	
	$result = $db->exec($sql);
	
	$problem_id = $db->lastInsertId();
} else {
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