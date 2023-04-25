<?php

include '../koneksi.php';

$id = $_POST['id'];
$komplain = $_POST['komplain'];


mysqli_query($koneksi,"update tb_transaksi  set komplain= '$komplain' where id='$id'");

header("location:transaksi.php?info=update");

?>