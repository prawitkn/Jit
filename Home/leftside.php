<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu ">
		<li class="header">เมนู</li>    
    <li><a href="Scan.php?"><i class="fa fa-barcode"></i> <span>ลงทะเบียน</span></a></li> 
    <li><a href="CheckIn.php?"><i class="fa fa-arrow-down"></i> <span>บันทึกเข้าร่วมพิธี</span></a></li> 
    <li><a href="RptSummary.php?"><i class="fa fa-file"></i> <span>สรุปยอดเข้าร่วมพิธี</span></a></li> 

    <?php switch($s_userGroupCode){  case 1 : ?>
		<li class="header">เจ้าหน้าที่ดูแลระบบ</li>		
		<li><a href="User.php?"><i class="fa fa-user"></i> <span>User</span></a></li>	
		<li><a href="UserGroup.php?"><i class="fa fa-users"></i> <span>User Group</span></a></li>	
    <li><a href="Config.php?"><i class="fa fa-users"></i> <span>Config</span></a></li> 
    <?php break; ?>
    <?php default : } //.switch ?>
		
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>