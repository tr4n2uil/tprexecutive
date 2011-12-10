<?php 
require_once(CWROOT. 'dev/libraries/Mysql.class.php');

class Course {
	public static function syllabus($cid){
		$mysql = new Mysql(MYSQL_DB, MYSQL_USER, MYSQL_PASS, MYSQL_HOST);
	
		$result = $mysql->getResult("select c.syllabus from courses c where c.cid=$cid;");
		if($result === false){
			echo "SQL Error : ".$mysql->getError();
			exit;
		}
		if(count($result) != 1){
			echo "Error in Database : Non unique resultset";
			exit;
		}
		
		return $result[0]['syllabus'];
	}
	
	public static function name($cid){
		$mysql = new Mysql(MYSQL_DB, MYSQL_USER, MYSQL_PASS, MYSQL_HOST);
	
		$result = $mysql->getResult("select c.name from courses c where c.cid=$cid;");
		if($result === false){
			echo "SQL Error : ".$mysql->getError();
			exit;
		}
		if(count($result) != 1){
			echo "Error in Database : Non unique resultset";
			exit;
		}
		
		return $result[0]['name'];
	}
}

?>