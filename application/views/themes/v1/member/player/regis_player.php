<?php
    $data['active'] = 'home';
    $this->load->view($folder.'member/header', $data);
?>
<div class="responsif-add-100px">
    <form class='form_multi' action="<?= base_url('member'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="fn" class="cinput" value="regplayer">
        <div class="container data-profil mt20">
            <div id="reqclub" class='loadclub' action="member" loading="off" clean="clsclub">
                <div id='clsclub'>
                    <script>
                        $(document).ready(function(){
                            $(window).on('load',function(){
                                ajaxOnLoad('loadclub');
                            });
                        });
                    </script>
                </div>
                <h2>Registrasi Klub</h2>
                <input type='hidden' name='fn' value='get_listclub' class='cinput'>
                <table>
                    <tr>
                        <td>Klub Sekarang</td>
                        <td>
                            <select id="club" name="club" class="form-control">
                                <option value="">Pilih Klub</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>
                            <input type="text" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td>No. Kartu Keluarga</td>
                        <td>
                            <input type="text" name="no_kk">
                        </td>
                    </tr>
                    <tr>
                        <td>Kartu Keluarga</td>
                        <td>
                            <input type="file" name="file_kk">
                        </td>
                    </tr>
                    <tr>
                        <td>No. KTP atau NIK</td>
                        <td>
                            <input type="number" name="no_ktp">
                        </td>
                    </tr>
                    <tr>
                        <td>KTP (Jika sudah punya)</td>
                        <td>
                            <input type="file" name="file_ktp">
                        </td>
                    </tr>
                    <tr>
                        <td>Akte Kelahiran</td>
                        <td>
                            <input type="file" name="file_akte">
                        </td>
                    </tr>
                    <tr>
                        <td>Ijazah</td>
                        <td>
                            <input type="file" name="file_ijazah">
                        </td>
                    </tr>
                    <tr>
                        <td>Passport</td>
                        <td>
                            <input type="file" name="file_passport">
                        </td>
                    </tr>
                    <tr>
                        <td>Buku Rekening</td>
                        <td>
                            <input type="file" name="file_bukurek">
                        </td>
                    </tr>
                    <tr>
                        <td>KTP Ibu Kandung</td>
                        <td>
                            <input type="file" name="file_ibukandung">
                        </td>
                    </tr>
                    <tr>
                        <td>Surat Rekening SSB</td>
                        <td>
                            <input type="file" name="file_srtrekssb">
                        </td>
                    </tr>
                </table>
            </div>
           
            <?php /*
            ?>
                <div class="container data-oficial">
                    <h3>KARIR DAN PRESTASI OFFICIAL</h3>
                    <div class="scroll-x-outer">
                        <table class="scroll-x-inner">
                            <tr>
                                <td>Bulan</td>
                                <td>Tahun</td>
                                <td>Klub</td>
                                <td>Turnamen / Kompetisi</td>
                                <td>Peringkat Lisensi Penghargaan</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="" id="">
                                        <!-- <option value="">Pilih Bulan</option> -->
                                        <option value="">Jan</option>
                                        <option value="">Feb</option>
                                        <option value="">Mar</option>
                                        <option value="">Apr</option>
                                        <option value="">Mei</option>
                                        <option value="">Jun</option>
                                        <option value="">Jul</option>
                                        <option value="">Agus</option>
                                        <option value="">Sept</option>
                                        <option value="">Okt</option>
                                        <option value="">Nov</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="">
                                        <!-- <option value="">Pilih Tahun</option> -->
                                        <option value="">2018</option>
                                        <option value="">2017</option>
                                        <option value="">2016</option>
                                        <option value="">2015</option>
                                        <option value="">2014</option>
                                        <option value="">2013</option>
                                    </select>
                                </td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php
            */ ?>
        </div>
        <div class="tx-c">
            <input type="submit" value="Simpan" class="klik-dsn" style="font-size:.85em;">
        </div>
    </form>
</div>
<!-- INBOX NOTIFICATION -->
<div class="container dash-notif" id="notifInbox" style="display: none;">
    <div class="panah-notif"></div>
    <div class="title-notif">
        <span class="container">Kotak Masuk</span>
    </div>
    <div class="notific">
        <a href="" class="container inbox-dashboard">
            <div class="container img-inbox-dashboard">
                <img src="<?php echo SUBCDN ?>assets/img/eyeme/user-discover.png" alt="">
            </div>
            <div class="text-inbox">
                <span class="time">12:15</span>
                <span class="sender">eyesoccer</span>
                <span class="title">ayo update data kamu ...</span>
                <span class="preview">Hallo Dila, ayo update data kamu...</span>
            </div>
            <div class="bb2g"></div>
        </a>
        <!-- <a href="" class="container inbox-dashboard">
            <div class="container img-inbox-dashboard">
                <img src="http://localhost/mob.eyesoccer.id/assets/img/eyeme/user-discover.png" alt="">
            </div>
            <div class="text-inbox">
                <span class="time">12:15</span>
                <span class="sender">eyesoccer</span>
                <span class="title">ayo update data kamu ...</span>
                <span class="preview">Hallo Dila, ayo update data kamu...</span>
            </div>
            <div class="bb2g"></div>
        </a> -->
    </div>
</div>

<!-- NOTIFICATION -->
<div class="container dash-notif" id="notifications" style="display: none;">
    <div class="panah-notif2"></div>
    <div class="title-notif">
        <span class="container">Notifikasi</span>
    </div>
    <div class="notific">
        <a href="" class="container inbox-dashboard">
            <div class="container img-inbox-dashboard">
                <img src="<?php echo SUBCDN ?>assets/img/eyeme/user-discover.png" alt="">
            </div>
            <div class="text-inbox2">
                <span>Rika Aulia</span>
                <span>melihat profil kamu</span>
            </div>
            <div class="bb2g"></div>
        </a>
        <!-- <a href="" class="container inbox-dashboard">
            <div class="container img-inbox-dashboard">
                <img src="http://localhost/mob.eyesoccer.id/assets/img/eyeme/user-discover.png" alt="">
            </div>
            <div class="text-inbox2">
                <span>Rika Aulia</span>
                <span>melihat profil kamu</span>
            </div>
            <div class="bb2g"></div>
        </a> -->
    </div>
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
    function closeFunction() {
        var y = document.getElementById("welcome");
        if (y.style.display == "block") {
            y.style.display = "none";
        }
    }
    function functionNotifInbox() {
        var y = document.getElementById("notifInbox");
        var p = document.getElementById("isiContent");
        var q = document.getElementById("signNotifInbox");
        var a = document.getElementById("notifications");
        if (y.style.display == "none") {
            y.style.display = "block";
            q.style.display = "none";
            p.style.filter = "blur(20px)";
            a.style.display = "none";
            
        } else {
            y.style.display = "none";
            p.style.filter = "unset";
        }
    }
    function functionNotification() {
        var a = document.getElementById("notifications");
        var b = document.getElementById("isiContent");
        var c = document.getElementById("signNotification");
        var y = document.getElementById("notifInbox");
        if (a.style.display == "none") {
            a.style.display = "block";
            c.style.display = "none";
            b.style.filter = "blur(20px)";
            y.style.display = "none";
        } else {
            a.style.display = "none";
            b.style.filter = "unset";
        }
    }
</script>