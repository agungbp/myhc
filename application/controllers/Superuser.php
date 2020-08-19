<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Superuser extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
            $this->load->helper('tgl_indo');
            $this->load->helper('number_to_words');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
            date_default_timezone_set("ASIA/JAKARTA");
        }
    
        public function index() {
            if ($this->session->userdata('superuser_login') != 1)
                redirect(site_url('login'),'refresh');
    
            if ($this->session->userdata('superuser_login') == 1)
                redirect(site_url('superuser/dashboard'),'refresh');
                
            $this->load->view('backend/index');
        }
    
        function dashboard() {
            if ($this->session->userdata('superuser_login') != 1) {
                redirect(site_url('login'),'refresh');
            }
            
            $page_data['graph'] = $this->superuser_model->graph();
            $page_data['page_name'] = 'dashboard';
            $page_data['page_title'] = 'Dashboard';
            $this->load->view('backend/index', $page_data);
        }
        

        // ------------- USERS ------------- //

        function user($param1 = '', $param2 = '') {
            if ($this->session->userdata('superuser_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $user = $this->superuser_model->user_add();
                if ($user == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('superuser/user/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $user = $this->superuser_model->user_edit($param2);
                if ($user == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('superuser/user/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $user = $this->superuser_model->user_delete($param2);
                if ($user == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('superuser/user/list'), 'refresh');
            }
            if ($param1 == 'reset_password') {
                $user = $this->superuser_model->reset_password($param2);
                if ($user == true) {
                    $this->session->set_flashdata('success', 'Password Reseted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Reset Password Failed');
                }
                redirect(site_url('superuser/user/list'), 'refresh');
            } if ($param1 == 'search') {
                $page_data['searchmethod']    = $this->input->post('searchmethod');
                $page_data['search']          = $this->input->post('search');
                $page_data['user_createdate'] = NULL;
                $page_data['start']           = NULL;
                $page_data['end']             = NULL;
                $page_data['section_code']    = NULL;
                $page_data['user_type']       = NULL;
                $page_data['page_name']       = 'user';
                $page_data['page_title']      = 'User List';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'filter') {
                $page_data['searchmethod']    = NULL;
                $page_data['search']          = NULL;
                $page_data['user_createdate'] = $this->input->post('user_createdate');
                $page_data['start']           = $this->input->post('start');
                $page_data['end']             = $this->input->post('end');
                $page_data['section_code']    = $this->input->post('section_code');
                $page_data['user_type']       = $this->input->post('user_type');
                $page_data['page_name']       = 'user';
                $page_data['page_title']      = 'User List';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['searchmethod']    = NULL;
                $page_data['search']          = NULL;
                $page_data['user_createdate'] = NULL;
                $page_data['start']           = NULL;
                $page_data['end']             = NULL;
                $page_data['section_code']    = NULL;
                $page_data['user_type']       = NULL;
                $page_data['page_name']       = 'user';
                $page_data['page_title']      = 'User List';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- MARQUEE ------------- //

        function marquee($param1 = '', $param2 = '') {
            if ($this->session->userdata('superuser_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $marquee = $this->superuser_model->marquee_add();
                if ($marquee == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('superuser/marquee/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $marquee = $this->superuser_model->marquee_edit($param2);
                if ($marquee == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('superuser/marquee/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $marquee = $this->superuser_model->marquee_delete($param2);
                if ($marquee == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('superuser/marquee/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'marquee';
                $page_data['page_title'] = 'Running Text';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- LOGIN LOG ------------- //

        function log($param1 = '', $param2 = '') {
            if ($this->session->userdata('superuser_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'filter') {
                $page_data['start']         = $this->input->post('start');
                $page_data['end']           = $this->input->post('end');
                $page_data['page_name']     = 'login_log';
                $page_data['page_title']    = 'Login Log';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['start']      = date("Y-m-01");
                $page_data['end']        = date("Y-m-t");
                $page_data['page_name']  = 'login_log';
                $page_data['page_title'] = 'Login Log';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------- PASSWORD ------- //

        function change_password($param1 = '') {
            if ($param1 == 'change') {
                $data['user_password']        = md5($this->input->post('user_password'));
                $data['new_password']         = md5($this->input->post('new_password'));
                $data['confirm_new_password'] = md5($this->input->post('confirm_new_password'));
                
                $current_password = $this->db->get_where('user', array('nik' => $this->session->userdata('login_nik')))->row()->user_password;
                
                if ($current_password == $data['user_password'] && $data['new_password'] == $data['confirm_new_password']) {
                    $this->db->where('nik', $this->session->userdata('login_nik'));
                    $this->db->update('user', array('user_password' => $data['new_password']));
                    
                    $this->session->set_flashdata('success', 'Password Updated');
                } else {
                    $this->session->set_flashdata('error', 'Password Mismatch');
                }
                redirect(site_url('superuser/change_password'), 'refresh');
            }
            
            $page_data['page_name']     = 'change_password';
            $page_data['page_title']    = 'Change Password';
            $this->load->view('backend/index', $page_data);
        }
    }

?>