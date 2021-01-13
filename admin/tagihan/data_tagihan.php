<?php
	$bulan = $_POST["bulan"];
	$tahun = $_POST["tahun"];
?>
<?php
	$sql = $koneksi->query("SELECT * from tb_bulan where id_bulan='$bulan'");
	while ($data= $sql->fetch_assoc()) {
	
		$bl=$data['bulan'];
	}
?>


<section class="content">

	<div class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>
			<i class="icon fa fa-info"></i> Data Tagihan</h4>
		<h4>Bulan :
			<?php echo $bl; ?>- Tahun :
			<?php echo $tahun; ?>
		</h4>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">DATA TAGIHAN</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove">
					<i class="fa fa-remove"></i>
				</button>

			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>ID PELANGGAN</th>
							<th>Nama</th>
							<th>Tagihan</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
                  $no = 1;
                  $sql = $koneksi->query("SELECT p.id_pelanggan, p.nama, p.no_hp, t.id_tagihan, t.tagihan, t.status, t.tgl_bayar 
				  from tb_pelanggan p inner join tb_tagihan t on p.id_pelanggan=t.id_pelanggan where bulan='$bulan' and tahun='$tahun' and status='BL'
				  order by status asc");
                  while ($data= $sql->fetch_assoc()) {
                ?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['id_pelanggan']; ?>
							</td>
							<td>
								<?php echo $data['nama']; ?>
							</td>
							<td>
								<?php echo rupiah($data['tagihan']); ?>
							</td>
							<td>
								<?php $stt = $data['status']  ?>
								<?php if($stt == 'BL'){ ?>
								<span class="label label-danger">Belum Bayar</span>
								<?php }elseif($stt == 'LS'){ ?>
								<span class="label label-primary">Lunas</span>
								(
								<?php echo $data['tgl_bayar']; ?>)
							</td>
							<?php } ?>

							<td>
								<a href="?page=bayar-tagihan&kode=<?php echo $data['id_tagihan']; ?>" title="Bayar Tagihan"
								 class="btn btn-info">
									<i class="glyphicon glyphicon-ok"></i> BAYAR
								</a>
								<a href="https://api.whatsapp.com/send?phone=<?php echo $data['no_hp']; ?>&text=Sdr/i%20<?php echo $data['nama']; ?>,
								%20Anda%20belum%20melakukan%20pembayaran%20Tagihan%20Internet%20untuk%20Bulan%20<?php echo $bulan; ?>%20Tahun%20<?php echo $tahun; ?>%20*Admin RT RW Net*"
								 target=" _blank" title="Pesan WhatsApp" class="btn btn-success">
									<b>WA</b>
								</a>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>

				</table>
				<!-- /.box-body -->
				<div class="box-footer">
					<a href="?page=buka-tagihan" class="btn btn-primary">Kembali</a>
				</div>
			</div>
		</div>
	</div>
</section>