<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberMod extends CI_Model {

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
        $refer = ($refer === null || $refer === '' ? 'member': str_replace('-', '/', $refer));
        $email = $this->input->post('email');
        $pass  = $this->input->post('password');
        $query = array('email'=> $email, 'password'=> $pass);
        $res   = $this->excurl->remoteCall($this->__xurl().'login', $this->__xkey(), $query);
        $res   = json_decode($res);
    
        $arr  = [];
        if($res AND is_array($res->data))
        {
            if($res->status == 'Error')
            {
                if($res->message == 'Validation')
                {
                    $arr = array_merge($arr, array('xSplit' => true, 'xData' => array()));
                    foreach ($res->data as $key => $value) {
                        $arr['xData'] = array_merge($arr['xData'], array('msg'.$value->param => $value->msg));
                    }
                    
                } else {
                    $arr = array('xCss'=> 'boxfailed','xMsg'=> $res->message,'xAlert'=> true);
                }
            }
        } else {
            #echo $res->data->username;
           $v = $res->data;
           $sess = array(
                    'id'=> $v->id,
                    'username' => $v->username,
                    'name'=> $v->name,
                    'url_pic' => $v->url_pic,
                    'url'     => $v->url,
                    'active'  => $v->active,
                    'verification' => $v->verification
                );
           $this->session->member   = $sess;

           #redirect(mMEMBERAREA,'refresh');
           $arr = array('xDirect'=> base_url().$refer,'xCss'=> 'boxsuccess','xMsg'=> $res->message,'xAlert'=> true);
           $this->tools->__flashMessage($arr);
        }
        
        $this->tools->__flashMessage($arr);
	}

    function __regact(){

        $name = $this->input->post('name');
        $uname = $this->input->post('username');
        $email = $this->input->post('email');
        $pass  = $this->input->post('password');
        $cpass = $this->input->post('passconfirm');
        $query = array(
                'name'  => $name,
                'username' => $uname,
                'email' => $email,
                'password' => $pass,
                'passconfirm'=> $cpass);
        $res  = $this->excurl->remoteCall($this->__xurl().'register',$this->__xkey(),$query);
        $res = json_decode($res);

        $arr  = [];

        if($res AND is_array($res->data))
        {
            if($res->status == 'Error')
            {
                if($res->message == 'Validation')
                {
                    $arr = array_merge($arr, array('xSplit' => true, 'xData' => array()));
                    foreach ($res->data as $key => $value) {
                        $arr['xData'] = array_merge($arr['xData'], array('msg'.$value->param => $value->msg));
                    }
                } else {
                    $arr = array('xCss'=> 'boxfailed','xMsg'=> $res->message,'xAlert'=> true);
                }
            }
        }
        else{

        $arr = array('xDirect'=> base_url(),'xCss'=> 'boxsuccess','xMsg'=> 'Silahkan Cek Email <br> Untuk aktifasi akun anda','xAlert'=> true);
        }

        $this->tools->__flashMessage($arr);

    }
    function __forgotact(){
        $email = $this->input->post('email');
        $query = array('email' => $email);
        $res = $this->excurl->remoteCall($this->__xurl().'forget-password',$this->__xkey(),$query);
        $res = json_decode($res);
        if($res->status == 'Success'){
            $arr = array('xCss'=> 'boxsuccess','xMsg'=> 'Berhasil Reset password silahkan cek email kamu','xAlert'=> true);
        }
        else{
            $arr = array('xCss'=> 'boxfailed','xMsg'=> 'Email kamu  tidak ditemukan ','xAlert'=> true);
        }
        $this->tools->__flashMessage($arr);
    }
	
	function __profile_upload(){
		$param = array('username'=> $this->session->member['username']);
        $res   = $this->excurl->remoteCall($this->__xurl().'upload-pic', $this->__xkey(), $param, ['fupload']);
		$res = json_decode($res);
		if($res->status == 'Error')
		{
			$arr = array('xCss'=> 'boxfailed','xMsg'=> $res->message,'xAlert'=> true);
		}else{
			$arr = array('xDirect'=> base_url().'member','xCss'=> 'boxsuccess','xMsg'=> 'Upload Profile Berhasil.','xAlert'=> true);
           $this->session->set_userdata(['member' => (array)$res->data]);
		}
		
		
		$this->tools->__flashMessage($arr);
	}

	function member_detail($id){
		$query = $this->db->query(" SELECT
                                        *
                                    FROM
                                        tbl_member
                                    WHERE
                                        id_member = '$id'
                                        ")->row();
        return $query;
    }
	
	function submit_data_member($post){
		$id  	= $this->HomeMod->get_id('id_member', 'tbl_member', $this->session->member['id']);
		$col = ""; $i = 0;
		foreach($post as $field => $value)
		{
			$x = 0;
			switch ($field){
				case 'val':
				case 'undefined':
				$x = 1;
				break;
			}
			
			if($x == 0)
			{
				if ($i > 0) {
					$col .=",$field='$value'";
				}else{
					//last item
					$col .="$field='$value'";
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
        if($this->db->affected_rows() > 0){
			$arr = array('xCss'=> 'boxsuccess','xMsg'=> 'Submit Data Berhasil.','xAlert'=> true);
		}else{
			$arr = array('xCss'=> 'boxfailed','xMsg'=> 'Submit Data Gagal.','xAlert'=> true);
		}
		$this->tools->__flashMessage($arr);
    }
	
	function __infoklub()
    {
		$query = array('id_club' => $this->session->userdata('id_club'), 'detail' => true);
		$data['klubdetail'] = $this->excurl->remoteCall($this->__xurl() . 'profile-club', $this->__xkey(), $query);
		
		$html = $this->load->view($this->__theme().'member/ajax/info_klub', $data, true);
		
		$data = array('xClass' => 'reqinfoklub', 'xHtml' => $html);
		$this->tools->__flashMessage($data);
    }

    function __regclub()
    {
        $name = $this->input->post('name');
        $namealias = $this->input->post('namealias');

        $sesi = $this->session->userdata('member');

        $query = array('uid' => $sesi['id'], 'name' => $name, 'namealias' => $namealias);
        $res   = $this->excurl->reqCurlapp('register-club', $query, array('legal_pt','legal_kemenham','legal_npwp','legal_dirut'));

        if($res AND is_array($res->data))
        {
            if($res->status == 'Error')
            {
                if($res->message == 'Validation')
                {
                    $arr = array_merge($arr, array('xSplit' => true, 'xData' => array()));
                    foreach ($res->data as $key => $value) {
                        $arr['xData'] = array_merge($arr['xData'], array('msg'.$value->param => $value->msg));
                    }
                    
                } else {
                    $arr = array('xCss'=> 'boxfailed','xMsg'=> $res->message,'xAlert'=> true);
                }
            }
        }

        if($res->status == 'Success')
        {
            $message = "Registrasi Club Berhasil. Silahkan Cek Email Anda";

            $arr = array('xDirect'=> base_url().'member','xCss'=> 'boxsuccess','xMsg'=> $message,'xAlert'=> true);
        }
            
        $this->tools->__flashMessage($arr);
    }
}
