<?php

	require "db_connect.php";

	$sql = "SELECT problem_type AS type,
	(SELECT problem_content FROM problem sub
	WHERE problem_type = main.problem_type ORDER BY rand()
	LIMIT 0,1) AS content
	FROM problem main
	GROUP BY problem_type;";
	
	$result = $db->query($sql);
	
	$response = array();
	
	$response['status'] = 200;
	
	$response['data'] = $result->fetchAll(PDO::FETCH_ASSOC);
	
	echo json_encode($response);
	
	//var_dump($response['data']);
	

