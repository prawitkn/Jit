<?php
    include 'session.php';	
		
	$tb='product';
	
	if(!isset($_POST['action'])){		
		header('Content-Type: application/json');
		echo json_encode(array('success' => false, 'message' => 'No action.'));
	}else{
		switch($_POST['action']){
			case 'getBarcode' :
				try{	
					$barcode = $_POST['barcode'];
					$sql = "SELECT a.`Id`, a.`Code`, a.`Name`, a.`qtyMax`
					,IFNULL((SELECT SUM(x.qty) FROM jit_data x WHERE x.GroupId=a.Code GROUP BY x.GroupId ),0) as qtyPrev 
					FROM jit_group a WHERE code=:code LIMIT 1
					";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':code', $barcode);
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
				$remark = $_POST['remark'];
				
				try{
				$pdo->beginTransaction();


			 	$sql = "SELECT `Id`, `QueueTime`, `QtyTotal`, `InBit`, `OutBit` FROM `jit_time` ";
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				$row=$stmt->fetch();

				$queueTime=$row['QueueTime'];
				$qtyTotal=$row['QtyTotal'];
				$qtyCalc=$qty+$row['InBit'];
				$ratio=ceil($qtyCalc/18);
				
				$bit=$qtyCalc%18;

				$addMin='+ '.($ratio*2).' minutes';
				$nextTime=$queueTime;
				$nextTime=strtotime($nextTime);
				$nextTime=date("Y-m-d H:i:s", strtotime($addMin, $nextTime));

				$qtyTotal+=$qty;

				$sql = "UPDATE `jit_time` SET `QueueTime`=:QueueTime, `QtyTotal`=:QtyTotal, `InBit`=:InBit ";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':QueueTime', $nextTime); 
				$stmt->bindParam(':QtyTotal', $qtyTotal); 
				$stmt->bindParam(':InBit', $bit); 
				$stmt->execute();


				$sql = "INSERT INTO `jit_data`(`GroupId`, `Qty`, `QueueTime`, `Remark`, `CreateTime`, `CreateUserId`)  
				VALUES (:GroupId,:Qty,:QueueTime,:Remark,NOW(),:CreateUserId)";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':GroupId', $barcode); 
				$stmt->bindParam(':Qty', $qty); 
				$stmt->bindParam(':QueueTime', $queueTime); 
				$stmt->bindParam(':Remark', $remark); 
				$stmt->bindParam(':CreateUserId', $s_userId);
			 	$stmt->execute();

				$lastInsertId=$pdo->lastInsertId();

				$pdo->commit();

				 header('Content-Type: application/json');
				  echo json_encode(array('success' => true, 'lastInsertId' => $lastInsertId, 'queueTime' => date('H:i', strtotime($queueTime)), 'message' => 'Data Inserted Complete.'));

				}catch(Exception $e){
					$pdo->rollBack();
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('success' => false, 'message' => $errors));
				} 

				break;	
			case 'deleteItem' :
				try{
					$Id = $_POST['Id'];
					
					//$pdo->beginTransaction();
					$sql = "SELECT `Id`, `QueueTime`, `QtyTotal`, `InBit`, `OutBit` FROM `jit_time` ";
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					$row=$stmt->fetch();

					$queueTime=$row['QueueTime'];
					$qtyTotal=$row['QtyTotal'];
					$qtyCalc=$qty+$row['InBit'];
					$ratio=ceil($qtyCalc/18);
					
					$bit=$qtyCalc%18;

					$addMin='+ '.($ratio*2).' minutes';
					$nextTime=$queueTime;
					$nextTime=strtotime($nextTime);
					$nextTime=date("Y-m-d H:i:s", strtotime($addMin, $nextTime));

					$qtyTotal+=$qty;

					$sql = "UPDATE `jit_time` SET `QueueTime`=:QueueTime, `QtyTotal`=:QtyTotal, `InBit`=:InBit ";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':QueueTime', $nextTime); 
					$stmt->bindParam(':QtyTotal', $qtyTotal); 
					$stmt->bindParam(':InBit', $bit); 
					$stmt->execute();

					
					$sql = "DELETE FROM jit_data WHERE Id=:Id ";
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
			case 'getData' :
				try{	
					$Id = $_POST['Id'];
					$sql = "SELECT jd.`Id`, jd.`GroupId`, jd.`Qty`, jd.`Remark`, jd.`CreateTime`, jd.`CreateUserId` 
					, jg.Name as GroupName, cu.userFullname as CreateUserName 
					FROM `jit_data` jd
					INNER JOIN `jit_group` jg ON jg.Code=jd.GroupId 
					INNER JOIN `cr_user` cu ON cu.userId=jd.CreateUserId
					WHERE jd.Id=:Id 
					LIMIT 1";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':Id', $Id);
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
			case 'setCheckInYes' :
				try{	
					$Id = $_POST['Id'];
					$sql = "UPDATE jit_data SET CheckInTime=NOW() WHERE Id=:Id ";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':Id', $Id);
					$stmt->execute();
					
					header('Content-Type: application/json');
					echo json_encode(array('success' => true, 'message' => 'บันทึกเรียบร้อย'));
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('success' => false, 'message' => $errors));
				} 
				break;
			case 'setCheckInNo' :
				try{	
					$Id = $_POST['Id'];
					$sql = "UPDATE jit_data SET CheckInTime=NULL WHERE Id=:Id ";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':Id', $Id);
					$stmt->execute();
					
					header('Content-Type: application/json');
					echo json_encode(array('success' => true, 'message' => 'บันทึกเรียบร้อย'));
				}catch(Exception $e){
					header('Content-Type: application/json');
				  $errors = "Error : " . $e->getMessage();
				  echo json_encode(array('success' => false, 'message' => $errors));
				} 
				break;
			default : 
				header('Content-Type: application/json');
				echo json_encode(array('success' => false, 'message' => 'Unknow action.'));				
		}
	}