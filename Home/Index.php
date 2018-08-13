<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php 
	include 'head.php'; 
?>

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- Main Header -->
  <?php include 'header.php'; ?>
  
  <!-- Left side column. contains the logo and sidebar -->
   <?php include 'leftside.php'; ?>
   <?php
	$rootPage = 'Index';
	$tb="";
   ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-home"></i>
       หน้าแรก
        <small></small>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?=$rootPage;?>.php"><i class="glyphicon glyphicon-list"></i>หน้าแรก</a></li>
		<!--<li><a href="#"><i class="glyphicon glyphicon-edit"></i>View</a></li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
	<div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">ลำดับคิว</h3>
        <div class="box-tools pull-right">
          <!-- Buttons, labels, and many other things can be placed here! -->
          <!-- Here is a label for example -->
         
        </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">  
        	<div class="row col-md-12">
        		<div class="col-md-8">
					<table id="tblData" class="table table-striped">
						<thead>
							<td>ลำดับที่</td>
							<td>หน่วย</td>
							<td>จำนวน ลงทะเบียน</td>
							<td>คิวที่</td>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-md-4">
					<div class="row col-md-12">
						<div class="col-md-8">ยอดจาก ทม. ทั้งหมด</div>
						<div class="col-md-4"><label id="lblTotal" class="pull-right">0</label></div>
						<div class="col-md-8">ยังไม่ได้ลงทะเบียนรับคิว</div>
						<div class="col-md-4"><label id="lblUnRegister" class="pull-right">0</label></div>
						<div class="col-md-8">.</div>
						<div class="col-md-4"><label id="" class="pull-right">.</label></div>
						<div class="col-md-8">ลงทะเบียนรับคิวแล้ว</div>
						<div class="col-md-4"><label id="lblRegister" class="pull-right">0</label></div>
						<div class="col-md-8">รับคิว และเข้าร่วมพิธีแล้ว</div>
						<div class="col-md-4"><label id="lblCheckIn" class="pull-right">0</label></div>
						<div class="col-md-8">รับคิว และรอเรียกเข้าร่วมพิธี</div>
						<div class="col-md-4"><label id="lblUnCheckIn" class="pull-right">0</label></div>
					</div>
				</div>
     		</div>
     		<!--row col-md-12-->
        </div>
		<!--.body-->    
    </div>
	<!-- /.box box-primary -->
	

	</section>
	<!--sec.content-->
	
	</div>
	<!--content-wrapper-->

</div>
<!--warpper-->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<script src="bootstrap/js/smoke.min.js"></script>

<!-- Add Spinner feature -->
<script src="bootstrap/js/spin.min.js"></script>



<script> 
$(document).ready(function() {
	$('#barcode').select();
	
	//setTimeout(function(){ getList(); }, 5000);
	
	//setInterval( getList(), 5000);
	
	
	function getList(){		
		var params = {
			action: 'getData'
		}; //alert(params.sendDate);
		/* Send the data using post and put the results in a div */
		  $.ajax({
			  url: "IndexAjax.php",
			  type: "post",
			  data: params,
			datatype: 'json',
			  success: function(data){	//alert(data);
					//data=$.parseJSON(data);
					var sumInviteTotal=0;
					var sumCountTotal=0;
					var sumPendingTotal=0;
					//alert(data);
					//alert(data.rowCount);
					switch(data.rowCount){
						case 0 : alert('Data not found.');
							//$('#tbl_items tbody').empty();
							return false; break;
						default : 							
							//$('#tbl_items tbody').empty();
							$('#tblData tbody').fadeOut('slow').empty();
							$rowNo=1;
							$.each($.parseJSON(data.data), function(key,value){
								$('#tblData').append(
									'<tr><td>'+$rowNo+'</td>'+
									'<td>'+value.GroupName+'</td>'+
									'<td>'+value.Qty+'</td>'+
									'<td>'+value.Id+'</td></tr>');
								$rowNo+=1;
							});
							$('#tblData tbody').fadeIn('slow');

							itm=$.parseJSON(data.data2);							
							qtyRemain=itm.totalQtyMax-itm.totalRegister;
							qtyCheckInRemain=itm.totalRegister-itm.totalCheckIn;
							$('#lblTotal').text(itm.totalQtyMax);
							$('#lblUnRegister').text(qtyRemain);
							$('#lblRegister').text(itm.totalRegister);
							$('#lblCheckIn').text(itm.totalCheckIn);
							$('#lblUnCheckIn').text(qtyCheckInRemain);
					}//.switch
			  }   
			}).error(function (response) {
				alert(response.responseText);
			}); 
	}
	
	getList();

	//setTimeout(function() {
    //    getList();
   // }, 10000);

});
//doc ready
</script>





</body>
</html>
