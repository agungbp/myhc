<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Head extends CI_Controller {

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
            if ($this->session->userdata('head_login') != 1)
                redirect(site_url('login'),'refresh');
    
            if ($this->session->userdata('head_login') == 1)
                redirect(site_url('head/dashboard'),'refresh');
                
            $this->load->view('backend/index');
        }
    
        function dashboard() {
            if ($this->session->userdata('head_login') != 1) {
                redirect(site_url('login'),'refresh');
            }
            
            $page_data['graphposition'] = $this->head_model->graphposition();
            $page_data['graphstatus']   = $this->head_model->graphstatus();
            $page_data['graphsection']  = $this->head_model->graphsection();
            $page_data['graphunit']     = $this->head_model->graphunit();
            $page_data['graphvacancy']  = $this->head_model->graphvacancy();
            $page_data['graphlevel']    = $this->head_model->graphlevel();
            $page_data['page_name'] = 'dashboard';
            $page_data['page_title'] = 'Dashboard';
            $this->load->view('backend/index', $page_data);
        }

        // ------------- EMPLOYEE ------------- //

        function employee($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'search') {
                $page_data['searchmethod']    = $this->input->post('searchmethod');
                $page_data['search']          = $this->input->post('search');
                $page_data['employee_join']   = NULL;
                $page_data['start']           = NULL;
                $page_data['end']             = NULL;
                $page_data['section_code']    = NULL;
                $page_data['employee_status'] = NULL;
                $page_data['page_name']       = 'employee_list';
                $page_data['page_title']      = 'Employee List';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'filter') {
                $page_data['searchmethod']    = NULL;
                $page_data['search']          = NULL;
                $page_data['employee_join']   = $this->input->post('employee_join');
                $page_data['start']           = $this->input->post('start');
                $page_data['end']             = $this->input->post('end');
                $page_data['section_code']    = $this->input->post('section_code');
                $page_data['employee_status'] = $this->input->post('employee_status');
                $page_data['page_name']       = 'employee_list';
                $page_data['page_title']      = 'Employee List';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['searchmethod']    = NULL;
                $page_data['search']          = NULL;
                $page_data['employee_join']   = NULL;
                $page_data['start']           = NULL;
                $page_data['end']             = NULL;
                $page_data['section_code']    = NULL;
                $page_data['employee_status'] = NULL;
                $page_data['page_name']       = 'employee_list';
                $page_data['page_title']      = 'Employee List';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'new') {
                $page_data['page_name']  = 'employee_list_new';
                $page_data['page_title'] = 'New Employee This Month';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'profile') {
                $page_data['page_name']  = 'employee_profile';
                $page_data['nik']        = $param2;
                $page_data['page_title'] = 'Employee Profile';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'print') {
                $page_data['nik']           = $param2;
                $page_data['page_title']    = 'Employee Profile';
                $this->load->view('backend/head/employee_profile_print', $page_data);
            }
        }

        function get_employee($section_code) {
            $page_data['section_code'] = $section_code;
            $this->load->view('backend/head/freelance_payroll_employee_select', $page_data);
        }

        function get_unit(){
            $section_code = $this->input->post('id',TRUE);
            $data = $this->head_model->get_unit($section_code)->result();
            echo json_encode($data);
        }

        function get_branch(){
            $regional_code = $this->input->post('id',TRUE);
            $data = $this->head_model->get_branch($regional_code)->result();
            echo json_encode($data);
        }

        function get_origin(){
            $branch_code = $this->input->post('id',TRUE);
            $data = $this->head_model->get_origin($branch_code)->result();
            echo json_encode($data);
        }

        function get_zone(){
            $origin_code = $this->input->post('id',TRUE);
            $data = $this->head_model->get_zone($origin_code)->result();
            echo json_encode($data);
        }

        // ------------- SPK ------------- //

        function spk($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print_freelance') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Freelance';
                $this->load->view('backend/head/spk_print_freelance', $page_data);
            }
            if ($param1 == 'print_pkwt') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK PKWT';
                $this->load->view('backend/head/spk_print_pkwt', $page_data);
            }
            if ($param1 == 'print_mitra') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Mitra';
                $this->load->view('backend/head/spk_print_mitra', $page_data);
            }
            if ($param1 == 'soon') {
                $page_data['page_name'] = 'spk_soon';
                $page_data['page_title'] = 'SPK Expiring Soon';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'expired') {
                $page_data['page_name'] = 'spk_expired';
                $page_data['page_title'] = 'Expired SPK';
                $this->load->view('backend/index', $page_data);
            }
        }

        // ------------- TEGURAN ------------- //

        function teguran($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print') {
                $page_data['teguran_id']     = $param2;
                $page_data['nik']            = $param3;
                $page_data['page_title']     = 'Surat Teguran';
                $this->load->view('backend/head/teguran_print', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['page_name']  = 'teguran';
                $page_data['page_title'] = 'Surat Teguran';
                $this->load->view('backend/index', $page_data);
            }
        }

        // ------------- PANGGILAN ------------- //

        function panggilan($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print') {
                $page_data['panggilan_id']  = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'Surat Panggilan';
                $this->load->view('backend/head/panggilan_print', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'panggilan';
                $page_data['page_title'] = 'Surat Panggilan';
                $this->load->view('backend/index', $page_data);
            }
        }

        // ------------- SECTION ------------- //

        function section($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'section';
                $page_data['page_title'] = 'Department';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- UNIT ------------- //

        function unit($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'unit';
                $page_data['page_title'] = 'Unit';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- REGIONAL ------------- //

        function regional($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'regional';
                $page_data['page_title'] = 'Regional';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- BRANCH ------------- //

        function branch($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'branch';
                $page_data['page_title'] = 'Branch';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- ORIGIN ------------- //

        function origin($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'origin';
                $page_data['page_title'] = 'Origin';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- ZONE ------------- //
        
        function zone($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'zone';
                $page_data['page_title'] = 'Zone';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- VACANCY ------------- //
        
        function vacancy($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'vacancy';
                $page_data['page_title'] = 'Vacancy';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'print') {
                $page_data['vacancy_id']    = $param2;
                $page_data['page_title']    = 'Job Posting';
                $this->load->view('backend/head/vacancy_print', $page_data);
            }
        }  


        // ------------- CANDIDATE ------------- //

        function candidate($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'filter') {
                $page_data['vacancy_id']         = $this->input->post('vacancy_id');
                $page_data['application_status'] = $this->input->post('application_status');
                $page_data['page_name']          = 'candidate_list';
                $page_data['page_title']         = 'Candidate List';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['vacancy_id']         = NULL;
                $page_data['application_status'] = NULL;
                $page_data['page_name']          = 'candidate_list';
                $page_data['page_title']         = 'Candidate List';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'eksternal_list') {
                $vac = $this->db->get_where('vacancy', array('vacancy_id' => $param2))->row();
                $page_data['vacancy_id'] = $param2;
                $page_data['page_name'] = 'candidate_eksternal_list';
                $page_data['page_title'] = $vac->vacancy_position . ' ' . $vac->vacancy_level . ' ' . 'Candidate List';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'internal_list') {
                $vac = $this->db->get_where('vacancy', array('vacancy_id' => $param2))->row();
                $page_data['vacancy_id'] = $param2;
                $page_data['page_name'] = 'candidate_internal_list';
                $page_data['page_title'] = $vac->vacancy_position . ' ' . $vac->vacancy_level . ' ' . 'Candidate List';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'profile_eksternal') {
                $page_data['candidate_ktp'] = $param2;
                $page_data['page_name']     = 'candidate_profile_eksternal';
                $page_data['page_title']    = 'Candidate Profile';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'profile_internal') {
                $page_data['nik'] = $param2;
                $page_data['page_name'] = 'candidate_profile_internal';
                $page_data['page_title'] = 'Candidate Profile';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'print_eksternal') {
                $page_data['candidate_ktp'] = $param2;
                $page_data['page_title']    = 'Curriculum Vitae';
                $this->load->view('backend/head/candidate_profile_eksternal_print', $page_data);
            }
        }


        // ------------- SCHEDULE ------------- //

        function recruitment_schedule($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name']  = 'candidate_schedule';
                $page_data['page_title'] = 'Recruitment Schedule';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'print_eksternal') {
                $page_data['schedule_id']   = $param2;
                $page_data['page_title']    = 'Recruitment Attendance';
                $this->load->view('backend/head/candidate_schedule_list_eksternal_print', $page_data);
            }
            if ($param1 == 'print_internal') {
                $page_data['schedule_id']   = $param2;
                $page_data['page_title']    = 'Recruitment Attendance';
                $this->load->view('backend/head/candidate_schedule_list_internal_print', $page_data);
            }
        }


        // ------------- PLAFON ------------- //
        
        function plafon($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'filter') {
                $page_data['searchmethod']    = $this->input->post('searchmethod');
                $page_data['search']          = $this->input->post('search');
                $page_data['plafon_periode']  = $this->input->post('plafon_periode');
                $page_data['page_name']       = 'plafon';
                $page_data['page_title']      = 'Plafon';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['searchmethod']    = 'ALL';
                $page_data['search']          = NULL;
                $page_data['plafon_periode']  = date('Y');
                $page_data['page_name']       = 'plafon';
                $page_data['page_title']      = 'Plafon';
                $this->load->view('backend/index', $page_data);
            }
        } 


        // ------------- RAWAT INAP ------------- //
        
        function rawatinap($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['rawatinap_period'] = NULL;
                $page_data['start']            = date("Y-m-01");;
                $page_data['end']              = date("Y-m-t");
                $page_data['rawatinap_status'] = 'All';
                $page_data['page_name'] = 'rawatinap';
                $page_data['page_title'] = 'Claim Rawat Inap';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'filter') {
                $page_data['rawatinap_period'] = $this->input->post('rawatinap_period');
                $page_data['start']            = $this->input->post('start');
                $page_data['end']              = $this->input->post('end');
                $page_data['rawatinap_status'] = $this->input->post('rawatinap_status');
                $page_data['page_name'] = 'rawatinap';
                $page_data['page_title'] = 'Claim Rawat Inap';
                $this->load->view('backend/index', $page_data);
            }
        } 


        // ------------- RAWAT JALAN ------------- //
        
        function rawatjalan($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['rawatjalan_period'] = NULL;
                $page_data['start']             = date("Y-m-01");;
                $page_data['end']               = date("Y-m-t");
                $page_data['rawatjalan_status'] = 'All';
                $page_data['page_name']         = 'rawatjalan';
                $page_data['page_title']        = 'Claim Rawat Jalan';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'filter') {
                $page_data['rawatjalan_period'] = $this->input->post('rawatjalan_period');
                $page_data['start']             = $this->input->post('start');
                $page_data['end']               = $this->input->post('end');
                $page_data['rawatjalan_status'] = $this->input->post('rawatjalan_status');
                $page_data['page_name']         = 'rawatjalan';
                $page_data['page_title']        = 'Claim Rawat Jalan';
                $this->load->view('backend/index', $page_data);
            }
        } 


        // ------------- MELAHIRKAN ------------- //
        
        function melahirkan($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['melahirkan_period'] = NULL;
                $page_data['start']             = date("Y-m-01");;
                $page_data['end']               = date("Y-m-t");
                $page_data['melahirkan_status'] = 'All';
                $page_data['page_name']         = 'melahirkan';
                $page_data['page_title']        = 'Claim Melahirkan';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'filter') {
                $page_data['melahirkan_period'] = $this->input->post('melahirkan_period');
                $page_data['start']             = $this->input->post('start');
                $page_data['end']               = $this->input->post('end');
                $page_data['melahirkan_status'] = $this->input->post('melahirkan_status');
                $page_data['page_name']         = 'melahirkan';
                $page_data['page_title']        = 'Claim Melahirkan';
                $this->load->view('backend/index', $page_data);
            }
        } 


        // ------------- KACAMATA ------------- //
        
        function kacamata($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['kacamata_period'] = NULL;
                $page_data['start']             = date("Y-m-01");;
                $page_data['end']               = date("Y-m-t");
                $page_data['kacamata_status'] = 'All';
                $page_data['page_name']         = 'kacamata';
                $page_data['page_title']        = 'Claim Kacamata';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'filter') {
                $page_data['kacamata_period'] = $this->input->post('kacamata_period');
                $page_data['start']             = $this->input->post('start');
                $page_data['end']               = $this->input->post('end');
                $page_data['kacamata_status'] = $this->input->post('kacamata_status');
                $page_data['page_name']         = 'kacamata';
                $page_data['page_title']        = 'Claim Kacamata';
                $this->load->view('backend/index', $page_data);
            }
        } 


        // ------- FREELANCE ATTENDANCE ------- //

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
            redirect(site_url('head/freelance_attendance_report_view/') .$data['section_code'] . '/' . $data['year'] . '/' . $data['month'], 'refresh');
        }

        function freelance_attendance_report_view($section_code = '', $year = '', $month = '') {
            if ($this->session->userdata('head_login') != 1)
                redirect(site_url('login'), 'refresh');

            if($section_code != 'All'){
                $section_name = $this->db->get_where('section', array('section_code' => $section_code))->row()->section_name;
            } elseif($section_code == 'All') {
                $section_name = 'All Employees';
            }
            $page_data['section_code']  = $section_code;
            $page_data['year']          = $year;
            $page_data['month']         = $month;
            $page_data['page_name']     = 'freelance_attendance_report_view';
            $page_data['page_title']    = 'Freelance Attendance Report of' . ' ' . $section_name;
            $this->load->view('backend/index', $page_data);
        }

        function freelance_payslip_details_print($fpayroll_id = '') {
            if ($this->session->userdata('head_login') != 1)
                redirect(site_url('login'), 'refresh');

            $page_data['fpayroll_id']  = $fpayroll_id;
            $page_data['page_title']   = 'Freelance Payslip';
            
            $this->load->view('backend/head/freelance_payslip_details_print', $page_data);
        }


        // ------- LOAN ------- //
        
        function loan($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'loan';
                $page_data['page_title'] = 'Loan Request';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'history') {
                $page_data['page_name'] = 'loan_history';
                $page_data['page_title'] = 'Loan History';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------- RESIGN ------- //
        
        function resign($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'resign';
                $page_data['page_title'] = 'Resign Request';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'employeelist') {
                $page_data['page_name'] = 'employee_list_resign';
                $page_data['page_title'] = 'Employee Resign';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- ROTATION ------------- //

        function rotation($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }

            $page_data['page_name'] = 'rotation';
            $page_data['page_title'] = 'Rotation';
            $this->load->view('backend/index', $page_data);
        }


        // ------------- UNIFORM ------------- //

        function uniform($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'uniform';
                $page_data['page_title'] = 'Uniform';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- CLASS ------------- //

        function class($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'elearning_class_list';
                $page_data['page_title'] = 'E-Learning';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- MATERI ------------- //

        function materi($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $class_name = $this->db->get_where('elearning_class', array('class_id' => $param2))->row()->class_name;
                $page_data['class_id'] = $param2;
                $page_data['page_name'] = 'elearning_materi_list';
                $page_data['page_title'] = $class_name . ' Materi';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- STUDENT ------------- //

        function student($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $class_name = $this->db->get_where('elearning_class', array('class_id' => $param2))->row()->class_name;
                $page_data['class_id'] = $param2;
                $page_data['page_name'] = 'elearning_student';
                $page_data['page_title'] = $class_name . ' Student';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- EXAM ------------- //

        function exam($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'cbt_exam';
                $page_data['page_title'] = 'Online Test';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- QUESTION PACK ------------- //

        function questionpack($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'cbt_questionpack';
                $page_data['page_title'] = 'Question Package';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- QUESTION ------------- //

        function question($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $questionpack_name = $this->db->get_where('cbt_questionpack', array('questionpack_id' => $param2))->row()->questionpack_name;

                $page_data['page_name'] = 'cbt_question';
                $page_data['questionpack_id'] = $param2;
                $page_data['page_title'] = $questionpack_name;
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- PARTICIPANTS ------------- //

        function participants($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $exam_name = $this->db->get_where('cbt_exam', array('exam_id' => $param2))->row()->exam_name;

                $page_data['page_name'] = 'cbt_participants';
                $page_data['exam_id'] = $param2;
                $page_data['page_title'] = 'Participants of ' . $exam_name;
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- EGD E-ATTENDANCE ------------- //

        function egdattendance($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'egdattendance';
                $page_data['page_title'] = 'E-Attendance';
                $this->load->view('backend/index', $page_data);
            }
        }

        function egdparticipants($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $egdattendance = $this->db->get_where('egd_attendance', array('egdattendance_id' => $param2))->row();

                $page_data['page_name']  = 'egdparticipants';
                $page_data['egdattendance_id']  = $param2;
                $page_data['page_title'] = $egdattendance->egdattendance_name . ' - ' . $egdattendance->egdattendance_place . ' - ' . date_format(date_create($egdattendance->egdattendance_date), "d F Y");
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- SURVEY ------------- //

        function survey($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'change_status_approved') {
                $survey = $this->head_model->survey_approved($param2);
                if ($survey == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('head/survey/list/'));
            }
            if ($param1 == 'change_status_declined') {
                $survey = $this->head_model->survey_declined($param2);
                if ($survey == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('head/survey/list/'));
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'survey';
                $page_data['page_title'] = 'E-Survey Approval';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- SURVEY QUESTION ------------- //

        function surveyquestion($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $survey_name = $this->db->get_where('survey', array('survey_id' => $param2))->row()->survey_name;

                $page_data['page_name']  = 'surveyquestion';
                $page_data['survey_id']  = $param2;
                $page_data['page_title'] = $survey_name;
                $this->load->view('backend/index', $page_data);
            }
        }

        function delete_surveyquestionoption($surveyquestionoption_id = '')
        {
            $this->db->where('surveyquestionoption_id', $surveyquestionoption_id);
            $this->db->delete('survey_question_option');

            echo 'success';
        }


        // ------------- RESPONDEN ------------- //

        function responds($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $survey_name = $this->db->get_where('survey', array('survey_id' => $param2))->row()->survey_name;

                $page_data['page_name']  = 'surveyresponden';
                $page_data['survey_id']  = $param2;
                $page_data['page_title'] = $survey_name;
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------ UMRAH -------------- //
        
        function umrah($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'umrah';
                $page_data['page_title'] = 'Umrah Reward';
                $this->load->view('backend/index', $page_data);
            }
        }

        // ------------- MARQUEE ------------- //

        function marquee($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $marquee = $this->head_model->marquee_add();
                if ($marquee == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('head/marquee/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $marquee = $this->head_model->marquee_edit($param2);
                if ($marquee == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('head/marquee/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $marquee = $this->head_model->marquee_delete($param2);
                if ($marquee == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('head/marquee/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'marquee';
                $page_data['page_title'] = 'Running Text';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- SPEAKUP ------------- //

        function speakup($param1 = '', $param2 = '') {
            if ($this->session->userdata('head_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'speakup';
                $page_data['page_title'] = 'Speak Up Corner';
                $this->load->view('backend/index', $page_data);
            }
        }



        // ------- PASSWORD ------- //

        function change_password($param1 = '', $param2 = '') {
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
                redirect(site_url('head/change_password'), 'refresh');
            }
            
            $page_data['page_name']     = 'change_password';
            $page_data['page_title']    = 'Change Password';
            $this->load->view('backend/index', $page_data);
        }
    }

?>