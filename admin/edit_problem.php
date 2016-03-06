<?php
	if (isset($_POST))
	
	if (!isset($_GET['problem_id'])) {
		echo "请使用正确的接口";
		exit;
	}
	
	$problem_id = $_GET['problem_id'];
	
	require "../include/db_connect.php";
	$sql = "SELECT * FROM `problem` WHERE problem_id = $problem_id;";
	$problem_result = $db->query($sql);
	
	$problem_result = $problem_result->fetch(PDO::FETCH_ASSOC);
	$problem_type = $problem_result['problem_type'];
	$problem_desc = $problem_result['problem_desc'];
	$problem_content = $problem_result['problem_content'];
	//var_dump($problem_result);
	
	$sql = "SELECT * FROM `problem_type` WHERE 1;";
	$type_result = $db->query($sql);
	
	$db = null;
?>

<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
	body{
		padding:20px;
	}
	.one-cell{
		margin-top:20px;
	}
	select{
		width:100px;
		height:30px;
		font-size:16px;
	}
	#problem_desc {
		width:860px;height:80px;
	}
	#editor {
		width:860px;min-height:480px;
	}
	</style>
</head>

<body>
	<form action="edit_problem_submit.php" method="post" id="contentForm">
		<div class="one-cell">
			<label for="problem_id">题目编号</label>
			<input type="hidden" value="<?php echo "$problem_id"?>" name="problem_id" id="problem_id" />
			<input type="text" value="<?php echo "$problem_id"?>" disabled="disabled" />
		</div>
		
		<div class="one-cell">
			<label for="problem_type">题目类型</label>
			<select name="problem_type" form="contentForm" id="problem_type">
			<?php
				foreach ($type_result as $row) {
					$type_id = $row['type_id'];
					$type_name = $row['type_name'];
					if ($problem_type == $type_id)
						echo "<option value='$type_id' selected = 'selected'>$type_name</option>";
					else
						echo "<option value='$type_id'>$type_name</option>";
				}
			?>
			</select> 
		</div>
		
		<div class="one-cell">
			<label for="problem_desc">题目简述</label>
			<br>
			<textarea name="problem_desc" id="problem_desc"><?php echo $problem_desc?></textarea>
		</div>

		<div class="one-cell editor-area">
			<label for="problem_content">题目描述</label>
			<br>
			<script id="editor" type="text/plain" ></script>
		</div>
		
		<div class="one-cell">
			<button class="btn btn-primary" type="submit" >提交</button>
		</div>
	</form>
	<script type="text/javascript" charset="utf-8" src="../lib/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="../lib/ueditor/ueditor.all.min.js"></script>

	<script type="text/javascript" charset="utf-8" src="../lib/ueditor/lang/zh-cn/zh-cn.js"></script>
	<script type="text/javascript">
		var ue = UE.getEditor('editor', {
			toolbars: [[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 
						'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 
						'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
            '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage',  'scrawl', 'wordimage', '|',
            'horizontal', 'date', 'time', 'spechars', '|',
            'print', 'preview'
        ]]
		});
		
		ue.addListener("ready", function () {
			ue.setContent('<?php echo $problem_content?>');
		});

	</script>
</body>