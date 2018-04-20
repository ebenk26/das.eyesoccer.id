<script>
    $(document).ready(function () {
         $('#birthdate').datepicker({
             dateFormat: 'dd-mm-yy',
             changeMonth: true,
             changeYear: true
         });
     });
</script>

<div class="container mt20">
    <div class="pp-profil">
        <img src="<?php echo SUBCDN . "assets/themes/v1/img/fav.png"; ?>" alt="Player">
    </div>
</div>
<div class="container data-profil mt20">
    <table>
        <tr>
            <td>Nama</td>
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
            <td>Deskripsi</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>
                <input type="text" id="birthdate">
            </td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Mobile</td>
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
            <td>Height</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Weight</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Negara</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Posisi Utama</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Posisi Cadangan</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Nomor Punggung</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Kemampuan Kaki</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Favorit Klub</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Favorit Pemain</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Favorit Pelatih</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Gaji</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Nama Bapak</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>
                Foto Pemain
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