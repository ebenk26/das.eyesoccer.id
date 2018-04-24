<?php foreach ($verify as $ver): ?>

	<div class="x-form-daftar-pemain row">
		<table>
			<tr>
				<th>Nama</th>
				<td>: <?= $ver->name; ?></td>
			</tr>
			<tr>
				<th>No. KK</th>
				<td>: <?= ($ver->no_kk == "") ? '-' : $ver->no_kk; ?></td>
			</tr>
			<tr>
				<th>No. Ktp</th>
				<td>: <?= ($ver->no_ktp == "") ? '-' : $ver->no_ktp; ?></td>
			</tr>
			<tr>
				<th>Tanggal Registrasi</th>
				<td>: <?= date('d M Y',strtotime($ver->date_create)); ?></td>
			</tr>
		</table>
		<p>Lampiran</p>
		<table>
			<?php if ($ver->url_kk != "http://static.eyesoccer.id/v1/cache/images/"): ?>
				<tr>
					<td>
						Kartu Keluarga
					</td>
					<td>
						<img src="<?= $ver->url_kk; ?>" alt="" style="width: 35%;">
					</td>
				</tr>
			<?php endif ?>
			<?php if ($ver->url_ktp != "http://static.eyesoccer.id/v1/cache/images/"): ?>
				<tr>
					<td>
						KTP
					</td>
					<td>
						<img src="<?= $ver->url_ktp; ?>" alt="" style="width: 35%;">
					</td>
				</tr>
			<?php endif ?>
			<?php if ($ver->url_akte != "http://static.eyesoccer.id/v1/cache/images/"): ?>
				<tr>
					<td>
						Akte Kelahiran
					</td>
					<td>
						<img src="<?= $ver->url_akte; ?>" alt="" style="width: 35%;">
					</td>
				</tr>
			<?php endif ?>
			<?php if ($ver->url_ijazah != "http://static.eyesoccer.id/v1/cache/images/"): ?>
				<tr>
					<td>
						Ijazah
					</td>
					<td>
						<img src="<?= $ver->url_ijazah; ?>" alt="" style="width: 35%;">
					</td>
				</tr>
			<?php endif ?>
			<?php if ($ver->url_passport != "http://static.eyesoccer.id/v1/cache/images/"): ?>
				<tr>
					<td>
						Passport
					</td>
					<td>
						<img src="<?= $ver->url_passport; ?>" alt="" style="width: 35%;">
					</td>
				</tr>
			<?php endif ?>
			<?php if ($ver->url_bukurek != "http://static.eyesoccer.id/v1/cache/images/"): ?>
				<tr>
					<td>
						Buku Rekening
					</td>
					<td>
						<img src="<?= $ver->url_bukurek; ?>" alt="" style="width: 35%;">
					</td>
				</tr>
			<?php endif ?>
			<?php if ($ver->url_ibukandung != "http://static.eyesoccer.id/v1/cache/images/"): ?>
				<tr>
					<td>
						KTP Ibu Kandung
					</td>
					<td>
						<img src="<?= $ver->url_ibukandung; ?>" alt="" style="width: 35%;">
					</td>
				</tr>
			<?php endif ?>
			<?php if ($ver->url_srtrekssb != "http://static.eyesoccer.id/v1/cache/images/"): ?>
				<tr>
					<td>
						Surat Rekening SSB
					</td>
					<td>
						<img src="<?= $ver->url_srtrekssb; ?>" alt="" style="width: 35%;">
					</td>
				</tr>
			<?php endif ?>
		</table>
		<span class="klik-dsn" style="padding-bottom: 12px; margin-left: 33%;"> Approve </span>
	</div>
	<div class="x-form-daftar-pemain row">
		<?php if (count($ver->players) > 0 ): ?>
			<p>Pemain Dengan Nama yang Sama</p>
			<table>
				<?php foreach ($ver->players as $pl): ?>
					<tr>
						<td>Nama</td>
						<td>: <?= $pl->name; ?></td>
					</tr>
					<tr>
						<td>Club</td>
						<td>: <?= $pl->club; ?></td>
					</tr>
					<tr>
						<td>Kewarganegaraan</td>
						<td>: <?= $pl->nationality; ?></td>
					</tr>
				<?php endforeach ?>
			</table>
			<span class="klik-dsn" style="padding-bottom: 12px; margin-left: 33%;"> Approve </span>
		<?php endif ?>
	</div>
	
<?php endforeach ?>
