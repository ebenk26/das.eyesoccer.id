<?php
if ($galerilist){
	foreach ($galerilist->data as $g) {
?>
		<div class="player-galeri">
			<!--<input type="radio" name="" id="<?php echo $g->id; ?>">-->
			<img src="<?php echo $g->url_pic; ?>" alt="">
			<a onclick="if(confirm('Apa anda yakin untuk menghapus ?')){return true;}else{return false;}" href="javascript:void(0)" title="Hapus" id="delgalericlub_<?php echo $g->id; ?>" class="form_post" action="member" fn="deletegalericlub"
                   >
				   <i class="fas fa-times mg-r10" style="float:right; font-size:.9em;position: relative;top: 5px;"></i>
				   <input type="hidden" name="uid" value="<?php echo $g->id; ?>" class="cinput">
			</a>
		</div>
<?php
	}
?>
	<div class="player-galeri" style="background-color: transparent;">
		<img class="viewimg"></img>
	</div>
	<div class="container simpan tx-c bgw">
		<form class='form_multi' action="<?= base_url('member'); ?>" enctype="multipart/form-data">
			<input type="hidden" name="fn" class="cinput" value="uploadgalericlub">
			<input type="hidden" name="id_club" value="<?php echo $galerilist->query->club;?>">
			<input id="file_pic" name="fupload" type="file" style="display: none;" accept="image/*">
			<button type="button" class="klik-dsn" onclick="add()">ADD FOTO</button>
			<button type="submit" style="display:none;" class="klik-dsn saveBtn">SIMPAN</button>
			<!--<button type="button" class="klik-dsn red" onclick="delete()">DELETE</button>-->
		</form>
	</div>
<?php
}
?>
<script>
	function add(){
			$('#file_pic').click();
		}
		
	$(document).ready(function(){
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('.viewimg').attr('src', e.target.result);
					$('.saveBtn').show();
				}

				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$("#file_pic").change(function(){
			readURL(this);
		});
	});
</script>