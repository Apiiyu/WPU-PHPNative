<?php
    include 'functions.php';
    $noPegawai = $_GET['No'];

    //lalu langsung kita buat function hapus
    if ( deleteData($noPegawai) > 0 ) {
        echo "
        <script>
            alert('Data berhasil dihapus');
            document.location.href = 'index.php';
        </script>";
    } else{
        echo "
        <script>
            alert('Data tidak berhasil dihapus, Mohon di cek kembali!');
            document.location.href = 'index.php';
        </script>";
    }
?>