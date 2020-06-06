<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="<?php echo base_url();?>assets/vendor/modernizr/modernizr.js"></script>
		
	</head>
	<body style="
		background: url(<?=base_url()?>assets/images/background.jpg) no-repeat center center fixed;
		background-size: cover;
	">
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign" id="login">
				

				<div class="panel panel-sign">
					
					<div class="panel-title-sign mt-xl text-left">
						<a href="<?=site_url()?>" class="logo pull-left">
							<img src="<?php echo base_url();?>assets/images/logos/cic2.png" height="54" alt="Logo UCIC" />
						</a>
					</div>
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i>User</h2>
					</div>
					<div class="panel-body">
						
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="username" type="text" class="form-control input-lg" id="username"/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" id="password" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
							
								<div class="col-sm-12 text-right">
									<button class="btn btn-login btn-primary hidden-xs" id="btnLogin">Login</button>
									<button class="btn btn-login btn-primary btn-block btn-lg visible-xs mt-lg">Login</button>
								</div>
							</div>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright FARIDA TRIE AGUSTIANY</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="<?php echo base_url();?>assets/vendor/jquery/jquery.js"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
		<script>
			$(document).ready(function (){
				$(".btn-login").click( function(){
					const username = $("#username").val();
					const password = $("#password").val();

					if(username.length == ""){
						Swal({
							type:'warning',
							title :'Oops...',
							text :'Username Wajib diisi !'
						});
					}else if(password.length == ""){
						Swal({
							type:'warning',
							title :'Oops...',
							text :'Password Wajib diisi !'
						});
					}else{
						$.ajax({
							url:"<?=site_url('login/cek_login/')?>",
							type:"POST",

							data :{
								"username":username,
								"password":password
							},
							dataType:'json',
							success: function(response){
								if(response.msg=="success"){
									Swal.fire({
					                    type: 'success',
					                    title: 'Login Berhasil!',
					                    text: 'Anda akan di arahkan dalam 3 Detik',
					                    timer: 3000,
					                    showCancelButton: false,
					                    showConfirmButton: false
					                  })
					                  .then (function(respon){
					                  	console.log(response);
					                  	if(response.level=="Administrator"){
					                  	window.location.href = "<?=site_url('admin')?>";
					                  }else{
					                  	window.location.href = "<?=site_url('user')?>";
					                  }
					                  });
					                  
								}else{
									Swal.fire({
					                    type: 'error',
					                    title: 'Login Gagal!',
					                    text: 'silahkan coba lagi!'
					                  });
								}
							},
							error:function(respon){
								Swal.fire({
				                    type: 'error',
				                    title: 'Opps!',
				                    text: 'server error!'
				                  });

				                  console.log(respon);
							}
						});
					}
				});
			});
		</script>
	</body>
</html>