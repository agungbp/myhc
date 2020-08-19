<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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

    public function index() {
        $this->load->view('backend/login');
    }

    function validate_login() {
        $this->db->from('user');
        $this->db->join('employee', 'user.nik = employee.nik');
        $this->db->where('user.nik', strtoupper($this->input->post('nik')));
        $this->db->where('user_password', md5($this->input->post('user_password')));
        $this->db->where('user_status', 'Y');
        $this->db->where('user_application', 'MYHC');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            if($query->num_rows() == 1){
                $this->session->set_userdata('employee_login' , 1);
                $this->session->set_userdata('login_type' , 'employee');
                $this->session->set_userdata('login_nik' , $query->row()->nik);
                $this->session->set_userdata('login_id' , $query->row()->user_id);
                $this->session->set_userdata('login_branch' , $query->row()->branch_code);
                $this->session->set_userdata('login_origin' , $query->row()->origin_code);

                $data['nik']             = $this->input->post('nik');
                $data['log_application'] = 'MYHC';
                $data['log_type']        = 'EMPLOYEE';
                $data['log_time']        = date('Y-m-d H:i:s');
                $data['log_ipaddress']   = $this->input->ip_address();
                $data['log_browser']     = $this->agent->browser();
                $data['log_os']          = $this->agent->platform();
                $data['log_status']      = 'Success';

                $this->db->insert('login_log', $data);

                redirect(site_url($this->session->userdata('login_type').'/dashboard'), 'refresh');
            } elseif($query->num_rows() > 1){
                $data['nik']             = $this->input->post('nik');
                redirect(site_url('login/choose_type/' . $data['nik']), 'refresh');
            }
        } else {
            $data['nik']             = $this->input->post('nik');
            $data['log_application'] = 'MYHC';
            $data['log_type']        = 'EMPLOYEE';
            $data['log_time']        = date('Y-m-d H:i:s');
            $data['log_ipaddress']   = $this->input->ip_address();
            $data['log_browser']     = $this->agent->browser();
            $data['log_os']          = $this->agent->platform();
            $data['log_status']      = 'Failed';

            $this->db->insert('login_log', $data);

            $this->session->set_flashdata('error', 'Invalid Login');
            redirect(site_url('login'), 'refresh');
        }
    }

    function choose_type($param1 = '') {
        $page_data['nik']  = $param1;
        
        $this->load->view('backend/choose_type', $page_data);
    }

    function select($param1 = '', $param2 = '', $param3 = '') {
        $emp = $this->db->get_where('employee', array('nik' => $param1))->row();
        if($param2 == 'ADMIN' || $param2 == 'SPV'){
            $this->session->set_userdata(strtolower($param2) . '_login' , 1);
            $this->session->set_userdata('login_type' , strtolower($param2));
            $this->session->set_userdata('login_nik' , $param1);
            $this->session->set_userdata('login_section' , $emp->section_code);
            $this->session->set_userdata('login_branch' , $emp->branch_code);
            $this->session->set_userdata('login_origin' , $emp->origin_code);
            $this->session->set_userdata('login_id' , $param3);
        } else {
            $this->session->set_userdata(strtolower($param2) . '_login' , 1);
            $this->session->set_userdata('login_type' , strtolower($param2));
            $this->session->set_userdata('login_nik' , $param1);
            $this->session->set_userdata('login_branch' , $emp->branch_code);
            $this->session->set_userdata('login_origin' , $emp->origin_code);
            $this->session->set_userdata('login_id' , $param3);
            
        }

        $data['nik']             = $param1;
        $data['log_application'] = 'MYHC';
        $data['log_type']        = $param2;
        $data['log_time']        = date('Y-m-d H:i:s');
        $data['log_ipaddress']   = $this->input->ip_address();
        $data['log_browser']     = $this->agent->browser();
        $data['log_os']          = $this->agent->platform();
        $data['log_status']      = 'Success';

        $this->db->insert('login_log', $data);

        redirect(site_url($this->session->userdata('login_type').'/dashboard'), 'refresh');
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(site_url('login') , 'refresh');
    }
}
