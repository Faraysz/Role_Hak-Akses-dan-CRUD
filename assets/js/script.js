$(document).ready(function () {
    // Inisialisasi DataTables
    $('#tableJurusan').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });

    // Konfirmasi Delete dengan AJAX
    $(document).on('click', '.btn-delete', function () {
        let id = $(this).data('id');
        if (confirm("Yakin ingin menghapus data ini?")) {
            $.ajax({
                url: 'contents/jurusan/delete.php',
                type: 'POST',
                data: { id: id },
                success: function (response) {
                    window.location.reload();
                },
                error: function () {
                    alert('Gagal menghapus data!');
                }
            });
        }
    });

    // Auto-hide alerts after 3 seconds
    setTimeout(function () {
        $('.alert-dismissible').fadeOut('slow');
    }, 3000);
});
