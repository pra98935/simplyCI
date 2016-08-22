<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simply Delicious Dinners | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>asset/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/admin/css/plugin.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/admin/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/admin/css/flaticon.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/admin/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/admin/css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/admin/css/datatable.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/js/modernizr-custom.js"></script>
  
  </head>

  <body class="nav-md">
   <main class="animsition">
    

        <header class="header_sec" id="header">
            <div class="top_header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="pull-left">
                                <div class="top_social"> <a href="#"><i class="fa fa-facebook"></i></a> </div>
                            </div>
                            <div class="logo">
                                <a href="#"><img src="<?php echo base_url(); ?>asset/admin/images/logo.png" class="img-responsive"></a>
                            </div>
                            <div class="pull-right">
                                <div class="account_login user"> 
                                  <?php if($this->session->userdata('email')) { ?>
                                    <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> WELCOME <?php echo $this->session->userdata('email'); ?> </a> 
                                    <br/>
                                    <a href="<?php echo base_url() ?>admin/Admin_Logout_Cntrl" style="padding-top:0;"><i class="fa fa-sign-out pull-right"></i> Log Out</a> 
                                  <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="middle_header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12"></div>
                    </div>
                </div>
            </div>
            <div class="main_nav">
                <nav class="navbar navbar-inverse">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>                                </button>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                      
                        </div>
                    </div>
                </nav>
            </div>
        </header>


<div class="main_container how_it">
            <section class="common  contain_sec">
                <div class="container">
                <div class="row">
