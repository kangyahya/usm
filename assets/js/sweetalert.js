$('.btn-delete').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    swal({
        title: "Anda Yakin",
        text: "Data Ingin Dihapus?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Hapus",
        closeOnConfirm: false
    },
        function () {
            document.location.href = href;
        });

});