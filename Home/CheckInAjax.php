<?php
    include 'session.php';	
		
	$tb='';
	
	if(!isset($_POST['action'])){		
		header('Content-Type: application/json');
		echo json_encode(array('success' => false, 'message' => 'No action.'));
	}else{
		switch($_POST['action']){
			case 'getBarcode' :
				try{	
					$barcode = $_POST['barcode'];
					$sql = "SELECT jd.`Id`, jd.`GroupId`, jd.`Qty`, jd.`Remark`, jd.`CreateTime`, jd.`CreateUserId`, jd.`CheckInTime`, jd.`CheckInUserId` 
					,jg.Name as GroupName, jg.qtyMax 
					FROM `jit_data` jd 
					INNER JOIN jit_group jg ON jg.Code=jd.GroupId 
					WHERE jd.Id=:Id
					LIMIT 1
					";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':Id', $barcode);
					$stmt->execute();
					
					$rowCount=$stmt->rowCount();
					$jsonData = array();
					$jsonData=$stmt->fetch();					
					
					header('Content-Type: application/json');				
					echo json_encode( array('success' => true, 'rowCount' => $rowCount, 'data' => json_encode($jsonData) ));
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('success' => false, 'message' => $errors));
				} 
				break;
			case 'save' :			
				$barcode = $_POST['barcode'];
				$qty = $_POST['qty'];

				$sql = "UPDATE jit_data SET CheckInTime=NOW(), CheckInUserId=:CheckInUserId WHERE Id=:Id ";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':CheckInUserId', $s_userId);
				$stmt->bindParam(':Id', $barcode); 
			 
				if ( $stmt->execute() ) {
				  header('Content-Type: application/json');
				  echo json_encode(array('success' => true, 'message' => 'บันทึกเข้าร่วมพิธีเรียบร้อย'));
			   } else {
				  header('Content-Type: application/json');
				  $errors = "Error : " . $pdo->errorInfo();
				  echo json_encode(array('success' => false, 'message' => $errors));
				}					
				break;
			case 'deleteItem' :
				try{
					$Id = $_POST['Id'];
					
					//$pdo->beginTransaction();

					$sql = "UPDATE jit_data SET CheckInTime=NULL, CheckInUserId=NULL WHERE Id=:Id ";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':Id', $Id);
					$stmt->execute();

					//$pdo->commit();	
					
					//header("Location: product.php");
					header('Content-Type: application/json');
					echo json_encode(array('success' => true, 'message' => 'ลบข้อมูลเรียบร้อย'));
					
				}catch(Exception $e){
					//Rollback the transaction.
					$pdo->rollBack();
					//return JSON
					header('Content-Type: application/json');
					$errors = "Error on Data Delete. Please try again. " . $e->getMessage();
					echo json_encode(array('success' => false, 'message' => $errors));
				}
				break;
			default : 
				header('Content-Type: application/json');
				echo json_encode(array('success' => false, 'message' => 'Unknow action.'));				
		}
	}