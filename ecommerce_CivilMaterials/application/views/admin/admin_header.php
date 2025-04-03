<!DOCTYPE html>
<html lang="en">
<style>
  .navbar-nav {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-grow: 1;
    }

    .navbar-nav > li {
      margin-right: 15px;
    }

    .navbar-nav.ml-auto {
      justify-content: flex-end;
    }

    .navbar-nav .nav-link {
      font-size: 15px; 
    }

    .paint {
      font-size: 17px; 
    }

     .dropdown-item {
      font-size: 15px; 
    }

</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Civil Material</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url()?>admin_asstes/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url()?>admin_asstes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>admin_asstes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>admin_asstes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>admin_asstes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>admin_asstes/dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="hold-transition light-mode sidebar-collapse layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?php echo base_url()?>admin_asstes/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light fixed-top">
    <!-- <div class="container-fluid"> -->
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="paint">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('dashboard')?>" class="nav-link">Dashboard</a>
      </li>
       <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Order Management</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="<?php echo base_url('admin-vendor')?>" class="dropdown-item">Vendor</a></li>
            <li><a href="<?php echo base_url('admin-user')?>" class="dropdown-item">User</a></li>
            </ul>
        </li>
       <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url('admin-vendor-page')?>" class="nav-link">Vendor</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url('admin-user-page')?>" class="nav-link">User</a>
        </li> -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url('add-slider')?>" class="nav-link">Add Slider</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="<?php echo base_url('brand-master')?>" class="dropdown-item">Brand</a></li>
            <li><a href="<?php echo base_url('category-master')?>" class="dropdown-item">Category</a></li>
            <li><a href="<?php echo base_url('size-master')?>" class="dropdown-item">Size</a></li>
            </ul>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url('product-list')?>" class="nav-link">Product List</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <!-- Dropdown items go here -->
            <a class="dropdown-item" href="<?php echo base_url('admin-logout'); ?>">Logout</a>
        </div>
    </li>
</ul>

  <!-- </div> -->
  </nav>
  <!-- /.navbar -->

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard')?>" class="brand-link">
      <img src="<?php echo base_url()?>admin_asstes/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

     <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url('dashboard')?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!--  <li class="nav-item">
            <a href="<?php echo base_url('admin-vendor-page')?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Vendor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin-user-page')?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li> -->
                    <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Order Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin-vendor')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vendor</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="<?php echo base_url('admin-user')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item">
            <a href="<?php echo base_url('add-slider')?>" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Add Slider
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('brand-master')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="<?php echo base_url('category-master')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('size-master')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Size</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('product-list')?>" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Product List
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar --> -->
  </aside>