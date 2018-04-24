<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{

    private function __theme() { return $this->config->item('themes'); }

    function __construct()
    {
        parent::__construct();
        $this->load->model('ajax/MemberMod');
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
				
				$queryclub = array('member' => $this->session->member['id']);
				$data['clubstatus'] = $this->excurl->reqCurlapp('reglist-club', $queryclub);
				
				$data['playerstatus'] = $this->excurl->reqCurlback('reglist-player', $queryclub);
				// print_r($data['clubstatus']);
				// print_r($data['playerstatus']);
				// exit();
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

    function profile()
    {
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';

        $content = 'member/profile';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }

    function password()
    {
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';

        $content = 'member/password';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
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

                    if (isset($_GET['act'])) {
                        $content = 'member/player/karirform';
                    } else {
                        $this->library->backnext('pageplayerkarir');
                        if ($page > 1) $this->session->set_userdata(array('pageplayerkarir' => $page));
                    }

                    break;
                case 'penghargaan':
                    $content = 'member/player/penghargaan';

                    if (isset($_GET['act'])) {
                        $content = 'member/player/penghargaanform';
                    } else {
                        $this->library->backnext('pageplayerachive');
                        if ($page > 1) $this->session->set_userdata(array('pageplayerachive' => $page));
                    }

                    break;
                case 'galeri':
                    $content = 'member/player/galeri';

                    if (isset($_GET['act'])) {
                        $content = 'member/player/galeriform';
                    } else {
                        $this->library->backnext('pageplayergallery');
                        if ($page > 1) $this->session->set_userdata(array('pageplayergallery' => $page));
                    }

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
		
		if ($data['member']->id_club == 0) {
			redirect('member');
		}

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

    function regis_player()
    {
    	$query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
    	$member = $this->excurl->reqCurlapp('me', $query);
    	$data['member'] = ($member) ? $member->data[0] : '';

    	if ($data['member']->id_player > 0) {
    	    redirect('member/player');
    	}

        $content = 'member/player/regis_player';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }

    function official($page = 1)
    {
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';

        if ($data['member']->id_club == 0) {
            redirect('member');
        }

        $content = 'member/club/official';
        if (isset($_GET['act'])) {
            $content = 'member/club/officialform';
        } else {
            $this->library->backnext('pageclubofficial');
            if ($page > 1) $this->session->set_userdata(array('pageclubofficial' => $page));
        }

        $data['content'] = $content;
        $data['title']   = $this->config->item('meta_title');
        $data['kanal']   = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme().'member/template', $data);
    }

    function karir($page = 1)
    {
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';

        if ($data['member']->id_club == 0) {
            redirect('member');
        }

        $content = 'member/club/karir';
        if (isset($_GET['act'])) {
            $content = 'member/club/karirform';
        } else {
            $this->library->backnext('pageclubcareer');
            if ($page > 1) $this->session->set_userdata(array('pageclubcareer' => $page));
        }

        $data['content'] = $content;
        $data['title']   = $this->config->item('meta_title');
        $data['kanal']   = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme().'member/template', $data);
    }

	function galeri()
    {
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';
        
        if ($data['member']->id_club == 0) {
            redirect('member');
        }

        $content = 'member/club/galeri';
        $data['content'] = $content;
        $data['title']   = $this->config->item('meta_title');
        $data['kanal']   = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');
        
        $this->load->view($this->__theme().'member/template', $data);
    }

    function verifikasi()
	{
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';
		
		if ($data['member']->id_club == 0) {
			redirect('member');
		}

    	$content = 'member/club/verifikasi';
    	$data['content'] = $content;
    	$data['title']   = $this->config->item('meta_title');
    	$data['kanal']   = 'member';
    	$data['meta_desc'] = $this->config->item('meta_desc');
	    $data['meta_keyword'] = $this->config->item('meta_keyword');
	    
	    $this->load->view($this->__theme().'member/template', $data);
	}

    function detail_verifikasi($id_member)
    {
        $query = array('id_member' => $this->session->member['id'], 'detail' => true, 'md5' => true);
        $member = $this->excurl->reqCurlapp('me', $query);
        $data['member'] = ($member) ? $member->data[0] : '';
        
        if ($data['member']->id_club == 0) {
            redirect('member');
        }

        $data['id_member'] = $id_member;

        $content = 'member/club/verikasiform';
        $data['content'] = $content;
        $data['title']   = $this->config->item('meta_title');
        $data['kanal']   = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');
        
        $this->load->view($this->__theme().'member/template', $data);
    }
}
