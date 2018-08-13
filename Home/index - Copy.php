<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php include 'head.php'; ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
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
  
  
  <!-- Left side column. contains the logo and sidebar -->
   <?php include 'leftside.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		ลงทะเบียนผู้มารับพระราชทานหมวกกับผ้าพันคอ
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
              <h3 class="box-title">ลงทะเบียนผู้มารับพระราชทานหมวกกับผ้าพันคอ : <?=$s_userId; ?></h3>

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
              <div class="row">                
                    <form id="form1" action="Preview.php" method="post" class="form" validate>
					
					<input type="hidden" name="action" value="add" />
					
					<div class="form-group row">	
						<div class="col-md-6">
							<label for="barcode" class="col-md-6  col-form-label">รหัสหน่วย</label>
							<div class="col-md-6">
							  <input type="text" name="barcode" id="barcode" class="form-control" id="inputEmail3" placeholder="9999">
							</div>
						</div>	
						
					  </div>
					  <div class="form-group row">	
						<div class="col-md-6">
							<label for="groupName" class="col-md-6  col-form-label">หน่วย</label>
							<div class="col-md-6">
							  <label name="groupName" id="groupName">กรมสารบรรณหทาร</label>
							</div>
						</div>	
						</div>	
					 <div class="form-group row">	
						<div class="col-md-6">
							<label for="qtyMax" class="col-md-6  col-form-label">จำนวน ลงทะเบียนจาก มท</label>
							<div class="col-md-6">
							  <input type="text" name="qtyMax" id="qtyMax" class="form-control" id="inputEmail3" placeholder="9999">
							</div>
						</div>	
						
					  </div>
					  <div class="form-group row">	
						<div class="col-md-6">
							<label for="qty" class="col-md-6  col-form-label">จำนวน มาลงทะเบียน</label>
							<div class="col-md-6">
							  <input type="text" name="qty" id="qty" class="form-control" id="inputEmail3" placeholder="9999">
							</div>
						</div>	
						
					  </div>
						

					</div><!--col-md-6-->
							
                    </form>
					<!--form1-->
                </div>
                <!--/.row-->  
            </div> 
			<!-- /.box-body -->
			

	



	
	
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
			url: 'IndexAjax.php',
			data: params,
			dataType: 'json'
		}).done(function (data) {					
			if (data.success){ 				
				//alert(data);								
				itm=$.parseJSON(data.data);
				if (data.rowCount==1) {
					$('#groupName').text(itm.name);
					$('#qtyMax').val(itm.qtyMax);									
					
					$('#qty').val('0').focus().select();
				}else{
					$('#groupName').text('Null');
					$('#qtyMax').val('0');									
					
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
		var params = {
			action: 'save',
			barcode: $('#barcode').val(),
			qtyMax: $('#qtyMax').val(),
			qty: $('#qty').val()
		}; //alert(params.barcode);
		/* Send the data using post and put the results in a div */
		if(params.barcode==""){ alert('โปรดระบุรหัสบาร์โค๊ด (Barcode)'); return false; }
		if(params.qty==""){ alert('โปรดระบุ จำนวน'); return false; }
		$.post({
			url: 'IndexAjax.php',
			data: params,
			dataType: 'json'
		}).done(function (data) {					
			if (data.success){ 	
				alert(data);
				$itm=$.parseJSON(data.itm);
				//$('#lblResult').text('');
				
				
				$('#fullname').text($itm.fullname);
				$('#group').text($itm.groupName);
				$('#position').text($itm.position);
				$('#lblCoupon').text('Coupon : '+$itm.coupon);
				$('#img').prop('src','images/person/'+$itm.photo);	
				
				/*$('#lblResult').html('');
				if($itm.isCount==1){
					$('#lblResult').html('<span style="color: green;">ลงทะเบียนแล้ว</span>');
					$('#btn_cancel').attr('data-id',$('#barcode').val());
					$('#btn_cancel').attr('data-name',$('#fullname').text());		
					$('#btn_cancel').text('ยกเลิก '+$('#fullname').text());
					$('#btn_cancel').css('display','block');
				}else{
					$('#btn_cancel').css('display','none');
					$('#lblResult').html('<span style="color: red;">ยังไม่ได้ลงทะเบียน</span>');
				}*/					
				$('#Qty').focus();
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
	$('#qty').keyup(function(e){
		if(e.keyCode == 13)
		{	
			save();
		}/* e.keycode=13 */	
	});
});
//doc ready
</script>


</body>
</html>
	