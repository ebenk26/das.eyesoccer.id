<?php
	if($detailclub)
	{
		$detailclub = json_decode($detailclub);
		$dt = $detailclub->data;
?>
<style>
div.user-data{background-color:#00000005}
div.user-data:hover{background-color:#ff990026}
</style>
		<div class="head">
			<div class="img-radius">
				<img src="<?php echo $dt->url_logo;?>"
					alt="">
			</div>
			<h2 class="h2-text-bottom"><?php echo $dt->name;?></h2>
			<div class="container tab-eprofile">
				<a class="active" href="#content1">Info</a>
			</div>
			<div class="table-scroll">
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
					<tr>
						<td>Website</td>
						<td>: <?php echo $dt->website;?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="container">
			<div id="boxtab" class="container sub-menu">
				<a id="tab-pemain" href="javascript:void(0)" class="active" onclick="tabmenu(this.id, 'a', 'div', 'active')" active="true">Pemain</a>
				<a id="tab-ofisial" href="javascript:void(0)" onclick="tabmenu(this.id, 'a', 'div', 'active')">Ofisial</a>
				<a id="tab-suporter" href="javascript:void(0)" onclick="tabmenu(this.id, 'a', 'div', 'active')">suporter</a>
			</div>
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
				coming soon
		</div>
			<?php
	}
?>