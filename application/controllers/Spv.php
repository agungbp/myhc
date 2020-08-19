<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Spv extends CI_Controller {

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
            if ($this->session->userdata('spv_login') != 1)
                redirect(site_url('login'),'refresh');
    
            if ($this->session->userdata('spv_login') == 1)
                redirect(site_url('spv/dashboard'),'refresh');
                
            $this->load->view('backend/index');
        }
    
        function dashboard() {
            if ($this->session->userdata('spv_login') != 1) {
                redirect(site_url('login'),'refresh');
            }

            $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;

            $page_data['graphposition'] = $this->spv_model->graphposition();
            $page_data['graphstatus']   = $this->spv_model->graphstatus();
            $page_data['graphunit']     = $this->spv_model->graphunit();
            $page_data['page_name'] = 'dashboard';
            $page_data['page_title'] = $section_name . ' DASHBOARD';
            $this->load->view('backend/index', $page_data);
        }


        // ------------- EMPLOYEE ------------- //

        function employee($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'update') {
                $employee = $this->spv_model->employee_edit($param2);
                if ($employee == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('employee/profile/update_list'));
            }
            if ($param1 == 'update_list') {
                $page_data['page_name']     = 'employee_update';
                $page_data['update_id']     = $param2;
                $page_data['page_title']    = 'Employee Update Request';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_shift') {
                $page_data['page_name'] = 'employee_update_shift';
                $page_data['update_id'] = $param2;
                $page_data['nik'] = $param3;
                $page_data['page_title'] = 'Employee Update Request';
                $this->load->view('backend/index', $page_data);
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
                $page_data['page_name']  = 'employee_profile';
                $page_data['nik']        = $param2;
                $page_data['page_title'] = 'Employee Profile';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'print') {
                $page_data['nik'] = $param2;
                $page_data['page_title']    = 'Employee Profile';
                $this->load->view('backend/spv/employee_profile_print', $page_data);
            }
        }


        // ------------- SPK ------------- //

        function spk($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print_freelance') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Freelance';
                $this->load->view('backend/spv/spk_print_freelance', $page_data);
            }
            if ($param1 == 'print_pkwt') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK PKWT';
                $this->load->view('backend/spv/spk_print_pkwt', $page_data);
            }
            if ($param1 == 'print_mitra') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Mitra';
                $this->load->view('backend/spv/spk_print_mitra', $page_data);
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
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print') {
                $page_data['teguran_id']     = $param2;
                $page_data['nik']            = $param3;
                $page_data['page_title']     = 'Surat Teguran';
                $this->load->view('backend/spv/teguran_print', $page_data);
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
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print') {
                $page_data['panggilan_id']  = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'Surat Panggilan';
                $this->load->view('backend/spv/panggilan_print', $page_data);
            }
            if ($param1 == 'list') {
                $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;
                $page_data['page_name'] = 'panggilan';
                $page_data['page_title'] = $section_name . ' SURAT PANGGILAN';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- MPP ------------- //
        
        // function mpp($param1 = '', $param2 = '') {
        //     if ($this->session->userdata('spv_login') != 1) {
        //         $this->session->set_userdata('last_page', current_url());
        //         redirect(site_url('login'),'refresh');
        //     }
        //     if ($param1 == 'create') {
        //         $mpp = $this->spv_model->mpp_add();
        //         if($mpp == true){
        //             $this->session->set_flashdata('success', 'Data Created Successfully');
        //         } else {
        //             $this->session->set_flashdata('error', 'Create Data Failed');
        //         }
        //         redirect(site_url('spv/mpp/list'), 'refresh');
        //     }
        //     if ($param1 == 'update') {
        //         $mpp = $this->spv_model->mpp_edit($param2);
        //         if($mpp == true){
        //             $this->session->set_flashdata('success', 'Data Created Successfully');
        //         } else {
        //             $this->session->set_flashdata('error', 'Create Data Failed');
        //         }
        //         redirect(site_url('spv/mpp/list'), 'refresh');
        //     }
        //     if ($param1 == 'list') {
        //         $section_name = $this->db->get_where('section', array('section_code' => $this->session->userdata('login_section')))->row()->section_name;
        //         $page_data['page_name'] = 'mpp';
        //         $page_data['page_title'] = $section_name . ' MAN POWER PLAN';
        //         $this->load->view('backend/index', $page_data);
        //     }
        // }  


        // ------- ATTENDANCE ------- //

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
            redirect(site_url('spv/freelance_attendance_report_view/') .$data['section_code'] . '/' . $data['year'] . '/' . $data['month'], 'refresh');
        }

        function freelance_attendance_report_view($section_code = '', $year = '', $month = '') {
            if ($this->session->userdata('spv_login') != 1)
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


        // ------------- CANDIDATE ------------- //

        function candidate($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
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
                $this->load->view('backend/spv/candidate_profile_eksternal_print', $page_data);
            }
        }


        // ------------- APPLICATION ------------- //
        
        function application($param1 = '', $param2 = '') {
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'approve') {
                $application = $this->spv_model->application_approve($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/application/list'));
            }
            if ($param1 == 'decline') {
                $application = $this->spv_model->application_decline($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/application/list'));
            }
            if ($param1 == 'hire_approve') {
                $application = $this->spv_model->application_hireapprove($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/application/newhire'));
            }
            if ($param1 == 'hire_decline') {
                $application = $this->spv_model->application_hiredecline($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/application/newhire'));
            }
            if ($param1 == 'profile') {
                $page_data['page_name'] = 'application_profile';
                $page_data['nik'] = $param2;
                $page_data['page_title'] = 'Candidate Profile';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'application';
                $page_data['page_title'] = 'Job Application Approval';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'newhire') {
                $page_data['page_name'] = 'application_newhire';
                $page_data['page_title'] = 'New Hire Approval';
                $this->load->view('backend/index', $page_data);
            }
        }  


        // ------- LOAN ------- //
        
        function loan($param1 = '', $param2 = '') {
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'change_status_approved') {
                $loan = $this->spv_model->loan_approved($param2);
                if ($loan == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/loan/list/'));
            }
            if ($param1 == 'change_status_declined') {
                $loan = $this->spv_model->loan_declined($param2);
                if ($loan == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/loan/list/'));
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'loan';
                $page_data['page_title'] = 'Loan Approval';
                $this->load->view('backend/index', $page_data);
            }
        }

        // ------- ELEARNING ------- //
        
        function elearning($param1 = '', $param2 = '') {
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'change_status_approved') {
                $elearning = $this->spv_model->elearning_approved($param2);
                if ($elearning == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/elearning/list/'));
            }
            if ($param1 == 'change_status_declined') {
                $elearning = $this->spv_model->elearning_declined($param2);
                if ($elearning == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/elearning/list/'));
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'elearning';
                $page_data['page_title'] = 'Elearning Approval';
                $this->load->view('backend/index', $page_data);
            }
        }

        // ------- RESIGN ------- //
        
        function resign($param1 = '', $param2 = '') {
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'change_status_approved') {
                $resign = $this->spv_model->resign_approved($param2);
                if ($resign == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/resign/list/'));
            }
            if ($param1 == 'change_status_declined') {
                $resign = $this->spv_model->resign_declined($param2);
                if ($resign == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/resign/list/'));
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'resign';
                $page_data['page_title'] = 'Resign Approval';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------- ONLINE TEST ------- //
        
        function questionpack($param1 = '', $param2 = '') {
            if ($this->session->userdata('spv_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'change_status_approved') {
                $questionpack = $this->spv_model->questionpack_approved($param2);
                if ($questionpack == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/questionpack/list/'));
            }
            if ($param1 == 'change_status_declined') {
                $questionpack = $this->spv_model->questionpack_declined($param2);
                if ($questionpack == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('spv/questionpack/list/'));
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'cbt_questionpack';
                $page_data['page_title'] = 'Question Pack Approval';
                $this->load->view('backend/index', $page_data);
            }
        }

        // ------------- QUESTION ------------- //

        function question($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('spv_login') != 1) {
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
            
            $page_data['page_name']     = 'change_password';
            $page_data['page_title']    = 'CHANGE PASSWORD';
            $this->load->view('backend/index', $page_data);
        }
    }

?>