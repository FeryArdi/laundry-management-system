<?php

include '../koneksi.php';

$id = $_POST['id'];
$durasi = $_POST['durasi'];


mysqli_query($koneksi,"update tb_transaksi  set durasi= '$durasi' where id='$id'");

header("location:transaksi.php?info=update");

?>