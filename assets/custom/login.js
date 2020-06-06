function check_login(){
	//mengambil value dari input username dan password
	const username = $('#username').val();
	const password = $('#password').val();
	//ubah alamat berikut sesuai dengan link script anda
	const url_login = <?=site_url('login/logging')?>;
	const url_admin = "<?php echo site_url()?>admin";
	const url_user = '<?php site_url()?>user';

	$('#btnLogin').attr('value','Sliahkan Tunggu ...');

	// gunakan jquery ajax

	$.ajax({
		url : url_login,
		data : 'username='+username+'&password='+password,
		type :'POST',
		dataType : 'php',
		success : function(message){
			if(message==="ok"){
				if(level==="Administrator"){
					window.location = url_admin;
				}else{
					window.location = url_user;
				}
				
			}else{
				alert(pesan);
				$('#btnLogin','Coba Lagi ...');
			}
		}
	});
}