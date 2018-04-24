<?php foreach ($verify as $ver): ?>
	<a href="<?= base_url('member/detail_verifikasi/'.$ver->id_member); ?>">
		<div class="x-form-daftar-pemain row">
		    <i class="far fa-edit" style="float:right; font-size:.9em;"></i>
		    <div class="col-xs-4 edits">
		        <div class="img-round">
		            <img src="<?php echo SUBCDN."assets/img/eyeme/user-discover.png"; ?>" alt="">
		        </div>
		    </div>
		    <div class="col-xs-8 pd-t-19 edits dftr-pemain">
		        <span><?= $ver->name; ?></span>
		        <span> No. KK : <?= $ver->no_kk; ?></span>
		        <span> No. KTP : <?= $ver->no_ktp; ?></span>
		        <span> Tanggal Registrasi : <?= date('d M Y', strtotime($ver->date_create)); ?></span>
		    </div>
		</div>
	</a>
<?php endforeach ?>
