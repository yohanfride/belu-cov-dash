<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=base_url();?>assets/img/logo-lambang.png" type="image/x-icon">
    <title> <?= $title?> - Halaman Dashboard</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/app.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/leaflet/dist/leaflet.css" />
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }


        <?php if( $title == 'Tampilan Maps - Pasien Covid-19' ){ ?>
        div.circle {
            background-color: #ff7800;
            border-color: black;
            border-radius: 3px;
            border: 0.4px black solid !important;
            width:5px;
            height:5px;
        }
        .bg-confirm{
            background-color: #ef5350 !important;
            -webkit-box-shadow:0 0 10px #ef5350!important; 
            -moz-box-shadow: 0 0 10px #ef5350!important; 
            box-shadow:0 0 10px #ef5350!important;
        }
        .bg-pdpicon{
            background-color: #ffa000  !important;
            -webkit-box-shadow:0 0 10px #ffa000  !important; 
            -moz-box-shadow: 0 0 10px #ffa000  !important; 
            box-shadow:0 0 10px #ffa000  !important;
        }
        .bg-odpicon{
            background-color: #fdd835 !important;
            -webkit-box-shadow:0 0 10px #fdd835 !important; 
            -moz-box-shadow: 0 0 10px #fdd835 !important; 
            box-shadow:0 0 10px #fdd835 !important;
        }
        .bg-odricon{
            background-color: #42a5f5   !important;
            -webkit-box-shadow:0 0 10px #42a5f5 !important; 
            -moz-box-shadow: 0 0 10px #42a5f5 !important; 
            box-shadow:0 0 10px #42a5f5;
        }
        .bg-ppicon{
            background-color: #ab47bc   !important;
            -webkit-box-shadow:0 0 10px #ab47bc !important; 
            -moz-box-shadow: 0 0 10px #ab47bc !important; 
            box-shadow:0 0 10px #ab47bc;
        }
        .info-peta{
            height: 18px;
            width: 18px;
            border-radius: 50%;
            display: inline-block;
        }

        <?php } ?>
    </style>
    <?php if( $title == 'Tambah Fasilitas Kesehatan' or $title == 'Ubah Fasilitas Kesehatan' ){ ?>
        <style>
          /* Always set the map height explicitly to define the size of the div
           * element that contains the map. */
          #map {
            height: 100%;
          }
          /* Optional: Makes the sample page fill the window. */
          html, body {
            height: 100%;
            margin: 0;
            padding: 0;
          }
          #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
          }

          #infowindow-content .title {
            font-weight: bold;
          }

          #infowindow-content {
            display: none;
          }

          #map #infowindow-content {
            display: inline;
          }

          .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
          }

          #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
          }

          .pac-controls {
            display: inline-block;
            padding: 5px 11px;
          }

          .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
          }

          #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 300px;
            padding: .375rem .75rem;
          }

          #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
          }
          #target {
            width: 345px;
          }
        </style>
      
    <?php } ?>
