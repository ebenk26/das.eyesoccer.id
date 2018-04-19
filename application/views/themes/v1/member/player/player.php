<?php
    $data['active'] = 'player';
    $this->load->view($folder.'member/header', $data);
?>
<div class="menu-dashboard">
    <div class="container bg-menu-pic bg250">
        <div class="menu-pic">
            <img src="http://localhost/mob.eyesoccer.id/assets/themes/v1/img/d.jpg" alt="">
        </div>
    </div>
    <div class="player-tabs bg250">
        <div class="container player-tab" id="player-tab">
            <span id="form-player" class="active">Profil</span>
            <span id="form-karir">Karir</span>
            <span id="form-penghargaan">Penghargaan</span>
            <span id="form-galeri">Galeri</span>
        </div>
    </div>
    <!-- player -->
    <div class="container">
        <div class="form-profil-dash" id="form-player">
            <span>Kewarganegaraan</span>
            <input type="text" placeholder="data player">
            <span>Tempat Lahir</span>
            <input type="text" placeholder="data player">
            <span>Tanggal Lahir</span>
            <input type="text" placeholder="data player">
            <span>Status</span>
            <input type="text" placeholder="data player">
            <span>Tinggi</span>
            <input type="text" placeholder="data player">
            <span>Berat</span>
            <input type="text" placeholder="data player">
            <span>No HP</span>
            <input type="text" placeholder="data player">
            <span>Email</span>
            <input type="text" placeholder="data player">
            <span>Posisi</span>
            <input type="text" placeholder="data player">
            <span>Klub</span>
            <input type="text" placeholder="data player">
            <span>Nomor Punggung</span>
            <input type="text" placeholder="data player">
            <span>Nama Panggilan</span>
            <input type="text" placeholder="data player">
            <span>Foot</span>
            <input type="text" placeholder="data player">
        </div>
        <div class="container tx-c simpan">
            <button class="klik-dsn">SIMPAN</button>
        </div>
    </div>
    <!-- karir -->
    <!-- <div class="container">
        <div class="form-profil-dash" id="form-karir">
            <span>Tahun</span>
            <input type="text" placeholder="data player">
            <span>Turnamen</span>
            <input type="text" placeholder="data player">
            <span>Negara</span>
            <input type="text" placeholder="data player">
            <span>Ranking</span>
            <input type="text" placeholder="data player">
            <span>Pelatih</span>
            <input type="text" placeholder="data player">
            <span>Klub</span>
            <input type="text" placeholder="data player">
            <span>Nomor Punggung</span>
            <input type="text" placeholder="data player">
        </div>
        <div class="container tx-c simpan">
            <button class="klik-dsn">SIMPAN</button>
        </div>
    </div> -->
    <!-- penghargaan -->
    <!-- <div class="container">
        <div class="form-profil-dash" id="form-penghargaan">
            <span>Tahun</span>
            <input type="text" placeholder="data player">
            <span>Turnamen</span>
            <input type="text" placeholder="data player">
            <span>Negara</span>
            <input type="text" placeholder="data player">
            <span>Ranking</span>
            <input type="text" placeholder="data player">
            <span>Pelatih</span>
            <input type="text" placeholder="data player">
            <span>Klub</span>
            <input type="text" placeholder="data player">
            <span>Nomor Punggung</span>
            <input type="text" placeholder="data player">
        </div>
        <div class="container tx-c simpan">
            <button class="klik-dsn">SIMPAN</button>
        </div>
    </div> -->
    <!-- galeri -->
    <!-- <div class="container">
        <div class="container form-profil-dash" id="form-galeri">
            <div class="player-galeri">
                <input type="radio" name="" id="">
                <img src="http://localhost/mob.eyesoccer.id/assets/themes/v1/img/a.jpg" alt="">
            </div>
            <div class="player-galeri">
                <input type="radio" name="" id="">
                <img src="http://localhost/mob.eyesoccer.id/assets/themes/v1/img/a.jpg" alt="">
            </div>
            <div class="player-galeri">
                <input type="radio" name="" id="">
                <img src="http://localhost/mob.eyesoccer.id/assets/themes/v1/img/a.jpg" alt="">
            </div>
            <div class="player-galeri">
                <input type="radio" name="" id="">
                <img src="http://localhost/mob.eyesoccer.id/assets/themes/v1/img/a.jpg" alt="">
            </div>
            <div class="player-galeri">
                <input type="radio" name="" id="">
                <img src="http://localhost/mob.eyesoccer.id/assets/themes/v1/img/a.jpg" alt="">
            </div>
        </div>
        <div class="container simpan">
            <button class="klik-dsn">ADD FOTO</button>
            <button class="klik-dsn">DELETE</button>
        </div>
    </div> -->
</div>
<script>
    function myFunction() {
        var x = document.getElementById("menuDashboard");
        if (x.style.display == "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>