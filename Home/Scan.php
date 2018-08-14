<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php include 'head.php'; ?>

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<?php 
function thaiDateToSqlDate($thai_date){
    if(strlen($thai_date) != 10){
        return null;
    }else{
        $new_date = explode('/', $thai_date);

        $new_y = (int)$new_date[2] - 543;
        $new_m = $new_date[1];
        $new_d = $new_date[0];

        $mysql_date = $new_y . '-' . $new_m . '-' . $new_d;

        return $mysql_date;
    }
}
function sqlDateToThaiDate($sqlDate){
    $sqlDate = trim($sqlDate);        
    if(strlen($sqlDate) != 10){
        return null;
    }else{
        //$new_datetime = explode(' ', $mysql_datetime);
        //$sqlDateDate=$new_datetime[0];
        $new_date = explode('-', $sqlDate);

        $new_y = (int) $new_date[0] + 543;
        $new_m = $new_date[1];
        $new_d = $new_date[2];
        
        $thai_date = $new_d . '/' . $new_m . '/' . $new_y;
        return $thai_date;
    }
}
?>

<div class="wrapper">

  <!-- Main Header -->
  <?php include 'header.php'; ?>
    <?php 
  		$rootPage="Scan"; 
  ?>
  
  
  <!-- Left side column. contains the logo and sidebar -->
   <?php include 'leftside.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		ลงทะเบียนผู้มารับพระราชทานหมวกกับผ้าพันคอ  [ผู้ใช้งานระบบ : <?=$s_userFullname;?> ]
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> หน้าแรก</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

	
	<div class="box box-primary">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">ลงทะเบียนรับคิว</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <div class="row col-md-12">                
                <form id="form1" action="Preview.php" method="post" class="form" validate>
				
				<input type="hidden" name="action" value="add" />
				<input type="hidden" name="qtyRemain" id="qtyRemain" value="0" />
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group row">	
							<label for="barcode" class="col-md-6  col-form-label">รหัสหน่วย</label>
							<div class="col-md-6">
							<input type="text" name="barcode" id="barcode" class="form-control" id="inputEmail3" placeholder="9999">
							</div>
						</div>

						<div class="form-group row">	
							<label for="groupName" class="col-md-6  col-form-label">หน่วย</label>
							<div class="col-md-6">
							<label name="groupName" id="groupName">ชื่อหน่วย</label>
							</div>
						</div>

						<div class="form-group row">	
							<label for="qtyMax" class="col-md-6  col-form-label">จำนวน ลงทะเบียนจาก มท</label>
							<div class="col-md-6">
							<label name="qtyMax" id="qtyMax">0 / 0</label>
							</div>
						</div>

						<div class="form-group row">	
							<label for="remark" class="col-md-6  col-form-label">หมายเลขโทรศัพท์ผู้ควบคุมยอดครั้งนี้</label>
							<div class="col-md-6">
							<input type="text" name="remark" id="remark" class="form-control" placeholder="0987654321">
							</div>						
						</div>

						<div class="form-group row">	
							<label for="qty" class="col-md-6  col-form-label">จำนวน มาลงทะเบียนครั้งนี้</label>
							<div class="col-md-6">
							<input type="text" name="qty" id="qty" class="form-control" placeholder="9999">
							</div>		
						</div>
					</div>

					<div class="col-md-6">
						<div id="result" class="col-md-12">
							<?php 
							$sql = "SELECT jd.`Id`, jd.`GroupId`, jd.`Qty`, `QueueTime`, jd.`Remark`, jd.`CreateTime`, jd.`CreateUserId`, jd.`CheckInTime`, jd.`CheckInUserId` 
								,jg.Name as GroupName, jg.qtyMax 
								FROM `jit_data` jd 
								INNER JOIN jit_group jg ON jg.Code=jd.GroupId 
								WHERE jd.CreateUserId=:CreateUserId
								ORDER BY CreateTime DESC 
								LIMIT 3
								";
								$stmt = $pdo->prepare($sql);
								$stmt->bindParam(':CreateUserId', $s_userId);
								$stmt->execute();
								while ( $row=$stmt->fetch() ) {
								  echo '<div class="alert alert-success alert-dismissible">'.
								'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.
								'<h4><i class="icon fa fa-check"></i> เรียบร้อย!&nbsp;&nbsp;&nbsp;'.$row['GroupName'].' : '.$row['Qty'].' นาย</h4>'.
								'ลำดับที่ : <span style="font-size: 24pt;">'.$row['Id'].'</span>&nbsp;&nbsp;&nbsp;'.
								'เวลาพร้อม : <span style="font-size: 24pt;">'.date('H:i',strtotime($row['QueueTime'])).'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
								'<a href="#" name="btnDelete" class="btn btn-danger"  data-Id="'.$row['Id'].'" ><i class="fa fa-trash"></i> ลบ</a>'.
							  '</div>';
								}
							?>
							

						</div><!--col-md-6-->
					</div>
					<!--col-md-6-->

				</div>
				<!--row-->

                </form>
				<!--form1-->
                </div>
                <!--/.row-->  
            </div> 
			<!-- /.box-body -->
			
			<div class="box-footer">
			</div>
			<!--/box-footer-->
		</div>
		<!--box-->


	
	
	</section>
	<!--sec.content-->
	
	</div>
	<!--content-wrapper-->

  <!-- Main Footer -->
  <?php include'footer.php'; ?>
  
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- smoke validate -->
<script src="bootstrap/js/smoke.min.js"></script>