</head>
<body class="light">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
<aside class="main-sidebar fixed offcanvas shadow">
    <section class="sidebar">
        <div class="blue accent-4">
            <div class="p-2 pt-3 pb-3 text-white">
                <span class="s-24  text-primary">Covid-19 - Admin Panel</span>
            </div>
        </div>
        <!-- <div class="w-80px mt-3 mb-3 ml-3">
            <img src="<?= base_url();?>assets/img/basic/logo.png" alt="">
        </div> -->
        <div class="relative">
            <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
               aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm fab-right fab-top btn-primary shadow1 ">
                <i class="icon icon-cogs"></i>
            </a>
            <div class="user-panel p-3 light mb-2">
                <div>
                    <div class="float-left image">
                        <img class="user_avatar" src="<?= base_url();?>assets/img/dummy/u1.png" alt="User Image">
                    </div>
                    <div class="float-left info">
                        <h6 class="font-weight-light mt-2 mb-1"><?= $user_now->name ?></h6>
                        <a data-toggle="collapse" href="#userSettingsCollapse"><i class="icon-circle text-primary blink"></i> <?= ($user_now->role == 'administrator')?'Administrator':'Gugus Tugas' ?></a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="collapse multi-collapse" id="userSettingsCollapse">
                    <?php 
                        if($user_now->role == 'administrator')
                            $role = 'admin';
                        else
                            $role = 'gugustugas';
                    ?>
                    <div class="list-group mt-3 shadow">
                        <a href="<?= base_url().''.$role; ?>/myprofile" class="list-group-item list-group-item-action ">
                            <i class="mr-2 icon-umbrella text-blue"></i>Ubah Profil
                        </a>
                        <a href="<?= base_url().''.$role; ?>/setting" class="list-group-item list-group-item-action"><i
                                class="mr-2 icon-security text-purple"></i>Ubah Password
                        </a>
                        <a href="<?= base_url() ?>auth/logout" class="list-group-item list-group-item-action"><i
                                class="mr-2 icon-exit_to_app text-red"></i>Keluar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header"><strong>NAVIGASI UTAMA </strong></li>
            <li class="treeview"><a href="<?= base_url();?>">
                <i class="icon icon-sailing-boat-water purple-text s-18"></i> <span>Halaman Utama</span> 
            </a>
            </li>
            <li class="treeview"><a href="#"><i class="icon icon-users blue-text s-18"></i>Kasus Covid-19<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url();?>user/add"><i class="icon icon-add"></i>Tambah Kasus Covid-19</a>
                    </li>
                    <?php if($user_now->name =='master-admin1'){ ?>
                    <li><a href="<?=base_url();?>user/import"><i class="icon icon-file-excel-o"></i>Import Excel Kasus Covid-19</a>
                    </li>
                    <?php } ?>
                    <li><a href="<?=base_url();?>user/"><i class="icon icon-document-table"></i>Tampilan Tabel</a>
                    </li>
                    <li><a href="<?=base_url();?>user/maps"><i class="icon icon-map"></i>Tampilan Peta</a>
                    </li>
                    <li><a href="<?=base_url();?>user/grafik"><i class="icon icon-show_chart"></i>Grafik Trend Kasus Covid-19</a>
                    </li>
                    <li><a href="<?=base_url();?>user/log"><i class="icon icon-clipboard-list"></i>Manajemen Log</a>
                    </li>
                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="icon icon-users blue-text s-18"></i>Vaksinasi Covid-19<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url();?>vaksin/add"><i class="icon icon-add"></i>Tambah Vaksinasi Covid-19</a>
                    </li>
                    <?php if($user_now->name =='master-admin1'){ ?>
                    <li><a href="<?=base_url();?>vaksin/import"><i class="icon icon-file-excel-o"></i>Import Excel Vaksinasi Covid-19</a>
                    </li>
                    <?php } ?>
                    <li><a href="<?=base_url();?>vaksin/"><i class="icon icon-document-table"></i>Tampilan Tabel</a>
                    </li>
                    <!-- <li><a href="<?=base_url();?>vaksin/maps"><i class="icon icon-map"></i>Tampilan Peta</a>
                    </li> -->
                    <li><a href="<?=base_url();?>vaksin/grafik"><i class="icon icon-show_chart"></i>Grafik Trend Vaksinasi Covid-19</a>
                    </li>
                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="icon icon-users blue-text s-18"></i>Tes Covid-19<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url();?>tes/add"><i class="icon icon-add"></i>Tambah Tes Covid-19</a>
                    </li>
                    <?php if($user_now->name =='master-admin1'){ ?>
                    <li><a href="<?=base_url();?>tes/import"><i class="icon icon-file-excel-o"></i>Import Excel Tes Covid-19</a>
                    </li>
                    <?php } ?>
                    <li><a href="<?=base_url();?>tes/"><i class="icon icon-document-table"></i>Tampilan Tabel</a>
                    </li>
                    <!-- <li><a href="<?=base_url();?>vaksin/maps"><i class="icon icon-map"></i>Tampilan Peta</a>
                    </li> -->
                    <li><a href="<?=base_url();?>tes/grafik"><i class="icon icon-show_chart"></i>Grafik Trend Tes Covid-19</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="icon icon-qrcode text-lime s-18"></i> <span>QR Code</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url();?>qrcode/"><i class="icon icon-circle-o"></i>Manajemen QR Code</a>
                    </li>
                    <?php if($user_now->name =='master-admin1'){ ?>
                    <li><a href="<?=base_url();?>qrcode/generate"><i class="icon icon-add"></i>Generate QR Code</a>
                    <?php } ?>
                    </li>
                </ul>
            </li>
            <?php if($role == 'admin'){ ?>
            <li class="treeview">
                <a href="#">
                    <i class="icon icon-hospital-o text-blue s-18"></i> <span>Fasilitas Kesehatan</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url();?>faskes/"><i class="icon icon-circle-o"></i>Manajemen Fasilitas Kesehatan</a>
                    </li>
                    <li><a href="<?=base_url();?>faskes/add"><i class="icon icon-add"></i>Tambah Fasilitas Kesehatan</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="icon icon-tablet2 text-blue s-18"></i> <span>Halaman Depan</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url();?>video/"><i class="icon icon-video-camera"></i>Manajemen Tautan Video</a>
                    </li>
                    <li><a href="<?=base_url();?>infografis/"><i class="icon icon-photo"></i>Manajemen Info Grafis</a>
                    </li>
                    <li><a href="<?=base_url();?>homeslide/"><i class="icon icon-view_carousel"></i>Manajemen Home Slide</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php if($role == 'admin'){ ?>
            <li class="header light mt-3"><strong>NAVIGASI ADMINISTRATOR</strong></li>
            <?php if($user_now->level == 'master-admin'){ ?>
            <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Administrator<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url();?>admin/"><i class="icon icon-circle-o"></i>Manajemen Administrator</a>
                    </li>
                    <li><a href="<?=base_url();?>admin/add"><i class="icon icon-add"></i>Tambah Administrator</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <li class="treeview"><a href="#"><i class="icon icon-account_box amber-text s-18"></i>Gugus Tugas<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url();?>gugustugas/"><i class="icon icon-circle-o"></i>Manajemen Gugus Tugas</a>
                    </li>
                    <li><a href="<?=base_url();?>gugustugas/add"><i class="icon icon-add"></i>Tambah Gugus Tugas</a>
                    </li>
                </ul>
            </li>  
            <?php } ?>      
        </ul>
    </section>
</aside>
<!--Sidebar End-->
<div class="has-sidebar-left">
    <div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
            <div class="search-bar">
                <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50" type="text"
                       placeholder="start typing...">
            </div>
            <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="false"
               aria-label="Toggle navigation" class="paper-nav-toggle paper-nav-white active "><i></i></a>
        </div>
    </div>
</div>
    <div class="sticky">
        <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
            <div class="relative">
                <a href="#" data-toggle="offcanvas" class="paper-nav-toggle pp-nav-toggle">
                    <i></i>
                </a>
            </div>
            <!--Top Menu Start -->
<div class="navbar-custom-menu p-t-10">
    <ul class="nav navbar-nav">
        <!-- Notifications -->
        <!-- <li class="dropdown custom-dropdown notifications-menu">
            <a href="#" class=" nav-link" data-toggle="dropdown" aria-expanded="false">
                <i class="icon-notifications "></i>
                <span class="badge badge-danger badge-mini rounded-circle">4</span>
            </a>
            <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                   <ul class="menu">
                        <li>
                            <a href="#">
                                <i class="icon icon-data_usage text-success"></i> 5 new members joined today
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon icon-data_usage text-danger"></i> 5 new members joined today
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon icon-data_usage text-yellow"></i> 5 new members joined today
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="footer p-2 text-center"><a href="#">View all</a></li>
            </ul>
        </li> -->
    </ul>
</div>
        </div>
    </div>
</div>
<div class="page has-sidebar-left height-full">
