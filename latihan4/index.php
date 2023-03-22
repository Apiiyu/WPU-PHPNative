<?php
  include 'functions.php';
  $Workers = query("SELECT * FROM pegawai"); 

  // jika button search diclick
  if( isset($_POST["Search"]) ) {
    $Workers = searchData($_POST["Keyword"]);
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Struktur Diagram Perusahaan!</title>
    <style>
      .btn-search{
        width:100%;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .btn-search #formBs{
        width: 362px;
        height: 42px;
        margin: 22px 20px 24px 0px;
        font-family: 'Poppins';
        font-size: 14px;
        padding:11px;
        font-weight: 500;
      }

      .btn-search .btn-outline-success{
        font-family: 'Poppins';
        font-size: 12px;
        width: 86px;
        height: 42px;
        padding: 13px;
        font-weight:500;
      }
    </style>
  </head>
  <body>

  <h1>Daftar Pegawai StudyGroup</h1>
  <a href="tambahPegawai.php">Tambah data Pegawai</a> <br>
      <div class="btn-search">
        <form class="form-inline my-2 my-lg-0" action="" method="POST">
          <input id="formBs" name="Keyword" class="form-control mr-sm-2" type="search" placeholder="Search" autofocus autocomplete="off" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="Search">Search</button>
        </form>
      </div>

    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Gambar</th>
      <th scope="col">Nama</th>
      <th scope="col">Jabatan</th>
      <th scope="col">Email</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>

  <tbody>
  <?php $noPegawai = 1; ?>
  <?php foreach ( $Workers as $dataPegawai) : ?>
    <tr>
      <th scope="row"><?= $noPegawai ?></th>
      <td><img src="img/<?= $dataPegawai["Gambar"]; ?>" alt="BusinessMan" width="152px"></td>
      <td><?= $dataPegawai["Nama"]; ?></td>
      <td><?= $dataPegawai["Jabatan"]; ?></td>
      <td><?= $dataPegawai["Email"] ?></td>
      <td>
          <a href="updateData.php?No=<?= $dataPegawai['No']; ?>" onclick="return confirm('Apakah anda yakin ingin mengubah data pegawai tersebut?');">Ubah</a> | <a href="deleteData.php?No=<?= $dataPegawai['No']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data pegawai tersebut?');">Hapus</a>
      </td>
    </tr>
    <?php $noPegawai++; ?>
  <?php endforeach; ?>

  </tbody>
</table>






    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>