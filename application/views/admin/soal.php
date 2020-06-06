
<link rel="stylesheet" href="<?php echo base_url('datatables/datatables/dataTables.bootstrap.css') ?>"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css">
<div class="container page__heading-container">
	<div class="page__heading d-flex align-items-center justify-content-between">
		<h1 class="m-0">Data Soal</h1>
	</div>
</div>
<div class="container page-container">
	<div class="card card-form">
		<div class="row no-gutters">

			<div class="col-lg-12 col-sm-12 col-md-12 card-body">
				<center>
					<?=anchor(site_url('admin/soal/create'),'Input Soal', array('class'=>"btn btn-primary"))?>
				</center>
				<?php if($this->session->flashdata('success')){ ?>
				<div class="col-md-12 text-center">
                    <div class="alert alert-success"  id="success">
                        <?php echo $this->session->userdata('success') <> '' ? $this->session->userdata('success') : ''; ?>
                    </div>
                </div>
            	<?php }?>
                
					<table class="table table-bordered table-hover responsive-table" width="100%" id="mytable">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th>Soal</th>
								<th>Opsi A</th>
								<th>Opsi B</th>
                                <th>Opsi C</th>
                                <th>Opsi D</th>
                                <th>Opsi E</th>
                                <th>Opsi Jawaban</th>
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
                    ajax: {"url": "<?=site_url()?>admin/soal/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id",
                            "orderable": false
                        },
                        {"data": "soal"},
                        {"data": "opsi_a"},
                        {"data": "opsi_b"},
                        {"data": "opsi_c"},
                        {"data": "opsi_d"},
                        {"data": "opsi_e"},
                        {"data": "jawaban"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
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
        