<script>
$(document).ready(function() {
	function getBarcode(){
		var params = {
			action: 'getBarcode',
			barcode: $('#barcode').val()
		}; //alert(params.barcode);
		/* Send the data using post and put the results in a div */
		if(params.barcode==""){ alert('โปรดระบุรหัสบาร์โค๊ด (Barcode)'); return false; }
		$.post({
			url: 'ScanAjax.php',
			data: params,
			dataType: 'json'
		}).done(function (data) {					
			if (data.success){ 				
				//alert(data.rowCount);								
				itm=$.parseJSON(data.data);
				if (data.rowCount==1) {					
					$('#qtyRemain').val(itm.qtyMax-itm.qtyPrev);	
					$('#groupName').text(itm.Name);
					$('#qtyMax').text(""+itm.qtyMax+' / '+itm.qtyPrev);							
					
					$('#remark').select();
				}else{
					$('#groupName').text('Null');
					$('#qtyMax').text('0 / 0');		
					$('#qtyRemain').val(0);									
					
					$('#barcode').focus().select();
				}				
			} else {
				alert(data.message);
				$('#barcode').select();
			}
		}).error(function (response) {
			alert(response.responseText);
		}); 
	}//.getGroup

	function getData(){
		var params = {
			action: 'getData',
			Id: $('#Id').val()
		}; //alert(params.barcode);
		/* Send the data using post and put the results in a div */
		if(params.barcode==""){ alert('โปรดระบุรหัส (Id)'); return false; }
		$.post({
			url: 'ScanAjax.php',
			data: params,
			dataType: 'json'
		}).done(function (data) {					
			if (data.success){ 				
				//alert(data.rowCount);								
				itm=$.parseJSON(data.data);
				if (data.rowCount==1) {					
					$('#qtyRemain').val(itm.qtyPrev);	
					$('#groupName').text(itm.Name);
					$('#qtyMax').text(""+itm.qtyMax+' / '+itm.qtyPrev);							
					
					$('#remark').select();
				}else{
					$('#groupName').text('Null');
					$('#qtyMax').text('0 / 0');		
					$('#qtyRemain').val(itm.qtyPrev);									
					
					$('#barcode').focus().select();
				}				
			} else {
				alert(data.message);
				$('#barcode').select();
			}
		}).error(function (response) {
			alert(response.responseText);
		}); 
	}//.getGroup
	
	function save(){
		if( parseInt($('#qtyRemain').val(),10) < parseInt($('#qty').val(),10) ){
			alert('ไม่สามารถลงทะเบียนเกินยอดคงเหลือได้');
			$('#qty').focus().select();
			return false;
		}
		var params = {
			action: 'save',
			barcode: $('#barcode').val(),
			groupName: $('#groupName').text(),
			qtyMax: $('#qtyMax').val(),
			qty: $('#qty').val(),
			remark: $('#remark').val()
		}; //alert(params.barcode);
		/* Send the data using post and put the results in a div */
		if(params.barcode==""){ alert('โปรดระบุรหัสบาร์โค๊ด (Barcode)'); return false; }
		if(params.qty=="" || params.qty=="0"){ alert('โปรดระบุ จำนวน'); return false; }
		$.post({
			url: 'ScanAjax.php',
			data: params,
			dataType: 'json'
		}).done(function (data) {					
			if (data.success){ 	
				//alert(data.rowCount);				
				$html='<div class="alert alert-success alert-dismissible">'+
						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
						'<h4><i class="icon fa fa-check"></i> เรียบร้อย!&nbsp;&nbsp;&nbsp;'+
						params.groupName+' : '+params.qty+' นาย</h4>'+
						'ลำดับที่ : <span style="font-size: 24pt;">'+data.lastInsertId+'</span>&nbsp;&nbsp;&nbsp;'+
						'เวลาพร้อม : <span style="font-size: 24pt;">'+data.queueTime+'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
						'<a href="#" name="btnDelete" class="btn btn-danger"  data-Id="'+data.lastInsertId+'" ><i class="fa fa-trash"></i> ลบ</a>'+
					  '</div>';
				$($html).hide().prependTo("#result").fadeIn("slow");		  
				$( "#result div:nth-child(4)" ).fadeOut('slow');
				//$itm=$.parseJSON(data.itm);
				
				$('#barcode').focus().select();
			} else {
				alert(data.message);
				$('#barcode').select();
			}
		}).error(function (response) {
			alert(response.responseText);
		}); 
	}//.getGroup
	
	$('#barcode').select();
	
	$('#barcode').keyup(function(e){
		if(e.keyCode == 13)
		{	
			getBarcode();
		}/* e.keycode=13 */	
	});
	
	$('#remark').keyup(function(e){
		if(e.keyCode == 13)
		{	
			$('#qty').val('0').focus().select();
		}/* e.keycode=13 */	
	});		

	$('#qty').keyup(function(e){
		if(e.keyCode == 13)
		{	
			save();
		}/* e.keycode=13 */	
	});
	
	$('#result').on( 'click', 'a[name=btnDelete]' ,function(){
		var params = {
			action: 'deleteItem',
			Id: $(this).attr('data-Id')
		};
		$.smkConfirm({text:'คุณต้องการลบข้อมูลหรือไม่ ?',accept:'ลบข้อมูล', cancel:'ยกเลิก'}, function (e){if(e){
			$.post({
				url: 'ScanAjax.php',
				data: params,
				dataType: 'json'
			}).done(function (data) {					
				if (data.status === "success"){ 
					$.smkAlert({
						text: data.message,
						type: data.status,
						position:'top-center'
					});
					//$(this).parent().fadeOut();
					//location.reload();
				} else {
					alert(data.message);
					$.smkAlert({
						text: data.message,
						type: data.status
					});
				}
			}).error(function (response) {
				alert(response.responseText);
			}); 
		}});
		e.preventDefault();
	});
});
//doc ready
</script>


</body>
</html>
	