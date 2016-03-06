<?php
	require "../include/db_connect.php";
	$sql = "SELECT * FROM `problem_type` WHERE 1;";
	$result = $db->query($sql);
	
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
	.editor-area {
		margin-bottom:120px;
	}
	select{
		min-width:100px;
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
	<form action="add_problem_submit.php" method="post" id="contentForm">
		<div class="one-cell">
			<label for="problem_type">题目类型</label>
			<select name="problem_type" form="contentForm" id="problem_type">
			<?php
				foreach ($result as $row) {
					$type_id = $row['type_id'];
					$type_name = $row['type_name'];
					echo "<option value='$type_id'>$type_name</option>";
				}
			?>
			</select> 
		</div>
		
		<div class="one-cell">
			<label for="problem_desc">题目简述</label>
			<br>
			<textarea name="problem_desc" id="problem_desc"></textarea>
		</div>
		
		<div class="one-cell editor-area">
			<label for="problem_content">题目描述</label>
			<br>
			<script id="editor" type="text/plain" ></script>
		</div>
		
		<div class="one-cell">
			<button class="btn btn-primary" type="submit">提交</button>
		</div>
	</form>
	<script type="text/javascript" charset="utf-8" src="../lib/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="../lib/ueditor/ueditor.all.min.js"> </script>
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

	</script>
</body>




