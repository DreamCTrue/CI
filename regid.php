<?php 
	$regId = $_POST['regId'];

	$con = mysql_connect("localhost","vany","tsoc2014");
	if(!$con){
		die('MySQL connection failed'.mysql_error());
	}

	$db = mysql_select_db("vany",$con);
	if(!$db){
		die('Database selection failed'.mysql_error());
	}
	
	$sql="SELECT * FROM `tblregistration` WHERE `registration_id`='$regId'";
	
	if(mysql_num_rows(mysql_query($sql, $con))==0){
	
		$sql = "INSERT INTO tblregistration (registration_id) values ('$regId')";

		if(!mysql_query($sql, $con)){
			die('MySQL query failed'.mysql_error());
		}
	}
	echo "123";

	mysql_close($con);
?>