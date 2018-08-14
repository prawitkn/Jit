<?php
    include 'session.php';	
		
	$tb=$dtPrefix."user";
	
	if(!isset($_POST['action'])){		
		header('Content-Type: application/json');
		echo json_encode(array('status' => 'danger', 'message' => 'No action.'));
	}else{
		switch($_POST['action']){
			case 'add' :				
				try{					
					$userName = $_POST['userName'];
					$userPassword = $_POST['userPassword'];
					
					$userFullname = $_POST['userFullname'];					
					$userPin = $_POST['userPin'];
					$userEmail = $_POST['userEmail'];
					$userTel = $_POST['userTel'];
					$userGroupCode = $_POST['userGroupCode'];
					$userDeptCode = $_POST['userDeptCode'];
					
					// Check duplication?
					$sql = "SELECT * FROM `".$tb."` WHERE userName=:userName LIMIT 1 ";
					$stmt = $pdo->prepare($sql);	
					$stmt->bindParam(':userName', $userName);
					$stmt->execute();
					if ($stmt->rowCount() == 1){
					  header('Content-Type: application/json');
						$errors = "Error on Data Insertion. Please try new username. ";
						echo json_encode(array('status' => 'warning', 'message' => $errors));
					}else{ 			
						
						$salt = "QAzzArVA38rTSm8ctnvrGyDT3ZDVPV88";						
						// Encript Password
						$hash_userPassword = hash_hmac('sha256', $userPassword, $salt);
						// Encript PIN
						$hash_userPin = hash_hmac('sha256', $userPin, $salt);
						
						$new_picture_name="";
						 // Upload Picture
						if (is_uploaded_file($_FILES['inputFile']['tmp_name'])){
							$new_picture_name = 'user_'.uniqid().".".pathinfo(basename($_FILES['inputFile']['name']), PATHINFO_EXTENSION);
							$path_upload = "dist/img/".$new_picture_name;
							move_uploaded_file($_FILES['inputFile']['tmp_name'], $path_upload);        
						}

						$sql = "INSERT INTO ".$tb." (`userName`, `userPassword`, `userPin`, `userFullname`
						, `userEmail`, `userTel`, `userPicture`, `userGroupCode`,  `userDeptCode`, `statusCode`,CreateTime, CreateUserId)"
						. " VALUES (:userName, :userPassword, :userPin, :userFullname
						, :userEmail, :userTel, :userPicture, :userGroupCode, :userDeptCode,1,NOW(),:CreateUserId)";
						 
						$stmt = $pdo->prepare($sql);	
						$stmt->bindParam(':userName', $userName);
						$stmt->bindParam(':userPassword', $hash_userPassword);
						$stmt->bindParam(':userPin', $hash_userPin);
						$stmt->bindParam(':userFullname', $userFullname);
						$stmt->bindParam(':userEmail', $userEmail);
						$stmt->bindParam(':userTel', $userTel);
						$stmt->bindParam(':userPicture', $new_picture_name);
						$stmt->bindParam(':userGroupCode', $userGroupCode);
						$stmt->bindParam(':userDeptCode', $userDeptCode);
						$stmt->bindParam(':CreateUserId', $s_userId);
						if ($stmt->execute()) {
							header('Content-Type: application/json');
							echo json_encode(array('status' => 'success', 'message' => 'Data Inserted Complete.'));
						} else {
							header('Content-Type: application/json');
							$errors = "Error on Data Insertion. Please try new username. ";
							echo json_encode(array('status' => 'danger', 'message' => $errors));
						}
					}						
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('status' => 'danger', 'message' => $errors));
				} 			
				break;
			case 'edit' :
				try{					
					$Id = $_POST['Id'];
					$Code = $_POST['Code'];
					$Name = $_POST['Name'];
					$StatusId = $_POST['StatusId'];
					
					// Check user name duplication?
					$sql = "SELECT Id FROM `".$tb."` WHERE (Code=:Code OR Name=:Name) AND Id<>:Id LIMIT 1 ";
					$stmt = $pdo->prepare($sql);	
					$stmt->bindParam(':Code', $Code);
					$stmt->bindParam(':Name', $Name);
					$stmt->bindParam(':Id', $Id);
					$stmt->execute();				
					if ($stmt->rowCount() == 1){
					  header('Content-Type: application/json');
					  $errors = "Error on Data Insertion. Duplicate data, Please try new username. " . $pdo->errorInfo()[2];
					  echo json_encode(array('status' => 'warning', 'message' => $errors));  
					  exit;    
					} 	   
					
					//Sql
					$sql = "UPDATE `".$tb."` SET `Code`=:Code 
					, `Name`=:Name
					, `StatusId`=:StatusId
					, `UpdateTime`=NOW()
					, `UpdateUserId`=:UpdateUserId
					WHERE Id=:Id 
					";	
					$stmt = $pdo->prepare($sql);	
					$stmt->bindParam(':Code', $Code);
					$stmt->bindParam(':Name', $Name);
					$stmt->bindParam(':StatusId', $StatusId);
					$stmt->bindParam(':UpdateUserId', $s_userId);
					$stmt->bindParam(':Id', $Id);
					if ($stmt->execute()) {
						  header('Content-Type: application/json');
						  echo json_encode(array('status' => 'success', 'message' => 'Data Updated Complete.'));
					   } else {
						  header('Content-Type: application/json');
						  $errors = "Error on Data Update." . $pdo->errorInfo();
						  echo json_encode(array('status' => 'danger', 'message' => $errors));
					}
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('status' => 'danger', 'message' => $errors));
				} 	
				break;
			case 'setActive' :				
				try{					
					$Id = $_POST['Id'];
					$StatusId = $_POST['StatusId'];	
					
					$sql = "UPDATE ".$tb." SET StatusId=:StatusId, UpdateTime=NOW(), UpdateUserId=:UpdateUserId WHERE id=:Id ";
					$stmt = $pdo->prepare($sql);	
					$stmt->bindParam(':StatusId', $StatusId);
					$stmt->bindParam(':Id', $Id);
					$stmt->bindParam(':UpdateUserId', $s_userId);
					$stmt->execute();	
					if ($stmt->execute()) {
					  header('Content-Type: application/json');
					  echo json_encode(array('status' => 'success', 'message' => 'Data Updated Complete.'));
					} else {
					  header('Content-Type: application/json');
					  $errors = "Error on Data Update. Please try new data. " . $pdo->errorInfo();
					  echo json_encode(array('status' => 'danger', 'message' => $errors));
					}
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('status' => 'danger', 'message' => $errors));
				} 					
				break;
			case 'remove' :
				try{					
					$Id = $_POST['Id'];	
					
					$sql = "UPDATE ".$tb." SET StatusId=3, UpdateTime=NOW(), UpdateUserId=:UpdateUserId WHERE Id=:Id ";
					$stmt = $pdo->prepare($sql);	
					$stmt->bindParam(':Id', $Id);
					$stmt->bindParam(':UpdateUserId', $s_userId);	
					if ($stmt->execute()) {
					  header('Content-Type: application/json');
					  echo json_encode(array('status' => 'success', 'message' => 'Data Removed Complete.'));
					} else {
					  header('Content-Type: application/json');
					  $errors = "Error on Data Remove. Please try new data. " . $pdo->errorInfo();
					  echo json_encode(array('status' => 'danger', 'message' => $errors));
					}
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('status' => 'danger', 'message' => $errors));
				}
				break;
			case 'delete' :
				try{					
					$Id = $_POST['Id'];
					$StatusId = $_POST['StatusId'];	
					
					
					$sql = "DELETE FROM ".$tb." WHERE Id=:Id ";
					$stmt = $pdo->prepare($sql);	
					$stmt->bindParam(':Id', $Id);
					if ($stmt->execute()) {
					  header('Content-Type: application/json');
					  echo json_encode(array('status' => 'success', 'message' => 'Data Delete Complete.'));
					} else {
					  header('Content-Type: application/json');
					  $errors = "Error on Data Delete. " . $pdo->errorInfo();
					  echo json_encode(array('status' => 'danger', 'message' => $errors));
					}
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('status' => 'danger', 'message' => $errors));
				}
				break;				
			case 'syncRank' :
				try{	
					$sql = "INSERT INTO cr_rank (code, name) 
					SELECT code,name FROM `daginterdb`.`core_rank` b
					WHERE NOT EXISTS (SELECT * FROM cr_rank x WHERE x.code=b.code AND x.name=b.name) ";
					$stmt = $pdo->prepare($sql);		
					if ($stmt->execute()) {
					  header('Content-Type: application/json');
					  echo json_encode(array('status' => 'success', 'message' => 'Data Sync Complete.'));
					} else {
					  header('Content-Type: application/json');
					  $errors = "Error on Data Sync. " . $pdo->errorInfo();
					  echo json_encode(array('status' => 'danger', 'message' => $errors));
					}
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('status' => 'danger', 'message' => $errors));
				}
				break;
			case 'syncPerson' :
				try{	
					$sql = "INSERT INTO cr_person (`Mid`, `Fullname`, `RankCode`, `Gender`, `DateOfBirth`) 
					SELECT mid, title_abb_name_surname, rank_id, gender, date_of_birth FROM `daginterdb`.`core_persons` b
					WHERE mid NOT IN (SELECT Mid FROM cr_person ) ";
					$stmt = $pdo->prepare($sql);		
					if ($stmt->execute()) {
					  header('Content-Type: application/json');
					  echo json_encode(array('status' => 'success', 'message' => 'Data Sync Complete.'));
					} else {
					  header('Content-Type: application/json');
					  $errors = "Error on Data Sync. " . $pdo->errorInfo();
					  echo json_encode(array('status' => 'danger', 'message' => $errors));
					}
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('status' => 'danger', 'message' => $errors));
				}
				break;				
			case 'syncUser' :
				try{	
					$sql = "INSERT INTO cr_user (`userName`, `userFullname`, `userGroupCode`, `statusCode`, `CreateTime`, `CreateUserId`) 
					SELECT mid, title_abb_name_surname, 2, 'A', NOW(), 1 
					FROM `daginterdb`.`core_persons` b
					WHERE mid NOT IN (SELECT userName FROM `cr`.cr_user )";
					$stmt = $pdo->prepare($sql);		
					if ($stmt->execute()) {
					  header('Content-Type: application/json');
					  echo json_encode(array('status' => 'success', 'message' => 'Data Sync Complete.'));
					} else {
					  header('Content-Type: application/json');
					  $errors = "Error on Data Sync. " . $pdo->errorInfo();
					  echo json_encode(array('status' => 'danger', 'message' => $errors));
					}
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('status' => 'danger', 'message' => $errors));
				}
				break;
			default : 
				header('Content-Type: application/json');
				echo json_encode(array('status' => 'danger', 'message' => 'Unknow action.'));				
		}
	}