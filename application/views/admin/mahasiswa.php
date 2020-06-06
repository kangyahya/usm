
<link rel="stylesheet" href="<?php echo base_url('datatables/datatables/dataTables.bootstrap.css') ?>"/>
<div class="container page__heading-container">
	<div class="page__heading d-flex align-items-center justify-content-between">
		<h1 class="m-0">Daftar Mahasiswa</h1>
	</div>
</div>
<div class="container page">
	<div class="card card-form">
		<div class="row no-gutters">

			<div class="col-lg-12 card-body">
				<?=anchor(site_url('admin/mahasiswa/create'),'Daftar Baru', array('class'=>"btn btn-primary"))?>
				<?php if($this->session->flashdata('success')){ ?>
				<div class="col-md-12 text-center">
                <div class="alert alert-success"  id="success">
                    <?php echo $this->session->userdata('success') <> '' ? $this->session->userdata('success') : ''; ?>
                </div>
            	<?php }?>
            </div>
					<table class="table mb-0 thead-border-top-0 responsive-table" id="mytable">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th>Nama</th>
								<th>Prodi Pilihan</th>
								<th>Asal Sekolah</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
			</div>
		</div>
	</div>
</div>

		<script src="<?php echo base_url('datatables/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('datatables/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('datatables/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                	"paging" : false,
                	"ordering":false,
                	"info":false,
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "<?=site_url()?>admin/mahasiswa/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_daftar",
                            "orderable": false
                        },
                        {"data": "nama"},
                        {"data": "nama_prodi"},
                        {"data": "asal_sekolah"},
                        {
                           
                            data: null,
                            className: "center",
                            "mRender": function(data, type, row){
                                return `<a href = "<?=site_url()?>admin/mahasiswa/update/${data.id_daftar}" class="btn btn-primary">Update</a>
                                <a href = "#" class="btn btn-danger" data-toggle="modal" data-target="#delete-data${data.id_daftar}" data-backdrop="false">Delete</a>
                                `;
                            }
                           
                        }
                    ],
                    order: [[0, 'asc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>