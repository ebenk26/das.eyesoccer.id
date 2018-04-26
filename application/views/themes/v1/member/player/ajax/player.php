
<a href="<?php echo base_url('member/player/?tab=profil'); ?>" class="btn-white-orange fl-r">Tambah pemain</a>
<div class="container mt20">
		<div class="pp-profil">
			<img src="<?php echo (!empty($v[0]->url_logo) ? $v[0]->url_logo : base_url()."assets/themes/v1/img/fav.png")?>" alt="" class="viewimg">
		</div>
		<div class="full-width">
            <label class="btn-blue">
                Ganti Logo
                <input id="file_pic" name="logo" type="file" style="display: none;" accept="image/*">
            </label>
        </div>
    </div>
    <div class="container">
<?php
    if ($player) {
        foreach ($player->data as $p) {
            ?>
            <div class="x-form-daftar-pemain row">
                <a href="javascript:void(0)" title="Hapus" id="delkarir_<?php echo $p->id; ?>" class="form_post" action="member" fn="playeract"
                   confirm="Apakah anda yakin ingin menghapusnya?">
                    <i class="fas fa-times" style="float:right; font-size:.9em;"></i>
                    <span class="cinput disp-none" name="act" val="2"></span>
                    <input type="hidden" name="uid" value="<?php echo $p->slug; ?>" class="cinput">
                </a>
                <a href="<?php echo base_url('member/player/?tab=profil&uid='.$p->id); ?>"><i class="far fa-edit mg-r10" style="float:right; font-size:.9em;"></i></a>
                <div class="col-xs-4 edits">
                    <div class="img-round">
                        <img src="<?php echo $p->url_pic; ?>" alt="">
                    </div>
                </div>
                <div class="col-xs-8 pd-t-19 edits dftr-pemain">
                    <span><?php echo $p->name; ?></span>
                    <span><?php echo $p->back_number; ?></span>
                    <span><?php echo $p->position_a; ?></span>
                    <span><?php echo $p->nationality; ?></span>
                </div>
            </div>
            <?php
        }

        $this->library->backnext('pageplayer', 'pagetotalplayer', $playercount, 'member', 'player', 20);
    }
?>
</div>
