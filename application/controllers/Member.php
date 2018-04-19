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

    function login()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $arr = array('email' => $email, 'xHtml' => $pass);
        echo json_encode($arr);
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

    function player()
    {
        $content = 'member/player/player';
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

    function info_klub()
    {
        $content = 'member/club/info_klub';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }

    function regis_klub()
    {
        $content = 'member/club/regis_klub';
        $data['content'] = $content;
        $data['title'] = $this->config->item('meta_title');
        $data['kanal'] = 'member';
        $data['meta_desc'] = $this->config->item('meta_desc');
        $data['meta_keyword'] = $this->config->item('meta_keyword');

        $this->load->view($this->__theme() . 'member/template', $data);
    }
}
