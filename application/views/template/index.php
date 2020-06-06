<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tables</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="<?=base_url()?>assets/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="<?=base_url()?>assets/css/app.css" rel="stylesheet">
    <!-- <link type="text/css" href="<?=base_url()?>assets/css/app.rtl.css" rel="stylesheet"> -->

    <!-- Material Design Icons -->
    <link type="text/css" href="<?=base_url()?>assets/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="<?=base_url()?>assets/css/vendor-material-icons.rtl.css" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="<?=base_url()?>assets/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="<?=base_url()?>assets/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css">

</head>

<body class="layout-fixed layout-sticky-subnav">

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <?=$header?>

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page">
            <div class="page__header  page__header-nav mb-0">
                <div class="container page__container">
                    <div class="navbar navbar-secondary navbar-light navbar-expand-sm p-0 d-none d-md-flex" id="secondaryNavbar">
                        <ul class="nav navbar-nav">
                            <li class="nav-item <?=($this->uri->segment(2)=="")?"active":""?>">
                                <a href="<?=site_url()?>" class="nav-link">Home</a>
                            </li>
                            <?php if($this->session->userdata('level')=="Administrator"){?>
                                <li class="nav-item <?=($this->uri->segment(2)=="mahasiswa")?"active":""?>">
                                    <a href="<?=site_url('admin/mahasiswa')?>" class="nav-link">Daftar Mahasiswa</a>
                                </li>
                                <li class="nav-item <?=($this->uri->segment(2)=="soal")?"active":""?>">
                                    <a href="<?=site_url('admin/soal')?>" class="nav-link">Data Soal</a>
                                </li>
                                <li class="nav-item <?=($this->uri->segment(2)=="prodi")?"active":""?>">
                                    <a href="<?=site_url('admin/prodi')?>" class="nav-link">Prodi</a>
                                </li>
                                <li class="nav-item <?=($this->uri->segment(2)=="cat_soal")?"active":""?>">
                                    <a href="<?=site_url('admin/cat_soal')?>" class="nav-link">Kategori Soal</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=site_url()?>" class="nav-link">Laporan</a>
                                </li>
                            <?php }else{ ?>
                                <li class="nav-item <?=($this->uri->segment(2)=="ujian")?"active":""?>">
                                    <a href="<?=site_url('user/ujian')?>" class="nav-link">Ujian</a>
                                </li>
                                <li class="nav-item <?=($this->uri->segment(2)=="result")?"active":""?>">
                                    <a href="<?=site_url('user/result')?>" class="nav-link">Hasil Ujian</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?=$content?>
        </div>
        <!-- // END header-layout__content -->

    </div>
    <!-- // END header-layout -->
    <?=$sidebar?>
    
    <!-- Bootstrap -->
    <script src="<?=base_url()?>assets/vendor/popper.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="<?=base_url()?>assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="<?=base_url()?>assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="<?=base_url()?>assets/vendor/material-design-kit.js"></script>

    <!-- Range Slider -->
    <script src="<?=base_url()?>assets/vendor/ion.rangeSlider.min.js"></script>
    <script src="<?=base_url()?>assets/js/ion-rangeslider.js"></script>

    <!-- App -->
    <script src="<?=base_url()?>assets/js/toggle-check-all.js"></script>
    <script src="<?=base_url()?>assets/js/check-selected-row.js"></script>
    <script src="<?=base_url()?>assets/js/dropdown.js"></script>
    <script src="<?=base_url()?>assets/js/sidebar-mini.js"></script>
    <script src="<?=base_url()?>assets/js/app.js"></script>

    <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.js"></script>
</body>
</html>