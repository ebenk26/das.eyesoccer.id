<?php
if ($klubdetail){
	$dt = json_decode($klubdetail);
	print_r($dt);
?>
	<div class="container data-profil mt20">
		<table>
			<tr>
				<td>Nama Klub</td>
				<td>
					<input type="text" value="<?php echo $dt->data->name;?>">
				</td>
			</tr>
			<tr>
				<td>Nama Panggilan</td>
				<td>
					<input type="text" value="<?php echo $dt->data->nickname;?>">
				</td>
			</tr>
			<tr>
				<td>Provinsi</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Kabupaten</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Tanggal didirikan</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>No. Telp</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Home Base</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Alamat Klub</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Deskripsi Klub</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Nama Pelatih</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Nama Manager</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Nama Supporter</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Nama Pemilik</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Nama Direktur</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>Jadwal Latihan</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>
					Legalitas Perusahaan
				</td>
				<td>
					<div class="up-foto">
						<i class="fas fa-plus-circle"></i>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="tx-c">
					<button class="klik-dsn">Simpan</button>
				</td>
			</tr>
		</table>
	</div>
<?php
}
?>