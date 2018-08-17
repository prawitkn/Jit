
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php include 'head.php'; 
$rootPage = 'User';
$tb = $dtPrefix."user";
?>	<!-- head.php included session.php! -->
 
    
 </head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">   

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
		ลงทะเบียนผู้มารับพระราชทานหมวกกับผ้าพันคอ [ผู้ใช้งานระบบ : <?=$s_userFullname;?> ]
      </h1>
	  <ol class="breadcrumb">
        <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> หน้าแรก</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<!-- To allow only admin to access the content -->      
    <div class="box box-primary">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">สรุปยอด</h3>
		
		
        <div class="box-tools pull-right">
          <!-- Buttons, labels, and many other things can be placed here! -->
          <!-- Here is a label for example -->
          <?php
                //$sql_user = "SELECT COUNT(*) AS COUNTUSER FROM wh_user";
               // $result_user = mysqli_query($link, $sql_user);
               // $count_user = mysqli_fetch_assoc($result_user);
				
				$search_word="";
                $sql = "
				SELECT hdr.code, hdr.name, hdr.qtyMax
				,(SELECT SUM(x.qty) FROM jit_data x WHERE x.GroupId=hdr.Id) AS qtyCheckIn
				FROM jit_group hdr ";
				if(isset($_GET['search_word']) and isset($_GET['search_word'])){
					$search_word=$_GET['search_word'];
					$sql .= "and (hdr.userFullname like '%".$_GET['search_word']."%' ) ";
				}
				$sql.="GROUP BY hdr.code, hdr.name, hdr.qtyMax ";
				if(isset($_GET['search_word']) and isset($_GET['search_word'])){
					$search_word=$_GET['search_word'];
					$sql .= "and (hdr.name like '%".$_GET['search_word']."%' ) ";
				}
				$stmt = $pdo->prepare($sql);	
				$stmt->execute();			
				$countTotal=$stmt->rowCount();

				$rows=500;
				$page=0;
				if( !empty($_GET["page"]) and isset($_GET["page"]) ) $page=$_GET["page"];
				if($page<=0) $page=1;
				$total_data=$countTotal;
				$total_page=ceil($total_data/$rows);
				if($page>=$total_page) $page=$total_page;
				$start=($page-1)*$rows;
				if($start<0) $start=0;		
          ?>
          <span class="label label-primary">Total <?php echo $total_data; ?> items</span>
        </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
			<div class="row col-md-12">	
			
           
            <div class="col-md-8 table-responsive">
        	<?php
				$sql = "
				SELECT hdr.code, hdr.name, hdr.qtyMax
				,(SELECT SUM(x.qty) FROM jit_data x WHERE x.GroupId=hdr.Code) AS qtyCheckIn
				FROM jit_group hdr ";
				if(isset($_GET['search_word']) and isset($_GET['search_word'])){
					$search_word=$_GET['search_word'];
					$sql .= "and (hdr.userFullname like '%".$_GET['search_word']."%' ) ";
				}
				$sql.="GROUP BY hdr.code, hdr.name, hdr.qtyMax ";
				$sql .= "ORDER BY hdr.code, hdr.name  ASC
						LIMIT $start, $rows 
				";		
                //$result = mysqli_query($link, $sql);
				$stmt = $pdo->prepare($sql);	
				$stmt->execute();	
                
           ?> 
            <table class="table table-hover">
                <thead><tr style="background-color: #ffff80;">
					<th style="text-align: center;">ลำดับ</th>			
                    <th style="text-align: center;">รหัส</th>	
                    <th style="text-align: center;">หน่วย</th>					
                    <th style="text-align: center;">ยอดลงทะเบียนจาก มท.</th>
					<th style="text-align: center;">เข้าร่วมพิธี</th>
					<th style="text-align: center;">ไม่เข้าร่วมพิธี</th>
                </tr></thead>
                <?php $c_row=($start+1); while ($row = $stmt->fetch()) { 
						?>
                <tr>
					<td style="text-align: center;">
                         <?= $c_row; ?>
                    </td>
                    <td>
                         <?= $row['code']; ?>
                    </td>
                    <td>
                         <?= $row['name']; ?>
                    </td>
                    <td style="text-align: center;">
                         <?= $row['qtyMax']; ?>
                    </td>			
                    <td style="text-align: center;">
                         <?= $row['qtyCheckIn']; ?>
                    </td>				
                    <td style="text-align: center;">
                         <?= $row['qtyMax']-$row['qtyCheckIn']; ?>
                    </td>
                </tr>
                <?php $c_row+=1; } ?>
            </table>
				
			<nav>
			<ul class="pagination">
				<li <?php if($page==1) echo 'class="disabled"'; ?> >
					<a href="<?=$rootPage;?>.php?search_word=<?= $search_word;?>&=page=<?= $page-1; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
				</li>
				<?php for($i=1; $i<=$total_page;$i++){ ?>
				<li <?php if($page==$i) echo 'class="active"'; ?> >
					<a href="<?=$rootPage;?>.php?search_word=<?= $search_word;?>&page=<?= $i?>" > <?= $i;?></a>			
				</li>
				<?php } ?>
				<li <?php if($page==$total_page) echo 'class="disabled"'; ?> >
					<a href="<?=$rootPage;?>.php?search_word=<?= $search_word;?>&page=<?=$page+1?>" aria-labels="Next"><span aria-hidden="true">&raquo;</span></a>
				</li>
			</ul>
			</nav>
			
			</div>
			<!--/.col-md-8-->

			<div class="col-md-4">
				<?php
					$sql = "
					SELECT left(hdr.code,1) as code, sum(hdr.qtyMax) as qtyMax 
					,(SELECT SUM(x.qty) FROM jit_data x WHERE left(x.GroupId,1)=left(hdr.code,1)) AS qtyCheckIn
					FROM jit_group hdr ";
					if(isset($_GET['search_word']) and isset($_GET['search_word'])){
						$search_word=$_GET['search_word'];
						$sql .= "and (hdr.userFullname like '%".$_GET['search_word']."%' ) ";
					}
					$sql.="GROUP BY left(hdr.code,1) ";
					$sql .= "ORDER BY left(hdr.code,1)  ASC
							LIMIT $start, $rows 
					";		
	                //$result = mysqli_query($link, $sql);
					$stmt = $pdo->prepare($sql);	
					$stmt->execute();	
	                
	           ?> 
	            <table class="table table-hover">
	                <thead><tr style="background-color: #80ffff;">
						<th style="text-align: center;">ลำดับ</th>		
	                    <th style="text-align: center;">หน่วย</th>					
	                    <th style="text-align: center;">ยอดลงทะเบียนจาก มท.</th>
						<th style="text-align: center;">เข้าร่วมพิธี</th>
						<th style="text-align: center;">ไม่เข้าร่วมพิธี</th>
	                </tr></thead>
	                <?php $c_row=($start+1); while ($row = $stmt->fetch()) { 
							?>
	                <tr>
						<td style="text-align: center;">
	                         <?= $c_row; ?>
	                    </td>
	                    <td>
	                    	<?php switch($row['code']){
	                    		case '1' : echo 'สป.'; break;
	                    		case '2' : echo 'ทท.'; break;
	                    		case '3' : echo 'ทบ.'; break;
	                    		case '4' : echo 'ทร.'; break;
	                    		case '5' : echo 'ทอ.'; break;
	                    		default : echo 'อื่นๆ'; 
	                    	} ?>	                    	
	                    </td>
	                    <td style="text-align: center;">
	                         <?= $row['qtyMax']; ?>
	                    </td>			
	                    <td style="text-align: center;">
	                         <?= $row['qtyCheckIn']; ?>
	                    </td>				
	                    <td style="text-align: center;">
	                         <?= $row['qtyMax']-$row['qtyCheckIn']; ?>
	                    </td>
	                </tr>
	                <?php $c_row+=1; } ?>
	            </table>
			</div>
			<!--/.col-md-2-->
		</div>
		<!--/.row col-md-12-->
    </div><!-- /.box-body -->
  <div class="box-footer">
      
      
    <!--The footer of the box -->
  </div><!-- box-footer -->
</div><!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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

<script src="bootstrap/js/smoke.min.js"></script>
<script>
$(document).ready(function() {
	$('a[name=btn_row_setActive]').click(function(){
		var params = {
			action: 'setActive',
			Id: $(this).attr('data-Id'),
			StatusId: $(this).attr('data-StatusId')			
		};
		$.smkConfirm({text:'Are you sure ?',accept:'Yes', cancel:'Cancel'}, function (e){if(e){
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
					location.reload();
				} else {
					alert(data.message);
					$.smkAlert({
						text: data.message,
						type: data.status
					//                        position:'top-center'
					});
				}
			}).error(function (response) {
				alert(response.responseText);
			}); 
		}});
		e.preventDefault();
	});
	//end btn_row_setActive
	
	$('a[name=btn_row_remove]').click(function(){
		var params = {
			action: 'remove',
			Id: $(this).attr('data-Id')
		};
		$.smkConfirm({text:'Are you sure to Remove ?',accept:'Yes', cancel:'Cancel'}, function (e){if(e){
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
					location.reload();
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
	//end btn_row_remove
	
	$('a[name=btn_row_delete]').click(function(){
		var params = {
			action: 'delete',
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
					location.reload();
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
	//end btn_row_delete
});
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
