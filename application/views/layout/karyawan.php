<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Oct 2019 18:06:06 GMT -->
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>TK</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">


  <!-- CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/atlantis.css">

  <script src="<?php echo base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/format_rp.js"></script>

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/demo.css">

  <style type="text/css">
    .timeline_active{
      border:2px solid #31CE36 ; padding: 10px;border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="main-header">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="blue">
        
        <a href="index-2.html" class="logo">
          <img src="http://demo.themekita.com/atlantis/livepreview/examples/assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
            <i class="icon-menu"></i>
          </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="icon-menu"></i>
          </button>
        </div>
      </div>
      <!-- End Logo Header -->

      <!-- Navbar Header -->
      <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        
        <div class="container-fluid">
          <div class="collapse" id="search-nav">
            <form class="navbar-left navbar-form nav-search mr-md-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search pr-1">
                    <i class="fa fa-search search-icon"></i>
                  </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control">
              </div>
            </form>
          </div>
          <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item toggle-nav-search hidden-caret">
              <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                <i class="fa fa-search"></i>
              </a>
            </li>
            <li class="nav-item dropdown hidden-caret">
              <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope"></i>
              </a>
              <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                <li>
                  <div class="dropdown-title d-flex justify-content-between align-items-center">
                    Messages                  
                    <a href="#" class="small">Mark all as read</a>
                  </div>
                </li>
                <li>
                  <div class="message-notif-scroll scrollbar-outer">
                    <div class="notif-center">
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url() ?>assets/img/jm_denis.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="subject">Jimmy Denis</span>
                          <span class="block">
                            How are you ?
                          </span>
                          <span class="time">5 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url() ?>assets/img/chadengle.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="subject">Chad</span>
                          <span class="block">
                            Ok, Thanks !
                          </span>
                          <span class="time">12 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url() ?>assets/img/mlane.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="subject">Jhon Doe</span>
                          <span class="block">
                            Ready for the meeting today...
                          </span>
                          <span class="time">12 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url() ?>assets/img/talha.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="subject">Talha</span>
                          <span class="block">
                            Hi, Apa Kabar ?
                          </span>
                          <span class="time">17 minutes ago</span> 
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li>
                  <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown hidden-caret">
              <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                <span class="notification">4</span>
              </a>
              <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                <li>
                  <div class="dropdown-title">You have 4 new notification</div>
                </li>
                <li>
                  <div class="notif-scroll scrollbar-outer">
                    <div class="notif-center">
                      <a href="#">
                        <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                        <div class="notif-content">
                          <span class="block">
                            New user registered
                          </span>
                          <span class="time">5 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                        <div class="notif-content">
                          <span class="block">
                            Rahmad commented on Admin
                          </span>
                          <span class="time">12 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url() ?>assets/img/profile2.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="block">
                            Reza send messages to you
                          </span>
                          <span class="time">12 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                        <div class="notif-content">
                          <span class="block">
                            Farrah liked Admin
                          </span>
                          <span class="time">17 minutes ago</span> 
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li>
                  <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown hidden-caret">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fas fa-layer-group"></i>
              </a>
              <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                <div class="quick-actions-header">
                  <span class="title mb-1">Quick Actions</span>
                  <span class="subtitle op-8">Shortcuts</span>
                </div>
                <div class="quick-actions-scroll scrollbar-outer">
                  <div class="quick-actions-items">
                    <div class="row m-0">
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <div class="avatar-item bg-danger rounded-circle">
                            <i class="far fa-calendar-alt"></i>
                          </div>
                          <span class="text">Calendar</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <div class="avatar-item bg-warning rounded-circle">
                            <i class="fas fa-map"></i>
                          </div>
                          <span class="text">Maps</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <div class="avatar-item bg-info rounded-circle">
                            <i class="fas fa-file-excel"></i>
                          </div>
                          <span class="text">Reports</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <div class="avatar-item bg-success rounded-circle">
                            <i class="fas fa-envelope"></i>
                          </div>
                          <span class="text">Emails</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <div class="avatar-item bg-primary rounded-circle">
                            <i class="fas fa-file-invoice-dollar"></i>
                          </div>
                          <span class="text">Invoice</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <div class="avatar-item bg-secondary rounded-circle">
                            <i class="fas fa-credit-card"></i>
                          </div>
                          <span class="text">Payments</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link quick-sidebar-toggler">
                <i class="fa fa-th"></i>
              </a>
            </li>
            <li class="nav-item dropdown hidden-caret">
              <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                  <img src="<?php echo base_url() ?>assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                  <li>
                    <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>">Logout</a>
                  </li>
                </div>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>

    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">     
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <div class="user">
            <div class="avatar-sm float-left mr-2">
              <img src="<?php echo base_url() ?>assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
            </div>
            <div class="info">
              <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                <span>
                  <?php echo $this->session->userdata('user_data')['nama_karyawan'] ?>
                  <span class="user-level"><?php echo "Karyawan" ?></span>
                  <span class="caret"></span>
                </span>
              </a>
              <div class="clearfix"></div>

              <div class="collapse in" id="collapseExample">
                <ul class="nav">
                  <li>
                    <a href="#profile">
                      <span class="link-collapse">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="#edit">
                      <span class="link-collapse">Edit Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="#settings">
                      <span class="link-collapse">Settings</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <ul class="nav nav-primary">
            <li class="nav-item active">
              <a href="<?php echo site_url('karyawan') ?>">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">MENU</h4>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('karyawan/gaji') ?>">
                <i class="fas fa-users"></i>
                <p>Gaji</p>
              </a>
            </li> 

            <li class="nav-item">
              <a href="<?php echo site_url('karyawan/izin') ?>">
                <i class="fas fa-users"></i>
                <p>Perizinan</p>
              </a>
            </li> 

            <li class="nav-item">
              <a href="<?php echo site_url('karyawan/pinjaman') ?>">
                <i class="fas fa-users"></i>
                <p>Pinjaman</p>
              </a>
            </li>

          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="container">
        
        <?php echo $contents ?>

      </div>
    </div>
    
    <div class="quick-sidebar">
      <a href="#" class="close-quick-sidebar">
        <i class="flaticon-cross"></i>
      </a>
      <div class="quick-sidebar-wrapper">
        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
          <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#messages" role="tab" aria-selected="true">Messages</a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tasks" role="tab" aria-selected="false">Tasks</a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Settings</a> </li>
        </ul>
        <div class="tab-content mt-3">
          <div class="tab-chat tab-pane fade show active" id="messages" role="tabpanel">
            <div class="messages-contact">
              <div class="quick-wrapper">
                <div class="quick-scroll scrollbar-outer">
                  <div class="quick-content contact-content">
                    <span class="category-title mt-0">Contacts</span>
                    <div class="avatar-group">
                      <div class="avatar">
                        <img src="<?php echo base_url() ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                      </div>
                      <div class="avatar">
                        <img src="<?php echo base_url() ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                      </div>
                      <div class="avatar">
                        <img src="<?php echo base_url() ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                      </div>
                      <div class="avatar">
                        <img src="<?php echo base_url() ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                      </div>
                      <div class="avatar">
                        <span class="avatar-title rounded-circle border border-white">+</span>
                      </div>
                    </div>
                    <span class="category-title">Recent</span>
                    <div class="contact-list contact-list-recent">
                      <div class="user">
                        <a href="#">
                          <div class="avatar avatar-online">
                            <img src="<?php echo base_url() ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                          </div>
                          <div class="user-data">
                            <span class="name">Jimmy Denis</span>
                            <span class="message">How are you ?</span>
                          </div>
                        </a>
                      </div>
                      <div class="user">
                        <a href="#">
                          <div class="avatar avatar-offline">
                            <img src="<?php echo base_url() ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                          </div>
                          <div class="user-data">
                            <span class="name">Chad</span>
                            <span class="message">Ok, Thanks !</span>
                          </div>
                        </a>
                      </div>
                      <div class="user">
                        <a href="#">
                          <div class="avatar avatar-offline">
                            <img src="<?php echo base_url() ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                          </div>
                          <div class="user-data">
                            <span class="name">John Doe</span>
                            <span class="message">Ready for the meeting today with...</span>
                          </div>
                        </a>
                      </div>
                    </div>
                    <span class="category-title">Other Contacts</span>
                    <div class="contact-list">
                      <div class="user">
                        <a href="#">
                          <div class="avatar avatar-online">
                            <img src="<?php echo base_url() ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                          </div>
                          <div class="user-data2">
                            <span class="name">Jimmy Denis</span>
                            <span class="status">Online</span>
                          </div>
                        </a>
                      </div>
                      <div class="user">
                        <a href="#">
                          <div class="avatar avatar-offline">
                            <img src="<?php echo base_url() ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                          </div>
                          <div class="user-data2">
                            <span class="name">Chad</span>
                            <span class="status">Active 2h ago</span>
                          </div>
                        </a>
                      </div>
                      <div class="user">
                        <a href="#">
                          <div class="avatar avatar-away">
                            <img src="<?php echo base_url() ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                          </div>
                          <div class="user-data2">
                            <span class="name">Talha</span>
                            <span class="status">Away</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="messages-wrapper">
              <div class="messages-title">
                <div class="user">
                  <div class="avatar avatar-offline float-right ml-2">
                    <img src="<?php echo base_url() ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                  </div>
                  <span class="name">Chad</span>
                  <span class="last-active">Active 2h ago</span>
                </div>
                <button class="return">
                  <i class="flaticon-left-arrow-3"></i>
                </button>
              </div>
              <div class="messages-body messages-scroll scrollbar-outer">
                <div class="message-content-wrapper">
                  <div class="message message-in">
                    <div class="avatar avatar-sm">
                      <img src="<?php echo base_url() ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                    </div>
                    <div class="message-body">
                      <div class="message-content">
                        <div class="name">Chad</div>
                        <div class="content">Hello, Rian</div>
                      </div>
                      <div class="date">12.31</div>
                    </div>
                  </div>
                </div>
                <div class="message-content-wrapper">
                  <div class="message message-out">
                    <div class="message-body">
                      <div class="message-content">
                        <div class="content">
                          Hello, Chad
                        </div>
                      </div>
                      <div class="message-content">
                        <div class="content">
                          What's up?
                        </div>
                      </div>
                      <div class="date">12.35</div>
                    </div>
                  </div>
                </div>
                <div class="message-content-wrapper">
                  <div class="message message-in">
                    <div class="avatar avatar-sm">
                      <img src="<?php echo base_url() ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                    </div>
                    <div class="message-body">
                      <div class="message-content">
                        <div class="name">Chad</div>
                        <div class="content">
                          Thanks
                        </div>
                      </div>
                      <div class="message-content">
                        <div class="content">
                          When is the deadline of the project we are working on ?
                        </div>
                      </div>
                      <div class="date">13.00</div>
                    </div>
                  </div>
                </div>
                <div class="message-content-wrapper">
                  <div class="message message-out">
                    <div class="message-body">
                      <div class="message-content">
                        <div class="content">
                          The deadline is about 2 months away
                        </div>
                      </div>
                      <div class="date">13.10</div>
                    </div>
                  </div>
                </div>
                <div class="message-content-wrapper">
                  <div class="message message-in">
                    <div class="avatar avatar-sm">
                      <img src="<?php echo base_url() ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
                    </div>
                    <div class="message-body">
                      <div class="message-content">
                        <div class="name">Chad</div>
                        <div class="content">
                          Ok, Thanks !
                        </div>
                      </div>
                      <div class="date">13.15</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="messages-form">
                <div class="messages-form-control">
                  <input type="text" placeholder="Type here" class="form-control input-pill input-solid message-input">
                </div>
                <div class="messages-form-tool">
                  <a href="#" class="attachment">
                    <i class="flaticon-file"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="tasks" role="tabpanel">
            <div class="quick-wrapper tasks-wrapper">
              <div class="tasks-scroll scrollbar-outer">
                <div class="tasks-content">
                  <span class="category-title mt-0">Today</span>
                  <ul class="tasks-list">
                    <li>
                      <label class="custom-checkbox custom-control checkbox-secondary">
                        <input type="checkbox" checked="" class="custom-control-input"><span class="custom-control-label">Planning new project structure</span>
                        <span class="task-action">
                          <a href="#" class="link text-danger">
                            <i class="flaticon-interface-5"></i>
                          </a>
                        </span>
                      </label>
                    </li>
                    <li>
                      <label class="custom-checkbox custom-control checkbox-secondary">
                        <input type="checkbox" class="custom-control-input"><span class="custom-control-label">Create the main structure              </span>
                        <span class="task-action">
                          <a href="#" class="link text-danger">
                            <i class="flaticon-interface-5"></i>
                          </a>
                        </span>
                      </label>
                    </li>
                    <li>
                      <label class="custom-checkbox custom-control checkbox-secondary">
                        <input type="checkbox" class="custom-control-input"><span class="custom-control-label">Add new Post</span>
                        <span class="task-action">
                          <a href="#" class="link text-danger">
                            <i class="flaticon-interface-5"></i>
                          </a>
                        </span>
                      </label>
                    </li>
                    <li>
                      <label class="custom-checkbox custom-control checkbox-secondary">
                        <input type="checkbox" class="custom-control-input"><span class="custom-control-label">Finalise the design proposal</span>
                        <span class="task-action">
                          <a href="#" class="link text-danger">
                            <i class="flaticon-interface-5"></i>
                          </a>
                        </span>
                      </label>
                    </li>
                  </ul>

                  <span class="category-title">Tomorrow</span>
                  <ul class="tasks-list">
                    <li>
                      <label class="custom-checkbox custom-control checkbox-secondary">
                        <input type="checkbox" class="custom-control-input"><span class="custom-control-label">Initialize the project             </span>
                        <span class="task-action">
                          <a href="#" class="link text-danger">
                            <i class="flaticon-interface-5"></i>
                          </a>
                        </span>
                      </label>
                    </li>
                    <li>
                      <label class="custom-checkbox custom-control checkbox-secondary">
                        <input type="checkbox" class="custom-control-input"><span class="custom-control-label">Create the main structure              </span>
                        <span class="task-action">
                          <a href="#" class="link text-danger">
                            <i class="flaticon-interface-5"></i>
                          </a>
                        </span>
                      </label>
                    </li>
                    <li>
                      <label class="custom-checkbox custom-control checkbox-secondary">
                        <input type="checkbox" class="custom-control-input"><span class="custom-control-label">Updates changes to GitHub              </span>
                        <span class="task-action">
                          <a href="#" class="link text-danger">
                            <i class="flaticon-interface-5"></i>
                          </a>
                        </span>
                      </label>
                    </li>
                    <li>
                      <label class="custom-checkbox custom-control checkbox-secondary">
                        <input type="checkbox" class="custom-control-input"><span title="This task is too long to be displayed in a normal space!" class="custom-control-label">This task is too long to be displayed in a normal space!        </span>
                        <span class="task-action">
                          <a href="#" class="link text-danger">
                            <i class="flaticon-interface-5"></i>
                          </a>
                        </span>
                      </label>
                    </li>
                  </ul>

                  <div class="mt-3">
                    <div class="btn btn-primary btn-rounded btn-sm">
                      <span class="btn-label">
                        <i class="fa fa-plus"></i>
                      </span>
                      Add Task
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="settings" role="tabpanel">
            <div class="quick-wrapper settings-wrapper">
              <div class="quick-scroll scrollbar-outer">
                <div class="quick-content settings-content">

                  <span class="category-title mt-0">General Settings</span>
                  <ul class="settings-list">
                    <li>
                      <span class="item-label">Enable Notifications</span>
                      <div class="item-control">
                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="primary" data-style="btn-round" data-size>
                      </div>
                    </li>
                    <li>
                      <span class="item-label">Signin with social media</span>
                      <div class="item-control">
                        <input type="checkbox" data-toggle="toggle" data-onstyle="primary" data-style="btn-round">
                      </div>
                    </li>
                    <li>
                      <span class="item-label">Backup storage</span>
                      <div class="item-control">
                        <input type="checkbox" data-toggle="toggle" data-onstyle="primary" data-style="btn-round">
                      </div>
                    </li>
                    <li>
                      <span class="item-label">SMS Alert</span>
                      <div class="item-control">
                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="primary" data-style="btn-round">
                      </div>
                    </li>
                  </ul>

                  <span class="category-title mt-0">Notifications</span>
                  <ul class="settings-list">
                    <li>
                      <span class="item-label">Email Notifications</span>
                      <div class="item-control">
                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="primary" data-style="btn-round">
                      </div>
                    </li>
                    <li>
                      <span class="item-label">New Comments</span>
                      <div class="item-control">
                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="primary" data-style="btn-round">
                      </div>
                    </li>
                    <li>
                      <span class="item-label">Chat Messages</span>
                      <div class="item-control">
                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="primary" data-style="btn-round">
                      </div>
                    </li>
                    <li>
                      <span class="item-label">Project Updates</span>
                      <div class="item-control">
                        <input type="checkbox" data-toggle="toggle" data-onstyle="primary" data-style="btn-round">
                      </div>
                    </li>
                    <li>
                      <span class="item-label">New Tasks</span>
                      <div class="item-control">
                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="primary" data-style="btn-round">
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!--   Core JS Files   -->
  
  <script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery UI -->
  <script src="<?php echo base_url() ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="<?php echo base_url() ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Moment JS -->
  <script src="<?php echo base_url() ?>assets/js/plugin/moment/moment.min.js"></script>

  <!-- Chart JS -->
  <script src="<?php echo base_url() ?>assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="<?php echo base_url() ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="<?php echo base_url() ?>assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="<?php echo base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="<?php echo base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- Bootstrap Toggle -->
  <script src="<?php echo base_url() ?>assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="<?php echo base_url() ?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

  <!-- Google Maps Plugin -->
  <script src="<?php echo base_url() ?>assets/js/plugin/gmaps/gmaps.js"></script>

  <!-- Dropzone -->
  <script src="<?php echo base_url() ?>assets/js/plugin/dropzone/dropzone.min.js"></script>

  <!-- Fullcalendar -->
  <script src="<?php echo base_url() ?>assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>

  <!-- DateTimePicker -->
  <script src="<?php echo base_url() ?>assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

  <!-- Bootstrap Tagsinput -->
  <script src="<?php echo base_url() ?>assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

  <!-- Bootstrap Wizard -->
  <script src="<?php echo base_url() ?>assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

  <!-- jQuery Validation -->
  <script src="<?php echo base_url() ?>assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>

  <!-- Summernote -->
  <script src="<?php echo base_url() ?>assets/js/plugin/summernote/summernote-bs4.min.js"></script>

  <!-- Select2 -->
  <script src="<?php echo base_url() ?>assets/js/plugin/select2/select2.full.min.js"></script>

  <!-- Sweet Alert -->
  <script src="<?php echo base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Owl Carousel -->
  <script src="<?php echo base_url() ?>assets/js/plugin/owl-carousel/owl.carousel.min.js"></script>

  <!-- Magnific Popup -->
  <script src="<?php echo base_url() ?>assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Atlantis JS -->
  <script src="<?php echo base_url() ?>assets/js/atlantis.min.js"></script>



  <script>
    $('.timepicker').datetimepicker({
      format: 'HH:mm'
    });

    $('.datepicker').datetimepicker({
      format: 'YYYY-MM-DD',
    });

    $('.datatables').DataTable();
  </script>
</body>

<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Oct 2019 18:06:46 GMT -->
</html>