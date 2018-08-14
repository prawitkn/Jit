<?php
    session_start();

    if (!isset($_SESSION['userId'])){
        header("Location: login.php");
    }
    
	include 'db/db.php';
			
    $s_userId=$_SESSION['userId'];
    $sql = "SELECT * FROM ".$dtPrefix."user WHERE userId='$s_userId' LIMIT 1";
    $stmt=$pdo->prepare($sql);
	$result_user = $stmt->execute();
    if ($result_user) {	
		$row_user=$stmt->fetch();
						
        $s_userFullname = $row_user['userFullname'];
        $s_userPicture = $row_user['userPicture'];
		$s_username = $row_user['userName'];
		$s_userGroupCode = $row_user['userGroupCode'];
		$s_userDeptCode = $row_user['userDeptCode'];		
        		
		//Set Login 
		//setcookie("loginWh", "1", time()+3600);	//3600=1Hour; 1800=30Min; 60=1Min
		
		 $sql = "UPDATE ".$dtPrefix."user SET loginStatus=1, lastLoginTime=NOW() WHERE userId='$s_userId'";
		$stmt=$pdo->prepare($sql);
		$stmt->execute();
        
    }else{
		header("Location: login.php");
	}