<div class="container">
    <form class='form_multi' action="<?php echo base_url('member'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="fn" class="cinput" value="uploadgalericlub">
        <input type="hidden" name="act" class="cinput" value="1">
        <div class="full-width col-xs-7 container tx-c" style="padding:0px;">
            <div class="gal-upload">
                <img src="<?php echo SUBCDN . "assets/themes/v1/img/fav.png"; ?>" alt="Player" class="viewimg">
            </div>
        </div>
        <div class="full-width col-xs-5 container tx-c" style="box-sizing:border-box;">
            <label class="klik-dsn blue disp-inblock mg-b10 mg-b15">
                Upload Photo
                <input type="file" name="fupload" id="filepic" style="display: none;" accept="image/*">
            </label>
            <button class="klik-dsn">Simpan</button>
        </div>
    </form>
</div>

<?php
    if ($galerilist) {
        foreach ($galerilist->data as $g) {
            ?>
            <div class="player-galeri">
                <a onclick="if(confirm('Apa anda yakin untuk menghapus ?')){return true;}else{return false;}" href="javascript:void(0)" title="Hapus"
                   id="delgalericlub_<?php echo $g->id; ?>" class="form_post" action="member" fn="deletegalericlub">
                    <i class="fas fa-times" style="float:right; font-size:.9em;position: relative;top: 5px;"></i>
                    <input type="hidden" name="uid" value="<?php echo $g->id; ?>" class="cinput">
                </a>
                <div class="pad">
                    <span style="background-image: url('<?php echo $g->url_pic; ?>')" class="img"></span>
                </div>
            </div>
            <?php
        }
    }
?>
<script>
    $(document).ready(function () {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.viewimg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#filepic').change(function () {
            readURL(this);
        });
    });
</script>