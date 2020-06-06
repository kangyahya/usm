
<link rel="stylesheet" href="<?php echo base_url('datatables/datatables/dataTables.bootstrap.css') ?>"/>
<div class="container page__heading-container">
	<div class="page__heading d-flex align-items-center justify-content-between">
		<h1 class="m-0">Form Pendaftaran</h1>
	</div>
</div>
<div class="container page__container">
	<div class="card card-form">
        <form action="<?php echo $action; ?>" method="post">
		<div class="row no-gutters">
            
			<div class="col-lg-6 card-body">
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">Nama <?php echo form_error('nama') ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">Email <?php echo form_error('email') ?></label>
                            <div class="col-sm-9">    
                                <input type="email" class="form-control <?=$this->session->userdata('error') <> '' ? 'is-invalid' : ''?>" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                                <span class="invalid-feedback"><?php if($this->session->flashdata('error')){ ?><?php echo $this->session->userdata('error') <> '' ? $this->session->userdata('error') : ''; } ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">No Hp <?php echo form_error('no_hp') ?></label>
                            <div class="col-sm-9">    
                                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">Asal Sekolah <?php echo form_error('asal_sekolah') ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" placeholder="Asal Sekolah" value="<?php echo $asal_sekolah; ?>" />
                            </div>
                        </div>
			</div>
            <div class="col-lg-6 card-body">
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">Tanggal Lahir <?php echo form_error('ttl') ?></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="ttl" id="ttl" placeholder="Ttl" value="<?php echo $ttl; ?>" />
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">Alamat <?php echo form_error('alamat') ?></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">Prodi Pilihan <?php echo form_error('prodi_pilihan') ?></label>
                            <div class="col-sm-9">
                                <select data-toggle="select" class="form-control" name="prodi_pilihan" id="prodi_pilihan">
                                    <?php foreach($prodi_data->result_array() as $prodi){ ?>
                                    <option value="<?=$prodi['id_prodi']?>" <?=($prodi_pilihan==$prodi['id_prodi'])?"selected":""?>>
                                        <?=$prodi['nama_prodi']?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">Jenis Kelamin <?php echo form_error('jk') ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="jk" id="jk" placeholder="Jk" value="<?php echo $jk; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">Thn Lulus <?php echo form_error('thn_lulus') ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="thn_lulus" id="thn_lulus" placeholder="Thn Lulus" value="<?php echo $thn_lulus; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="varchar" class="col-sm-3 col-form-label">Nomer Token <?php echo form_error('no_token') ?></label>
                            <div class="col-sm-9">
                                
                                <input type="text" class="form-control" name="no_token" id="no_token" placeholder="No Token" value="<?php echo $token; ?>" readonly/>

                            </div>
                        </div>
            
		</div>
        <div class="row no-gutters">
            <div class="col-lg-12 card-body">
                <center>
                  
                        <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>" />
                   
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url('admin/mahasiswa') ?>" class="btn btn-danger">Cancel</a>
                </center>
            </div>
        </div>
        </form>
	</div>
</div>

		<script src="<?php echo base_url('datatables/js/jquery-1.11.2.min.js') ?>"></script>