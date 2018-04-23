<?php
if ($klubdetail){
	$v = $klubdetail->data;
?>
<style>
	.btn-blue{
        background-color: #4FC3F7;
        color: white;
        padding: 8px 10px;
        border-radius: 5px;
        font-size: .9em;
        display: block;
        text-align: center;
        margin: 8px;
        border: 0px;
        box-sizing: border-box;
    }
</style>
<form class='form_multi' action="<?= base_url('member'); ?>" enctype="multipart/form-data">
	<input type="hidden" name="fn" class="cinput" value="editclub">
	<input type="hidden" name="id_club" value="<?php echo $v[0]->id_club;?>">
	<input type="hidden" name="slug" value="<?php echo $v[0]->slug;?>">
	<div class="container mt20">
		<div class="pp-profil">
			<img src="<?php echo (!empty($v[0]->url_logo) ? $v[0]->url_logo : base_url()."assets/themes/v1/img/fav.png")?>" alt="Logo Klub" class="viewimg">
		</div>
		<div class="full-width">
            <label class="btn-blue">
                Ganti Logo
                <input id="file_pic" name="logo" type="file" style="display: none;" accept="image/*">
            </label>
        </div>
	</div>
	<div class="container data-profil mt20">
		<table>
			<tr>
				<td>Nama Klub</td>
				<td>
					<input type="text" name="name" value="<?php echo $v[0]->name;?>">
					<span class='err msgname'></span>
				</td>
			</tr>
			<tr>
				<td>Nama Panggilan</td>
				<td>
					<input type="text" name="nickname" value="<?php echo $v[0]->nickname;?>">
					<span class='err msgnickname'></span>
				</td>
			</tr>
			<tr>
				<td>Deskripsi Klub</td>
				<td>
					<input type="text" name="description" value="<?php echo strip_tags($v[0]->description);?>">
					<span class='err msgdescription'></span>
				</td>
			</tr>
			<tr>
				<td>Provinsi</td>
				<td>
					<div class="container" style="font-size: .8em;">
					<?php
						if($provinsi)
						{
					?>
							<select name="provinsi" selected="true" class="slc-musim form_change" action="member" fn="get_kabupaten" loading="off" dest="opt-kabupaten">
								<option value>--Pilih Provinsi--</option>
					<?php
							foreach($provinsi as $dt) 
							{
								if($v[0]->id_provinsi == $dt->IDProvinsi){
					?>
									<option value="<?php echo $dt->IDProvinsi?>" selected> 
										<?php echo $dt->nama;?> 
									</option>
					<?php
								}else{
					?>
									<option value="<?php echo $dt->IDProvinsi?>"> 
										<?php echo $dt->nama;?> 
									</option>
					<?php
								}
							}
					?>
							</select>
					<?php
						}
					?>
					</div>
				</td>
			</tr>
			<tr>
				<td>Kabupaten</td>
				<td>
					<div class="container opt-kabupaten" style="font-size: .8em;">
						<select id="kabupaten" name="kabupaten" class="form-control">
							<option value="">--Pilih Kabupaten--</option>
							<?php
									foreach($kabupaten as $dt) 
									{
										if($v[0]->Id_kabupaten == $dt->IDKabupaten){
							?>
											<option value="<?php echo $dt->IDKabupaten?>" selected> 
												<?php echo $dt->nama;?> 
											</option>
							<?php
										}else{
							?>
											<option value="<?php echo $dt->IDKabupaten?>"> 
												<?php echo $dt->nama;?> 
											</option>
							<?php
										}
									}
							?>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>Tanggal didirikan</td>
				<td>
					<input type="text" name="establish_date" value="<?php echo date('d-m-Y',strtotime($v[0]->establish_date));?>" id="birthdate">
					<span class='err msgestablish_date'></span>
				</td>
			</tr>
			<tr>
				<td>No. Telp</td>
				<td>
					<input type="number" name="phone" value="<?php echo $v[0]->phone;?>">
					<span class='err msgphone'></span>
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="text" name="email" value="<?php echo $v[0]->email;?>">
					<span class='err msgemail'></span>
				</td>
			</tr>
			<!--<tr>
				<td>Home Base</td>
				<td>
					<input type="text" name="">
				</td>
			</tr>-->
			<tr>
				<td>Alamat Klub</td>
				<td>
					<input type="text" name="address" value="<?php echo strip_tags($v[0]->address);?>">
					<span class='err msgaddress'></span>
				</td>
			</tr>
			<!--<tr>
				<td>Deskripsi Klub</td>
				<td>
					<input type="text" name="" value="">
				</td>
			</tr>-->
			<tr>
				<td>Nama Pelatih</td>
				<td>
					<input type="text" name="coach" value="<?php echo $v[0]->coach;?>">
					<span class='err msgcoach'></span>
				</td>
			</tr>
			<tr>
				<td>Nama Manager</td>
				<td>
					<input type="text" name="manager" value="<?php echo $v[0]->manager;?>">
					<span class='err msgmanager'></span>
				</td>
			</tr>
			<tr>
				<td>Nama Supporter</td>
				<td>
					<input type="text" name="supporter_name" value="<?php echo $v[0]->supporter_name;?>">
				</td>
			</tr>
			<tr>
				<td>Nama Pemilik</td>
				<td>
					<input type="text" name="owner" value="<?php echo $v[0]->owner;?>">
					<span class='err msgowner'></span>
				</td>
			</tr>
			<!--<tr>
				<td>Nama Direktur</td>
				<td>
					<input type="text" name="">
				</td>
			</tr>-->
			<tr>
				<td>Jadwal Latihan</td>
				<td>
					<input type="text" name="training_schedule" value="<?php echo $v[0]->training_schedule;?>">
					<span class='err msgtraining_schedule'></span>
				</td>
			</tr>
			<tr>
				<td>
					Legalitas Perusahaan
				</td>
				<td>
					<input id="file_pic" name="legal_pt" type="file" style="" accept="image/*">
					<span class='err msglegal_pt'></span>
					<!--<div class="up-foto">
						<i class="fas fa-plus-circle"></i>
					</div>-->
				</td>
			</tr>
			<tr>
				<td colspan="2" class="tx-c">
					<button class="klik-dsn">Simpan</button>
				</td>
			</tr>
		</table>
	</div>
</form>
<?php
}
?>
<script>
	$(document).ready(function(){
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('.viewimg').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$("#file_pic").change(function(){
			readURL(this);
		});
		
		$('#birthdate').datepicker({
             dateFormat: 'dd-mm-yy',
             changeMonth: true,
             changeYear: true
         });
	});
</script>