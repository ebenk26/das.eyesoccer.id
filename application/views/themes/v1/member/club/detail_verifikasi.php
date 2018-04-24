<?php
    $data['active'] = ($member->id_player > 0) ? 'verifikasi' : 'klub';
    $this->load->view($folder.'member/header', $data);
?>
<div class="responsif-add-100px">
    <div class="container mg-tb15">
    	<div id="reqverify" class='loadverify' action="member" loading="off" clean="clsverify">
    	    <div id='clsverify'>
    	        <script>
    	            $(document).ready(function () {
    	                $(window).on('load', function () {
    	                    ajaxOnLoad('loadverify');
    	                });
    	            });
    	        </script>
    	    </div>
    	    <input type='hidden' name='fn' value='detail_verify' class='cinput'>
    	    <input type='hidden' name='id_member' value='<?= $id_member; ?>' class='cinput'>
    		<h1>ini view detailnya</h1>
    	</div>
    </div>
</div>