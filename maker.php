<?php
	require "include/config.php";
	
	$content = stripslashes($_POST['content']);

	$url = $website_url;
	
	$content = preg_replace('/src="(\/)?([\w_\-\/\.\?&=@%#]*)"/i','src="' . $website_url . '$2"', $content);
	$content = preg_replace("/font-family:.+?['|\"]/i",'',$content);//remove type
	
	$file_content =
					'<html>
					<head>  
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<style>
							*{
								font-size: 20px!important;
								line-height: 28px;
								font-family: 宋体;
							}
							body{
								padding: 45px;
							}
						</style>
					</head>
					<body>'.
					$content .
					'</body>
					</html>';


	$fileName = date('YmdHis');
	
	$myfile = fopen("tmp/{$fileName}.html", "w") or die("Unable to open file!");

	fwrite($myfile, $file_content);

	fclose($myfile);
	
	$fileName = '20160214084003';
	
	shell_exec("xvfb-run --server-args='-screen 0, 1024x768x24' /usr/local/bin/wkhtmltopdf tmp/{$fileName}.html tmp/{$fileName}.pdf");

	$response = array();
	$response['status'] = 200;
	
	$response['data'] = array();
	$response['data']['url'] = "tmp/{$fileName}.pdf";
	
	echo json_encode($response);
	