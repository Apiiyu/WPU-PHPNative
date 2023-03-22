<?php
  include 'functions.php';
  
    //ambil data di dalam url
    $noPegawai = $_GET['No'];
    
    // query/ambil data pegawai berdasarkan No
    $dataPegawai = query("SELECT * FROM pegawai WHERE No = $noPegawai")[0];

  //Cek button Submit sudah ditekan atau belum
  if( isset($_POST["Submit"])) {

  //Cek data berhasil diubah atau tidak
  if( updateData($_POST) > 0) {
    echo "
    <script>
      alert('Data berhasil diubah');
      document.location.href = 'index.php';
    </script>";
  } else{
    echo "<script>alert('Data Tidak berhasil diubah, Silahkan Cek kembali')</script>";
    echo mysqli_error($connection);
  }
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

    <title>UpdateData</title>
    <style>
      .form-control{
        width: 80%;
        font-family: 'Poppins';
        font-size: 16px;
      }

      .form-group, h1{
        margin-left: 40px;
      }

      .btn-success{
        margin: 24px 20px 0px 50px;
        transition: .3s;
        font-family: 'Poppins';
        padding: 10px;
        width: 126px;
      }
      
    </style>
  </head>
  <body>
    <h1>Update data pegawai</h1><br>
    
  <form action="" method="POST">
    <input type="hidden" name="No" value="<?= $dataPegawai['No']; ?>">

    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Gambar</label>
    
    <div class="col-sm-10">
      <input type="text" class="form-control" id="exampleFormControlInput1" required placeholder="1.jpg" name="Gambar" value="<?= $dataPegawai['Gambar']; ?>">
    </div>
  </div>

    <div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
    
    <div class="col-sm-10">
      <input type="text" class="form-control" id="exampleFormControlInput1" required placeholder="JohnDoe" name="Nama" value="<?= $dataPegawai['Nama']; ?>">
    </div>
  </div>

  <div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label">Jabatan</label>
    
    <div class="col-sm-10">
      <input type="text" class="form-control" id="exampleFormControlInput1" required placeholder="Director" name="Jabatan" value="<?= $dataPegawai['Jabatan']; ?>">
    </div>
  </div>

  <div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
    
    <div class="col-sm-10">
      <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="Email" value="<?= $dataPegawai['Email']; ?>">
    </div>
  </div>

  <button type="Submit" class="btn btn-success" name="Submit">Update Data</button>
</form>

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