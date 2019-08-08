<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Rack Model</title>
  <!-- Bootstrap core CSS-->
  <link href="template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="template/css/sb-admin.css" rel="stylesheet">
  <link href="template/css/w3.css" rel="stylesheet">
  
  <link href="template/style.css" rel="stylesheet">
  
  <script src="template/js/jquery.js"></script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Rack Model</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Adapter">
          <a class="nav-link" href="?task=showListAdapter">
            <i class="fa fa-plug"></i>
            <span class="nav-link-text">Adapter</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Document">
          <a class="nav-link" href="?task=showListDocument">
            <i class="fa fa-file-text"></i>
            <span class="nav-link-text">Document</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Line">
          <a class="nav-link" href="?task=showListLine">
            <i class="fa fa-recycle"></i>
            <span class="nav-link-text">Line</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Model">
          <a class="nav-link" href="?task=showListModel">
            <i class="fa fa-object-group"></i>
            <span class="nav-link-text">Model</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Rack">
          <a class="nav-link" href="?task=showListRack">
            <i class="fa fa-inbox"></i>
            <span class="nav-link-text">Rack</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="btn_signIn nav-link" href="?task=logoutSystem"><i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      