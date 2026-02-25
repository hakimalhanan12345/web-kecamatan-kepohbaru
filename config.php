<?php
$conn = mysqli_connect("localhost", "root", "", "kepohbaru");

if(!$conn){
    die("Database gagal terkoneksi: " . mysqli_connect_error());
}
?>
