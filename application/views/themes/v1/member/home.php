<?php
    $data['active'] = 'home';
    $this->load->view($folder.'member/header', $data);
?>

<div class="responsif-add-100px">
    <div class="container wlc" id="welcome" style="display:block;">
        <div>
            <img src="<?php echo base_url('assets/img/email/background.png'); ?>" alt="">
        </div>
        <div class="close-wlcm">
            <i class="fas fa-times" onclick="closeFunction()"></i>
        </div>
        <div class="wlcm">
            <span>SELAMAT DATANG</span>
            <span>DI EYESOCCER</span>
            <span>UPDATE DATA PRIBADI KAMU</span>
        </div>
    </div>
    <div class="container daftar-pemain">
        <div class="form-daftar-pemain">
            <span>JIKA KAMU PEMAIN SEPAKBOLA</span>
            <span>DAFTARKAN KLUB KAMU</span>
            <a href="<?php echo base_url()?>member/regis_klub"><button class="klik-dsn">KLIK DISINI</button></a>
        </div>
        <div class="form-daftar-pemain">
            <span class="fs68">JIKA KAMU SUPPORTER SEPAKBOLA</span>
            <span>DAFTARKAN PEMAIN</span>
            <a href="<?php echo base_url()?>member/regis_player"><button class="klik-dsn">KLIK DISINI</button></a>
        </div>
    </div>
</div>