<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Admin extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
            $this->load->helper('tgl_indo');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
            date_default_timezone_set("ASIA/JAKARTA");
        }
    
        public function index() {
            if ($this->session->userdata('admin_login') != 1)
                redirect(site_url('login'),'refresh');
    
            if ($this->session->userdata('admin_login') == 1)
                redirect(site_url('admin/dashboard'),'refresh');
                
            $this->load->view('backend/index');
        }
    
        function dashboard() {
            if ($this->session->userdata('admin_login') != 1) {
                redirect(site_url('login'),'refresh');
            }

            $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;
            $page_data['page_name'] = 'dashboard';
            $page_data['page_title'] = $section_name . ' DASHBOARD';
            $this->load->view('backend/index', $page_data);
        }


        // ------------- EMPLOYEE ------------- //

        function employee($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('admin_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'filter') {
                $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;

                $page_data['start']         = $this->input->post('start');
                $page_data['end']           = $this->input->post('end');
                $page_data['page_name']     = 'employee_list';
                $page_data['page_title']    = $section_name . ' EMPLOYEE LIST';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'list') {
                $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;

                $page_data['start']      = 'All';
                $page_data['end']        = 'All';
                $page_data['page_name']  = 'employee_list';
                $page_data['page_title'] = $section_name . ' EMPLOYEE LIST';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'profile') {
                $page_data['page_name'] = 'employee_profile';
                $page_data['nik'] = $param2;
                $page_data['page_title'] = 'Employee Profile';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'print') {
                $page_data['nik'] = $param2;
                $page_data['page_title']    = 'Employee Profile';
                $this->load->view('backend/admin/employee_profile_print', $page_data);
            }
        }


        // ------------- SPK ------------- //

        function spk($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('admin_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print_freelance') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Freelance';
                $this->load->view('backend/admin/spk_print_freelance', $page_data);
            }
            if ($param1 == 'print_pkwt') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK PKWT';
                $this->load->view('backend/admin/spk_print_pkwt', $page_data);
            }
            if ($param1 == 'print_mitra') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Mitra';
                $this->load->view('backend/admin/spk_print_mitra', $page_data);
            }
        }


        // ------------- TEGURAN ------------- //

        function teguran($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('admin_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print') {
                $page_data['teguran_id']     = $param2;
                $page_data['nik']            = $param3;
                $page_data['page_title']     = 'Surat Teguran';
                $this->load->view('backend/admin/teguran_print', $page_data);
            }
            if ($param1 == 'list') {
                $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;
                $page_data['page_name']  = 'teguran';
                $page_data['page_title'] = $section_name . ' SURAT TEGURAN';
                $this->load->view('backend/index', $page_data);
            }
        }

        // ------------- PANGGILAN ------------- //

        function panggilan($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('admin_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print') {
                $page_data['panggilan_id']  = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'Surat Panggilan';
                $this->load->view('backend/admin/panggilan_print', $page_data);
            }
            if ($param1 == 'list') {
                $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;
                $page_data['page_name'] = 'panggilan';
                $page_data['page_title'] = $section_name . ' SURAT PANGGILAN';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- MPP ------------- //
        
        function mpp($param1 = '', $param2 = '') {
            if ($this->session->userdata('admin_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $mpp = $this->admin_model->mpp_add();
                if($mpp == true){
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('admin/mpp/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $mpp = $this->admin_model->mpp_edit($param2);
                if($mpp == true){
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('admin/mpp/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;
                $page_data['page_name'] = 'mpp';
                $page_data['page_title'] = $section_name . ' MAN POWER PLAN';
                $this->load->view('backend/index', $page_data);
            }
        }  


        // ------- ATTENDANCE ------- //

        function freelance_attendance() {
            if ($this->session->userdata('admin_login') != 1)
                redirect(site_url('login'), 'refresh');

            $page_data['page_name']     = 'freelance_attendance';
            $page_data['page_title']    = 'Freelance Attendance';
            $this->load->view('backend/index', $page_data);
        }

        function freelance_attendance_selector() {
            $data['section_code']     = $this->input->post('section_code');
            $data['fattendance_date'] = $this->input->post('fattendance_date');

            $query = $this->db->get_where('freelance_attendance', array('fattendance_date' => $data['fattendance_date']));

            $this->db->from('employee');
            $this->db->where('employee_status', 'FREELANCE');
            $this->db->where('section_code', $data['section_code']);
            $sql = $this->db->get();

            $employees = $sql->result_array();

            if($query->num_rows() < 1)     // NEW ATTENDANCE ENTRY
                foreach($employees as $row) {
                    $attn_data['nik']                = $row['nik'];
                    $attn_data['fattendance_date']   = $data['fattendance_date'];
                    $attn_data['fattendance_status'] = 'M';
                    $this->db->insert('freelance_attendance', $attn_data);
                }

            if($query->num_rows() >= 1) {     // NEW ATTENDANCE ENTRY ONLY FOR NEWLY INSERTED EMPLOYEES
                $employee_ids_of_attendance = array();
                $attendance = $query->result_array();

                foreach($attendance as $row2){
                    array_push($employee_ids_of_attendance, $row2['nik']);
                }

                foreach($employees as $row){
                    if(!in_array($row['nik'], $employee_ids_of_attendance)){
                        $attn_data['nik']                = $row['nik'];
                        $attn_data['fattendance_date']   = $data['fattendance_date'];
                        $attn_data['fattendance_status'] = 'M';
                        $this->db->insert('freelance_attendance', $attn_data);
                    }
                }
            }

            redirect(site_url('admin/freelance_attendance_view/') .$data['section_code'] . '/' . $data['fattendance_date'], 'refresh');
        }

        function freelance_attendance_view($section_code = '', $fattendance_date = '') {
            if ($this->session->userdata('admin_login') != 1)
                redirect(site_url('login'), 'refresh');

            $page_data['section_code']    = $section_code;
            $page_data['fattendance_date'] = $fattendance_date;
            $page_data['page_name']       = 'freelance_attendance_view';
            $page_data['page_title']      = 'Freelance Attendance';
            $this->load->view('backend/index', $page_data);
        }

        function freelance_attendance_update($section_code = '', $fattendance_date = '') {
            $number_of_attendances = $this->input->post('number_of_attendances');

            for($i = 1; $i <= $number_of_attendances; $i++) {
                $fattendance_id      = $this->input->post('fattendance_id_' . $i);
                $fattendance_status  = $this->input->post('fattendance_status_' . $fattendance_id);

                // if($fattendance_status == 'S' || $fattendance_status == 'I' || $fattendance_status == 'A')
                //     $fattendance_remarks = $this->input->post('fattendance_remarks_' . $fattendance_id);
                // if($fattendance_status == 'M')
                //     $fattendance_remarks = '';

                $this->db->where('fattendance_id', $fattendance_id);
                $this->db->update('freelance_attendance', array('fattendance_status' => $fattendance_status));
                // $this->db->update('freelance_attendance', array('fattendance_status' => $fattendance_status, 'fattendance_remarks' => $fattendance_remarks));
            }

            $this->session->set_flashdata('success', 'Attendance Updated');
            redirect(site_url('admin/freelance_attendance_view/'). $section_code . '/' . $fattendance_date, 'refresh');
        }

        function freelance_attendance_report() {
            $page_data['month']         = date('m');
            $page_data['year']          = date('Y');
            $page_data['page_name']     = 'freelance_attendance_report';
            $page_data['page_title']    = 'Freelance Attendance Report';
            $this->load->view('backend/index', $page_data);
        }

        function freelance_attendance_report_selector() {
            $data['section_code']   = $this->input->post('section_code');
            $data['year']           = $this->input->post('year');
            $data['month']          = $this->input->post('month');
            redirect(site_url('admin/freelance_attendance_report_view/') .$data['section_code'] . '/' . $data['year'] . '/' . $data['month'], 'refresh');
        }

        function freelance_attendance_report_view($section_code = '', $year = '', $month = '') {
            if ($this->session->userdata('admin_login') != 1)
                redirect(site_url('login'), 'refresh');

            if($section_code != 'All')
                $section_name = $this->db->get_where('section', array('section_code' => $section_code))->row()->section_name;
            else
                $section_name = 'All Employees';

            $page_data['section_code']  = $section_code;
            $page_data['year']          = $year;
            $page_data['month']         = $month;
            $page_data['page_name']     = 'freelance_attendance_report_view';
            $page_data['page_title']    = 'Freelance Attendance Report of' . ' ' . $section_name;
            $this->load->view('backend/index', $page_data);
        }


        // ------- PASSWORD ------- //

        function change_password($param1 = '', $param2 = '')
        {
            if ($param1 == 'change') {
                $data['user_password']        = md5($this->input->post('user_password'));
                $data['new_password']         = md5($this->input->post('new_password'));
                $data['confirm_new_password'] = md5($this->input->post('confirm_new_password'));

                $this->db->from('user');
                $this->db->where('nik', $this->session->userdata('login_nik'));
                $query = $this->db->get();
                $row = $query->row();
                
                $current_password = $row->user_password;
                
                if ($current_password == $data['user_password'] && $data['new_password'] == $data['confirm_new_password']) {
                    $this->db->where('nik', $this->session->userdata('login_nik'));
                    $this->db->update('user', array('user_password' => $data['new_password']));
                    
                    $this->session->set_flashdata('success', 'Password Updated');
                } else {
                    $this->session->set_flashdata('error', 'Password Mismatch');
                }
                redirect(site_url('candidate/change_password'), 'refresh');
            }
            
            $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;
            $page_data['page_name']     = 'change_password';
            $page_data['page_title']    = $section_name . ' CHANGE PASSWORD';
            $this->load->view('backend/index', $page_data);
        }
    }

?>