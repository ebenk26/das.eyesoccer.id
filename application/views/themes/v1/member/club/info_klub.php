    <?php
        $data['active'] = 'klub';
        $this->load->view($folder.'member/header', $data);
	?>
    <div class="responsif-add-100px">
		<?php
			$data['active'] = 'klub';
			$this->load->view($folder.'member/club/header', $data);
		?>
	<div id="reqinfoklub" class='loadinfoklub' action="member" loading="off" clean="clsinfoklub">
		<div id='clsinfoklub'>
			<script>
				$(document).ready(function(){
					$(window).on('load',function(){
						ajaxOnLoad('loadinfoklub');
					});
				});
			</script>
		</div>
		<input type='hidden' name='fn' value='infoklub' class='cinput'>
		<div class="container mt20">
			<div class="pp-profil">
				<img src="<?php echo SUBCDN;?>assets/themes/v1/img/fav.png" alt="Logo Klub">
			</div>
		</div>
			<div class="container data-profil mt20">
				<table>
					<tr>
						<td>Nama Klub</td>
						<td>
							<input type="text">
						</td>
					</tr>
					<tr>
						<td>Nama Panggilan</td>
						<td>
							<input type="text">
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
		</div>
	</div>
    <div class="container dash-notif" id="notifications" style="display: none;">
        <div class="panah-notif2"></div>
        <div class="title-notif">
            <span class="container">Notifikasi</span>
        </div>
        <div class="notific">
            <a href="" class="container inbox-dashboard">
                <div class="container img-inbox-dashboard">
                    <img src="<?php echo base_url();?>assets/img/eyeme/user-discover.png" alt="">
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