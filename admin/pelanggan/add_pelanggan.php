<?php
//kode

$pass_acak = mt_rand(1000, 9999);

  
$carikode = mysqli_query($koneksi,"SELECT id_pelanggan FROM tb_pelanggan order by id_pelanggan desc");
$datakode = mysqli_fetch_array($carikode);
$kode = $datakode['id_pelanggan'];
$urut = substr($kode, 1, 3);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1){
$format = "C"."00".$tambah;
 	}else if (strlen($tambah) == 2){
 	$format = "C"."0".$tambah;
			}else (strlen($tambah) == 3){
			$format = "C".$tambah
				}

?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">TAMBAH PELANGGAN</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove">
							<i class="fa fa-remove"></i>
						</button>
					</div>
				</div>

				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">ID Pelanggan</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?php echo $format; ?>"
								 readonly/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" autofocus required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Alamat</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">No HP (Awali : 62)</label>
							<div class="col-sm-4">
								<input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No HP" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">E-Mail</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="email" name="email" placeholder="E-Mail" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Paket</label>
							<div class="col-sm-4">
								<select name="id_paket" id="id_paket" class="form-control select2" style="width: 100%;">
									<option selected="selected">-- Pilih --</option>
									<?php
								// ambil data dari database
								$query = "select * from tb_paket";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
									<option value="<?php echo $row['id_paket'] ?>">
										<?php echo $row['paket'] ?>
										|
										<?php echo rupiah($row['tarif']); ?>
									</option>
									<?php
								}
								?>
								</select>
							</div>
						</div>

						<!-- /.box-body -->
						<div class="box-footer">
							<a href="?page=data-pelanggan" class="btn btn-default">Batal</a>
							<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
						</div>
				</form>
				</div>
			</div>
		</div>
</section>

<?php

    if (isset ($_POST['Simpan'])){
    
        $sql_simpan = "INSERT INTO tb_pelanggan (id_pelanggan, nama, alamat, no_hp, email, password, id_paket) VALUES (
           '".$_POST['id_pelanggan']."',
          '".$_POST['nama']."',
		  '".$_POST['alamat']."',
		  '".$_POST['no_hp']."',
		  '".$_POST['email']."',
		  '".$pass_acak."',
          '".$_POST['id_paket']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan){

      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OKE'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=data-pelanggan';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OKE'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=data-pelanggan';
          }
      })</script>";
    }
  }
    
