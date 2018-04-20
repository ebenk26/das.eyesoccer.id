<script>
    $(document).ready(function () {
        $('#birthdate').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<?php $player = ($player) ? $player->data[0] : ''; ?>

<div class="container mt20">
    <div class="pp-profil">
        <img src="<?php echo ($player) ? $player->url_pic : SUBCDN . "assets/themes/v1/img/fav.png"; ?>" alt="Player">
    </div>
</div>
<div class="container data-profil mt20">
    <form class='form_multi' action="<?php echo base_url('member'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="fn" class="cinput" value="playerinfo">
        <input type="hidden" name="act" class="cinput" value="<?php echo ($player) ? 1 : 0; ?>">
        <table>
            <tr>
                <td>Nama</td>
                <td>
                    <input type="text" name="name" value="<?php echo ($player) ? $player->name : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Nama Panggilan</td>
                <td>
                    <input type="text" name="nickname" value="<?php echo ($player) ? $player->nickname : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>
                    <textarea name="description" rows="5">
                         <?php echo ($player) ? $player->description : ''; ?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>
                    <input type="text" name="birth_place" value="<?php echo ($player) ? $player->birth_place : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>
                    <input type="text" name="birth_date" id="birthdate" value="<?php echo ($player) ? $player->birth_date : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>
                    <input type="text" name="phone" value="<?php echo ($player) ? $player->phone : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>No. Hp</td>
                <td>
                    <input type="text" name="mobile" value="<?php echo ($player) ? $player->mobile : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="email" value="<?php echo ($player) ? $player->email : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Height</td>
                <td>
                    <input type="text" name="height" value="<?php echo ($player) ? $player->height : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Weight</td>
                <td>
                    <input type="text" name="weight" value="<?php echo ($player) ? $player->weight : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <select name="gender">
                        <?php
                        $gender = array('1' => 'Laki-laki', '2' => 'Perempuan');
                        foreach ($gender as $n => $v) {
                            if ($player AND $n == $player->gender) {
                                echo "<option value='$n' selected>$v</option>";
                            } else {
                                echo "<option value='$n'>$v</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Negara</td>
                <td>
                    <input type="text" name="nationality" value="<?php echo ($player) ? $player->nationality : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Posisi Utama</td>
                <td>
                    <select name="position_a">
                        <?php
                        if ($position) {
                            foreach ($position->data as $v) {
                                if ($player AND $v->id_position == $player->position_a) {
                                    echo "<option value='$v->id_position' selected>$v->position</option>";
                                } else {
                                    echo "<option value='$v->id_position'>$v->position</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Posisi Cadangan</td>
                <td>
                    <select name="position_b">
                        <?php
                        if ($position) {
                            foreach ($position->data as $v) {
                                if ($player AND $v->id_position == $player->position_b) {
                                    echo "<option value='$v->id_position' selected>$v->position</option>";
                                } else {
                                    echo "<option value='$v->id_position'>$v->position</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nomor Punggung</td>
                <td>
                    <input type="text" name="back_number" value="<?php echo ($player) ? $player->back_number : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Kemampuan Kaki</td>
                <td>
                    <select name="foot">
                        <?php
                        if ($foot) {
                            foreach ($foot->data as $v) {
                                if ($player AND $v->id_foot == $player->id_foot) {
                                    echo "<option value='$v->id_foot' selected>$v->foot</option>";
                                } else {
                                    echo "<option value='$v->id_foot'>$v->foot</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Favorit Klub</td>
                <td>
                    <input type="text" name="fav_club" value="<?php echo ($player) ? $player->fav_club : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Favorit Pemain</td>
                <td>
                    <input type="text" name="fav_player" value="<?php echo ($player) ? $player->fav_player : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Favorit Pelatih</td>
                <td>
                    <input type="text" name="fav_coach" value="<?php echo ($player) ? $player->fav_coach : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Kisaran Gaji</td>
                <td>
                    <input type="text" name="contract_start" value="<?php echo ($player) ? $player->contract_start : ''; ?>" placeholder="Start">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="text" name="contract_end" value="<?php echo ($player) ? $player->contract_end : ''; ?>" placeholder="End">
                </td>
            </tr>
            <tr>
                <td>Nama Bapak</td>
                <td>
                    <input type="text" name="father" value="<?php echo ($player) ? $player->father : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>
                    <input type="text" name="mother" value="<?php echo ($player) ? $player->mother : ''; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Foto Pemain
                </td>
                <td>
                    <input type="file" name="photo">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="tx-c">
                    <button class="klik-dsn">Simpan</button>
                </td>
            </tr>
        </table>
    </form>
</div>