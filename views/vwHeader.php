<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PKETI (Kelas C - Semester Gasal 2017) - Kelompok 4</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url('assets/css/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/css/sb-admin.css'); ?>" rel="stylesheet">

  <style type="text/css">
     .act-button{
        font-size:14px;
        padding: 1px 4px;
      }

      .nowrap {
        white-space: nowrap;
      }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo base_url('dashboard'); ?>"><b>PKETI (Kelas C - Semester Gasal 2017) - Kelompok 4</b></span></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="User">
          <a class="nav-link" href="<?php echo base_url('dashboard/request'); ?>">
            <i class="fa fa-fw fa-info-circle"></i>
            <span class="nav-link-text">Request</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Iklan">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUser" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Services</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseUser">
            <li>
              <a href="<?php echo base_url('dashboard/process') ?>">Process</a>
            </li>
            <li>
              <a href="<?php echo base_url('dashboard/completed') ?>">Complete</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="User">
          <a class="nav-link" href="<?php echo base_url('dashboard/log'); ?>">
            <i class="fa fa-fw fa-pencil"></i>
            <span class="nav-link-text">Service Log</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>