
<link rel="stylesheet" href="<?php echo base_url('datatables/datatables/dataTables.bootstrap.css') ?>"/>
<div class="container page__heading-container">
	<div class="page__heading d-flex align-items-center justify-content-between">
		<h1 class="m-0">List Data Prodi</h1>
	</div>
</div>
<div class="container page">
	<div class="card card-form">
		<div class="row no-gutters">

			<div class="col-lg-12 card-body">
				<?=anchor(site_url('#'),'Input', array('class'=>"btn btn-primary",'data-toggle'=>'modal','data-backdrop'=>'false', 'data-target'=>'#insert'))?>
				<?php if($this->session->flashdata('success')){ ?>
				<div class="col-md-12 text-center">
                <div class="alert alert-success"  id="success">
                    <?php echo $this->session->userdata('success') <> '' ? $this->session->userdata('success') : ''; ?>
                </div>
            	<?php }?>
            </div>
					<table class="table mb-0 thead-border-top-0 responsive-table" width="100%" id="mytable">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th>Prodi Pilihan</th>
                                <th>Prodi Jurusan</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="insert" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title" id="modal-large-title">Tambah Prodi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <form class="form-horizontal" action="<?=site_url('admin/prodi/create')?>" method="post" enctype="multipart/form-data" role="form">
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Prodi</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" id="id_prodi" name="id_prodi" placeholder="Tuliskan ID Prodi" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Prodi</label>
                                                <div class="col-lg-10">
                                                    
                                                    <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" placeholder="Tuliskan Nama" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Jurusan</label>
                                                <div class="col-lg-10">
                                                <input class="form-control" id="jurusan" name="jurusan" placeholder="Tuliskan Alamat" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info" type="submit"> Save </button>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
<div id="update-data"></div>
		<script src="<?php echo base_url('datatables/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('datatables/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('datatables/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
        var editor;
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
                    "searching": false,
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
                    ajax: {"url": "<?=site_url()?>admin/prodi/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_prodi",
                            "orderable": false
                        },
                        {"data": "nama_prodi"},
                        {"data": "jurusan"},
                        {
                            data: null,
                            className: "center",
                            "mRender": function(data, type, row){
                                return `<a href = "#" class="btn btn-primary" data-toggle="modal" data-target="#ubah-data${data.id_prodi}" data-backdrop="false">Update</a>
                                <a href = "#" class="btn btn-danger" data-toggle="modal" data-target="#delete-data${data.id_prodi}" data-backdrop="false">Delete</a>
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
                $('#ubah-data').on('show.bs.modal', function (event) {
                    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    var modal          = $(this)
                    
                    // Isi nilai pada field
                    modal.find('#id_prodi').attr("value",div.data('id_prodi'));
                    modal.find('#nama_prodi').attr("value",div.data('nama_prodi'));
                    modal.find('#jurusan').html(div.data('jurusan'));
                });
                const baseUrl = '<?=site_url("admin/prodi/json")?>';
                const baseUrlUpdate = '<?=site_url("admin/prodi/update")?>';
                 const getProdi= ()=>{
                    fetch(`${baseUrl}`)
                    .then((response)=>{
                        return response.json();
                    })
                    .then((responseJson)=>{
                        renderProdi(responseJson.data);
                        console.log(responseJson);
                    })
                    .catch((error)=>{
                        showResponseError(error);
                    });
                 }
                 const renderProdi = (prodi) =>{
                     const listProdi = document.querySelector('#update-data');
                     listProdi.innerHTML = '';
                     prodi.forEach((prod)=>{
                         listProdi.innerHTML += `
                         <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ubah-data${prod.id_prodi}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title" id="modal-large-title">Update Prodi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <form class="form-horizontal" action="${baseUrlUpdate}" method="post" enctype="multipart/form-data" role="form">
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Prodi</label>
                                                <div class="col-lg-10">
                                                    <input type="hidden" id="id_prodi" name="id_prodi" value="${prod.id_prodi}">
                                                    <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" placeholder="Tuliskan Nama" value="${prod.nama_prodi}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Jurusan</label>
                                                <div class="col-lg-10">
                                                <input class="form-control" id="jurusan" name="jurusan" placeholder="Tuliskan Alamat" value="${prod.jurusan}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delete-data${prod.id_prodi}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title" id="modal-large-title">Delete Prodi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <form class="form-horizontal" action="${baseUrlUpdate}" method="post" enctype="multipart/form-data" role="form">
                                        <div class="modal-body">
                                            <p>Yakin Ingin Menghapus Prodi Ini ?</p>
                                            <input type="hidden" id="id_prodi" name="id_prodi" value="${prod.id_prodi}">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="submit"> Delete </button>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                         `;
                     })
                 }
                 const showResponseError = (message = 'check your internet connection') => {
                        alert(message);
                    };
                    getProdi();
            });
        </script>