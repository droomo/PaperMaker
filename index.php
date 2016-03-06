<!DOCTYPE HTML>
<html class="no-js">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="renderer" content="webkit">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Paper Maker</title>
		<link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<style>
			.modal-dialog {
				width:860px;
			}
			html,body,.background-area-container,.background-area{
				height:100%;
			}
			body{
				font-family:Apple LiGothic Medium,Microsoft YaHei,SimHei
			}
			.background-area {
				padding-left:10px;
				padding-top:10px;
			}
			.btn-start-top,.btn-start-bottom {
				position: absolute;
				height:10%;
				font-size:72px;
				left:50%;
				margin-left:-144px;
			}
			.btn-start-top{
				bottom:55%;
				color:#ddd
			}
			.btn-start-bottom{
				top:45%;
				color:#222
			}
			#loadingBug {
				position:absolute;
				width:100%;
				height:100%;
			}
		</style>
	</head>
	<body>
		<div class="background-area-container">
			<div class="col-xs-1 background-area"></div>
			<div class="col-xs-2 background-area"></div>
			<div type="button" class="col-xs-6 background-area btn reload" data-toggle="modal">
				<div class="btn-start-top">
					生成题目
				</div>				
				<div class="btn-start-bottom">
					生成题目
				</div>
			</div>
			<div class="col-xs-2 background-area"></div>
			<div class="col-xs-1 background-area"></div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">预览</h4>
					</div>
					<div class="modal-header" align="right">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<button type="button" class="btn btn-primary reload">重新生成</button>
						<button type="button" class="btn btn-primary download">下载</button>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">

					</div>
				</div>
			</div>
		</div>
		<div id="loadingBug">
		</div>
		<script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
		<script src="http://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		
		<script type="text/javascript">
			$(function(){
				initColor();
				
				$(".reload").bind("click", function() {
					loadPaper();
					$("#myModal").modal("show");
				});
				
				$(".download").bind("click", function() {
					makePaper();
					waitMaker();
				});
			}); 
			
			var initColor = function() {
				$(".background-area").css("background-color", getRandomColor);
			}
			
			var loadPaper = function() {
				$(".modal-body").empty();
				$.ajax({
					url: "include/get_paper.php",
					data: {},
					success: function(data){
						$.each(data['data'], function(index, data) {
							$(".modal-body").append(data['content']);
						});
					},
					dataType: "json"
				});
			}
			
			var makePaper = function() {
				$.ajax({
					type: 'POST',
					url: "maker.php",
					data: {
						"content" : $(".modal-body").html()
					},
					success: function(data){
						if (data['status'] === 200) {
							$(".modal-body").empty();
							var $a = $("<a href="+data['data']['url']+" target='_blank'>点击下载</a>")
							$(".modal-body").html($a);
						}
					},
					dataType: "json"
				});
			}
			
			var waitMaker = function() {
				$(".modal-body").empty();
				var $img = $("<div align='center'><img src='assets/images/loading.gif'/></div>");
				$(".modal-body").html($img);
			}
			
			var getRandomColor = function(){
				return '#'+(Math.random()*0xffffff<<0).toString(16); 
			}

		</script>
		
	</body>
</html>



