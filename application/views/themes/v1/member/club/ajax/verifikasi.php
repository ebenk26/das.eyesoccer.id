<?php foreach ($verify as $ver): ?>
	<a href="<?= base_url('member/detail_verifikasi/'.$ver->id_member); ?>">
		<div class="x-form-daftar-pemain row">
		    <i class="far fa-edit top-edit"></i>
		    <div class="container edits">
				<table>
					<tr>
						<td colspan="2">
						<b style="color: #616161;font-weight: 600;"><?= $ver->name; ?></b>
						</td>
					</tr>
					<tr>
						<td>
						No. KK
						</td>
						<td>
						: <?= $ver->no_kk; ?>
						</td>
					</tr>
					<tr>
						<td>
						No. KTP
						</td>
						<td>
						: <?= $ver->no_ktp; ?>
						</td>
					</tr>
					<tr>
						<td>
						Registrasi
						</td>
						<td>
						: <?= date('d M Y', strtotime($ver->date_create)); ?>
						</td>
					</tr>
				</table>
		        <!-- <span><b><?= $ver->name; ?></b></span>
		        <span> No. KK : <?= $ver->no_kk; ?></span>
		        <span> No. KTP : <?= $ver->no_ktp; ?></span>
		        <span> Registrasi : <?= date('d M Y', strtotime($ver->date_create)); ?></span> -->
		    </div>
		</div>
	</a>
<?php endforeach ?>
