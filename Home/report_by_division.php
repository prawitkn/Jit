<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php	include 'head.php'; ?>    

<div class="wrapper">
  <!-- Main Header -->
  <?php include 'header.php'; 
  
  $rootPage="report_by_division";
  ?>  
  
  <!-- Left side column. contains the logo and sidebar -->
   <?php include 'leftside.php'; ?>
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><i class="glyphicon glyphicon-list"></i>
       Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=$rootPage;?>.php"><i class="glyphicon glyphicon-list"></i>Report</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <!-- Your Page Content Here -->
    <div class="box box-primary">
        <div class="box-header with-border">
		<label class="box-title">Grade Report</label>
		
        <div class="box-tools pull-right">
          <!-- Buttons, labels, and many other things can be placed here! -->
          <!-- Here is a label for example -->
          <?php
				$search_word="";
				
				$sqlSearch = "";
				if(isset($_GET['search_word']) and isset($_GET['search_word'])){
					$search_word=$_GET['search_word'];
					$sqlSearch = "and (a.code like '%".$_GET['search_word']."%' OR a.name like '%".$_GET['search_word']."%') ";
				}
				$sql = "SELECT count(*) as countTotal
				FROM topics dtl						
				LEFT JOIN topic_groups tg ON tg.id=dtl.topic_group_id 
				WHERE 1 ";
				if(isset($_GET['position_group_id'])) $sql.="AND dtl.position_group_id=:position_group_id "; 
				if(isset($_GET['topic_group_id'])) $sql.="AND dtl.topic_group_id=:topic_group_id ";
				
				$stmt = $pdo->prepare($sql);				
				if(isset($_GET['position_group_id'])) $stmt->bindParam(':position_group_id', $_GET['position_group_id']);
				if(isset($_GET['topic_group_id'])) $stmt->bindParam(':topic_group_id', $_GET['topic_group_id']);
				$stmt->execute();
				
				$rows=20;
				$page=0;
				if( !empty($_GET["page"]) and isset($_GET["page"]) ) $page=$_GET["page"];
				if($page<=0) $page=1;
				$total_data=$stmt->fetch()['countTotal'];
				$total_page=ceil($total_data/$rows);
				if($page>=$total_page) $page=$total_page;
				$start=($page-1)*$rows;
				if($start<0) $start=0;
          ?>
          <span class="label label-primary">Total <?php echo $total_data; ?> items</span>
        </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
			<div class="row">
			<div class="col-md-12">					
                    <form id="form1" action="<?=$rootPage;?>.php" method="get" class="form" novalidate>
						<div class="row col-md-4">
							<div class="form-group">
							<label for="position_group_id">Division : </label>   
							<select name="position_group_id" class="form-control"  data-smk-msg="Require Location Type" required >
								<option value="" <?php echo (null==""?'selected':''); ?> >--All Division--</option>
								<?php
								$sql = "SELECT `id`, `name` FROM divisions ";
								$stmt = $pdo->prepare($sql);
								$stmt->execute();					
								while ($optItm = $stmt->fetch()){
									$selected="";//($position_group_id==$optItm['code']?'selected':'');						
									echo '<option value="'.$optItm['id'].'" '.$selected.'>'.$optItm['id'].' : '.$optItm['name'].'</option>';
								}
								?>
							</select>
							</div>
						</div>
						
						<div class="row col-md-2">
							<div class="form-group">
							<label for="locationCode">.</label>   
							<input type="submit" class="form-control btn-primary" value="Submit" />
							</div>
						</div>
                    </form>
                </div>    
			</div>
			
			<div class="row col-md-12">	
				<div class="pull-right">
					<a href="<?=$rootPage;?>_add.php" class="btn btn-default"><i class="glyphicon glyphicon-save"></i> Grade Export (Excel)</a>
					<a href="<?=$rootPage;?>_add.php" class="btn btn-default"><i class="glyphicon glyphicon-save"></i> Name Export (PDF)</a>
				</div>
			</div>
			
           <?php
			 $sql = "SELECT dtl.*
			, dp.name as position_name 
			FROM persons dtl						
			LEFT JOIN division_positions dp ON dp.id=dtl.position_id ";
			if(isset($_GET['division_id'])) $sql.="ON dp.division_id=:division_id "; 
			$sql.="WHERE 1 ";
			
			$sql.="ORDER BY dtl.id desc ";
			$sql.="LIMIT $start, $rows "; 
			
			$stmt = $pdo->prepare($sql);				
			if(isset($_GET['position_group_id'])) $stmt->bindParam(':position_group_id', $_GET['position_group_id']);
			if(isset($_GET['topic_group_id'])) $stmt->bindParam(':topic_group_id', $_GET['topic_group_id']);
			$stmt->execute();            
           ?>             
            <table class="table table-striped">
                <tr>
                    <th>No.</th>	
					<th>Fullname</th>
					<th>Position</th>
                    <th>Grade</th>
                </tr>
                <?php $c_row=($start+1); while ($row = $stmt->fetch() ) { 
					$img = 'dist/img/avatar5.png';
				?>
                <tr>
                    <td>
                         <?= $c_row; ?>
                    </td>			
					<td>
                         <?= $row['fullname']; ?>
                    </td>	
					<td>
						 <?= $row['position_name']; ?>
					</td>	
					<td>
						 <?php if($c_row<=2){echo 'A';}else{echo 'B';} ?>
					</td>
                </tr>
                <?php $c_row +=1; } ?>
            </table>
			
			<nav>
			<ul class="pagination">
				<li <?php if($page==1) echo 'class="disabled"'; ?> >
					<a href="<?$rootPage;?>.php?search_word=<?= $search_word;?>&=page=<?= $page-1; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
				</li>
				<?php for($i=1; $i<=$total_page;$i++){ ?>
				<li <?php if($page==$i) echo 'class="active"'; ?> >
					<a href="<?$rootPage;?>.php?search_word=<?= $search_word;?>&page=<?= $i?>" > <?= $i;?></a>			
				</li>
				<?php } ?>
				<li <?php if($page==$total_page) echo 'class="disabled"'; ?> >
					<a href="<?$rootPage;?>.php?search_word=<?= $search_word;?>&page=<?=$page+1?>" aria-labels="Next"><span aria-hidden="true">&raquo;</span></a>
				</li>
			</ul>
			</nav>
			
			
        </div><!-- /.box-body -->
  <div class="box-footer">
      
      
    <!--The footer of the box -->
  </div><!-- box-footer -->
