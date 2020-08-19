<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Employee extends CI_Controller {

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
            if ($this->session->userdata('employee_login') != 1)
                redirect(site_url('login'),'refresh');
    
            if ($this->session->userdata('employee_login') == 1)
                redirect(site_url('employee/dashboard'),'refresh');
                
            $this->load->view('backend/index');
        }
    
        function dashboard() {
            if ($this->session->userdata('employee_login') != 1) {
                redirect(site_url('login'),'refresh');
            }
    
            $page_data['page_name'] = 'dashboard';
            $page_data['page_title'] = 'Dashboard';
            $this->load->view('backend/index', $page_data);
        }


        // ------- PROFILE ------- //

        function profile($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'myprofile') {
                $page_data['page_name']     = 'employee_profile';
                $page_data['page_title']    = 'Profil';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'print') {
                $page_data['nik']           = $param2;
                $page_data['page_title']    = 'Profil Karyawan';
                $this->load->view('backend/employee/employee_profile_print', $page_data);
            }
            if ($param1 == 'edit') {
                $page_data['page_name']     = 'employee_edit';
                $page_data['nik']           = $param2;
                $page_data['page_title']    = 'Edit Karyawan';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update') {
                $employee = $this->employee_model->employee_edit($param2);
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
                $page_data['page_title']    = 'Request Update Data';
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
                $page_data['page_title'] = 'Request Update Data Shift';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------- ASSET ------- //

        function asset($param1 = '', $param2 = '', $param3 = ''){
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'create') {
                $asset = $this->employee_model->asset_add($param2);
                if ($asset == true) {
                    $this->session->set_flashdata('success', 'Data Added Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Add Data Failed');
                }
                redirect(site_url('employee/profile/update_list'));
            }
            if($param1 == 'update') {
                $asset = $this->employee_model->asset_edit($param2, $param3);
                if ($asset == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('employee/profile/update_list'));
            }
            if($param1 == 'delete') {
                $asset = $this->employee_model->asset_delete($param2, $param3);
                if ($asset == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('employee/profile/update_list'));
            }
            if ($param1 == 'update_asset_create') {
                $page_data['page_name'] = 'employee_update_asset_create';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Tambah Data Asset';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_asset_edit') {
                $page_data['page_name'] = 'employee_update_asset_edit';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Update Data Asset';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_asset_delete') {
                $page_data['page_name'] = 'employee_update_asset_delete';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Hapus Data Asset';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------- FAMILY ------- //

        function family($param1 = '', $param2 = '', $param3 = ''){
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if($param1 == 'create') {
                $family = $this->employee_model->family_add($param2);
                if ($family == true) {
                    $this->session->set_flashdata('success', 'Data Added Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Add Data Failed');
                }
                redirect(site_url('employee/profile/update_list'));
            }
            if($param1 == 'update') {
                $family = $this->employee_model->family_edit($param2, $param3);
                if ($family == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('employee/profile/update_list'));
            }
            if($param1 == 'delete') {
                $family = $this->employee_model->family_delete($param2, $param3);
                if ($family == true) {
                    $this->session->set_flashdata('success', 'Data Deleted Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Delete Data Failed');
                }
                redirect(site_url('employee/profile/update_list'));
            }
            if ($param1 == 'update_family_create') {
                $page_data['page_name'] = 'employee_update_family_create';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Tambah Data Keluarga';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_family_edit') {
                $page_data['page_name'] = 'employee_update_family_edit';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Update Data Keluarga';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'update_family_delete') {
                $page_data['page_name'] = 'employee_update_family_delete';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Hapus Data Keluarga';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------- FILE ------- //

        function file($param1 = '', $param2 = '', $param3 = ''){
            if ($this->session->userdata('employee_login') != 1) {
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
                    
                    $data['update_id']            =   substr(md5(microtime()),rand(0,26),5);

                    $this->db->insert('file_tmp', $data);  

                    $data2['update_id']      = $data['update_id'];
                    $data2['update_date']    = date('Y-m-d H:i:s');
                    $data2['update_status']  = 'Waiting for Approval';
                    $data2['update_type']    = 'File';
                    $data2['update_process'] = 'Update';
                    $data2['nik']            = $data['nik'];

                    $this->db->insert('employee_update', $data2);

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
                    redirect(site_url('employee/profile/update_list'));
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

                    $data['update_id']            =   substr(md5(microtime()),rand(0,26),5);

                    $this->db->insert('file_tmp', $data);  

                    $data2['update_id']      = $data['update_id'];
                    $data2['update_date']    = date('Y-m-d H:i:s');
                    $data2['update_status']  = 'Waiting for Approval';
                    $data2['update_type']    = 'File';
                    $data2['update_process'] = 'Update';
                    $data2['nik']            = $data['nik'];

                    $this->db->insert('employee_update', $data2);                 

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
                    redirect(site_url('employee/profile/update_list'));
                }
            }

            if ($param1 == 'update_file') {
                $page_data['page_name'] = 'employee_update_file';
                $page_data['update_id'] = $param2;
                $page_data['page_title'] = 'Request Update Data File';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------- ATTENDANCE ------- //

        function freelance_attendance_report() {
            $page_data['month']         = date('m');
            $page_data['year']          = date('Y');
            $page_data['page_name']     = 'freelance_attendance_report';
            $page_data['page_title']    = 'Freelance Attendance Report';
            $this->load->view('backend/index', $page_data);
        }

        function freelance_attendance_report_selector() {
            $data['nik']            = $this->input->post('nik');
            $data['year']           = $this->input->post('year');
            $data['month']          = $this->input->post('month');
            redirect(site_url('employee/freelance_attendance_report_view/') .$data['nik'] . '/' . $data['year'] . '/' . $data['month'], 'refresh');
        }

        function freelance_attendance_report_view($nik = '', $year = '', $month = '') {
            if ($this->session->userdata('employee_login') != 1)
                redirect(site_url('login'), 'refresh');

            $page_data['nik']           = $nik;
            $page_data['year']          = $year;
            $page_data['month']         = $month;
            $page_data['page_name']     = 'freelance_attendance_report_view';
            $page_data['page_title']    = 'Freelance Attendance Report';
            $this->load->view('backend/index', $page_data);
        }

        function freelance_attendance_report_print($nik = '', $year = '', $month = '') {
            if ($this->session->userdata('employee_login') != 1)
                redirect(site_url('login'), 'refresh');

            $page_data['page_title']    = 'Freelance Attendance Report';
            $page_data['nik']           = $nik;
            $page_data['year']          = $year;
            $page_data['month']         = $month;
            
            $this->load->view('backend/employee/freelance_attendance_report_print', $page_data);
        }


        // ------------- RAWAT INAP ------------- //
        
        function rawatinap($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $rawatinap = $this->employee_model->rawatinap_add();
                if ($rawatinap == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/rawatinap/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'rawatinap';
                $page_data['page_title'] = 'Claim Rawat Inap';
                $this->load->view('backend/index', $page_data);
            }
        } 


        // ------------- RAWAT JALAN ------------- //
        
        function rawatjalan($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $rawatjalan = $this->employee_model->rawatjalan_add();
                if ($rawatjalan == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/rawatjalan/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'rawatjalan';
                $page_data['page_title'] = 'Claim Rawat Jalan';
                $this->load->view('backend/index', $page_data);
            }
        } 


        // ------------- MELAHIRKAN ------------- //
        
        function melahirkan($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $melahirkan = $this->employee_model->melahirkan_add();
                if ($melahirkan == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/melahirkan/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'melahirkan';
                $page_data['page_title'] = 'Claim Melahirkan';
                $this->load->view('backend/index', $page_data);
            }
        } 


        // ------------- KACAMATA ------------- //
        
        function kacamata($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $kacamata = $this->employee_model->kacamata_add();
                if ($kacamata == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/kacamata/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'kacamata';
                $page_data['page_title'] = 'Claim Kacamata';
                $this->load->view('backend/index', $page_data);
            }
        } 


        // ------- LOAN ------- //
        
        function loan($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $loan = $this->employee_model->loan_add();
                if ($loan == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/loan/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'loan';
                $page_data['page_title'] = 'Peminjaman';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- UNIFORM ------------- //
        
        function uniform($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $uniform = $this->employee_model->uniform_add();
                if ($uniform == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/uniform/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'uniform';
                $page_data['page_title'] = 'Request Seragam';
                $this->load->view('backend/index', $page_data);
            }
        } 
        

        // ------- LEAVE ------- //
        
        // function leave($param1 = '', $param2 = '') {
        //     if ($this->session->userdata('employee_login') != 1) {
        //         $this->session->set_userdata('last_page', current_url());
        //         redirect(site_url('login'),'refresh');
        //     }
        //     if ($param1 == 'create') {
        //         $leave = $this->employee_model->leave_add();
        //         if ($leave == true) {
        //             $this->session->set_flashdata('success', 'Data Created Successfully');
        //         } else {
        //             $this->session->set_flashdata('error', 'Create Data Failed');
        //         }
        //         redirect(site_url('employee/leave/list'), 'refresh');
        //     }
        //     if ($param1 == 'list') {
        //         $page_data['page_name'] = 'leave';
        //         $page_data['page_title'] = 'Leave';
        //         $this->load->view('backend/index', $page_data);
        //     }
        // }  


        // ------- RESIGN ------- //
        
        function resign($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $resign = $this->employee_model->resign_add();
                if ($resign == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/resign/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'resign';
                $page_data['page_title'] = 'Resign';
                $this->load->view('backend/index', $page_data);
            }
        }  


        // ------------- SPK ------------- //

        function spk($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print_freelance') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Freelance';
                $this->load->view('backend/employee/spk_print_freelance', $page_data);
            }
            if ($param1 == 'print_pkwt') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK PKWT';
                $this->load->view('backend/employee/spk_print_pkwt', $page_data);
            }
            if ($param1 == 'print_mitra') {
                $page_data['spk_id']        = $param2;
                $page_data['nik']           = $param3;
                $page_data['page_title']    = 'SPK Mitra';
                $this->load->view('backend/employee/spk_print_mitra', $page_data);
            }
        }


        // ------------- SURAT TEGURAN ------------- //

        function teguran($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print') {
                $page_data['teguran_id']    = $param2;
                $page_data['page_title']    = 'Surat Teguran';
                $this->load->view('backend/employee/teguran_print', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'teguran';
                $page_data['page_title'] = 'Surat Teguran';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- SURAT PANGGILAN ------------- //

        function panggilan($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'print') {
                $page_data['panggilan_id']  = $param2;
                $page_data['page_title']    = 'Surat Panggilan';
                $this->load->view('backend/employee/panggilan_print', $page_data);
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'panggilan';
                $page_data['page_title'] = 'Surat Panggilan';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- CLASS ------------- //

        function class($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'join') {
                $class = $this->employee_model->class_join();
                if ($class == true) {
                    $this->session->set_flashdata('success', 'Join Successfully');
                } else {
                    $this->session->set_flashdata('success', 'Join Failed');
                }
                redirect(site_url('employee/class/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'elearning';
                $page_data['page_title'] = 'Kelas';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'materi') {
                $page_data['page_name']  = 'elearning_materi';
                $page_data['class_id']   = $param2;
                $page_data['page_title'] = 'Materi';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'students') {
                $page_data['page_name']  = 'elearning_students';
                $page_data['class_id']   = $param2;
                $page_data['page_title'] = 'Anggota';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'leave') {
                $class = $this->employee_model->class_leave($param2);
                if ($class == true) {
                    $this->session->set_flashdata('success', 'Leave Successfully');
                } else {
                    $this->session->set_flashdata('success', 'Leave Failed');
                }
                redirect(site_url('employee/class/list'), 'refresh');
            }
        }


        // ------- VACANCY ------- //

        function vacancy($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name']     = 'vacancy';
                $page_data['page_title']    = 'Job Posting';
                $this->load->view('backend/index', $page_data);
            }
            
        }


        // ------- APPLICATION ------- //

        function application($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }

            if ($param1 == 'list') {
                $page_data['page_name']     = 'application';
                $page_data['page_title']    = 'Status Lamaran';
                $this->load->view('backend/index', $page_data);
            }

            if($param1 == 'apply') {
                $application = $this->employee_model->application_apply($param2);
                if($application == true){
                    $this->session->set_flashdata('success', 'Job Applied Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Applying Job Failed');
                }
                $nik = $this->db->get_where('employee',array('nik' => $param3))->row()->nik;
                redirect(site_url('employee/vacancy/list/'. $nik),'refresh');
            }
        }


        // ------------- EXAM ------------- //

        function exam($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'cbt_exam';
                $page_data['page_title'] = 'Test Online';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'take') {
                $exam_name = $this->db->get_where('cbt_exam', array('exam_id' => $param2))->row()->exam_name;

                $page_data['page_name']  = 'cbt_exam_take';
                $page_data['exam_id']    = $param2;
                $page_data['page_title'] = $exam_name;
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'auth') {
                $exam_id    =   $param2;
                $token      =   $this->input->post('exam_token');

                $validate = $this->db->get_where('cbt_exam' , array('exam_id' => $exam_id , 'exam_token' => $token));
                if ($validate->num_rows() > 0) {
                    $this->session->set_userdata('exam_login' , '1');

                    $participants_id = $exam_id.'-'.$this->session->userdata('login_nik');
                    
                    $data['participants_id']      = $participants_id;
                    $data['nik']                  = $this->session->userdata('login_nik');
                    $data['exam_id']              = $exam_id;
                    $data['participants_start']   = date('Y-m-d H:i:s');
                    $data['participants_status']  = 'Take On';

                    $cekid = $this->db->get_where('cbt_participants', array('participants_id' => $participants_id))->num_rows();

                    if($cekid == 0){
                        $this->db->insert('cbt_participants', $data);
                    } else {
                        $this->db->where('participants_id', $participants_id);
                        $this->db->update('cbt_participants', $data);
                    }

                    if($validate->row()->exam_random == 'N'){
                        redirect(site_url('employee/exam/question/'.$exam_id.'/1'),'refresh');
                    } elseif($validate->row()->exam_random == 'Y') {
                        redirect(site_url('employee/exam/question_rand/'.$exam_id),'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Invalid Token');
                    redirect(site_url('employee/exam/take/'.$exam_id), 'refresh');
                }
            }
            if ($param1 == 'question') {
                if ($this->session->userdata('exam_login') != 1) {
                    redirect(site_url('employee/exam/take/'.$param2),'refresh');
                } else {
                    $data['model'] = $this->employee_model->view($param2);
		
                    $this->load->view('backend/employee/cbt_question2', $data);
                }
            }
            if($param1 == 'answer2') {
                $exam = $this->employee_model->exam_answer2($param2, $param4, $param5);
                redirect(site_url('employee/exam/question/'. $param2 . '/' . $param3));
            }
            if($param1 == 'answeressay') {
                $exam = $this->employee_model->exam_answeressay($param2, $param4);
                redirect(site_url('employee/exam/question/'. $param2 . '/' . $param3));
            }
            if($param1 == 'finish') {
                $this->session->set_userdata('exam_login' , '0');

                $exam = $this->employee_model->exam_finish($param2);
                if ($exam == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('employee/exam/list'));
            }

            // RANDOM
            // if ($param1 == 'question_rand') {
            //     if ($this->session->userdata('exam_login') != 1) {
            //         redirect(site_url('employee/exam/take/'.$param2),'refresh');
            //     } else {
            //         $exam_name = $this->db->get_where('cbt_exam', array('exam_id' => $param2))->row()->exam_name;

            //         $page_data['exam_id']    = $param2;
            //         $page_data['page_title'] = $exam_name;
            //         $this->load->view('backend/employee/cbt_question3', $page_data);
            //     }
            // }
            // if($param1 == 'answer') {
            //     $this->session->set_userdata('exam_login' , '0');

            //     $exam = $this->employee_model->exam_answer($param2);
            //     if ($exam == true) {
            //         $this->session->set_flashdata('success', 'Data Updated Successfully');
            //     } else {
            //         $this->session->set_flashdata('error', 'Update Data Failed');
            //     }
            //     redirect(site_url('employee/exam/list'));
            // }
        }


        // ------------- SURVEY ------------- //

        function survey($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'survey';
                $page_data['page_title'] = 'E-Survey';
                $this->load->view('backend/index', $page_data);
            }
            if ($param1 == 'take') {
                $survey_name = $this->db->get_where('survey', array('survey_id' => $param2))->row()->survey_name;

                $page_data['page_name']  = 'survey_take';
                $page_data['survey_id']    = $param2;
                $page_data['page_title'] = $survey_name;
                $this->load->view('backend/index', $page_data);
            }
            if($param1 == 'submit') {
                $survey = $this->employee_model->survey_submit($param2);
                if ($survey == true) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Update Data Failed');
                }
                redirect(site_url('employee/survey/list'));
            }
        }


        // ------------- EGD E-ATTENDANCE ------------- //

        function egdattendance($param1 = '', $param2 = '', $param3 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'attend') {
                $egdattendance = $this->employee_model->egdattendance_attend($param2, $param3);
                if ($egdattendance == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/egdattendance/list'), 'refresh');
            }
            if ($param1 == 'attendmanual') {
                $egdattendance = $this->employee_model->egdattendance_attendmanual();
                if ($egdattendance == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/egdattendance/list'), 'refresh');
            }
            if ($param1 == 'list') {
                $page_data['page_name'] = 'egdattendance';
                $page_data['page_title'] = 'E-Attendance';
                $this->load->view('backend/index', $page_data);
            }
        }


        // ------------- SPEAK UP ------------- //
        
        function speakup($param1 = '', $param2 = '') {
            if ($this->session->userdata('employee_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(site_url('login'),'refresh');
            }
            if ($param1 == 'create') {
                $speakup = $this->employee_model->speakup_add();
                if ($speakup == true) {
                    $this->session->set_flashdata('success', 'Data Created Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Create Data Failed');
                }
                redirect(site_url('employee/speakup/list'), 'refresh');
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
                redirect(site_url('employee/change_password'), 'refresh');
            }
            
            $page_data['page_name']     = 'change_password';
            $page_data['page_title']    = 'Ganti Password';
            $this->load->view('backend/index', $page_data);
        }
    }

?>