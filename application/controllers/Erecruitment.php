<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Erecruitment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('user_agent');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
        date_default_timezone_set("ASIA/JAKARTA");
    }

    public function index(){
        $data['visitor_date']        = date('Y-m-d H:i:s');
        $data['visitor_ipaddress']   = $this->input->ip_address();
        $data['visitor_browser']     = $this->agent->browser();
        $data['visitor_os']          = $this->agent->platform();

        $this->db->insert('visitor', $data);

        $page_data['page_name']  = 'home';
        $page_data['page_title'] = 'Erecruitment JNE Bandung';
        $this->load->view('frontend/index', $page_data);
    }

    public function about(){
        $page_data['page_name']  = 'about';
        $page_data['page_title'] = 'Profil';
        $this->load->view('frontend/index', $page_data);
    }

    public function vacancy($param1 = '', $param2 = ''){
        if ($param1 == 'list') {
            $page_data['page_name']  = 'vacancy';
            $page_data['page_title'] = 'Lowongan';
            $this->load->view('frontend/index', $page_data);
        }
        if ($param1 == 'details') {
            $page_data['vacancy_id'] = $param2;
            $page_data['page_name']  = 'vacancy_details';
            $page_data['page_title'] = 'Detail Lowongan';
            $this->load->view('frontend/index', $page_data);
        }
        
        $data['visitor_date']        = date('Y-m-d H:i:s');
        $data['visitor_ipaddress']   = $this->input->ip_address();
        $data['visitor_browser']     = $this->agent->browser();
        $data['visitor_os']          = $this->agent->platform();

        $this->db->insert('visitor', $data);
    }

    public function contact(){
        $page_data['page_name']  = 'contact';
        $page_data['page_title'] = 'Kontak';
        $this->load->view('frontend/index', $page_data);
    }
    
    public function login($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('candidate_login') == 1) {
            redirect(site_url('candidate/dashboard'), 'refresh');
        } 

        $this->load->view('backend/login_candidate');
    }

    public function register($param1 = ''){
        if ($this->session->userdata('candidate_login') == 1) {
            redirect(site_url('candidate/dashboard'), 'refresh');
        } 

        if ($param1 == 'create') {
            $data['candidate_ktp']               = $this->input->post('candidate_ktp');
            $data['candidate_name']              = $this->input->post('candidate_name');
            $data['candidate_email']             = $this->input->post('candidate_email');
            $data['candidate_password']          = md5($this->input->post('candidate_password'));
            $data2['confirm_candidate_password'] = md5($this->input->post('confirm_candidate_password'));
            $data3['nik']                        = $this->input->post('candidate_ktp');

            $duplicate = $this->db->get_where('candidate', array('candidate_ktp' => $this->input->post('candidate_ktp')))->num_rows();
            $duplicate2 = $this->db->get_where('employee', array('employee_ktp' => $this->input->post('candidate_ktp')))->num_rows();
            $duplicate3 = $this->db->get_where('candidate', array('candidate_email' => $this->input->post('candidate_email')))->num_rows();
            $duplicate4 = $this->db->get_where('file', array('nik' => $this->input->post('employee_ktp')))->num_rows();

            if($duplicate != 0 || $duplicate2 != 0 || $duplicate4 != 0){
                $this->session->set_flashdata('error', 'Nomor KTP sudah ada');
                redirect(site_url('erecruitment/login'), 'refresh');
            } elseif($duplicate3 != 0){
                $this->session->set_flashdata('error', 'Email telah digunakan');
                redirect(site_url('erecruitment/login'), 'refresh');
            } else {
                if ($data['candidate_password'] == $data2['confirm_candidate_password']) {
                    $this->db->insert('candidate', $data);;
                    $this->db->insert('file', $data3);
                    
                    $this->session->set_flashdata('success', 'Pendaftaran berhasil');
                    redirect(site_url('erecruitment/login'), 'refresh');
                } elseif ($data['candidate_password'] != $data2['confirm_candidate_password']) {
                    $this->session->set_flashdata('error', 'Password tidak cocok');
                    redirect(site_url('erecruitment/login'), 'refresh');
                }
            }
        }

        $this->load->view('backend/register');
    }

    function validate_login() {
        $this->db->from('candidate');
        $this->db->where('candidate_email', $this->input->post('candidate_email'));
        $this->db->where('candidate_password', md5($this->input->post('candidate_password')));
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $this->session->set_userdata('candidate_login' , 1);
            $this->session->set_userdata('login_type' , 'candidate');
            $this->session->set_userdata('login_nik' , $query->row()->candidate_ktp);
            redirect(site_url($this->session->userdata('login_type').'/dashboard'), 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Login gagal');
            redirect(site_url('erecruitment/login'), 'refresh');
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(site_url('erecruitment/login') , 'refresh');
    }

}

?>