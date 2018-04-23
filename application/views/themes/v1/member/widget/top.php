<div class="container stc">
    <div class="container m-bar">
        <i class="fas fa-bars" onclick="myFunction()"></i>
        <!--<i class="far fa-envelope" onclick="functionNotifInbox()"></i><span id="signNotifInbox">1</span>
        <i class="far fa-bell" onclick="functionNotification()"></i><span id="signNotification" class="l83">1</span>-->
    </div>
    <i class="fas fa-sign-in-alt login-ic"></i>
    <div class="fl-r img-pic">
        <a href="<?php echo base_url('member/profile'); ?>">
            <img src="<?php echo ($this->session->member != '') ? $this->session->member['url_pic'] : SUBCDN."assets/img/eyeme/user-discover.png"; ?>" alt="">
        </a>
    </div>
</div>