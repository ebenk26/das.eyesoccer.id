<?php
	if($detailclub)
	{
		// $detailclub = json_decode($detailclub);
		$dt = $detailclub->data;
		// print_r($dt);
?>
<style>
div.user-data{background-color:#00000005}
div.user-data:hover{background-color:#ff990026}
</style>
		<div class="head" style="border-radius: 8px 8px 0px 0px;margin-bottom: 25px;height: 210px;min-height:  unset;">
			<div class="container tx-c">
				<div class="img-radius">
					<img src="<?php echo $dt->url_logo;?>" alt="">
				</div>
			</div>
				<h2 class="tx-c h2-pemain-top-head"><?php echo $dt->name;?></h2>
				<?php if($dt->id_competition == 4){?>
				<a href="<?php echo ($this->session->member ? base_url().'member/regis_player' : base_url().'member/?from=member/regis_player')?>"><span class="button-open sbpbtn unset-btn-white" style="max-height: unset;box-shadow: 1px 2px 3px 1px #0357b5;border-radius: 30px;max-width: max-content;">Daftarkan Sebagai Pemain <?php echo $dt->name;?></span></a>
				<?php }?>
				<div class="container over-x">
							<div id="boxtab" class="container tab-sub-menu w-max" style="position: relative;bottom: unset;margin-top: 20px;">
								<a id="tab-info" href="javascript:void(0)" class="active" onclick="tabmenu(this.id, 'a', 'div', 'active')" active="true" style="padding: 0 8px;">Info</a>
								<a id="tab-pemain" href="javascript:void(0)" class="tabmenu(this.id, 'a', 'div', 'active')" onclick="tabmenu(this.id, 'a', 'div', 'active')" active="true" style="border-left: 1px solid;padding: 0 8px;">Pemain</a>
								<a id="tab-ofisial" href="javascript:void(0)" onclick="tabmenu(this.id, 'a', 'div', 'active')" style="border-left: 1px solid;border-right:  1px solid;border-color: white; padding: 0 8px;">Ofisial</a>
								<a id="tab-suporter" href="javascript:void(0)" onclick="tabmenu(this.id, 'a', 'div', 'active')"  style="padding: 0 8px;border-right:  1px solid;">Prestasi</a>
								<a id="tab-galeri" href="javascript:void(0)" onclick="tabmenu(this.id, 'a', 'div', 'active')"  style="padding: 0 8px;">Galeri</a>
							</div>
						</div>
			</div>
			<div class="container">
					<table class="content-tab-eprofile">
						<tr>
							<td>Julukan</td>
							<td>: <?php echo $dt->nickname;?></td>
						</tr>
						<tr>
							<td>Tanggal Berdiri</td>
							<td>: <?php echo $dt->establish_date;?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>: <?php echo strip_tags($dt->address);?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>: <?php echo $dt->email;?></td>
						</tr>
						<!-- <tr>
							<td>Website</td>
							<td>: <?php echo $dt->website;?></td>
						</tr> -->
					</table>
				</div>
		<div id="tab-pemain" class="container">
			<?php
				foreach($dt->players as $players){
			?>
			<div class="user-data">
				<div class="subhead">
					<div class="img-radius">
						<img src="<?php echo $players->url_pic;?>" alt="<?php echo $players->name;?>">
					</div>
					<h3><?php echo $players->name;?></h3>
					<b>#<?php echo $players->back_number;?></b> <?php echo $players->club;?>
				</div>
				<table>
					<?php
						$pos1=$players->position_a;
						$pos2=$players->position_b;
						if(empty($pos2)){
						$L_pos1="Posisi";
						echo	
							"<tr>
								<td>".$L_pos1."</td>
								<td>".$pos1."</td>
							</tr>
							<tr>";
						}
						else{
						$L_pos1="Posisi 1";
						$L_pos2="Posisi 2";
						echo	
							"<tr>
								<td>".$L_pos1."</td>
								<td>".$pos1."></td>
							</tr>
							<tr>
								<td>".$L_pos2."</td>
								<td>".$pos2."</td>
							</tr>";
						}	
					?>
				</table>
				<a href="<?php echo base_url();?>eyeprofile/pemain_detail/<?php echo $players->slug;?>">lihat detail pemain</a>
			</div>
			<script>
				$(document).ready(function(){
					$("li#slug_klub_detail").html("<?php echo $dt->name;?>");
					$("h3#next_match_klub").html("Jadwal pertandingan <?php echo $dt->name;?>");
				});
			</script>
<?php
			}?>
		</div>
		<div id="tab-ofisial" class="container" style="display:none;">
			<?php
				foreach($dt->official as $officials){
			?>
			<div class="user-data">
				<div class="subhead">
					<div class="img-radius">
						<img src="<?php echo $officials->url_pic;?>" alt="<?php echo $officials->name;?>">
					</div>
					<b><?php echo $officials->position;?></b>
					<h3><?php echo $officials->club;?></h3>
				</div>
				<table>
					<tr>
						<td>Tanggal Lahir</td>
						<td><?php echo $officials->birth_date;?></td>
					</tr>
					<tr>
						<td>Lisensi</td>
						<td><?php echo $officials->license;?></td>
					</tr>
				</table>
				<a href="<?php echo base_url();?>eyeprofile/official_detail/<?php echo $officials->slug;?>">lihat detail ofisial</a>
			</div>
			<?php
				}
			?>
		</div>
		
		<div id="tab-suporter" class="container" style="display:none;">
			<div class="user-data">
				<?php
					foreach($dt->careers as $careers){
				?>
						<span>
							<span><?php echo $careers->month;?></span>
							<span><?php echo $careers->year;?></span>
							<span><?php echo $careers->tournament;?></span>
							<span><?php echo $careers->rank;?></span>
							<span><?php echo $careers->coach;?></span>
						</span>
				<?php
					}
				?>
			</div>
		</div>
		<div id="tab-galeri" class="container" style="display:none;">
			<div class="user-data">
				<?php
					foreach($dt->gallery as $gallery){
				?>
						<img style="width:90%;" src="<?php echo $gallery->url_pic;?>" alt="foto club">
				<?php
					}
				?>
			</div>
		</div>
			<?php
	}
?>
<script>
	$(document).ready(function(){
		// alert();
		$("#tab-info").click();
	});
</script>