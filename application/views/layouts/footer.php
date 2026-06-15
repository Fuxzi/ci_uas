</div><!-- end main-content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script>
function exportPDF(jenis) {
    var tglMulai = $('input[name="tgl_mulai"]').val();
    var tglAkhir = $('input[name="tgl_akhir"]').val();
    
    // Jika di halaman laporan, ambil dari input filter
    // Jika di menu, gunakan default bulan ini
    if (!tglMulai) {
        var today = new Date();
        var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        tglMulai = firstDay.toISOString().split('T')[0];
        tglAkhir = today.toISOString().split('T')[0];
    }
    
    window.open(
        '<?= base_url("laporan/export_pdf") ?>?tgl_mulai=' + tglMulai + 
        '&tgl_akhir=' + tglAkhir + '&jenis=' + jenis,
        '_blank'
    );
}
</script>
</body>
</html>