</div><!-- /.box -->

	<div id="spin"></div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include'footer.php'; ?>  
  
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<!--Deprecation Notice: The jqXHR.success(), jqXHR.error(), and jqXHR.complete() callbacks are removed as of jQuery 3.0. 
    You can use jqXHR.done(), jqXHR.fail(), and jqXHR.always() instead.-->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- smoke validate -->
<script src="bootstrap/js/smoke.min.js"></script>
<!-- Add Spinner feature -->
<script src="bootstrap/js/spin.min.js"></script>


<script> 		
$(document).ready(function() {    
	//.ajaxStart inside $(document).ready to start and stop spiner.  
	$( document ).ajaxStart(function() {
		$("#spin").show();
	}).ajaxStop(function() {
		$("#spin").hide();
	});
	//.ajaxStart inside $(document).ready END
	
	$("#title").focus();
	var spinner = new Spinner().spin();
	$("#spin").append(spinner.el);
	$("#spin").hide();
			
	  
			   
	$('a[name=btn_row_setActive]').click(function(){
		var params = {
			action: 'setActive',
			id: $(this).attr('data-id'),
			statusCode: $(this).attr('data-statusCode')			
		};
		$.smkConfirm({text:'Are you sure ?',accept:'Yes', cancel:'Cancel'}, function (e){if(e){
			$.post({
				url: '<?=$rootPage;?>_ajax.php',
				data: params,
				dataType: 'json'
			}).done(function (data) {					
				if (data.success){ 
					$.smkAlert({
						text: data.message,
						type: 'success',
						position:'top-center'
					});
					location.reload();
				} else {
					alert(data.message);
					$.smkAlert({
						text: data.message,
						type: 'danger'//,
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
			id: $(this).attr('data-id')
		};
		$.smkConfirm({text:'Are you sure to Remove ?',accept:'Yes', cancel:'Cancel'}, function (e){if(e){
			$.post({
				url: '<?=$rootPage;?>_ajax.php',
				data: params,
				dataType: 'json'
			}).done(function (data) {					
				if (data.success){ 
					$.smkAlert({
						text: data.message,
						type: 'success',
						position:'top-center'
					});
					location.reload();
				} else {
					alert(data.message);
					$.smkAlert({
						text: data.message,
						type: 'danger'//,
					//                        position:'top-center'
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
			id: $(this).attr('data-id')
		};
		$.smkConfirm({text:'Are you sure to Delete ?',accept:'Yes', cancel:'Cancel'}, function (e){if(e){
			$.post({
				url: '<?=$rootPage;?>_ajax.php',
				data: params,
				dataType: 'json'
			}).done(function (data) {					
				if (data.success){ 
					$.smkAlert({
						text: data.message,
						type: 'success',
						position:'top-center'
					});
					location.reload();
				} else {
					alert(data.message);
					$.smkAlert({
						text: data.message,
						type: 'danger'//,
					//                        position:'top-center'
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

</body>
</html>
