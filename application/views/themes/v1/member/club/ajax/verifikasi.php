<?php
if ($verify) {
    foreach ($verify->data as $ver) {
        ?>
        <div class="x-form-daftar-pemain row">
            <a href="<?php echo base_url('member/verifikasi/?act=' . $ver->id); ?>" title="Edit">
                <i class="far fa-edit mg-r10" style="float:right; font-size:.9em;"></i>
            </a>
            <div class="col-xs-12 pd-t-19 edits dftr-pemain">
                <span><?= $ver->name; ?></span>
                <span>No. Kartu Keluarga : <?= $ver->no_kk; ?></span>
                <span>No. KTP/NIK/Kartu Pelajar : <?= $ver->no_ktp; ?></span>
                <span>Registrasi : <?= date('d M Y', strtotime($ver->date_create)); ?></span>
            </div>
        </div>
        <?php
    }

    $this->library->backnext('pageverify', 'pagetotalverify', $verifycount, 'member', 'verify', 20);
}
?>
