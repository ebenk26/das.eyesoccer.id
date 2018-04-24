    <?php
        $data['active'] = 'klub';
        $this->load->view($folder.'member/header', $data);
	?>
    <div class="responsif-add-100px">
		<?php
			$data['active'] = 'galeri';
			$this->load->view($folder.'member/club/header', $data);
		?>
			<!-- galeri -->
			<div class="container">
				<div class="container form-profil-dash pd20" id="form-galeri">
				
					<div id="reqgaleri" class='loadgaleri' action="member" loading="off" clean="clsgaleri">
						<div id='clsgaleri'>
							<script>
								$(document).ready(function(){
									$(window).on('load',function(){
										ajaxOnLoad('loadgaleri');
									});
								});
							</script>
						</div>
						<input type='hidden' name='fn' value='galeri' class='cinput'>
						<div class="player-galeri">
							<input type="radio" name="" id="">
							<img src="<?php echo SUBCDN;?>assets/themes/v1/img/a.jpg" alt="">
						</div>
						<div class="player-galeri">
							<input type="radio" name="" id="">
							<img src="<?php echo SUBCDN;?>assets/themes/v1/img/a.jpg" alt="">
						</div>
						<div class="player-galeri">
							<input type="radio" name="" id="">
							<img src="<?php echo SUBCDN;?>assets/themes/v1/img/a.jpg" alt="">
						</div>
						<div class="player-galeri">
							<input type="radio" name="" id="">
							<img src="<?php echo SUBCDN;?>assets/themes/v1/img/a.jpg" alt="">
						</div>
						<div class="player-galeri">
							<input type="radio" name="" id="">
							<img src="<?php echo SUBCDN;?>assets/themes/v1/img/a.jpg" alt="">
						</div>
					</div>
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