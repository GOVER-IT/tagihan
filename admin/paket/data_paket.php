<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="?page=add-paket" title="Tambah Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> DATA PAKET</a>
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
							<th>ID</th>
							<th>Paket</th>
							<th>Tarif</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$sql = $koneksi->query("SELECT * from tb_paket");
						while ($data= $sql->fetch_assoc()) {
						?>

						<tr>
							<td>
								<?php echo $data['id_paket']; ?>
							</td>
							<td>
								<?php echo $data['paket']; ?>
							</td>
							<td>
								<?php echo rupiah($data['tarif']); ?>
							</td>

							<td>
								<a href="?page=edit-paket&kode=<?php echo $data['id_paket']; ?>" title="Ubah"
								 class="btn btn-warning">
									<i class="glyphicon glyphicon-edit"></i>
								</a>
								<a href="?page=del-paket&kode=<?php echo $data['id_paket']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
								 title="Hapus" class="btn btn-danger">
									<i class="glyphicon glyphicon-remove"></i>
							</td>
						</tr>
						<?php
                  }
                ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</section>