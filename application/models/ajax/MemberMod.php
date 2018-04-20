<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberMod extends CI_Model
{

    private function __xurl() { return $this->config->item('xurl'); }
    private function __xkey() { return $this->config->item('xkey'); }
    private function __theme() { return $this->config->item('themes'); }

    function __construct()
    {
        parent::__construct();
    }

    function __loginact()
    {
        $refer = $this->input->get('from');
        $refer = ($refer === null || $refer === '' ? 'member' : str_replace('-', '/', $refer));
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $query = array('email' => $email, 'password' => $pass);
        $res = $this->excurl->remoteCall($this->__xurl() . 'login', $this->__xkey(), $query);
        $res = json_decode($res);

        $arr = $this->library->errorMessage($res);

        if ($res->status == 'Success') {
            #echo $res->data->username;
            $v = $res->data;
            $sess = array(
                'id' => $v->id,
                'username' => $v->username,
                'name' => $v->name,
                'url_pic' => $v->url_pic,
                'url' => $v->url,
                'active' => $v->active,
                'verification' => $v->verification
            );
            $this->session->member = $sess;

            $arr = array('xDirect' => base_url() . $refer, 'xCss' => 'boxsuccess', 'xMsg' => $res->message, 'xAlert' => true);
        }

        $this->tools->__flashMessage($arr);
    }

    function __regact()
    {
        $name = $this->input->post('name');
        $uname = $this->input->post('username');
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $cpass = $this->input->post('passconfirm');
        $query = array(
            'name' => $name,
            'username' => $uname,
            'email' => $email,
            'password' => $pass,
            'passconfirm' => $cpass);
        $res = $this->excurl->remoteCall($this->__xurl() . 'register', $this->__xkey(), $query);
        $res = json_decode($res);

        $arr = $this->library->errorMessage($res);

        if ($res->status == 'Success') {
            $arr = array('xDirect' => base_url(), 'xCss' => 'boxsuccess', 'xMsg' => 'Silahkan Cek Email <br> Untuk aktifasi akun anda', 'xAlert' => true);
        }

        $this->tools->__flashMessage($arr);
    }

    function __forgotact()
    {
        $email = $this->input->post('email');
        $query = array('email' => $email);
        $res = $this->excurl->remoteCall($this->__xurl() . 'forget-password', $this->__xkey(), $query);
        $res = json_decode($res);

        if ($res->status == 'Success') {
            $arr = array('xCss' => 'boxsuccess', 'xMsg' => 'Berhasil Reset password silahkan cek email kamu', 'xAlert' => true);
        } else {
            $arr = array('xCss' => 'boxfailed', 'xMsg' => 'Email kamu  tidak ditemukan ', 'xAlert' => true);
        }

        $this->tools->__flashMessage($arr);
    }

    function __profile_upload()
    {
        $param = array('username' => $this->session->member['username']);
        $res = $this->excurl->remoteCall($this->__xurl() . 'upload-pic', $this->__xkey(), $param, ['fupload']);
        $res = json_decode($res);

        if ($res->status == 'Error') {
            $arr = array('xCss' => 'boxfailed', 'xMsg' => $res->message, 'xAlert' => true);
        } else {
            $arr = array('xDirect' => base_url() . 'member', 'xCss' => 'boxsuccess', 'xMsg' => 'Upload Profile Berhasil.', 'xAlert' => true);
            $this->session->set_userdata(['member' => (array)$res->data]);
        }

        $this->tools->__flashMessage($arr);
    }

    function member_detail($id)
    {
        $query = $this->db->query(" SELECT
                                        *
                                    FROM
                                        tbl_member
                                    WHERE
                                        id_member = '$id'
                                        ")->row();
        return $query;
    }

    function submit_data_member($post)
    {
        $id = $this->HomeMod->get_id('id_member', 'tbl_member', $this->session->member['id']);
        $col = "";
        $i = 0;
        foreach ($post as $field => $value) {
            $x = 0;
            switch ($field) {
                case 'val':
                case 'undefined':
                    $x = 1;
                    break;
            }

            if ($x == 0) {
                if ($i > 0) {
                    $col .= ",$field='$value'";
                } else {
                    //last item
                    $col .= "$field='$value'";
                }

                $i++;
            }
        }

        $this->db->query(" UPDATE
								tbl_member
							SET
								$col
							WHERE
								id_member = '$id'
						");

        if ($this->db->affected_rows() > 0) {
            $arr = array('xCss' => 'boxsuccess', 'xMsg' => 'Submit Data Berhasil.', 'xAlert' => true);
        } else {
            $arr = array('xCss' => 'boxfailed', 'xMsg' => 'Submit Data Gagal.', 'xAlert' => true);
        }

        $this->tools->__flashMessage($arr);
    }

    function __infoklub()
    {
        $param = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $res = $this->excurl->reqCurlback('me', $param);
        $v = $res->data;

        $query = array('id_club' => ($v[0]->id_club == 0 ? 1128 : $v[0]->id_club), 'detail' => true);
        $data['klubdetail'] = $this->excurl->reqCurlback('profile-club', $query);
        $val = $data['klubdetail']->data;
        // print_r($val[0]);exit();
        $queryprov = array();
        $data['provinsilist'] = $this->excurl->reqCurlapp('provinsi', $queryprov);
        $val = $data['provinsilist']->data;
        $data['provinsi'] = $val;
        // print_r($data['provinsi']);exit();

        $html = $this->load->view($this->__theme() . 'member/club/ajax/infoklub', $data, true);

        $data = array('xClass' => 'reqinfoklub', 'xHtml' => $html);
        $this->tools->__flashMessage($data);
    }

    function __regclub()
    {
        $name = $this->input->post('name');
        $namealias = $this->input->post('namealias');

        $sesi = $this->session->userdata('member');

        $query = array('uid' => $sesi['id'], 'name' => $name, 'namealias' => $namealias);
        $res = $this->excurl->reqCurlapp('register-club', $query, array('legal_pt', 'legal_kemenham', 'legal_npwp', 'legal_dirut'));

        $arr = $this->library->errorMessage($res);

        if ($res->status == 'Success') {
            $message = "Registrasi Club Berhasil. Silahkan Cek Email Anda";
            $arr = array('xDirect' => base_url() . 'member', 'xCss' => 'boxsuccess', 'xMsg' => $message, 'xAlert' => true);
        }

        $this->tools->__flashMessage($arr);
    }

    function __editclub()
    {
        $id_club = $this->input->post('id_club');
        $name = $this->input->post('name');
        $nickname = $this->input->post('nickname');
        $address = $this->input->post('address');
        $query = array('id_club' => $id_club, 'name' => $name, 'nickname' => $nickname, 'address' => $address);
        $res = $this->excurl->reqCurlapp('edit-club', $query, array('logo', 'legal_pt'));
        print_r($res);
        exit;
        $arr = $this->library->errorMessage($res);

        if ($res->status == 'Success') {
            $message = "Data berhasil disimpan.";
            $arr = array('xDirect' => base_url() . 'member', 'xCss' => 'boxsuccess', 'xMsg' => $message, 'xAlert' => true);
        }

        $this->tools->__flashMessage($arr);
    }

    function __player()
    {
        $this->library->backnext('pageplayer', 'pagetotalplayer');

        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlback('me', $query);
        $member = ($member) ? $member->data[0] : '';

        $query = array('page' => $this->session->userdata('pageplayer'), 'limit' => 10, 'id_club' => $member->id_club,
                       'sorby' => 'a.id_player', 'sortdir' => 'desc');

        $data['player'] = $this->excurl->reqCurlapp('profile',  $query);
        $data['playercount'] = $this->excurl->reqCurlapp('profile',  array_merge($query, ['count' => true]));

        $html = $this->load->view($this->__theme() . 'member/player/ajax/player', $data, true);

        $data = array('xClass' => 'reqplayer', 'xHtml' => $html, 'xUrlhash' => base_url() . 'member/player/' . $this->session->userdata('pageplayer'));
        $this->tools->__flashMessage($data);
    }

    function __playerinfo()
    {
        $query = array('id_player' => $this->input->post('uid'), 'detail' => true, 'md5' => true);
        $data['player'] = $this->excurl->reqCurlback('profile',  $query);
        $data['foot'] = $this->excurl->reqCurlback('player-foot');
        $data['level'] = $this->excurl->reqCurlback('player-level');
        $data['position'] = $this->excurl->reqCurlback('player-position');

        $data['folder'] = $this->config->item('themes');
        $html = $this->load->view($this->__theme() . 'member/player/ajax/playerinfo', $data, true);

        $data = array('xClass' => 'reqplayerinfo', 'xHtml' => $html);
        $this->tools->__flashMessage($data);

    }
}
