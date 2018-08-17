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
        <h3 class="box-title">ลำดับคิวการลงทะเบียนรับหมวกและผ้าพันคอพระราชทาน</h3>
        <div class="box-tools pull-right">
          <!-- Buttons, labels, and many other things can be placed here! -->
          <!-- Here is a label for example -->
         
        </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="font-size: 20px;">  
        	<div class="row col-md-12">
        		<div class="col-md-8">
        			<div class="row col-md-12" style="background-color: #ffff80; margin: 5px;">
					<table id="tblData" class="table table-striped">
						<thead>
							<tr>
							<td style="text-align: center;">ลำดับที่</td>
							<td style="text-align: center;">หน่วย</td>
							<td style="text-align: center;">จำนวน ลงทะเบียน</td>
							<td style="text-align: center; font-weight: bold; width: 150px; important!">คิวที่ / เวลา</td>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row col-md-12" style="background-color: #80ffff; margin: 5px;">
						<table id="tblSummary" width="100%">
							<thead>
							<tr>
								<td style="text-align: center;">รายการ</td>
								<td style="text-align: center;">จำนวน</td>
							</tr>
							</thead>
							<tbody>
								<tr>
									<td style="color: black;">ยอดลงทะเบียนจาก มท.</td>
									<td style="color: black; text-align: right;"><label id="lblTotal" class="pull-right">0</label></td>
								</tr>
								<tr>
									<td style="color: red;">ยังไม่ได้ลงทะเบียนรับคิว</td>
									<td style="color: red; text-align: right;"><label id="lblUnRegister" class="pull-right">0</label></td>
								</tr>
								<tr>
									<td style="color: red;"></td>
									<td style="color: red; text-align: right;">&nbsp;</td>
								</tr>
								<tr>
									<td style="color: green;">ลงทะเบียนรับคิวแล้ว</td>
									<td style="color: green; text-align: right;"><label id="lblRegister" class="pull-right">0</label></td>
								</tr>
								<tr>
									<td style="color: blue;">รับคิว และเข้าร่วมพิธีแล้ว</td>
									<td style="color: blue; text-align: right;"><label id="lblCheckIn" class="pull-right">0</label></td>
								</tr>
								<tr>
									<td style="color: #ff4dff;">รับคิว และรอเรียกเข้าร่วมพิธี</td>
									<td style="color: #ff4dff; text-align: right;"><label id="lblUnCheckIn" class="pull-right">0</label></td>
								</tr>
							</tbody>
						</table>
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
	
	<!-- Main Footer -->
  <?php include'footer.php'; ?>
  
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
	/**
	 * Number.prototype.format(n, x)
	 * 
	 * @param integer n: length of decimal
	 * @param integer x: length of sections
	 */
	Number.prototype.format = function(n, x) {
	    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
	    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
	};
	
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
									'<tr>'+
									'<td style="text-align: center;">'+$rowNo+'</td>'+
									'<td style="text-align: left;">'+value.GroupName+'</td>'+
									'<td style="text-align: center;">'+value.Qty+'</td>'+
									'<td style="text-align: center; font-weight: bold; font-size: 32px;"><span style="color: red;">'+value.Id+'</span> / <small>'+value.QueueTime+'</small></td></tr>');
								$rowNo+=1;
							});
							$('#tblData tbody').fadeIn('slow');

							$('#tblSummary tbody').fadeOut('slow');
							itm=$.parseJSON(data.data2);							
							qtyRemain=itm.totalQtyMax-itm.totalRegister;
							qtyCheckInRemain=itm.totalRegister-itm.totalCheckIn;
							$('#lblTotal').text(itm.totalQtyMax);
							$('#lblUnRegister').text(qtyRemain);
							$('#lblRegister').text(itm.totalRegister);
							$('#lblCheckIn').text(itm.totalCheckIn);
							$('#lblUnCheckIn').text(qtyCheckInRemain);							
							$('#tblSummary tbody').fadeIn('slow');

					}//.switch
			  }   
			}).error(function (response) {
				alert(response.responseText);
			}); 
	}
	
	getList();

    var counter = 0;
	var i = setInterval(function(){
	    // do your thing
	    getList();

	    counter++;
	    if(counter === 10) {
	        clearInterval(i);
	    }
	}, 20000);	//20Minute

});
//doc ready
</script>





</body>
</html>
