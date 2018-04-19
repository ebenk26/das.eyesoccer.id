<!DOCTYPE html>
<?php $folder = $this->config->item('themes'); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?php echo SUBCDN."assets/$folder/img/fav.png" ?>" />

    <link rel="stylesheet" href="<?php echo SUBCDN."assets/themes/v1/css/style.css"; ?>">
    <link rel="stylesheet" href="<?php echo SUBCDN."assets/themes/v1/css/dashboard.css"; ?>">
    <link rel="stylesheet" href="<?php echo SUBCDN."assets/css/font-awesome/css/fontawesome-all.css"; ?>">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src='<?php echo SUBCDN."assets/$folder/js/main.js"; ?>'></script>

    <!-- Zoom -->
    <script src="<?php echo SUBCDN."assets/js/zoom/jquery.elevatezoom.js"; ?>"></script>

    <!-- Lazy -->
    <script src="<?php echo SUBCDN."assets/js/lazy/jquery.lazy.min.js"; ?>"></script>

    <!-- SWAlert -->
    <link href="<?php echo SUBCDN."assets/js/swalert/sweetalert.css" ?>" rel="stylesheet" />
    <script src="<?php echo SUBCDN."assets/js/swalert/sweetalert.min.js"; ?>"></script>
</head>
<body class="m-pd-t-100 body-responsive">
    <div class="container stc">
        <div class="container m-bar">
            <i class="fas fa-bars" onclick="myFunction()"></i>
            <i class="far fa-envelope" onclick="functionNotifInbox()"></i><span id="signNotifInbox">1</span>
            <i class="far fa-bell" onclick="functionNotification()"></i><span id="signNotification" class="l83">1</span>
        </div>
        <i class="fas fa-sign-in-alt login-ic"></i>
        <div class="fl-r img-pic">
            <img src="<?php echo SUBCDN."assets/img/eyeme/user-discover.png"; ?>" alt="">
        </div>
    </div>
    <div class="responsif-add-100px">
        <div id="menuDashboard" class="menu-dashboard bg243" style="display:none;">
            <div class="container bg-menu-pic">
                <div class="menu-pic">
                    <img src="<?php echo SUBCDN."assets/themes/v1/img/d.jpg"; ?>" alt="">
                </div>
            </div>
            <div class="container menu-dash">
                <a class="active" href="<?php echo SUBCDN."eyeprofile/klub"; ?>">
                    <img src="<?php echo SUBCDN."assets/themes/v1/img/ic_eyeprofile.png"; ?>" alt="">Eye Profile
                </a>
                <a href="<?php echo base_url("eyetube"); ?>">
                    <img src="<?php echo SUBCDN."assets/themes/v1/img/ic_eyetube.png"; ?>" alt="">Eye Tube
                </a>
                <a href="<?php echo base_url("eyenews"); ?>">
                    <img src="<?php echo SUBCDN."assets/themes/v1/img/ic_eyenews.png"; ?>" alt="">Eye News
                </a>
                <a href="<?php echo base_url("eyeme"); ?>">
                    <img src="<?php echo SUBCDN."assets/themes/v1/img/ic-eyeme.png"; ?>" alt="">Eye Me
                </a>
                <a href="<?php echo base_url("eyemarket"); ?>">
                    <img src="<?php echo SUBCDN."assets/themes/v1/img/ic_eyemarket.png"; ?>" alt="">Eye Market
                </a>
                <a href="<?php echo base_url("eyevent"); ?>">
                    <img src="<?php echo SUBCDN."assets/themes/v1/img/ic_eyevent.png"; ?>" alt="">EyeVent
                </a>
            </div>
        </div>
    </div>
    <div id="isiContent" style="filter:none;">
        <?php
            $data['folder'] = $folder;
            $this->load->view($folder.$content, $data);
        ?>
    </div>

    <div class='baseurl' val='<?php echo base_url(); ?>'></div>

    <div class='box_popup'>
        <div class='loading'></div>
        <div class='show_popup'></div>
    </div>
    <div class='xh'></div>

    <!-- INBOX NOTIFICATION -->
    <div class="container dash-notif" id="notifInbox" style="display: none;">
        <div class="panah-notif"></div>
        <div class="title-notif">
            <span class="container">Kotak Masuk</span>
        </div>
        <div class="notific">
            <a href="" class="container inbox-dashboard">
                <div class="container img-inbox-dashboard">
                    <img src="<?php echo SUBCDN."assets/img/eyeme/user-discover.png"; ?>" alt="">
                </div>
                <div class="text-inbox">
                    <span class="time">12:15</span>
                    <span class="sender">eyesoccer</span>
                    <span class="title">ayo update data kamu ...</span>
                    <span class="preview">Hallo Dila, ayo update data kamu...</span>
                </div>
                <div class="bb2g"></div>
            </a>
            <!-- <a href="" class="container inbox-dashboard">
                <div class="container img-inbox-dashboard">
                    <img src="<?php echo SUBCDN."assets/img/eyeme/user-discover.png"; ?>" alt="">
                </div>
                <div class="text-inbox">
                    <span class="time">12:15</span>
                    <span class="sender">eyesoccer</span>
                    <span class="title">ayo update data kamu ...</span>
                    <span class="preview">Hallo Dila, ayo update data kamu...</span>
                </div>
                <div class="bb2g"></div>
            </a> -->
        </div>
    </div>

    <!-- NOTIFICATION -->
    <div class="container dash-notif" id="notifications" style="display: none;">
        <div class="panah-notif2"></div>
        <div class="title-notif">
            <span class="container">Notifikasi</span>
        </div>
        <div class="notific">
            <a href="" class="container inbox-dashboard">
                <div class="container img-inbox-dashboard">
                    <img src="<?php echo SUBCDN."assets/img/eyeme/user-discover.png"; ?>" alt="">
                </div>
                <div class="text-inbox2">
                    <span>Rika Aulia</span>
                    <span>melihat profil kamu</span>
                </div>
                <div class="bb2g"></div>
            </a>
            <!-- <a href="" class="container inbox-dashboard">
                <div class="container img-inbox-dashboard">
                    <img src="<?php echo SUBCDN."assets/img/eyeme/user-discover.png"; ?>" alt="">
                </div>
                <div class="text-inbox2">
                    <span>Rika Aulia</span>
                    <span>melihat profil kamu</span>
                </div>
                <div class="bb2g"></div>
            </a> -->
        </div>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("menuDashboard");
            if (x.style.display == "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        function closeFunction() {
            var y = document.getElementById("welcome");
            if (y.style.display == "block") {
                y.style.display = "none";
            }
        }
        function functionNotifInbox() {
            var y = document.getElementById("notifInbox");
            var p = document.getElementById("isiContent");
            var q = document.getElementById("signNotifInbox");
            var a = document.getElementById("notifications");
            if (y.style.display == "none") {
                y.style.display = "block";
                q.style.display = "none";
                p.style.filter = "blur(20px)";
                a.style.display = "none";

            } else {
                y.style.display = "none";
                p.style.filter = "unset";
            }
        }
        function functionNotification() {
            var a = document.getElementById("notifications");
            var b = document.getElementById("isiContent");
            var c = document.getElementById("signNotification");
            var y = document.getElementById("notifInbox");
            if (a.style.display == "none") {
                a.style.display = "block";
                c.style.display = "none";
                b.style.filter = "blur(20px)";
                y.style.display = "none";
            } else {
                a.style.display = "none";
                b.style.filter = "unset";
            }
        }
    </script>
</body>
</html>