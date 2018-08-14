<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php include 'head.php'; ?>

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">

<div class="wrapper">

  <!-- Main Header -->
  <?php include 'header.php'; ?>
  <?php 
  		$rootPage="CheckIn"; 
  ?>
  
  
  <!-- Left side column. contains the logo and sidebar -->
   <?php include 'leftside.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		ลงทะเบียนผู้มารับพระราชทานหมวกกับผ้าพันคอ [ผู้ใช้งานระบบ : <?=$s_userFullname;?> ]
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
              <h3 class="box-title">บันทึกคิวเข้าร่วมพิธี</h3>

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
                <form id="form1" action="#" method="post" class="form" validate>
							
				<div class="row">
					<div class="col-md-6">
						<div class="form-group row">	
							<label for="barcode" class="col-md-6  col-form-label">คิวที่</label>
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
							<label name="remark" id="remark">-</label>
							</div>						
						</div>

						<div class="form-group row">	
							<label for="qty" class="col-md-6  col-form-label">จำนวน มาลงทะเบียนครั้งนี้</label>
							<div class="col-md-6">
							<input type="text" name="qty" id="qty" class="form-control" placeholder="9999">
							</div>		
						</div>

						<div class="form-group row">	
							<label for="barcode2" class="col-md-6  col-form-label">คิวที่ (เพื่อยืนยัน)</label>
							<div class="col-md-6">
							<input type="text" name="barcode2" id="barcode2" class="form-control" >
							</div>		
						</div>
					</div>

					<div class="col-md-6">
						<div id="result" class="col-md-12">
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
			url: 'CheckInAjax.php',
			data: params,
			dataType: 'json'
		}).done(function (data) {					
			if (data.success){ 				
				//alert(data.rowCount);								
				itm=$.parseJSON(data.data);
				if (data.rowCount==1) {					
					$('#groupName').text(itm.GroupName);	
					$('#qtyMax').text(itm.qtyMax);		
					$('#qty').val(itm.Qty);						
					
					$('#barcode2').select();
				}else{
					$('#groupName').text('-');	
					$('#qtyMax').text('-');		
					$('#qty').val('-');									
					
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
		if( $('#barcode').val()=="" ){ alert('โปรดระบุรหัส (ID) '); $('#barcode').select(); return false; }
		if( $('#qty').val()=="" || $('#qty').val()=="0" ){ alert('โปรดระบุจำนวน (Qty) '); $('#qty').select(); return false; }
		if( $('#barcode2').val()=="" ){ alert('โปรดระบุรหัสยืนยัน (ID2) '); $('#barcode2').select(); return false; }
		if( $('#barcode').val() != $('#barcode2').val() ){
			$.smkAlert({
				text: 'การทำงานผิดพลา รหัสยืนยันไม่ถูกต้อง.',
				type: 'Warning'
			});
			return false;
		}
		var params = {
			action: 'save',
			barcode: $('#barcode').val(),
			qty: $('#qty').val(),
			barcode2: $('#barcode2').val()
		}; //alert(params.barcode);		
		/* Send the data using post and put the results in a div */
		$.post({
			url: '<?=$rootPage;?>Ajax.php',
			data: params,
			dataType: 'json'
		}).done(function (data) {	
				//alert(data.success);				
			if (data.success){ 	
				$.smkAlert({
					text: data.message,
					type: 'success'
				});				
				$html='<div class="alert alert-success alert-dismissible">'+
						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
						'<h4><i class="icon fa fa-check"></i> เรียบร้อย!&nbsp;&nbsp;&nbsp;'+
						$('#groupName').text()+' : '+$('#qty').val()+' นาย</h4>'+
						'<a href="#" name="btnDelete" class="btn btn-danger"  data-Id="'+$('#barcode').val()+'" ><i class="fa fa-trash"></i> ย้อนกลับ</a>'+
					  '</div>';
						  
				$($html).hide().prependTo("#result").fadeIn("slow");		  
				$( "#result div:nth-child(4)" ).fadeOut('slow');
				//$itm=$.parseJSON(data.itm);
				
				$('#barcode').focus().select();
				
				//$itm=$.parseJSON(data.itm);
				
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
	
	$('#remark').keyup(function(e){
		if(e.keyCode == 13)
		{	
			$('#qty').val('0').focus().select();
		}/* e.keycode=13 */	
	});		

	$('#qty').keyup(function(e){
		if(e.keyCode == 13)
		{	
			$('#barcode2').val('0').focus().select();
		}/* e.keycode=13 */	
	});

	$('#barcode2').keyup(function(e){
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
		$.smkConfirm({text:'Are you sure to Delete ?',accept:'Yes', cancel:'Cancel'}, function (e){if(e){
			$.post({
				url: '<?=$rootPage;?>Ajax.php',
				data: params,
				dataType: 'json'
			}).done(function (data) {					
				if (data.status === "success"){ 
					$.smkAlert({
						text: data.message,
						type: data.status,
						position:'top-center'
					});
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
	