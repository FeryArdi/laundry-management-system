<?php 
include '../layouts/header.php';
include '../layouts/navbar.php';
?>

<script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }
    </script>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transaksi</h1>
         
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-17">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Transaksi</h3>

              <div class="card-tools">
               <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Data</button>
             </div>
           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <?php 
             if(isset($_GET['info'])){
              if($_GET['info'] == "hapus"){ ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-trash"></i> Sukses</h5>
                  Data berhasil di hapus
                </div>
              <?php } else if($_GET['info'] == "simpan"){ ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Sukses</h5>
                  Data berhasil di simpan
                </div>
              <?php }else if($_GET['info'] == "update"){ ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-edit"></i> Sukses</h5>
                  Data berhasil di update
                </div>
              <?php } } ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kode Invoice</th>
                    <th>Nama Member</th>
                    <th>Jenis Paket</th>
                    <th>Nama Outlet</th>
                    <th>Berat/PCS Cucian</th>
                    <th>Pembayaran</th>
                    <th style="width: 150px">Waktu Pembayaran</th>
                    <th>Biaya Tambahan</th>
                    <th>Diskon</th>
                    <th>Pajak</th>
                    <th>Total Bayar</th>
                    <th style="width: 150px">Status</th>  
                    <th>Proses Pengerjaan </th>
                    <th>Pengaturan</th>
                    <th>Komplain</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  include "../koneksi.php";
                  $tb_transaksi    =mysqli_query($koneksi, "SELECT * FROM tb_transaksi");
                  while($d_tb_transaksi = mysqli_fetch_array($tb_transaksi)){
                    $tb_outlet    =mysqli_query($koneksi, "SELECT * FROM tb_outlet where id='$d_tb_transaksi[id_outlet]'");
                    while($d_tb_outlet_d = mysqli_fetch_array($tb_outlet)){
                      $tb_member    =mysqli_query($koneksi, "SELECT * FROM tb_member where id='$d_tb_transaksi[id_member]'");
                      while($d_tb_member_d = mysqli_fetch_array($tb_member)){
                        $tb_user    =mysqli_query($koneksi, "SELECT * FROM tb_user where id='$d_tb_transaksi[id_user]'");
                        while($d_tb_user_d = mysqli_fetch_array($tb_user)){                          
                          ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?=$d_tb_transaksi['kode_invoice']?></td>
                            <td><?=$d_tb_member_d['nama']?></td>
                            <td>
                              <table>
                                <tr>
                                  <td>
                                    <?php 
                                    $tb_paket    =mysqli_query($koneksi, "SELECT * FROM tb_paket where id='$d_tb_transaksi[id_paket]'");
                                    while($d_tb_paket_d = mysqli_fetch_array($tb_paket)){ ?>
                                      <?=$d_tb_paket_d['nama_paket']?>                                
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-pilih-paket<?php echo $d_tb_transaksi['id']; ?>">Pilih</button>
                                  </td>
                                </tr>
                              </table>
                            </td>
                            <td><?=$d_tb_outlet_d['nama']?></td>
                            <td>
                              <?=$d_tb_transaksi['qty']?> 
                              <?php 
                              $tb_paket    =mysqli_query($koneksi, "SELECT * FROM tb_paket where id='$d_tb_transaksi[id_paket]'");
                              while($d_tb_paket_d = mysqli_fetch_array($tb_paket)){ ?>
                                <?=$d_tb_paket_d['jenis']?>                                
                              <?php } ?>
                            </td>
                            <td>
                                      <?php 
                                      if ($d_tb_transaksi['dibayar'] == 'dibayar') { ?> 
                                      <?=$d_tb_transaksi['tgl']?>
                                      <?php } else { ?> 
                                        <p class="btn btn-danger btn-sm">Belum Dibayar</p>
                                      <?php } ?> 
                                      </td>
                            <td> <?php 
                                      if ($d_tb_transaksi['dibayar'] == 'dibayar') { ?> 
                                      <p class="btn btn-success btn-sm">Telah Dibayar</p>
                                      <?php } else { ?> 
                                        <?=$d_tb_transaksi['batas_waktu']?>
                                      <?php } ?></td>
                            <td>Rp. <?= number_format($d_tb_transaksi['biaya_tambahan'])?></td>
                            <td><?= number_format($d_tb_transaksi['diskon'])?></td>
                            <td>Rp. <?= number_format($d_tb_transaksi['pajak'])?></td>
                            <td>
                              <?php 
                              if ($d_tb_transaksi['id_paket'] == '0') { ?>

                              <?php } else { ?>
                                <?php 
                                $tb_paket    =mysqli_query($koneksi, "SELECT * FROM tb_paket where id='$d_tb_transaksi[id_paket]'");
                                while($d_tb_paket_d = mysqli_fetch_array($tb_paket)){ 
                                  $a = $d_tb_paket_d['harga'];
                                }
                                $b = $d_tb_transaksi['qty'];
                                $c = $d_tb_transaksi['biaya_tambahan'];
                                $d = $d_tb_transaksi['pajak'];
                                $e = $d_tb_transaksi['diskon'];
                                $tdiskon = ($a*$b)*($e/100);
                                $total = (($a*$b)+$c)-$tdiskon+$d;
                                echo "Rp. $total";
                                ?>
                              <?php } ?>                              
                            </td>
                            <td>
                              <table>
                                <tr>
                                  <td>
                                    <?php 
                                    if ($d_tb_transaksi['status'] == 'baru') { ?>
                                      <p class="btn btn-default btn-sm">Baru</p>
                                    <?php } else if ($d_tb_transaksi['status'] == 'proses') { ?>
                                      <p class="btn btn-warning btn-sm">Proses</p>
                                    <?php } else if ($d_tb_transaksi['status'] == 'selesai') { ?>
                                      <p class="btn btn-primary btn-sm">Selesai</p>
                                    <?php } else { ?>
                                      <p class="btn btn-success btn-sm">Diambil</p>
                                    <?php } ?>
                                  </td>
                                  
                                  <td>
                                    <?php 
                                    if ($d_tb_transaksi['id_paket'] == '0') { ?>

                                    <?php } else { ?>
                                      <?php 
                                      if ($d_tb_transaksi['dibayar'] == 'dibayar') { ?> 
                                        <p class="btn btn-success btn-sm">Dibayar</p>
                                      <?php } else { ?> 
                                        <p class="btn btn-danger btn-sm">Belum Dibayar</p>
                                      <?php } ?> 
                                    <?php } ?>                                     
                                  </td>

                                </tr>
                              </table>                            
                            </td>  
                            <td>
                                    <?php
                                         if ($d_tb_transaksi['durasi'] == '1_hari'){ ?>
                                          <p>1 Hari <p>
                                         <?php } else if ($d_tb_transaksi['durasi'] == '2_hari'){?>
                                          <p>2 Hari </p>
                                        <?php } else if ($d_tb_transaksi['durasi'] == '3_hari'){?>
                                          <p>3 Hari</p>
                                        <?php } else { ?> 
                                          <?php } ?>
                                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-durasi<?php echo $d_tb_transaksi['id']; ?>">Pilih</button>
                                  </td>                
                            <td>
                              <table>
                                
                             <tr>
                              <td>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-status<?php echo $d_tb_transaksi['id']; ?>"><i class="fas fa-edit"></i> Status</button>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <?php 
                                if ($d_tb_transaksi['id_paket'] == '0') { ?>

                                <?php } else { ?>
                                  <?php 
                                  if ($d_tb_transaksi['dibayar'] == 'dibayar') { ?> 
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-batalkan<?php echo $d_tb_transaksi['id']; ?>"><i class="fas fa-times"></i> Batalkan</button>
                                  <?php } else { ?> 
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-bayar<?php echo $d_tb_transaksi['id']; ?>"><i class="fas fa-edit"></i> Bayar</button>
                                  <?php } ?> 

                                <?php } ?> 
                              </td>                              
                            </tr>
                            <tr>
                              <td>
                                <?php 
                                if ($d_tb_transaksi['id_paket'] == '0') { ?>
                                <?php } else { ?>
                                  <a href="print_nota.php?id=<?php echo $d_tb_transaksi['id']; ?>" class="btn btn-info btn-sm" target="blank_"><i class="fas fa-print"></i> Print</a>
                                <?php } ?>       
                            </tr>
                          </table>
                        </td>
                        </td>
                              <td> <?=($d_tb_transaksi['komplain'])?>
                              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-komplain<?php echo $d_tb_transaksi['id']; ?>">Pilih</button>
                            </td>
                      </tr>

                      <div class="modal fade" id="modal-pilih-paket<?php echo $d_tb_transaksi['id']; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Pilih Paket</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>                         
                            <form method="post" action="update_paket_pilih.php">
                              <div class="modal-body">
                                <input type="text" name="id" value="<?php echo $d_tb_transaksi['id']; ?>" hidden>
                                <div class="form-group">
                                  <label>Pilih Paket</label>
                                  <select name="id_paket" class="form-control" id="id_outlet" required>
                                    <option>--- Pilih Nama Paket ---</option>
                                    <?php
                                    include "../koneksi.php";
                                    $tb_paket    =mysqli_query($koneksi, "SELECT * FROM tb_paket where id_outlet='$d_tb_outlet_d[id]'");
                                    while($d_tb_paket_d_d = mysqli_fetch_array($tb_paket)){
                                      ?>
                                      <option value="<?=$d_tb_paket_d_d['id']?>"><?=$d_tb_paket_d_d['nama_paket']?></option>
                                    <?php } ?>
                                  </select>                                       
                                </div>                       
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="modal-komplain<?php echo $d_tb_transaksi['id']; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Komplain</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>                         
                            <form method="post" action="update_komplain.php">
                              <div class="modal-body">
                              <input type="text" name="id" value="<?php echo $d_tb_transaksi['id']; ?>" hidden>
                              <div class="form-group">
                                <textarea name="komplain" class="form-control" placeholder="Ketik"></textarea>
                                    </div> 
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>


                      <div class="modal fade" id="modal-durasi<?php echo $d_tb_transaksi['id']; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Lama Proses</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>                         
                            <form method="post" action="update_durasi.php">
                              <div class="modal-body">
                                <input type="text" name="id" value="<?php echo $d_tb_transaksi['id']; ?>" hidden>
                                <div class="form-group">
                                  <label>Lama Proses</label>
                                  <select class="form-control" name="durasi">
                                    <option>---Lama Proses---</option>
                                    <option value="1_hari" <?php if('1_hari' == $d_tb_transaksi['durasi']){ echo 'selected'; } ?>>1 Hari</option>
                                    <option value="2_hari" <?php if('2_hari' == $d_tb_transaksi['durasi']){ echo 'selected'; } ?>>2 hari</option>
                                    <option value="3_hari" <?php if('3_hari' == $d_tb_transaksi['durasi']){ echo 'selected'; } ?>>3 hari</option>
                                  </select>                     
                                </div>                       
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="modal-status<?php echo $d_tb_transaksi['id']; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Ubah Status</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>                         
                            <form method="post" action="update_status_transaksi.php">
                              <div class="modal-body">
                                <input type="text" name="id" value="<?php echo $d_tb_transaksi['id']; ?>" hidden>
                                <div class="form-group">
                                  <label>Pilih Status</label>
                                  <select class="form-control" name="status">
                                    <option>--- Pilih Status ---</option>
                                    <option value="baru" <?php if('baru' == $d_tb_transaksi['status']){ echo 'selected'; } ?>>Baru</option>
                                    <option value="proses" <?php if('proses' == $d_tb_transaksi['status']){ echo 'selected'; } ?>>Proses</option>
                                    <option value="selesai" <?php if('selesai' == $d_tb_transaksi['status']){ echo 'selected'; } ?>>Selesai</option>
                                    <option value="diambil" <?php if('diambil' == $d_tb_transaksi['status']){ echo 'selected'; } ?>>Diambil</option>
                                  </select>                     
                                </div>                       
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="modal-batalkan<?php echo $d_tb_transaksi['id']; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Batalkan Transaksi</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">                          
                              <p>Apakah anda Belum menerima dana transaksi sebesar 
                                <b>
                                  <?php 
                                  $tb_paket    =mysqli_query($koneksi, "SELECT * FROM tb_paket where id='$d_tb_transaksi[id_paket]'");
                                  while($d_tb_paket_d = mysqli_fetch_array($tb_paket)){ ?>
                                    <?php 
                                    $a = $d_tb_paket_d['harga'];
                                  }
                                  $b = $d_tb_transaksi['qty'];
                                  $c = $d_tb_transaksi['biaya_tambahan'];
                                  $d = $d_tb_transaksi['pajak'];
                                $e = $d_tb_transaksi['diskon'];
                                $tdiskon = ($a*$b)*($e/100);
                                $total = (($a*$b)+$c)-$tdiskon+$d;
                                  echo "Rp. $total";
                                  ?>                              
                                </b> 
                                dari <b><?=$d_tb_member_d['nama']?></b>...?</p>                           
                                <form method="post" action="update_batal_bayar_transaksi.php">
                                  <div class="modal-body">                          
                                    <div class="form-group">
                                      <input type="text" name="id" value="<?php echo $d_tb_transaksi['id']; ?>" hidden>
                                    </div>                         
                                  </div>                       
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="modal-bayar<?php echo $d_tb_transaksi['id']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Bayar Transaksi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">                          
                                <p>Apakah anda sudah menerima dana transaksi sebesar <b>
                                  <?php 
                                  $tb_paket    =mysqli_query($koneksi, "SELECT * FROM tb_paket where id='$d_tb_transaksi[id_paket]'");
                                  while($d_tb_paket_d = mysqli_fetch_array($tb_paket)){ ?>
                                    <?php 
                                    $a = $d_tb_paket_d['harga'];
                                  }
                                  $b = $d_tb_transaksi['qty'];
                                  $c = $d_tb_transaksi['biaya_tambahan'];
                                  $d = $d_tb_transaksi['pajak'];
                                $e = $d_tb_transaksi['diskon'];
                                $tdiskon = ($a*$b)*($e/100);
                                $total = (($a*$b)+$c)-$tdiskon+$d;
                                  echo "Rp. $total";
                                  ?>                              
                                </b>  dari <b><?=$d_tb_member_d['nama']?></b>...?</p>                           
                                <form method="post" action="update_bayar_transaksi.php">
                                  <div class="modal-body">                          
                                    <div class="form-group">
                                      <input type="text" name="id" value="<?php echo $d_tb_transaksi['id']; ?>" hidden>
                                      <input type="text" name="qty" value="<?php echo $d_tb_transaksi['qty']; ?>" hidden>
                                      <input type="text" name="id_paket" value="<?php echo $d_tb_paket_d['id']; ?>" hidden>
                                    </div>                         
                                  </div>                       
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="modal-hapus<?php echo $d_tb_transaksi['id']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus Data Transaksi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">                          
                                <p>Apakah anda yakin akan menghapus data <b><?php echo $d_tb_transaksi['kode_invoice']; ?></b> ini...?</p>                           
                              </div>                        
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                <a href="hapus_transaksi.php?id=<?php echo $d_tb_transaksi['id']; ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="modal-edit<?php echo $d_tb_transaksi['id']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Transaksi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" action="update_transaksi.php">
                                  <div class="form-group">
                                    <label>Invoice</label>
                                    <input type="text" name="id" class="form-control" value="<?php echo $d_tb_transaksi['id']; ?>" hidden>
                                    <input type="text" name="kode_invoice" class="form-control" value="<?php echo $d_tb_transaksi['kode_invoice']; ?>" readonly="">
                                  </div> 

                                  <div class="form-group">
                                    <label>Pilih Member</label>
                                    <select class="form-control" name="id_member">
                                      <option>--- Pilih Nama Member ---</option>
                                      <?php
                                      include "../koneksi.php";
                                      $tb_member    =mysqli_query($koneksi, "SELECT * FROM tb_member");
                                      while($d_tb_member = mysqli_fetch_array($tb_member)){
                                        ?>
                                        <option value="<?=$d_tb_member['id']?>" <?php if($d_tb_member['id'] == $d_tb_transaksi['id_member']){ echo 'selected'; } ?>><?=$d_tb_member['nama']?></option>
                                      <?php } ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Pilih Outlet</label>
                                    <select name="id_outlet" class="form-control" required>
                                    
                                      <?php
                                  include "../koneksi.php";
                                  $tb_outlet    =mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                                  while($d_tb_outlet = mysqli_fetch_array($tb_outlet)){
                                    ?>
                                    <option value="<?=$d_tb_outlet['id']?>"><?=$d_tb_outlet['nama']?></option>
                                  <?php } ?>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label>Berat/PCS</label>
                                      <input type="text" name="qty" value="<?php echo $d_tb_transaksi['qty']; ?>" class="form-control" placeholder="Masukan Berat" onkeypress="return hanyaAngka(event)" required>
                                    </div>  

                                    <div class="form-group">
                                      <label>Biaya Tambahan</label>
                                      <input type="text" name="biaya_tambahan" value="<?php echo $d_tb_transaksi['biaya_tambahan']; ?>" class="form-control" placeholder="Masukan Biaya Tambahan" onkeypress="return hanyaAngka(event)">
                                    </div>

                                    <div class="form-group">
                                      <label>Diskon</label>
                                      <input type="text" name="diskon" value="<?php echo $d_tb_transaksi['diskon']; ?>" class="form-control" placeholder="Masukan Diskon" onkeypress="return hanyaAngka(event)" >
                                    </div>

                                    <div class="form-group">
                                      <label>Pajak</label>
                                      <input type="number" name="pajak" value="<?php echo $d_tb_transaksi['pajak']; ?>" class="form-control" value="1500"readonly>
                                    </div>

                                    <div class="form-group">
                                      <?php
                                      include "../koneksi.php";
                                      $tb_user    =mysqli_query($koneksi, "SELECT * FROM tb_user where username='$_SESSION[username]'");
                                      while($d_tb_user = mysqli_fetch_array($tb_user)){ ?>
                                        <input type="text" name="id_user" value="<?php echo $d_tb_transaksi['id_user']; ?>" class="form-control" hidden>
                                      <?php } ?>
                                    </div>                     
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                      <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>


                        <?php } } } }  ?>


                        <div class="modal fade" id="modal-tambah">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Tambah Data Transaksi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" action="simpan_transaksi.php">
                                  <div class="form-group">
                                    <label>Invoice</label>
                                    <input type="text" name="kode_invoice" class="form-control" value="INV<?php echo date('dmYHis'); ?>" readonly="">
                                  </div> 

                                  <div class="form-group">
                                    <label>Pilih Member</label>
                                    <select class="form-control" name="id_member">
                                      <option>--- Pilih Nama Member ---</option>
                                      <?php
                                      include "../koneksi.php";
                                      $tb_member    =mysqli_query($koneksi, "SELECT * FROM tb_member");
                                      while($d_tb_member = mysqli_fetch_array($tb_member)){
                                        ?>
                                        <option value="<?=$d_tb_member['id']?>"><?=$d_tb_member['nama']?></option>
                                      <?php } ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Pilih Outlet</label>
                                    <select name="id_outlet" class="form-control" id="id_outlet" required>
                                      <option>--- Pilih Nama Outlet ---</option>
                                      <?php
                                  include "../koneksi.php";
                                  $tb_outlet    =mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                                  while($d_tb_outlet = mysqli_fetch_array($tb_outlet)){
                                    ?>
                                    <option value="<?=$d_tb_outlet['id']?>"><?=$d_tb_outlet['nama']?></option>
                                  <?php } ?>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label>Berat/PCS</label>
                                      <input type="text" name="qty" class="form-control" placeholder="Masukan Berat" onkeypress="return hanyaAngka(event)" required>
                                    </div>  

                                    <div class="form-group">
                                      <label>Biaya Tambahan</label>
                                      <input type="text" name="biaya_tambahan" class="form-control" placeholder="Masukan Biaya Tambahan" onkeypress="return hanyaAngka(event)" >
                                    </div>

                                    <div class="form-group">
                                      <label>Diskon</label>
                                      <input type="text" name="diskon" class="form-control" placeholder="Masukan Diskon" onkeypress="return hanyaAngka(event)" >
                                    </div>

                                    <div class="form-group">
                                      <label>Pajak</label>
                                      <input type="number" name="pajak" class="form-control" value="1500"readonly>
                                    </div>
                                    <div class="form-group">
                                      <?php
                                      include "../koneksi.php";
                                      $tb_user    =mysqli_query($koneksi, "SELECT * FROM tb_user where username='$_SESSION[username]'");
                                      while($d_tb_user = mysqli_fetch_array($tb_user)){ ?>
                                        <input type="text" name="id_user" value="<?php echo $d_tb_user['id']; ?>" class="form-control" hidden>
                                      <?php } ?>
                                    </div>                     
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                      <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content -->

        </div>
        <?php 
        include '../layouts/footer.php';
        ?>