<?php
	require "../include/db_connect.php";
	$sql = "SELECT * FROM `problem` WHERE 1;";
	$result = $db->query($sql);
	
	$sql = "SELECT * FROM `problem_type` WHERE 1;";
	$type_result = $db->query($sql);
	$type_result = $type_result->fetchAll(PDO::FETCH_ASSOC);

	$db = null;
	$type_arr = array();
	foreach ($type_result as $row) {
		$type_arr[$row['type_id']] = $row['type_name'];
	}

?>

<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
	body{
		padding:20px;
	}
	</style>
</head>
<body>
		<table class="table table-striped">
      <thead>
        <tr>
          <th>题目编号</th>
          <th>题目类型</th>
          <th>题目简述</th>
          <th>创建时间</th>
					<th>操作</th>
        </tr>
      </thead>
      <tbody>
				<?php
					foreach ($result as $row) {						
						$problem_id = $row['problem_id'];
						$problem_type = $row['problem_type'];
						$problem_desc = $row['problem_desc'];
						$create_time = $row['create_time'];
						echo "<tr>
										<th scope='row'>$problem_id</th>
										<td>". $type_arr[$problem_type]. "</td>
										<td>$problem_desc</td>
										<td>$create_time</td>
										<td>
											<a href='edit_problem.php?problem_id=$problem_id'><button class='btn btn-info'>编辑</button></a>
											<a href='edit_problem_submit.php?problem_id=$problem_id&delete=1' onclick='delcfm();'><button class='btn btn-danger'>删除</button></a>
										</td>
									</tr>
									";
					}
				?>
      </tbody>
    </table>
	<script>
		function delcfm() {
        if (!confirm("确认要删除？")) {
            window.event.returnValue = false;
        }
    }
	</script>
</body>
		