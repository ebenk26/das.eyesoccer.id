<?php
    $data['active'] = 'home';
    $this->load->view($folder.'member/header', $data);
?>
<div class="responsif-add-100px">
    <form class='form_multi' action="<?= base_url('member'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="fn" class="cinput" value="regclub">
        <div class="container mt20">
            <div class="pp-profil">
                <img src="<?php echo SUBCDN;?>assets/themes/v1/img/d.jpg" alt="Logo Klub">
            </div>
        </div>
        <div class="container data-profil mt20">
            <table>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>
                        <input type="text" name="name">
                    </td>
                </tr>
                <tr>
                    <td>Nama Alias</td>
                    <td>
                        <input type="text" name="namealias">
                    </td>
                </tr>
                <tr>
                    <td>Legalitas PT</td>
                    <td>
                        <input type="file" name="legal_pt">
                    </td>
                </tr>
                <tr>
                    <td>Legalitas Kemenham</td>
                    <td>
                        <input type="file" name="legal_kemenham">
                    </td>
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td>
                        <input type="file" name="legal_npwp">
                    </td>
                </tr>
                <tr>
                    <td>Legalitas Dirut</td>
                    <td>
                        <input type="file" name="legal_dirut">
                    </td>
                </tr>
            </table>
        </div>
        <div class="tx-c">
            <input type="submit" value="Simpan" class="klik-dsn" style="font-size:.85em;">
        </div>
    </form>
</div>