<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{

    private function __theme() { return $this->config->item('themes'); }

    function __construct()
    {
        parent::__construct();
        $this->load->model('ajax/MemberMod');
        $this->load->model('ajax/HomeMod');
    }

    function index()
    {
        if ($_POST) {
            $this->load->view($this->__theme() . 'function');
            $fn = $_POST['fn'];

            $data = [];
            if (function_exists($fn)) {
                $fn();
            } else {
                $fn = "__" . $fn;
                $this->MemberMod->$fn();
            }
        } else {
            $content = ($this->session->member ? 'member/home' : 'member/login');

            if ($this->session->member) {
                $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
                $member = $this->excurl->reqCurlapp('me', $query);
                $data['member'] = ($member) ? $member->data[0] : '';

                $data['id'] = $this->HomeMod->get_id('id_member', 'tbl_member', $this->session->member['id']);
                $data['detail'] = $this->MemberMod->member_detail($data['id']);
            }

            $data['eyeme'] = ($this->input->get('from') == 'eyeme' ? 1 : 0);
            $data['content'] = $content;
            $data['title'] = $this->config->item('meta_title');

            $data['kanal'] = 'member';

            $data['meta_desc'] = $this->config->item('meta_desc');
            $data['meta_keyword'] = $this->config->item('meta_keyword');

            $this->load->view($this->__theme() . 'member/template', $data);
        }
    }

    function forgot()
    {
        $content = 'member/forgot';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'template', $data);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

    public function profile_upload()
    {
        $this->MemberMod->profile_upload($_FILES, $_POST);
    }

    public function profile_submit_data()
    {
        $this->MemberMod->submit_data_member($_POST);
    }

    function player($page = 1)
    {
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';

        if (isset($_GET['tab'])) {
            if ($data['member']->id_player == 0) {
                if ($data['member']->id_club == 0) {
                    redirect('member');
                }
            } else {
                if ($data['member']->id_player > 0) {
                    $_POST['uid'] = md5($data['member']->id_player);
                }
            }

            switch ($_GET['tab']) {
                case 'profil':
                    $content = 'member/player/playerinfo';
                    break;
                case 'karir':
                    $content = 'member/player/karir';
                    if (isset($_GET['act'])) $content = 'member/player/karirform';
                    break;
                case 'penghargaan':
                    $content = 'member/player/penghargaan';
                    if (isset($_GET['act'])) $content = 'member/player/penghargaanform';
                    break;
                case 'galeri':
                    $content = 'member/player/galeri';
                    if (isset($_GET['act'])) $content = 'member/player/galeriform';
                    break;
            }
        } else {
            if ($data['member']->id_player > 0) {
                redirect('member/player/?tab=profil&uid='.md5($data['member']->id_player));
            } else {
                if ($data['member']->id_club == 0) {
                    redirect('member');
                }
            }

            $this->library->backnext('pageplayer');
            if ($page > 1) $this->session->set_userdata(array('pageplayer' => $page));

            $content = 'member/player/player';
        }

        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }

    function eyeme()
    {
        $content = 'member/menu/eyeme';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }

    function eyetube()
    {
        $content = 'member/menu/eyetube';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }

    function tulisan_kamu()
    {
        $content = 'member/menu/tulisan_kamu';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }

    function analytics()
    {
        $content = 'member/menu/analytics';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }
	
	function klub()
	{
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';

    	$content = 'member/club/info_klub';
    	$data['content'] = $content;
    	$data['title']   = $this->config->item('meta_title');
    	$data['kanal']   = 'member';
    	$data['meta_desc'] = $this->config->item('meta_desc');
	    $data['meta_keyword'] = $this->config->item('meta_keyword');
	    
	    $this->load->view($this->__theme().'member/template', $data);
	}

    function regis_klub()
    {
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';

        if ($data['member']->id_club > 0) {
            redirect('member/klub');
        }

        $content = 'member/club/regis_klub';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }
}
