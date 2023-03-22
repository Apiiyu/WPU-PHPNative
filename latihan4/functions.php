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
    $Gambar = htmlspecialchars($data["Gambar"]);
    $Nama = htmlspecialchars($data["Nama"]);
    $Jabatan = htmlspecialchars($data["Jabatan"]);
    $Email = htmlspecialchars($data["Email"]);

    //Query insert data
    $queryDb = "INSERT INTO pegawai VALUES
    ('', '$Gambar', '$Nama', '$Jabatan', '$Email')";
    mysqli_query($connection, $queryDb);

    //Cek data berhasil ditambahkan atau tidak
    return mysqli_affected_rows($connection);
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

    $updateGambar = htmlspecialchars($dataPegawai["Gambar"]);
    $updateNama = htmlspecialchars($dataPegawai["Nama"]);
    $updateJabatan = htmlspecialchars($dataPegawai["Jabatan"]);
    $updateEmail = htmlspecialchars($dataPegawai["Email"]);
     
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