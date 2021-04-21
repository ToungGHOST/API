<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url(); ?>admin/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-medal"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-PORTFOLIO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url(); ?>admin/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>แดชบอร์ด</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        จัดการผู้ใช้งาน
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMember" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>จัดการสมาชิก</span>
        </a>
        <div id="collapseMember" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการสมาชิก:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/getlistmember"><i class="fas fa-fw fa-user-friends"></i> รายชื่อสมาชิก</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/approvemember"><i class="fas fa-fw fa-clipboard-check"></i> อนุมัติสมาชิก</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/hismember"><i class="fas fa-fw fa-history"></i> ประวัติการอนุมัติ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/banmember"><i class="fas fa-fw fa-ban"></i> บัญชีที่ถูกระงับ</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompany" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>จัดการบริษัท</span>
        </a>
        <div id="collapseCompany" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการบริษัท:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/getcompanylist"><i class="fas fa-fw fa-briefcase"></i> รายชื่อบริษัท</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/approvecompany"><i class="fas fa-fw fa-clipboard-check"></i> อนุมัติบริษัท</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/hiscompany"><i class="fas fa-fw fa-history"></i> ประวัติการอนุมัติ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/bancompany"><i class="fas fa-fw fa-ban"></i> บัญชีที่ถูกระงับ</a>
                <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUniversity" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>จัดการสถาบัน</span>
        </a>
        <div id="collapseUniversity" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการสถาบัน:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/getuniversitylist"><i class="fas fa-fw fa-graduation-cap"></i> รายชื่อสถาบัน</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/approveuniversity"><i class="fas fa-fw fa-clipboard-check"></i> อนุมัติสถาบัน</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/hisuniversity"><i class="fas fa-fw fa-history"></i> ประวัติการอนุมัติ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/banuniversity"><i class="fas fa-fw fa-ban"></i> บัญชีที่ถูกระงับ</a>
                <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJob" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-scroll"></i>
            <span>จัดการข้อมูลประกาศ</span>
        </a>
        <div id="collapseJob" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการข้อมูลประกาศ:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/getjoblist"><i class="fas fa-fw fa-scroll"></i> รายชื่อประกาศ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/approvejob"><i class="fas fa-fw fa-clipboard-check"></i> อนุมัติประกาศ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/hisjob"><i class="fas fa-fw fa-history"></i> ประวัติการประกาศ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/banjob"><i class="fas fa-fw fa-ban"></i> บัญชีที่ถูกระงับประกาศ</a>
                <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvevnt" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-scroll"></i>
            <span>จัดการข้อมูลกิจกรรม</span>
        </a>
        <div id="collapseEvevnt" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการข้อมูลประกาศ:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/geteventlist"><i class="fas fa-fw fa-scroll"></i> รายชื่อกิจกรรม</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/approveevent"><i class="fas fa-fw fa-clipboard-check"></i> อนุมัติกิจกรรม</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/hisevent"><i class="fas fa-fw fa-history"></i> ประวัติกิจกรรม</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/banevent"><i class="fas fa-fw fa-ban"></i> กิจกรรมถูกระงับ</a>
                <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        จัดการผู้ดูแลระบบ
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>จัดการผู้ดูแลระบบ</span>
        </a>
        <div id="collapseAdmin" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการผู้ดูแลระบบ:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/listadmin"><i class="fas fa-fw fa-user-friends"></i> รายชื่อผู้ดูแล</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin/addadmin"><i class="fas fa-fw fa-user-plus"></i> เพิ่มผู้ดูแล</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>