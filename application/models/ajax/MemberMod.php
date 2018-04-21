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
		
        $queryprov = array();
        $data['provinsilist'] = $this->excurl->reqCurlback('provinsi', $queryprov);
        $val = $data['provinsilist']->data;
        $data['provinsi'] = $val;

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
        $description = $this->input->post('description');
        $establish_date = $this->input->post('establish_date');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $owner = $this->input->post('owner');
        $coach = $this->input->post('coach');
        $manager = $this->input->post('manager');
        $provinsi = $this->input->post('id_provinsi');
        $kabupaten = $this->input->post('id_provinsi');
        $slug = $this->input->post('slug');
		
        $query = array('id_club' => $id_club, 'name' => $name, 'nickname' => $nickname, 'address' => $address, 'description' => $description, 'establish_date' => $establish_date, 'phone' => $phone, 'email' => $email, 'owner' => $owner, 'coach' => $coach, 'provinsi' => $provinsi, 'kabupaten' => $kabupaten, 'manager' => $manager, 'slug' => $slug);
		
        $res = $this->excurl->reqCurlapp('edit-club', $query, array('logo', 'legal_pt'));
        // print_r($res);
        // exit;
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
        $member = $this->excurl->reqCurlapp('me', $query);
        $member = ($member) ? $member->data[0] : '';

        $query = array('page' => $this->session->userdata('pageplayer'), 'limit' => 10, 'id_club' => $member->id_club,
                       'sorby' => 'a.id_player', 'sortdir' => 'desc');

        $data['player'] = $this->excurl->reqCurlapp('profile', $query);
        $data['playercount'] = $this->excurl->reqCurlapp('profile', array_merge($query, ['count' => true]));

        $html = $this->load->view($this->__theme() . 'member/player/ajax/player', $data, true);

        $data = array('xClass' => 'reqplayer', 'xHtml' => $html, 'xUrlhash' => base_url() . 'member/player/' . $this->session->userdata('pageplayer'));
        $this->tools->__flashMessage($data);
    }

    function __playerinfo()
    {
        $query = array('id_player' => $this->input->post('uid'), 'detail' => true, 'md5' => true);
        $data['player'] = ($this->input->post('uid') != '') ? $this->excurl->reqCurlback('profile',  $query) : '';
        $data['foot'] = $this->excurl->reqCurlback('player-foot');
        $data['level'] = $this->excurl->reqCurlback('player-level');
        $data['position'] = $this->excurl->reqCurlback('player-position');

        $data['folder'] = $this->config->item('themes');
        $html = $this->load->view($this->__theme() . 'member/player/ajax/playerinfo', $data, true);

        $data = array('xClass' => 'reqplayerinfo', 'xHtml' => $html);
        $this->tools->__flashMessage($data);
    }

    function __playeract()
    {
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $member = ($member) ? $member->data[0] : '';

        $dt = array('name' => $this->input->post('name'), 'nickname' => $this->input->post('nickname'), 'description' => $this->input->post('description'),
                    'birth_place' => $this->input->post('birth_place'), 'birth_date' => date('Y-m-d', strtotime($this->input->post('birth_date'))),
                    'phone' => $this->input->post('phone'), 'mobile' => $this->input->post('mobile'), 'email' => $this->input->post('email'),
                    'height' => $this->input->post('height'), 'weight' => $this->input->post('weight'), 'gender' => $this->input->post('gender'),
                    'nationality' => $this->input->post('nationality'), 'position_a' => $this->input->post('position_a'), 'position_b' => $this->input->post('position_b'),
                    'back_number' => $this->input->post('back_number'), 'foot' => $this->input->post('foot'), 'fav_club' => $this->input->post('fav_club'),
                    'fav_player' => $this->input->post('back_number'), 'fav_coach' => $this->input->post('foot'),
                    'father' => $this->input->post('father'), 'mother' => $this->input->post('mother'));

        if ($this->input->post('act') > 0) {
            if ($member AND $member->id_player > 0 OR $member->id_club > 0) {
                if ($member->id_club > 0) {
                    $slug = $this->input->post('uid');
                    $query = array('url' => $slug, 'detail' => true);
                    $player = $this->excurl->reqCurlback('profile',  $query);
                    $player = ($player) ? $player->data[0] : '';
                } else {
                    $query = array('id_player' => $member->id_player, 'detail' => true);
                    $player = $this->excurl->reqCurlback('profile',  $query);
                    $player = ($player) ? $player->data[0] : '';
                    $slug = $player->slug;
                }

                $dt = array_merge($dt, ['slug' => $slug, 'level' => ($this->input->post('level') != '') ? $this->input->post('level') : $player->id_level,
                                        'contract_start' => ($this->input->post('contract_start') != '') ? $this->input->post('contract_start') : $player->contract_start,
                                        'contract_end' => ($this->input->post('contract_end') != '') ? $this->input->post('contract_end') : $player->contract_end]);

                $res = $this->excurl->reqCurlapp('edit-player', $dt, ['photo']);
                $arr = $this->library->errorMessage($res);

                if ($res->status == 'Success') {
                    $arr = array('xDirect' => base_url('member/player'), 'xCss' => 'boxsuccess', 'xMsg' => 'Data berhasil disimpan', 'xAlert' => true);
                }
            } else {
                $arr = array('xDirect' => base_url('member'));
            }
        } else {
            if ($member AND $member->id_club > 0) {
                $query = array('id_club' => $member->id_club);
                $club = $this->excurl->reqCurlback('profile-club',  $query);
                $club = ($club) ? $club->data[0] : '';

                $dt = array_merge($dt, ['slug' => $club->slug, 'level' => $this->input->post('level'),
                                        'contract_start' => $this->input->post('contract_start'),
                                        'contract_end' => $this->input->post('contract_end')]);

                if ($this->input->post('username') != '' AND $this->input->post('password') != '') {
                    $dt = array_merge($dt, ['register' => true, 'username' => $this->input->post('username'), 'password' => $this->input->post('password')]);
                }

                $res = $this->excurl->reqCurlapp('add-player', $dt, ['photo']);
                $arr = $this->library->errorMessage($res);

                if ($res->status == 'Success') {
                    $arr = array('xDirect' => base_url('member/player'), 'xCss' => 'boxsuccess', 'xMsg' => 'Data berhasil disimpan', 'xAlert' => true);
                }
            } else {
                $arr = array('xDirect' => base_url('member'));
            }
        }

        $this->tools->__flashMessage($arr);
    }
	
	function __get_kabupaten()
    { 
		$querykab = array('provinsi'=>$this->input->post('id_provinsi'));
        $data['kabupatenlist'] = $this->excurl->reqCurlapp('kabupaten', $querykab);
        $html = $this->load->view($this->__theme().'member/club/ajax/kabupaten',$data,true);

        $data = array('xSplit' => true, 'xData' => array($this->input->post('dest') => $html));
        $this->tools->__flashMessage($data);
    }
}
