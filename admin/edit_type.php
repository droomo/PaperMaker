<?php	
	require "../include/db_connect.php";
	
	if (isset($_POST['newType'])) {
		$newType = stripslashes($_POST['newType']);

		$sql = "INSERT INTO `problem_type` (`type_name`) VALUES ('$newType');";
		
		$new_result = $db->exec($sql);
			
		if ($new_result == 1) 
			echo "添加成功";
		else
			echo "添加失败，请重试";
		
	}
	
	if (isset($_POST['type_id'])) {
		//var_dump($_POST);
		$type_id = $_POST['type_id'];
		$type_name = stripslashes($_POST['type_name']);
		
		if ($type_name == "") {
			echo "请填写新类型名称";
			exit;
		} else {
		
			$sql = "UPDATE `problem_type` SET `type_name`='$type_name' WHERE `type_id`=$type_id;";

			$result = $db->exec($sql);
			
			if ($result == 1) 
				echo "修改成功";
			else
				echo "修改失败，请重试";
			
		}
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
<?php
	
	if (isset($_GET['delete'])) {
		$type_id = $_GET['type_id'];
		$sql = "DELETE FROM `problem_type` WHERE `type_id`=$type_id;";
		$result = $db->exec($sql);
		
		if ($result == 1) {
			$sql = "UPDATE `problem` SET `problem_type`=0 WHERE `problem_type`=$type_id;";
			$result = $db->exec($sql);
		}
		
		if ($result == 1)
			echo "删除成功！";
		else 
			echo "删除失败，请重试";

	}
		
	$sql = "SELECT * FROM `problem_type` WHERE 1;";
	$result = $db->query($sql);

	$db = null;
?>

		<table class="table table-striped">
      <thead>
        <tr>
          <th>类型名称</th>
					<th>操作</th>
        </tr>
      </thead>
      <tbody>
				<?php
					foreach ($result as $row) {
						$type_name = $row['type_name'];
						$type_id = $row['type_id'];

						echo "<tr>
									<td>$type_name</td>
									<td>
									<button class='btn btn-info edit-button' data-toggle='modal' data-target='#myModal' data-id='$type_id' data-name='$type_name'>编辑</button>
									";
						if ($type_id != 0) 
							echo "<a href='edit_type.php?delete=1&type_id=$type_id' onclick='delcfm();' ><button class='btn btn-danger'>删除</button></a>
										</td>
									</tr>";
					}
				?>
      </tbody>
    </table>
		
		<form class="form-inline" action="edit_type.php" method="post">
			<div class="form-group">
				<label for="newType">添加类别</label>
				<input type="text" class="form-control" name="newType" id="newType">
			</div>
			<button type="submit" class="btn btn-primary">添加新类型</button>
		</form>
		
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="edit_type.php" method="post">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">修改题目类型</h4>
						</div>
						<div class="modal-body" data="aaa">
							
								<label for="oldTypeNameInput" >原类型名称</label>
								<input type="text" id="oldTypeNameInput" disabled="disabled" />
								<br>
								<br>
								<label for="oldTypeNameInput" >新类型名称</label>
								<input type="hidden" name="type_id" id="typeIdInput" />
								<input type="text" name="type_name" id="newTypeNameInput" />
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
							<button type="submit" class="btn btn-primary" >保存修改</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script>
		function delcfm() {
			if (!confirm("确认要删除？")) {
				window.event.returnValue = false;
			}
    }
		
		$(".edit-button").bind("click",function(){
			$("#typeIdInput").attr('value', ($(this).attr("data-id")));
			$("#oldTypeNameInput").attr('value', ($(this).attr("data-name")));
		});
		
	</script>
</body>




		