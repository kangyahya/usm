
<div class="container page__heading-container">
	<div class="page__heading d-flex align-items-center justify-content-between">
		<h1 class="m-0">Form Soal</h1>
	</div>
</div>
<div class="container page__container">
	<div class="card card-form">
        <form action="<?php echo $action; ?>" method="post">
		<div class="row no-gutters">
            
			<div class="col-lg-12 card-body">
                <div class="form-group row">
                    <label for="id_fakultas" class="col-sm-3 col-form-label">Fakultas <?php echo form_error('id_fakultas') ?></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="id_fakultas">
                            <option value="1" <?=($id_fakultas==1)?"selected":""?>>Fakultas Teknologi & Informasi</option>
                            <option value="2" <?=($id_fakultas==2)?"selected":""?>>Fakultas Ekonomi & Bisnis</option>
                        </select>
                    </div>
                </div>  
                <div class="form-group row">
                    <label for="varchar" class="col-sm-3 col-form-label">Prodi <?php echo form_error('id_prodi') ?></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="id_prodi">
                            <?php foreach($prodi_data->result_array() as $prodi){ ?>
                            <option value="<?=$prodi['id_prodi']?>" <?=($prodi['id_prodi']==$id_prodi)?"selected":""?>><?=$prodi['nama_prodi']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="varchar" class="col-sm-3 col-form-label">Kategori <?php echo form_error('id_kategori') ?></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="id_kategori">
                            <?php foreach($kategori_data->result_array() as $kategori){ ?>
                            <option value="<?=$kategori['id_kategori']?>" <?=($kategori['id_kategori']==$id_kategori)?"selected":""?>><?=$kategori['nama_kategori']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="soal" class="col-sm-3 col-form-label">Soal <?php echo form_error('soal') ?></label>
                    <div class="col-sm-9">
                        <textarea id="ckeditor" class="ckeditor" name="soal"><?=$soal?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opsi_a" class="col-sm-3 col-form-label">Opsi A <?php echo form_error('opsi_a') ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="opsi_a" id="opsi_a" class="form-control border-primary" value="<?=$opsi_a?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opsi_b" class="col-sm-3 col-form-label">Opsi B <?php echo form_error('opsi_b') ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="opsi_b" id="opsi_b" class="form-control border-primary" value="<?=$opsi_b?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opsi_c" class="col-sm-3 col-form-label">Opsi C <?php echo form_error('opsi_c') ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="opsi_c" id="opsi_c" class="form-control border-primary" value="<?=$opsi_c?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opsi_d" class="col-sm-3 col-form-label">Opsi D <?php echo form_error('opsi_d') ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="opsi_d" id="opsi_d" class="form-control border-primary" value="<?=$opsi_d?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opsi_e" class="col-sm-3 col-form-label">Opsi E <?php echo form_error('opsi_e') ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="opsi_e" id="opsi_e" class="form-control border-primary" value="<?=$opsi_e?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jawaban" class="col-sm-3 col-form-label">Kunci Jawaban<?php echo form_error('jawaban') ?></label>
                    <div class="col-sm-9">
                        <select class="col-sm-5 form-control border-primary" name="jawaban" id="jawaban">
                            <option></option>
                            <option value="A" <?=($jawaban=="A")?"selected":""?>>A</option>
                            <option value="B" <?=($jawaban=="B")?"selected":""?>>B</option>
                            <option value="C" <?=($jawaban=="C")?"selected":""?>>C</option>
                            <option value="D" <?=($jawaban=="D")?"selected":""?>>D</option>
                            <option value="E" <?=($jawaban=="E")?"selected":""?>>E</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="varchar" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <?php if($button=="Update"){?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <?php }?>
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url('admin/soal') ?>" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
			</div>
            
		</div>
        </form>
	</div>
</div>

		<script src="<?php echo base_url('datatables/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendor/ckeditor/ckeditor.js') ?>"></script>
        