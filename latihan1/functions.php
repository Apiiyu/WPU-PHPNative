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
    
    while ( $ambilData = mysqli_fetch_assoc($dataFromDatabase) ){
        $pegawai[] = $ambilData;
    }
    
    return $pegawai;
}
        
    

    /* Cara mengambil data dari database
    1. mysqli_fetch_row() -> data akan berupa array numerik
    2. mysqli_fetch_assoc() -> data akan berupa array assosiatif
    3. mysqli_fetch_array() -> data akan berupa array numerik dan
    4. mysqli_fetch_object() -> data akan berupa object
    */
?>