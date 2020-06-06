
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
								<th>Kategori</th>
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
                                    <h5 class="modal-title" id="modal-large-title">Tambah Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <form class="form-horizontal" action="<?=site_url('admin/cat_soal/create')?>" method="post" enctype="multipart/form-data" role="form">
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Kategori</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Tuliskan Nama Kategori" required>
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
                    ajax: {"url": "<?=site_url()?>admin/cat_soal/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_kategori",
                            "orderable": false
                        },
                        {"data": "nama_kategori"},
                        {
                            data: null,
                            className: "center",
                            "mRender": function(data, type, row){
                                return `<a href = "#" class="btn btn-primary" data-toggle="modal" data-target="#ubah-data${data.id_kategori}" data-backdrop="false">Update</a>
                                <a href = "#" class="btn btn-danger" data-toggle="modal" data-target="#delete-data${data.id_kategori}" data-backdrop="false">Delete</a>
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
                const baseUrl = '<?=site_url("admin/cat_soal/json")?>';
                const baseUrlUpdate = '<?=site_url("admin/cat_soal/update")?>';
                const baseUrlDelete = '<?=site_url("admin/cat_soal/delete")?>';
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
                         <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ubah-data${prod.id_kategori}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title" id="modal-large-title">Update Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <form class="form-horizontal" action="${baseUrlUpdate}" method="post" enctype="multipart/form-data" role="form">
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Prodi</label>
                                                <div class="col-lg-10">
                                                    <input type="hidden" id="id_kategori" name="id_kategori" value="${prod.id_kategori}">
                                                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Tuliskan Nama" value="${prod.nama_kategori}" required>
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

                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delete-data${prod.id_kategori}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title" id="modal-large-title">Delete Prodi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <form class="form-horizontal" action="${baseUrlDelete}" method="post" enctype="multipart/form-data" role="form">
                                        <div class="modal-body">
                                            <p>Yakin Ingin Menghapus Kategori Ini ?</p>
                                            <input type="hidden" id="id_kategori" name="id_kategori" value="${prod.id_kategori}">
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