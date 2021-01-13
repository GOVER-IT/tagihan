<?php
include "../inc/koneksi.php";
include "../inc/rupiah.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Cetak Struk Kos</title>
	<link rel="icon" href="../dist/img/print.jpg">
</head>

<body>

	<center>
		<h2>** STRUK PEMBAYARAN **</h2>
		<h4>TAGIHAN LAYANAN RT-RW NET</h4>
		<hr / size="2px" color="black">


		<table border="1" cellspacing="0" style="width: 100%">
			<thead>
				<tr>
					<th>Pelanggan</th>
					<th>Paket</th>
					<th>Bulan/Tahun</th>
					<th>Tagihan</th>
					<th>Status</th>
					<th>Tgl Bayar</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$id = $_GET['id_tagihan'];

				$no=1;
				$sql_tampil = "SELECT p.id_pelanggan, p.nama, p.no_hp, t.id_tagihan, t.tagihan, t.status, t.tgl_bayar, t.bulan, t.tahun, k.id_paket   
				from tb_pelanggan p inner join tb_tagihan t on p.id_pelanggan=t.id_pelanggan 
				inner join tb_paket k on k.id_paket=p.id_paket where status='LS' AND id_tagihan='$id'";
				$query_tampil = mysqli_query($koneksi, $sql_tampil);
				while ($data = mysqli_fetch_array($query_tampil,MYSQLI_BOTH)) {
				?>
				<tr align="center">
					<td>
						<?php echo $data['id_pelanggan']; ?>
						-
						<?php echo $data['nama']; ?>
					</td>
					<td>
						<?php echo $data['id_paket']; ?>
					</td>
					<td>
						<?php echo $data['bulan']; ?>
						/
						<?php echo $data['tahun']; ?>
					</td>
					<td>
						<?php echo rupiah($data['tagihan']); ?>
					</td>
					<td>
						<?php $stt = $data['status']  ?>
						<?php if($stt == 'BL'){ ?>
						<span class="label label-danger">Belum Bayar</span>
						<?php }elseif($stt == 'LS'){ ?>
						<span class="label label-info">Lunas</span>
					</td>
					<?php } ?>
					<td>
						<?php  $tgl = $data['tgl_bayar']; echo date("d-M-Y", strtotime($tgl))?>
					</td>

				</tr>
				<?php
				}
        		?>
			</tbody>
		</table>
	</center>

	<script>
		window.print();
	</script>
</body>

</html>