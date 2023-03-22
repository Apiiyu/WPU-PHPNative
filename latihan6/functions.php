<?php
$connection = mysqli_connect("localhost", "root", "", "studygroup");
    
function query($query){
    global $connection;
    $dataFromDatabase = mysqli_query($connection, $query);
    
    //Jika data yang kita ambil error maka kita gunakan pengkondisian seperti dibawah ini!
    if(!$dataFromDatabase){
        echo mysqli_error($connection);
    }
    $pegawai = [];
    
     /* Cara mengambil data dari database
    1. mysqli_fetch_row() -> data akan berupa array numerik
    2. mysqli_fetch_assoc() -> data akan berupa array assosiatif
    3. mysqli_fetch_array() -> data akan berupa array numerik dan
    4. mysqli_fetch_object() -> data akan berupa object
    */
    while ( $ambilData = mysqli_fetch_assoc($dataFromDatabase) ){
        $pegawai[] = $ambilData;
    }
    
    return $pegawai;
}
        
    
// Insert Data
function insertData($data){
    global $connection;
    $Nama = htmlspecialchars($data["Nama"]);
    $Jabatan = htmlspecialchars($data["Jabatan"]);
    $Email = htmlspecialchars($data["Email"]);

    //Upload Gambar
    $Gambar = uploadImages();
    if ( !$Gambar ){
        return false;
    }
    
    
    //Query insert data
    $queryDb = "INSERT INTO pegawai VALUES
    ('', '$Gambar', '$Nama', '$Jabatan', '$Email')";
    mysqli_query($connection, $queryDb);

    //Cek data berhasil ditambahkan atau tidak
    return mysqli_affected_rows($connection);
}


// Upload Image
function uploadImages(){
     $namaImage = $_FILES['images']['name'];
     $sizeImage = $_FILES['images']['size'];
     $errorImage = $_FILES['images']['error'];
     $directoryImage = $_FILES['images']['tmp_name'];

    // Check gambar ada yang diupload atau tidak
    if ( $errorImage === 4) {
        echo "<script>alert('Mohon masukkan gambar identitas anda terlebih dahulu')</script>";
        return false;
    }


    // Cek apakah yang diupload adalah gambar
    $extensionImagesValidation = ['jpg','jpeg', 'png'];

    // Mengambil extensi file yang dikirimkan oleh user
    // Explode adalah fungsi dalam php yang berfungsi memecah sebuah string menjadi array 
    $extensionImages = explode('.', $namaImage);


    // Setelah memecah string gambar tersebut menjadi sebuah array, maka kita tinggal memanggil array yang indexnya paling akhir
    $extensionImages = strtolower(end($extensionImages));


    //Lalu kita gunakan fungsi in_array yang berfungsi untuk mencari sebuah string didalam array
    if( !in_array($extensionImages, $extensionImagesValidation) ) {
        echo "<script>alert('File yang anda masukkan bukan file gambar! silahkan Masukkan kembali file gambar yang berextension jpg, jpeg, png!'); </script>";
        
        return false;
    }


    // cek ukuran file jika terlalu besar
    if ( $sizeImage > 5000000) {
        echo "<script>alert('Ukuran file gambar anda terlalu besar! Mohon untuk memasukan file gambar < 5MB'); </script>";
    }


    // Jika telah lolos semua pengkondisian tersebut, gambar siap diupload
    
    // Agar file yang diinputkan oleh user tidak memiliki penamaan yg sama dengan user lainnya, maka kita akan mengenerate nama gambar baru

    // fungsi uniqid berfungsi untuk membuat string random
    $generateNamaImages = uniqid();
    $generateNamaImages .= '.'; // artinya untuk menambahkan titik disebelah string random
    $generateNamaImages .= $extensionImages;




    // fungsi move_uploaded_file untuk memindahkan file gambar yang dimasukkan ke user kedalam penyimpanan/folder kita
    move_uploaded_file($directoryImage, 'userUploadedImages/' . $generateNamaImages);

    return $generateNamaImages;
}






// Delete Data
function deleteData($noPegawai) {
    global $connection;
    mysqli_query($connection, "DELETE FROM pegawai WHERE No = $noPegawai");
    
    return mysqli_affected_rows($connection);
}






// Update Data
function updateData($dataPegawai){
    global $connection;
    $noUser = $dataPegawai["No"];

    $updateNama = htmlspecialchars($dataPegawai["Nama"]);
    $updateJabatan = htmlspecialchars($dataPegawai["Jabatan"]);
    $updateEmail = htmlspecialchars($dataPegawai["Email"]);
    $oldPicture = htmlspecialchars($dataPegawai["oldPicture"]);

    //Cek Apakah user upload gambar baru
    if ( $_FILES['images']['error'] === 4){
        $updateGambar = $oldPicture;
    } else {
        $updateGambar = uploadImages();
    }


    
    //Query insert data
    $queryDatabase = "UPDATE pegawai SET Gambar = '$updateGambar', Nama='$updateNama', Jabatan='$updateJabatan', Email='$updateEmail' WHERE No = $noUser";
        
    //Cek data berhasil ditambahkan atau tidak
    mysqli_query($connection, $queryDatabase);

    return mysqli_affected_rows($connection);
}







// Search Data
function searchData($keyword) {
    $querySearchData = "SELECT * FROM pegawai WHERE Nama LIKE '%$keyword%' OR Jabatan LIKE '%$keyword%' OR Email LIKE '%$keyword%' ";
    
    return query($querySearchData);
}
   
?>