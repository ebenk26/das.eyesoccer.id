<?php
if ($klubdetail){
	$dt = json_decode($klubdetail);
	$v = $dt->data;
?>
	<div class="container data-profil mt20">
		<table>
			<tr>
				<td>Nama Klub</td>
				<td>
					<input type="text" value="<?php echo $v[0]->name;?>">
				</td>
			</tr>
			<tr>
				<td>Nama Panggilan</td>
				<td>
					<input type="text" value="<?php echo $v[0]->nickname;?>">
				</td>
			</tr>
			<!--<tr>
				<td>Provinsi</td>
				<td>
					<input type="text" value="">
				</td>
			</tr>
			<tr>
				<td>Kabupaten</td>
				<td>
					<input type="text">
				</td>
			</tr>-->
			<tr>
				<td>Tanggal didirikan</td>
				<td>
					<input type="text" value="<?php echo $v[0]->establish_date;?>">
				</td>
			</tr>
			<tr>
				<td>No. Telp</td>
				<td>
					<input type="text" value="<?php echo $v[0]->phone;?>">
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="text" value="<?php echo $v[0]->email;?>">
				</td>
			</tr>
			<!--<tr>
				<td>Home Base</td>
				<td>
					<input type="text">
				</td>
			</tr>-->
			<tr>
				<td>Alamat Klub</td>
				<td>
					<input type="text" value="<?php echo strip_tags($v[0]->address);?>">
				</td>
			</tr>
			<!--<tr>
				<td>Deskripsi Klub</td>
				<td>
					<input type="text" value="">
				</td>
			</tr>-->
			<tr>
				<td>Nama Pelatih</td>
				<td>
					<input type="text" value="<?php echo $v[0]->coach;?>">
				</td>
			</tr>
			<tr>
				<td>Nama Manager</td>
				<td>
					<input type="text" value="<?php echo $v[0]->manager;?>">
				</td>
			</tr>
			<tr>
				<td>Nama Supporter</td>
				<td>
					<input type="text" value="<?php echo $v[0]->supporter_name;?>">
				</td>
			</tr>
			<tr>
				<td>Nama Pemilik</td>
				<td>
					<input type="text" value="<?php echo $v[0]->owner;?>">
				</td>
			</tr>
			<!--<tr>
				<td>Nama Direktur</td>
				<td>
					<input type="text">
				</td>
			</tr>-->
			<tr>
				<td>Jadwal Latihan</td>
				<td>
					<input type="text" value="<?php echo $v[0]->training_schedule;?>">
				</td>
			</tr>
			<tr>
				<td>
					Legalitas Perusahaan
				</td>
				<td>
					<div class="up-foto">
						<input id="file_pic" name="fupload" type="file" style="" accept="image/*">
						<!--<i class="fas fa-plus-circle"></i>-->
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