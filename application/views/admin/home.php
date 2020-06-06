<div class="container page__heading-container">
	<div class="page__heading d-flex align-items-center justify-content-between">

		<h1> <font color ="black"class="m-0">Halo Tim PMB</font></h1> 
	</div>
    </head>
    <body style="
        background: url(<?=base_url()?>assets/images/background.jpg) no-repeat center center fixed;
        background-size: cover;
    ">
</div>
<div class="container page__container">
	<div class="row card-group-row">
		<div class="col-lg-4 col-md-6 card-group-row__col">
			<div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
				<div class="flex">
                    <div class="card-header__title text-muted mb-2">User</div>
                    <div class="text-amount"><?=$total_user;?></div>
                </div>
                <div class="avatar">
                	<span class="bg-soft-success avatar-title rounded-circle text-center text-success">
                		<i class="material-icons icon-40pt">people</i>
                	</span>
                </div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 card-group-row__col">
			<div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
				<div class="flex">
                    <div class="card-header__title text-muted mb-2">Total Prodi</div>
                    <div class="text-amount"><?=$total_prodi;?></div>
                </div>
                <div class="avatar">
                	<span class="bg-soft-success avatar-title rounded-circle text-center text-success">
                		<i class="material-icons icon-40pt">school</i>
                	</span>
                </div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 card-group-row__col">
			<div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
				<div class="flex">
                    <div class="card-header__title text-muted mb-2">Total Camaba</div>
                    <div class="text-amount"><?=$total_camaba;?></div>
                </div>
                <div class="avatar">
                	<span class="bg-soft-success avatar-title rounded-circle text-center text-success">
                		<i class="material-icons icon-40pt">people</i>
                	</span>
                </div>
			</div>
		</div>
	</div>
</div>

		<script src="<?php echo base_url('datatables/js/jquery-1.11.2.min.js') ?>"></script>