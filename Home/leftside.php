<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/<?php echo (empty($s_userPicture)? 'avatar5.png' : $s_userPicture) ?> " class="img-circle" alt="">
        </div>
        <div class="pull-left info">
          <p>Mr.Prawit Khamnet</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
	
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu ">
		<li class="header">เมนู</li>    
    <li><a href="Scan.php?"><i class="fa fa-barcode"></i> <span>Register</span></a></li> 
    <li><a href="CheckIn.php?"><i class="fa fa-arrow-down"></i> <span>Check in</span></a></li> 

    <?php switch($s_userGroupCode){  case 'admin' : ?>
		<li class="header">เจ้าหน้าที่ดูแลระบบ</li>		
		<li><a href="User.php?"><i class="fa fa-user"></i> <span>User</span></a></li>	
		<li><a href="UserGroup.php?"><i class="fa fa-users"></i> <span>User Group</span></a></li>	
    <?php break; ?>
    <?php default : } //.switch ?>
		
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>