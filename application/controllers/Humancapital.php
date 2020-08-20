<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    class Humancapital extends CI_Controller {

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
            if ($this->session->userdata('humancapital_login') != 1)
                redirect(site_url('login'),'refresh');
    
            if ($this->session->userdata('humancapital_login') == 1)
                redirect(site_url('humancapital/dashboard'),'refresh');
                
            $this->load->view('backend/index');
        }
    
        function dashboard() {
            if ($this->session->userdata('humancapital_login') != 1) {
                redirect(site_url('login'),'refresh');
            }
    
            $kar = $this->db->get_where('employee', array('employee_status !=' => 'Resign'))->result_array();
            foreach($kar as $rows):
                if ($rows['employee_join'] != NULL || $rows['employee_join'] != ''){
                    $date1 = strtotime($rows['employee_join']);
                    $date2 = strtotime('now'); 
                    $diff = abs($date2 - $date1);
                    $years = floor($diff / (365*60*60*24));

                    if($years >= 12){
                        $um = $this->db->get_where('umrah', array('nik' => $rows['nik']))->num_rows();
                        if($um == 0){
                            $data['nik']               = $rows['nik'];
                            $data['umrah_status']      = 'Pending';
                            $data['umrah_createdate']  = date('Y-m-d');

                            $this->db->insert('umrah', $data);
                        }
                    }
                }
            endforeach;


            $loan = $this->db->get('loan_detail')->result_array();
            foreach($loan as $row):
                if($row['dtloan_month'] == date('Y-m') && date('d') >= 25){
                    $data2['dtloan_status']    = 'Paid';

                    $this->db->where('dtloan_month', date('Y-m'));
                    $this->db->update('loan_detail', $data2);
                }
            endforeach;

            $employee = $this->db->get('employee')->result_array();
            foreach($employee as $row):
                $cek = $this->db->get_where('loan', array('nik' => $row['nik'], 'loan_status' => 'Approved'))->num_rows();
                if ($cek > 0) {
                    $cekloan = $this->db->get_where('loan_detail', array('dtloan_status' => 'Unpaid', 'dtloan_status' => 'Unpaid', 'nik' => $row['nik']))->num_rows();
                    if ($cekloan == 0){
                        $data3['loan_status']    = 'Paid';

                        $this->db->where('nik', $row['nik']);
                        $this->db->update('loan', $data3);
                    }
                }
            endforeach;
            
            $page_data['graphposition'] = $this->humancapital_model->graphposition();
            $page_data['graphstatus']   = $this->humancapital_model->graphstatus();
            $page_data['graphsection']  = $this->humancapital_model->graphsection();
            $page_data['graphunit']     = $this->humancapital_model->graphunit();
            $page_data['graphvacancy']  = $this->humancapital_model->graphvacancy();
            $page_data['graphuniform']  = $this->humancapital_model->graphuniform();
            $page_data['page_name'] = 'dashboard';
            $page_data['page_title'] = 'Dashboard';
            $this->load->view('backend/index', $page_data);
        }


        // ------------- EMPLOYEE ------------- //

        function employee($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
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
            if ($param1 == 'add') {
                $page_data['page_name']  = 'employee_add';
                $page_data['page_title'] = 'Add Employee';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'create') {
                $employee = $this->humancapital_model->employee_add();
                if ($employee == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/employee/list'));
            }
            if ($param1 == 'edit') {
                $page_data['page_name']  = 'employee_edit';
                $page_data['nik']        = $param2;
                $page_data['page_title'] = 'Edit Employee';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update') {
                $employee = $this->humancapital_model->employee_edit($param2);
                if ($employee == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/edit/'.$param2));
            }
            if ($param1 == 'delete') {
                $employee = $this->humancapital_model->employee_delete($param2);
                if ($employee == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/employee/list'));
            }
            if ($param1 == 'print') {
                $page_data['nik']           = $param2;
                $page_data['page_title']    = 'Employee Profile';
                $this->load->view('backend/humancapital/employee_profile_print', $page_data);
            }
            if ($param1 == 'update_filter') {
                $page_data['update_type']     = $this->input->post('update_type');
                $page_data['update_status']   = $this->input->post('update_status');
                $page_data['page_name']       = 'employee_update';
                $page_data['page_title']      = 'Employee Update Request';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_list') {
                $page_data['update_type']    = 'All';
                $page_data['update_status']  = 'Waiting for Approval';
                $page_data['page_name']      = 'employee_update';
                $page_data['page_title']     = 'Employee Update Request';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_personal') {
                $page_data['page_name']  = 'employee_update_personal';
                $page_data['update_id']  = $param2;
                $page_data['page_title'] = 'Request Update Data Personal';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_shift') {
                $page_data['page_name']  = 'employee_update_shift';
                $page_data['update_id']  = $param2;
                $page_data['page_title'] = 'Request Update Data Company';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_approve') {
                $employee = $this->humancapital_model->employee_update_approve($param2, $param3);
                if ($employee == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
            if ($param1 == 'update_approve_shift') {
                $employee = $this->humancapital_model->employee_shift_approve($param2, $param3);
                if ($employee == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
            if ($param1 == 'update_decline') {
                $employee = $this->humancapital_model->employee_update_decline($param2, $param3);
                if ($employee == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
        }

        function get_employee($section_code) {
            $page_data['section_code'] = $section_code;
            $this->load->view('backend/humancapital/freelance_payroll_employee_select', $page_data);
        }

        function get_unit(){
            $section_code = $this->input->post('id',TRUE);
            $data = $this->humancapital_model->get_unit($section_code)->result();
            echo json_encode($data);
        }

        function get_branch(){
            $regional_code = $this->input->post('id',TRUE);
            $data = $this->humancapital_model->get_branch($regional_code)->result();
            echo json_encode($data);
        }

        function get_origin(){
            $branch_code = $this->input->post('id',TRUE);
            $data = $this->humancapital_model->get_origin($branch_code)->result();
            echo json_encode($data);
        }

        function get_zone(){
            $origin_code = $this->input->post('id',TRUE);
            $data = $this->humancapital_model->get_zone($origin_code)->result();
            echo json_encode($data);
        }

        function asset($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'create') {
                $asset = $this->humancapital_model->asset_add($param2);
                if ($asset == true) {
                    $this->session->set_flashdata('success', 'Data Added Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Add Data Failed');
                }
                $nik = $this->db->get_where('employee', array('nik'=>$param2))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if($param1 == 'update') {
                $asset = $this->humancapital_model->asset_edit($param2);
                if ($asset == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $nik = $this->db->get_where('employee',array('nik'=>$param3))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if($param1 == 'delete') {
                $asset = $this->humancapital_model->asset_delete($param2);
                if ($asset == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $nik = $this->db->get_where('employee',array('nik'=>$param3))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if ($param1 == 'update_asset_create') {
                $page_data['page_name']  = 'employee_update_asset_create';
                $page_data['update_id']  = $param2;
                $page_data['page_title'] = 'Request Create Data Asset';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_asset_edit') {
                $page_data['page_name']  = 'employee_update_asset_edit';
                $page_data['update_id']  = $param2;
                $page_data['page_title'] = 'Request Update Data Asset';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_asset_delete') {
                $page_data['page_name']  = 'employee_update_asset_delete';
                $page_data['update_id']  = $param2;
                $page_data['page_title'] = 'Request Delete Data Asset';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_asset_create_approve') {
                $asset = $this->humancapital_model->asset_create_approve($param2, $param3);
                if ($asset == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
            if ($param1 == 'update_asset_edit_approve') {
                $asset = $this->humancapital_model->asset_edit_approve($param2, $param3);
                if ($asset == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
            if ($param1 == 'update_asset_delete_approve') {
                $asset = $this->humancapital_model->asset_delete_approve($param2, $param3);
                if ($asset == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
            // if ($param1 == 'update_asset_create_decline') {
            //     $asset = $this->humancapital_model->asset_create_decline($param2, $param3);
            //     if ($asset == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('humancapital/employee/update_list'));
            // }
            // if ($param1 == 'update_asset_edit_decline') {
            //     $asset = $this->humancapital_model->asset_edit_decline($param2, $param3);
            //     if ($asset == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('humancapital/employee/update_list'));
            // }
            // if ($param1 == 'update_asset_delete_decline') {
            //     $asset = $this->humancapital_model->asset_delete_decline($param2, $param3);
            //     if ($asset == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('humancapital/employee/update_list'));
            // }
        }

        // ------------- SPK ------------- //

        function spk($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'create') {
                $spk = $this->humancapital_model->spk_add($param2);
                if ($spk == true) {
                    $this->session->set_flashdata('success', 'Data Added Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Add Data Failed');
                }
                $nik = $this->db->get_where('employee', array('nik'=>$param2))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if($param1 == 'update') {
                $spk = $this->humancapital_model->spk_edit($param2, $param3);
                if ($spk == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $nik = $this->db->get_where('employee',array('nik'=>$param3))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if($param1 == 'delete') {
                $spk = $this->humancapital_model->spk_delete($param2);
                if ($spk == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $nik = $this->db->get_where('employee',array('nik'=>$param3))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if ($param1 == 'print_freelance') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Freelance';
                $this->load->view('backend/humancapital/spk_print_freelance', $page_data);
            }
            if ($param1 == 'print_pkwt') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK PKWT';
                $this->load->view('backend/humancapital/spk_print_pkwt', $page_data);
            }
            if ($param1 == 'print_mitra') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Mitra';
                $this->load->view('backend/humancapital/spk_print_mitra', $page_data);
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'create') {
                $teguran = $this->humancapital_model->teguran_add();
                if ($teguran == true) {
                    $this->session->set_flashdata('success', 'Data Added Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Add Data Failed');
                }
                redirect(site_url('humancapital/teguran/list'),'refresh');
            }
            if($param1 == 'update') {
                $teguran = $this->humancapital_model->teguran_edit($param2);
                if ($teguran == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/teguran/list'),'refresh');
            }
            if($param1 == 'delete') {
                $teguran = $this->humancapital_model->teguran_delete($param2);
                if ($teguran == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/teguran/list'),'refresh');
            }
            if ($param1 == 'print') {
                $page_data['teguran_id']     = $param2;
                $page_data['nik']            = $param3;
                $page_data['page_title']     = 'Surat Teguran';
                $this->load->view('backend/humancapital/teguran_print', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['page_name']  = 'teguran';
                $page_data['page_title'] = 'Surat Teguran';
                $this->load->view('backend/index', $page_data);
            }
        }

        // ------------- PANGGILAN ------------- //

        function panggilan($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'create') {
                $panggilan = $this->humancapital_model->panggilan_add();
                if ($panggilan == true) {
                    $this->session->set_flashdata('success', 'Data Added Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Add Data Failed');
                }
                redirect(site_url('humancapital/panggilan/list'),'refresh');
            }
            if($param1 == 'update') {
                $panggilan = $this->humancapital_model->panggilan_edit($param2);
                if ($panggilan == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/panggilan/list'),'refresh');
            }
            if($param1 == 'delete') {
                $panggilan = $this->humancapital_model->panggilan_delete($param2);
                if ($panggilan == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/panggilan/list'),'refresh');
            }
            if ($param1 == 'result') {
                $panggilan = $this->humancapital_model->panggilan_result($param2);
                if ($panggilan == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/panggilan/list/'));
            }
            if ($param1 == 'print') {
                $page_data['panggilan_id']  = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'Surat Panggilan';
                $this->load->view('backend/humancapital/panggilan_print', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'panggilan';
                $page_data['page_title'] = 'Surat Panggilan';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- PA -------------- //

        function pa($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'create') {
                $pa = $this->humancapital_model->pa_add($param2);
                if ($pa == true) {
                    $this->session->set_flashdata('success', 'Data Added Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Add Data Failed');
                }
                $nik = $this->db->get_where('employee', array('nik'=>$param2))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if($param1 == 'update') {
                $pa = $this->humancapital_model->pa_edit($param2);
                if ($pa == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $nik = $this->db->get_where('employee',array('nik'=>$param3))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if($param1 == 'delete') {
                $pa = $this->humancapital_model->pa_delete($param2);
                if ($pa == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $nik = $this->db->get_where('employee',array('nik'=>$param3))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
        }


        // ------------- FAMILY -------------- //

        function family($param1 = '', $param2 = '', $param3 = ''){
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'create') {
                $family = $this->humancapital_model->family_add($param2);
                if ($family == true) {
                    $this->session->set_flashdata('success', 'Data Added Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Add Data Failed');
                }
                $nik = $this->db->get_where('employee', array('nik'=>$param2))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if($param1 == 'update') {
                $family = $this->humancapital_model->family_edit($param2);
                if ($family == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $nik = $this->db->get_where('employee',array('nik'=>$param3))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if($param1 == 'delete') {
                $family = $this->humancapital_model->family_delete($param2);
                if ($family == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $nik = $this->db->get_where('employee',array('nik'=>$param3))->row()->nik;
                redirect(site_url('humancapital/employee/edit/'. $nik),'refresh');
            }
            if ($param1 == 'update_family_create') {
                $page_data['page_name'] = 'employee_update_family_create';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Create Data Family';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_family_edit') {
                $page_data['page_name'] = 'employee_update_family_edit';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Update Data Family';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_family_delete') {
                $page_data['page_name'] = 'employee_update_family_delete';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Delete Data Family';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_family_create_approve') {
                $family = $this->humancapital_model->family_create_approve($param2, $param3);
                if ($family == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
            if ($param1 == 'update_family_edit_approve') {
                $family = $this->humancapital_model->family_edit_approve($param2, $param3);
                if ($family == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
            if ($param1 == 'update_family_delete_approve') {
                $family = $this->humancapital_model->family_delete_approve($param2, $param3);
                if ($family == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
            // if ($param1 == 'update_family_create_decline') {
            //     $family = $this->humancapital_model->family_create_decline($param2, $param3);
            //     if ($family == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('humancapital/employee/update_list'));
            // }
            // if ($param1 == 'update_family_edit_decline') {
            //     $family = $this->humancapital_model->family_edit_decline($param2, $param3);
            //     if ($family == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('humancapital/employee/update_list'));
            // }
            // if ($param1 == 'update_family_delete_decline') {
            //     $family = $this->humancapital_model->family_delete_decline($param2, $param3);
            //     if ($family == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('humancapital/employee/update_list'));
            // }
        }

        function file($param1 = '', $param2 = '', $param3 = ''){
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'upload'){
                if($_FILES['file_ktp']['name'] != '' || $_FILES['file_sim']['name'] != '' || $_FILES['file_kk']['name'] != '' || $_FILES['file_ijazah']['name'] != '' || $_FILES['file_transkrip']['name'] != '' || $_FILES['file_cv']['name'] != '' || $_FILES['file_other']['name'] != '') {
                    $data['nik'] = $param2;

                    if($_FILES['file_ktp']['name'] != '')
                        $data['file_ktp'] = $param2 . '_KTP.' . pathinfo($_FILES['file_ktp']['name'])['extension'];
                    if($_FILES['file_sim']['name'] != '')
                        $data['file_sim'] = $param2 . '_SIM.' . pathinfo($_FILES['file_sim']['name'])['extension'];
                    if($_FILES['file_kk']['name'] != '')
                        $data['file_kk'] = $param2 . '_KK.' . pathinfo($_FILES['file_kk']['name'])['extension'];
                    if($_FILES['file_ijazah']['name'] != '')
                        $data['file_ijazah'] = $param2 . '_IJAZAH.' . pathinfo($_FILES['file_ijazah']['name'])['extension'];
                    if($_FILES['file_transkrip']['name'] != '')
                        $data['file_transkrip'] = $param2 . '_TRANSKRIP.' . pathinfo($_FILES['file_transkrip']['name'])['extension'];
                    if($_FILES['file_cv']['name'] != '')
                        $data['file_cv'] = $param2 . '_CV.' . pathinfo($_FILES['file_cv']['name'])['extension'];
                    if($_FILES['file_other']['name'] != '')
                        $data['file_other'] = $param2 . '_OTHER.' . pathinfo($_FILES['file_other']['name'])['extension'];

                    $this->db->where('nik',$param2);
                    $this->db->update('file',$data);

                    if($_FILES['file_ktp']['name'] != '')
                        move_uploaded_file($_FILES['file_ktp']['tmp_name'], 'uploads/file/ktp/' . $data['file_ktp']);
                    if($_FILES['file_sim']['name'] != '')
                        move_uploaded_file($_FILES['file_sim']['tmp_name'], 'uploads/file/sim/' . $data['file_sim']);
                    if($_FILES['file_kk']['name'] != '')
                        move_uploaded_file($_FILES['file_kk']['tmp_name'], 'uploads/file/kk/' . $data['file_kk']);
                    if($_FILES['file_ijazah']['name'] != '')
                        move_uploaded_file($_FILES['file_ijazah']['tmp_name'], 'uploads/file/ijazah/' . $data['file_ijazah']);
                    if($_FILES['file_transkrip']['name'] != '')
                        move_uploaded_file($_FILES['file_transkrip']['tmp_name'], 'uploads/file/transkrip/' . $data['file_transkrip']);
                    if($_FILES['file_cv']['name'] != '')
                        move_uploaded_file($_FILES['file_cv']['tmp_name'], 'uploads/file/cv/' . $data['file_cv']);
                    if($_FILES['file_other']['name'] != '')
                        move_uploaded_file($_FILES['file_other']['tmp_name'], 'uploads/file/other/' . $data['file_other']);

                    $this->session->set_flashdata('success', 'Data Uploaded Successfully');
                    redirect(site_url('humancapital/employee/edit/'.$param2));
                }
            }

            if($param1 == 'upload_edit'){
                if($_FILES['file_ktp']['name'] != '' || $_FILES['file_kk']['name'] != '' || $_FILES['file_ijazah']['name'] != '' || $_FILES['file_transkrip']['name'] != '' || $_FILES['file_cv']['name'] != '' || $_FILES['file_other']['name'] != '') {
                    $data['nik'] = $param2;

                    if($_FILES['file_ktp']['name'] != '')
                        $data['file_ktp'] = $param2 . '_KTP.' . pathinfo($_FILES['file_ktp']['name'])['extension'];
                    if($_FILES['file_sim']['name'] != '')
                        $data['file_sim'] = $param2 . '_SIM.' . pathinfo($_FILES['file_sim']['name'])['extension'];
                    if($_FILES['file_kk']['name'] != '')
                        $data['file_kk'] = $param2 . '_KK.' . pathinfo($_FILES['file_kk']['name'])['extension'];
                    if($_FILES['file_ijazah']['name'] != '')
                        $data['file_ijazah'] = $param2 . '_IJAZAH.' . pathinfo($_FILES['file_ijazah']['name'])['extension'];
                    if($_FILES['file_transkrip']['name'] != '')
                        $data['file_transkrip'] = $param2 . '_TRANSKRIP.' . pathinfo($_FILES['file_transkrip']['name'])['extension'];
                    if($_FILES['file_cv']['name'] != '')
                        $data['file_cv'] = $param2 . '_CV.' . pathinfo($_FILES['file_cv']['name'])['extension'];
                    if($_FILES['file_other']['name'] != '')
                        $data['file_other'] = $param2 . '_OTHER.' . pathinfo($_FILES['file_other']['name'])['extension'];

                    $this->db->insert('file', $data);                    

                    if($_FILES['file_ktp']['name'] != '')
                        move_uploaded_file($_FILES['file_ktp']['tmp_name'], 'uploads/file/ktp/' . $data['file_ktp']);
                    if($_FILES['file_sim']['name'] != '')
                        move_uploaded_file($_FILES['file_sim']['tmp_name'], 'uploads/file/sim/' . $data['file_sim']);
                    if($_FILES['file_kk']['name'] != '')
                        move_uploaded_file($_FILES['file_kk']['tmp_name'], 'uploads/file/kk/' . $data['file_kk']);
                    if($_FILES['file_ijazah']['name'] != '')
                        move_uploaded_file($_FILES['file_ijazah']['tmp_name'], 'uploads/file/ijazah/' . $data['file_ijazah']);
                    if($_FILES['file_transkrip']['name'] != '')
                        move_uploaded_file($_FILES['file_transkrip']['tmp_name'], 'uploads/file/transkrip/' . $data['file_transkrip']);
                    if($_FILES['file_cv']['name'] != '')
                        move_uploaded_file($_FILES['file_cv']['tmp_name'], 'uploads/file/cv/' . $data['file_cv']);
                    if($_FILES['file_other']['name'] != '')
                        move_uploaded_file($_FILES['file_other']['tmp_name'], 'uploads/file/other/' . $data['file_other']);

                    $this->session->set_flashdata('success', 'Data Uploaded Successfully');
                    redirect(site_url('humancapital/employee/edit/'.$param2));
                }
            }

            if ($param1 == 'update_file') {
                $page_data['page_name'] = 'employee_update_file';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Update File';
                $this->load->view('backend/index', $page_data);
            }

            if ($param1 == 'update_approve') {
                $file = $this->humancapital_model->file_update_approve($param2, $param3);
                if ($file == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/employee/update_list'));
            }
            // if ($param1 == 'update_decline') {
            //     $file = $this->humancapital_model->file_update_decline($param2, $param3);
            //     if ($file == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('humancapital/employee/update_list'));
            // }
        }


        // ------------- SECTION ------------- //

        function section($param1 = '', $param2 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $section = $this->humancapital_model->section_add();
                if ($section == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/section/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $section = $this->humancapital_model->section_edit($param2);
                if ($section == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/section/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $section = $this->humancapital_model->section_delete($param2);
                if ($section == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/section/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'section';
                $page_data['page_title'] = 'Department';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- UNIT ------------- //

        function unit($param1 = '', $param2 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $unit = $this->humancapital_model->unit_add();
                if ($unit == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/unit/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $unit = $this->humancapital_model->unit_edit($param2);
                if ($unit == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/unit/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $unit = $this->humancapital_model->unit_delete($param2);
                if ($unit == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/unit/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'unit';
                $page_data['page_title'] = 'Unit';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- REGIONAL ------------- //

        function regional($param1 = '', $param2 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
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
            if ($this->session->userdata('humancapital_login') != 1) {
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
            if ($this->session->userdata('humancapital_login') != 1) {
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
            if ($this->session->userdata('humancapital_login') != 1) {
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $vacancy = $this->humancapital_model->vacancy_add();
                if ($vacancy == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/vacancy/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $vacancy = $this->humancapital_model->vacancy_edit($param2);
                if ($vacancy == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/vacancy/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $vacancy = $this->humancapital_model->vacancy_delete($param2);
                if ($vacancy == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/vacancy/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'vacancy';
                $page_data['page_title'] = 'Vacancy';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'print') {
                $page_data['vacancy_id']    = $param2;
                $page_data['page_title']    = 'Job Posting';
                $this->load->view('backend/humancapital/vacancy_print', $page_data);
            }
            if ($param1 == 'print_qrcode') {
                $page_data['vacancy_id']    = $param2;
                $page_data['page_title']    = 'Job Posting';
                $this->load->view('backend/humancapital/vacancy_qrcode', $page_data);
            }
        }  


        // ------------- CANDIDATE ------------- //

        function candidate($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
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
                $this->load->view('backend/humancapital/candidate_profile_eksternal_print', $page_data);
            }
            if ($param1 == 'move_eksternal') {
                $page_data['page_name'] = 'candidate_move_eksternal';
                $page_data['candidate_ktp'] = $param2;
                $page_data['page_title'] = 'Add Employee';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'move_internal') {
                $page_data['page_name'] = 'candidate_move_internal';
                $page_data['nik'] = $param2;
                $page_data['page_title'] = 'Edit Employee';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'move_data_eksternal') {
                $candidate = $this->humancapital_model->candidate_move_eksternal($param2);
                if ($candidate == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/employee/list'));
            }
            if ($param1 == 'move_data_internal') {
                $candidate = $this->humancapital_model->candidate_move_internal($param2);
                if ($candidate == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/employee/list'));
            }
        }


        // ------------- APPLICATION ------------- //

        function application($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'change_status_applied_eksternal') {
                $application = $this->humancapital_model->application_applied($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_eksternal/'.$param2));
            }
            if ($param1 == 'change_status_onreview_eksternal') {
                $application = $this->humancapital_model->application_onreview($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_eksternal/'.$param2));
            }
            if ($param1 == 'change_status_psikotest_eksternal') {
                $application = $this->humancapital_model->application_psikotest($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_eksternal/'.$param2));
            }
            if ($param1 == 'change_status_interview_eksternal') {
                $application = $this->humancapital_model->application_interview($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_eksternal/'.$param2));
            }
            if ($param1 == 'change_status_hired_eksternal') {
                $application = $this->humancapital_model->application_hired($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_eksternal/'.$param2));
            }
            if ($param1 == 'change_status_declined_eksternal') {
                $application = $this->humancapital_model->application_declined($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_eksternal/'.$param2));
            }

            if ($param1 == 'change_status_applied_internal') {
                $application = $this->humancapital_model->application_applied($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_internal/'.$param2));
            }
            if ($param1 == 'change_status_onreview_internal') {
                $application = $this->humancapital_model->application_onreview($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_internal/'.$param2));
            }
            if ($param1 == 'change_status_psikotest_internal') {
                $application = $this->humancapital_model->application_psikotest($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_internal/'.$param2));
            }
            if ($param1 == 'change_status_interview_internal') {
                $application = $this->humancapital_model->application_interview($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_internal/'.$param2));
            }
            if ($param1 == 'change_status_hired_internal') {
                $application = $this->humancapital_model->application_hired($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_internal/'.$param2));
            }
            if ($param1 == 'change_status_declined_internal') {
                $application = $this->humancapital_model->application_declined($param2);
                if ($application == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/candidate/profile_internal/'.$param2));
            }
        }


        // ------------- SCHEDULE ------------- //

        function recruitment_schedule($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $schedule = $this->humancapital_model->schedule_add();
                if ($schedule == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/recruitment_schedule/list'));
            }
            if ($param1 == 'update') {
                $schedule = $this->humancapital_model->schedule_edit($param2);
                if ($schedule == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/recruitment_schedule/list'));
            }
            if ($param1 == 'delete') {
                $schedule = $this->humancapital_model->schedule_delete($param2);
                if ($schedule == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/recruitment_schedule/list'));
            }
            if ($param1 == 'delete_candidate') {
                $schedule = $this->humancapital_model->schedule_delete_candidate($param2);
                if ($schedule == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/recruitment_schedule/list'));
            }
            if ($param1 == 'list') {
                $page_data['page_name']  = 'candidate_schedule';
                $page_data['page_title'] = 'Recruitment Schedule';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'print_eksternal') {
                $page_data['schedule_id']   = $param2;
                $page_data['page_title']    = 'Recruitment Attendance';
                $this->load->view('backend/humancapital/candidate_schedule_list_eksternal_print', $page_data);
            }
            if ($param1 == 'print_internal') {
                $page_data['schedule_id']   = $param2;
                $page_data['page_title']    = 'Recruitment Attendance';
                $this->load->view('backend/humancapital/candidate_schedule_list_internal_print', $page_data);
            }
        }


        // // ------------- MPP ------------- //
        
        // function mpp($param1 = '', $param2 = '') {
        //     if ($this->session->userdata('humancapital_login') != 1) {
        //         $this->session->set_userdata('last_page', current_url());
        //         redirect(site_url('login'),'refresh');
        //     }
        //     if ($param1 == 'change_status_approve') {
        //         $mpp = $this->humancapital_model->mpp_approve($param2);
        //         if ($mpp == true) {
        //             $this->session->set_flashdata('success', 'Data Updated Successfully');
        //         } else {
        //             $this->session->set_flashdata('error', 'Update Data Failed');
        //         }
        //         redirect(site_url('humancapital/mpp/list/'));
        //     }
        //     if ($param1 == 'change_status_decline') {
        //         $mpp = $this->humancapital_model->mpp_decline($param2);
        //         if ($mpp == true) {
        //             $this->session->set_flashdata('success', 'Data Updated Successfully');
        //         } else {
        //             $this->session->set_flashdata('error', 'Update Data Failed');
        //         }
        //         redirect(site_url('humancapital/mpp/list/'));
        //     }
        //     if ($param1 == 'list') {
        //         $page_data['page_name'] = 'mpp';
        //         $page_data['page_title'] = 'Man Power Planning';
        //         $this->load->view('backend/index', $page_data);
        //     }
        // } 


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
            redirect(site_url('humancapital/freelance_attendance_report_view/') .$data['section_code'] . '/' . $data['year'] . '/' . $data['month'], 'refresh');
        }

        function freelance_attendance_report_view($section_code = '', $year = '', $month = '') {
            if ($this->session->userdata('humancapital_login') != 1)
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
            if ($this->session->userdata('humancapital_login') != 1)
                redirect(site_url('login'), 'refresh');

            $page_data['fpayroll_id']  = $fpayroll_id;
            $page_data['page_title']   = 'Freelance Payslip';
            
            $this->load->view('backend/humancapital/freelance_payslip_details_print', $page_data);
        }


        // ------- LOAN ------- //
        
        function loan($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            // if ($param1 == 'change_status_approved') {
            //     $loan = $this->humancapital_model->loan_approved($param2, $param3);
            //     if ($loan == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('humancapital/loan/list/'));
            // }
            // if ($param1 == 'change_status_declined') {
            //     $loan = $this->humancapital_model->loan_declined($param2);
            //     if ($loan == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('humancapital/loan/list/'));
            // }
            if ($param1 == 'update') {
                $loan = $this->humancapital_model->loan_edit($param2, $param3);
                if ($loan == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Tanggal Realisasi harus diisi');
                }
                redirect(site_url('humancapital/loan/list/'));
            }
            if ($param1 == 'quota') {
                $loan = $this->humancapital_model->loan_quota($param2);
                if ($loan == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/loan/list/'));
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
            if ($param1 == 'print') {
                $page_data['loan_id']      = $param2;
                $page_data['page_title']    = 'Form Peminjaman';
                $this->load->view('backend/humancapital/loan_print', $page_data);
            }
        }


        // ------- RESIGN ------- //
        
        function resign($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
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
            if ($param1 == 'change_status_approved') {
                $resign = $this->humancapital_model->resign_approved($param2, $param3);
                if ($resign == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/resign/list/'));
            }
            if ($param1 == 'change_status_declined') {
                $resign = $this->humancapital_model->resign_declined($param2);
                if ($resign == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/resign/list/'));
            }
            if ($param1 == 'change_status_paid') {
                $resign = $this->humancapital_model->resign_paid($param2, $param3);
                if ($resign == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/resign/list/'));
            }
            if ($param1 == 'asset_update') {
                $resign = $this->humancapital_model->resignasset_update($param2);
                if ($resign == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/resign/list/'));
            }
        }


        // ------------- PLAFON ------------- //
        
        function plafon($param1 = '', $param2 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $plafon = $this->humancapital_model->plafon_add();
                if ($plafon == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/plafon/list'));
            }
            if ($param1 == 'update') {
                $plafon = $this->humancapital_model->plafon_edit($param2);
                if ($plafon == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/plafon/list'));
            }
            if ($param1 == 'delete') {
                $plafon = $this->humancapital_model->plafon_delete($param2);
                if ($plafon == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/plafon/list'));
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
                $page_data['searchmethod']    = NULL;
                $page_data['search']          = NULL;
                $page_data['plafon_periode']  = date('Y');
                $page_data['page_name']       = 'plafon';
                $page_data['page_title']      = 'Plafon';
                $this->load->view('backend/index', $page_data);
            }
        } 

        // public function upload(){
        //     // Load plugin PHPExcel nya
        //     include realpath('assets/PHPExcel/PHPExcel.php');

        //     $config['upload_path'] = realpath('excel');
        //     $config['allowed_types'] = 'xlsx|xls|csv';
        //     $config['max_size'] = '10000';
        //     $config['encrypt_name'] = true;

        //     $this->load->library('upload', $config);

        //     if (!$this->upload->do_upload()) {

        //         //upload gagal
        //         $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
        //         //redirect halaman
        //         redirect('import/');

        //     } else {

        //         $data_upload = $this->upload->data();

        //         $excelreader     = new PHPExcel_Reader_Excel2007();
        //         $loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
        //         $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

        //         $data = array();

        //         $numrow = 1;
        //         foreach($sheet as $row){
        //                         if($numrow > 1){
        //                             array_push($data, array(
        //                                 'plafon_rawatinap' => $row['A'],
        //                                 'plafon_rawatjalan'      => $row['B'],
        //                                 'plafon_melahirkannormal'      => $row['C'],
        //                                 'plafon_melahirkansectio'      => $row['D'],
        //                                 'plafon_setkacamata'      => $row['E'],
        //                                 'plafon_lensa'      => $row['F'],
        //                                 'plafon_periode'      => $row['G'],
        //                                 'nik'      => $row['H'],
        //                             ));
        //                 }
        //             $numrow++;
        //         }
        //         $this->db->insert_batch('plafon', $data);
        //         //delete file from server
        //         unlink(realpath('excel/'.$data_upload['file_name']));

        //         //upload success
        //         $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
        //         //redirect halaman
        //         redirect('import/');

        //     }
        // }

        function upload_plafon(){

            $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            
            if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
            
                $arr_file = explode('.', $_FILES['berkas_excel']['name']);
                $extension = end($arr_file);
            
                if('csv' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
            
                $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
                
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                for($i = 1;$i < count($sheetData);$i++) {
                    $data['plafon_rawatinap']        = $sheetData[$i]['0'];
                    $data['plafon_rawatjalan']       = $sheetData[$i]['1'];
                    $data['plafon_melahirkannormal'] = $sheetData[$i]['2'];
                    $data['plafon_melahirkansectio'] = $sheetData[$i]['3'];
                    $data['plafon_setkacamata']      = $sheetData[$i]['4'];
                    $data['plafon_lensa']            = $sheetData[$i]['5'];
                    $data['plafon_periode']          = $sheetData[$i]['6'];
                    $data['nik']                     = $sheetData[$i]['7'];
                    $data['createdate']              = date('Y-m-d H:i:s');
                    $data['createby']                = $this->session->userdata('login_nik');
                    
                    if($this->db->get_where('plafon', array('plafon_periode' => $data['plafon_periode'], 'nik' => $data['nik']))->num_rows() == 0){
                        $this->db->insert('plafon', $data);
                    }
                }
                redirect(site_url('humancapital/plafon/list'));
            }
        }


        // ------------- RAWAT INAP ------------- //
        
        function rawatinap($param1 = '', $param2 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'update') {
                $rawatinap = $this->humancapital_model->rawatinap_update($param2);
                if ($rawatinap == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/rawatinap/list/'));
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'update') {
                $rawatjalan = $this->humancapital_model->rawatjalan_update($param2);
                if ($rawatjalan == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/rawatjalan/list/'));
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'update') {
                $melahirkan = $this->humancapital_model->melahirkan_update($param2);
                if ($melahirkan == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/melahirkan/list/'));
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'update') {
                $kacamata = $this->humancapital_model->kacamata_update($param2);
                if ($kacamata == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/kacamata/list/'));
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


        // ------------- ROTATION ------------- //

        function rotation() {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }

            $page_data['page_name'] = 'rotation';
            $page_data['page_title'] = 'Rotation';
            $this->load->view('backend/index', $page_data);
        }


        // ------------- UNIFORM ------------- //

        function uniform($param1 = '', $param2 = '', $param3 = '', $param4 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'in') {
                $uniform = $this->humancapital_model->uniform_in();
                if ($uniform == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/uniform/list'), 'refresh');
            }
            if ($param1 == 'out') {
                $uniform = $this->humancapital_model->uniform_out();
                if ($uniform == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/uniform/list'), 'refresh');
            }
            if ($param1 == 'create') {
                $uniform = $this->humancapital_model->uniform_add();
                if ($uniform == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/uniform/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $uniform = $this->humancapital_model->uniform_edit($param2);
                if ($uniform == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $this->session->set_flashdata('success', 'Data Updated Successfully');
                redirect(site_url('humancapital/uniform/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $uniform = $this->humancapital_model->uniform_delete($param2);
                if ($uniform == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $this->session->set_flashdata('success', 'Data Deleted Successfully');
                redirect(site_url('humancapital/uniform/list'), 'refresh');
            }
            if ($param1 == 'change_status_approve') {
                $uniform = $this->humancapital_model->uniform_approve($param2, $param3, $param4);
                if ($uniform == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/uniform/list/'));
            }
            if ($param1 == 'change_status_decline') {
                $uniform = $this->humancapital_model->uniform_decline($param2);
                if ($uniform == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/uniform/request/'));
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'uniform';
                $page_data['page_title'] = 'Uniform';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'request') {
                $page_data['page_name'] = 'uniform_request';
                $page_data['page_title'] = 'Uniform Request';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- CLASS ------------- //

        function class($param1 = '', $param2 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $class = $this->humancapital_model->class_add();
                if ($class == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/class/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $class = $this->humancapital_model->class_edit($param2);
                if ($class == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/class/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $class = $this->humancapital_model->class_delete($param2);
                if ($class == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/class/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'elearning_class_list';
                $page_data['page_title'] = 'E-Learning';
                $this->load->view('backend/index', $page_data);
            }
        }

        function delete_student($student_id = '')
        {
            $this->db->where('student_id', $student_id);
            $this->db->delete('elearning_student');

            echo 'success';
        }


        // ------------- MATERI ------------- //

        function materi($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $materi = $this->humancapital_model->materi_add($param2);
                if ($materi == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                $class_id = $this->db->get_where('elearning_class', array('class_id'=>$param2))->row()->class_id;
                redirect(site_url('humancapital/materi/list/'. $class_id),'refresh');
            }
            if ($param1 == 'update') {
                $materi = $this->humancapital_model->materi_edit($param2);
                if ($materi == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $class_id = $this->db->get_where('elearning_class', array('class_id'=>$param3))->row()->class_id;
                redirect(site_url('humancapital/materi/list/'. $class_id),'refresh');
            }
            if ($param1 == 'delete') {
                $materi = $this->humancapital_model->materi_delete($param2);
                if ($materi == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $class_id = $this->db->get_where('elearning_class', array('class_id'=>$param3))->row()->class_id;
                redirect(site_url('humancapital/materi/list/'. $class_id),'refresh');
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'delete') {
                $student = $this->humancapital_model->student_delete($param2);
                if ($student == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $class_id = $this->db->get_where('elearning_class', array('class_id'=>$param3))->row()->class_id;
                redirect(site_url('humancapital/student/list/'. $class_id),'refresh');
            }
            if ($param1 == 'done') {
                $student = $this->humancapital_model->student_done($param2);
                if ($student == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $class_id = $this->db->get_where('elearning_class', array('class_id'=>$param3))->row()->class_id;
                redirect(site_url('humancapital/student/list/'. $class_id),'refresh');
            }
            if ($param1 == 'change_status_approved') {
                $student = $this->humancapital_model->student_approve($param2);
                if ($student == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $class_id = $this->db->get_where('elearning_class', array('class_id'=>$param3))->row()->class_id;
                redirect(site_url('humancapital/student/list/'. $class_id),'refresh');
            }
            if ($param1 == 'change_status_declined') {
                $student = $this->humancapital_model->student_decline($param2);
                if ($student == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $class_id = $this->db->get_where('elearning_class', array('class_id'=>$param3))->row()->class_id;
                redirect(site_url('humancapital/student/list/'. $class_id),'refresh');
            }
            if ($param1 == 'change_status_pending') {
                $student = $this->humancapital_model->student_pending($param2);
                if ($student == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $class_id = $this->db->get_where('elearning_class', array('class_id'=>$param3))->row()->class_id;
                redirect(site_url('humancapital/student/list/'. $class_id),'refresh');
            }
            if ($param1 == 'list') {
                $class_name = $this->db->get_where('elearning_class', array('class_id' => $param2))->row()->class_name;
                $page_data['class_id'] = $param2;
                $page_data['page_name'] = 'elearning_student';
                $page_data['page_title'] = $class_name . ' Student';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'listrequest') {
                $class_name = $this->db->get_where('elearning_class', array('class_id' => $param2))->row()->class_name;
                $page_data['class_id'] = $param2;
                $page_data['page_name'] = 'elearning_studentrequest';
                $page_data['page_title'] = $class_name . ' Student';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- EXAM ------------- //

        function exam($param1 = '', $param2 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $exam = $this->humancapital_model->exam_add();
                if ($exam == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/exam/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $exam = $this->humancapital_model->exam_edit($param2);
                if ($exam == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/exam/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $exam = $this->humancapital_model->exam_delete($param2);
                if ($exam == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/exam/list'), 'refresh');
            }
            if ($param1 == 'reset_token') {
                $exam = $this->humancapital_model->reset_token($param2);
                if ($exam == true) {
                    $this->session->set_flashdata('success', 'Token Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Token Failed');
                }
                redirect(site_url('humancapital/exam/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'cbt_exam';
                $page_data['page_title'] = 'Online Test';
                $this->load->view('backend/index', $page_data);
            }
        }
        // function delete_participants($participants_id = '')
        // {
        //     $this->db->where('participants_id', $participants_id);
        //     $this->db->delete('cbt_participants');

        //     echo 'success';
        // }


        // ------------- QUESTION PACK ------------- //

        function questionpack($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $questionpack = $this->humancapital_model->questionpack_add();
                if ($questionpack == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/questionpack/list'),'refresh');
            }
            if ($param1 == 'update') {
                $questionpack = $this->humancapital_model->questionpack_edit($param2);
                if ($questionpack == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/questionpack/list'),'refresh');
            }
            if ($param1 == 'delete') {
                $questionpack = $this->humancapital_model->questionpack_delete($param2);
                if ($questionpack == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/questionpack/list'),'refresh');
            }
            if ($param1 == 'requestapproval') {
                $questionpack = $this->humancapital_model->questionpack_requestapproval($param2);
                if ($questionpack == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/questionpack/list'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'cbt_questionpack';
                $page_data['page_title'] = 'Question Package';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- QUESTION ------------- //

        function question($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $question = $this->humancapital_model->question_add($param2);
                if ($question == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                $questionpack_id = $this->db->get_where('cbt_questionpack', array('questionpack_id'=>$param2))->row()->questionpack_id;
                redirect(site_url('humancapital/question/list/'. $questionpack_id),'refresh');
            }
            if ($param1 == 'update') {
                $question = $this->humancapital_model->question_edit($param2);
                if ($question == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $questionpack_id = $this->db->get_where('cbt_questionpack', array('questionpack_id'=>$param3))->row()->questionpack_id;
                redirect(site_url('humancapital/question/list/'. $questionpack_id),'refresh');
            }
            if ($param1 == 'delete') {
                $question = $this->humancapital_model->question_delete($param2);
                if ($question == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $questionpack_id = $this->db->get_where('cbt_questionpack', array('questionpack_id'=>$param3))->row()->questionpack_id;
                redirect(site_url('humancapital/question/list/'. $questionpack_id),'refresh');
            }
            if ($param1 == 'createessay') {
                $question = $this->humancapital_model->question_addessay($param2);
                if ($question == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                $questionpack_id = $this->db->get_where('cbt_questionpack', array('questionpack_id'=>$param2))->row()->questionpack_id;
                redirect(site_url('humancapital/question/list/'. $questionpack_id),'refresh');
            }
            if ($param1 == 'updateessay') {
                $question = $this->humancapital_model->question_editessay($param2);
                if ($question == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $questionpack_id = $this->db->get_where('cbt_questionpack', array('questionpack_id'=>$param3))->row()->questionpack_id;
                redirect(site_url('humancapital/question/list/'. $questionpack_id),'refresh');
            }
            if ($param1 == 'deleteessay') {
                $question = $this->humancapital_model->question_deleteessay($param2);
                if ($question == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $questionpack_id = $this->db->get_where('cbt_questionpack', array('questionpack_id'=>$param3))->row()->questionpack_id;
                redirect(site_url('humancapital/question/list/'. $questionpack_id),'refresh');
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $participants = $this->humancapital_model->participants_add($param2);
                if ($participants == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                $exam_id = $this->db->get_where('cbt_exam', array('exam_id' => $param2))->row()->exam_id;
                redirect(site_url('humancapital/participants/list/' . $exam_id),'refresh');
            }
            if ($param1 == 'delete') {
                $participants = $this->humancapital_model->participants_delete($param2);
                if ($participants == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $exam_id = $this->db->get_where('cbt_exam', array('exam_id' => $param3))->row()->exam_id;
                redirect(site_url('humancapital/participants/list/' . $exam_id),'refresh');
            }
            if ($param1 == 'list') {
                $exam_name = $this->db->get_where('cbt_exam', array('exam_id' => $param2))->row()->exam_name;

                $page_data['page_name'] = 'cbt_participants';
                $page_data['exam_id'] = $param2;
                $page_data['page_title'] = 'Participants of ' . $exam_name;
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- REVIEW ESSAY ------------- //

        function essay($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $exam_name = $this->db->get_where('cbt_exam', array('exam_id' => $param2))->row()->exam_name;

                $page_data['page_name']          = 'cbt_essay';
                $page_data['exam_id']            = $param2;
                $page_data['questionpack_id']    = $param3;
                $page_data['page_title']         = 'Essay Question List of ' . $exam_name;
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'answerlist') {
                $question_question = $this->db->get_where('cbt_question', array('question_id' => $param2));

                $page_data['page_name']          = 'cbt_essayanswer';
                $page_data['question_id']        = $param2;
                $page_data['exam_id']            = $param3;
                $page_data['questionpack_id']    = $param4;
                $page_data['page_title']         = $question_question->row()->question_question . ' (Bobot ' . $question_question->row()->question_bobot . ')';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'submit') {
                $essay = $this->humancapital_model->essay_submit($param2);
                if ($essay == true) {
                    $this->session->set_flashdata('success', 'Berhasil dinilai');
                } else {
                    $this->session->set_flashdata('error', 'Gagal dinilai');
                }
                redirect(site_url('humancapital/essay/answerlist/'. $param3 . '/' . $param4 . '/' . $param5),'refresh');
            }
        }


        // ------------- EGD E-ATTENDANCE ------------- //

        function egdattendance($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $egdattendance = $this->humancapital_model->egdattendance_add();
                if ($egdattendance == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/egdattendance/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $egdattendance = $this->humancapital_model->egdattendance_edit($param2);
                if ($egdattendance == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/egdattendance/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $egdattendance = $this->humancapital_model->egdattendance_delete($param2);
                if ($egdattendance == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/egdattendance/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'egdattendance';
                $page_data['page_title'] = 'E-Attendance';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'qrcode') {
                $page_data['egdattendance_token'] = $param2;
                $page_data['egdattendance_id']    = $param3;
                $page_data['page_title']          = 'EGD Attendance';
                $this->load->view('backend/humancapital/egdattendance_qrcode', $page_data);
            }
        }

        function egdparticipants($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'delete') {
                $egdparticipants = $this->humancapital_model->egdparticipants_delete($param2);
                if ($egdparticipants == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $egdattendance_id = $this->db->get_where('egd_attendance', array('egdattendance_id'=>$param3))->row()->egdattendance_id;
                redirect(site_url('humancapital/egdparticipants/list/'. $egdattendance_id),'refresh');
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $survey = $this->humancapital_model->survey_add();
                if ($survey == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/survey/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $survey = $this->humancapital_model->survey_edit($param2);
                if ($survey == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/survey/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $survey = $this->humancapital_model->survey_delete($param2);
                if ($survey == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/survey/list'), 'refresh');
            }
            if ($param1 == 'requestapproval') {
                $survey = $this->humancapital_model->survey_requestapproval($param2);
                if ($survey == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/survey/list'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'survey';
                $page_data['page_title'] = 'E-Survey';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- SURVEY QUESTION ------------- //

        function surveyquestion($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $surveyquestion = $this->humancapital_model->surveyquestion_add($param2);
                if ($surveyquestion == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                $survey_id = $this->db->get_where('survey', array('survey_id'=>$param2))->row()->survey_id;
                redirect(site_url('humancapital/surveyquestion/list/'. $survey_id),'refresh');
            }
            if ($param1 == 'update') {
                $surveyquestion = $this->humancapital_model->surveyquestion_edit($param2);
                if ($surveyquestion == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                $survey_id = $this->db->get_where('survey', array('survey_id'=>$param3))->row()->survey_id;
                redirect(site_url('humancapital/surveyquestion/list/'. $survey_id),'refresh');
            }
            if ($param1 == 'delete') {
                $surveyquestion = $this->humancapital_model->surveyquestion_delete($param2);
                if ($surveyquestion == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $survey_id = $this->db->get_where('survey', array('survey_id'=>$param3))->row()->survey_id;
                redirect(site_url('humancapital/surveyquestion/list/'. $survey_id),'refresh');
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'delete') {
                $responden = $this->humancapital_model->responden_delete($param2);
                if ($responden == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                $survey_id = $this->db->get_where('survey', array('survey_id'=>$param3))->row()->survey_id;
                redirect(site_url('humancapital/responds/list/'. $survey_id),'refresh');
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
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'update') {
                $umrah = $this->humancapital_model->umrah_edit($param2);
                if ($umrah == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/umrah/list'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'umrah';
                $page_data['page_title'] = 'Umrah Reward';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- MARQUEE ------------- //

        function marquee($param1 = '', $param2 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $marquee = $this->humancapital_model->marquee_add();
                if ($marquee == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('humancapital/marquee/list'), 'refresh');
            }
            if ($param1 == 'update') {
                $marquee = $this->humancapital_model->marquee_edit($param2);
                if ($marquee == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/marquee/list'), 'refresh');
            }
            if ($param1 == 'delete') {
                $marquee = $this->humancapital_model->marquee_delete($param2);
                if ($marquee == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('humancapital/marquee/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'marquee';
                $page_data['page_title'] = 'Running Text';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- SPEAKUP ------------- //

        function speakup($param1 = '', $param2 = '') {
            if ($this->session->userdata('humancapital_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'read') {
                $speakup = $this->humancapital_model->speakup_read($param2);
                if ($speakup == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('humancapital/speakup/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'speakup';
                $page_data['page_title'] = 'Speak Up Corner';
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
                redirect(site_url('humancapital/change_password'), 'refresh');
            }
            
            $page_data['page_name']     = 'change_password';
            $page_data['page_title']    = 'Change Password';
            $this->load->view('backend/index', $page_data);
        }
    }

?>