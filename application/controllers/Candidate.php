<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Candidate extends CI_Controller {

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
        if ($this->session->userdata('candidate_login') != 1)
            redirect(site_url('login/erecruitment'), 'refresh');
        if ($this->session->userdata('candidate_login') == 1)
            redirect(site_url('candidate/dashboard'), 'refresh');
        $this->load->view('backend/index');
    }

    function dashboard() {
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }

        $page_data['page_name'] = 'home';
        $page_data['page_title'] = 'Home';
        $this->load->view('backend/index', $page_data);
    }


    // ------- CURRICULUM VITAE ------- //

    function cv($param1 = '', $param2 = '') {
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }

        if ($param1 == 'profile') {
            $page_data['page_name']     = 'cv';
            $page_data['page_title']    = 'Curriculum Vitae';
            $page_data['edit_data']     = $this->db->get_where('candidate', array('candidate_ktp' => $this->session->userdata('login_nik')))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        if ($param1 == 'edit') {
            $page_data['page_name']     = 'cv_edit';
            $page_data['candidate_ktp'] = $param2;
            $page_data['page_title']    = 'Curriculum Vitae';
            $this->load->view('backend/index', $page_data);
        }

        if ($param1 == 'print') {
            $page_data['candidate_ktp'] = $param2;
            $page_data['page_title']    = 'Curriculum Vitae';
            $this->load->view('backend/candidate/cv_print', $page_data);
        }

        if ($param1 == 'update') {
            $candidate = $this->candidate_model->candidate_edit();
            if($candidate == true){
                $this->session->set_flashdata('success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('error', 'Update Data Failed');
            }
            redirect(site_url('candidate/cv/edit'), 'refresh');
        }
    }


    // ------- FAMILY ------- //

    function family($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }
        if($param1 == 'create') {
            $family = $this->candidate_model->family_add();
            if($family == true){
                $this->session->set_flashdata('success', 'Data Created Successfully');
            } else {
                $this->session->set_flashdata('error', 'Create Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate', array('candidate_ktp' => $param2))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'update') {
            $family = $this->candidate_model->family_edit($param2);
            if($family == true){
                $this->session->set_flashdata('success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('error', 'Update Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'delete') {
            $family = $this->candidate_model->family_delete($param2);
            if($family == true){
                $this->session->set_flashdata('success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('error', 'Delete Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
    }


    // ------- EDUCATION ------- //

    function education($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }
        if($param1 == 'create') {
            $education = $this->candidate_model->education_add();
            if($education == true){
                $this->session->set_flashdata('success', 'Data Created Successfully');
            } else {
                $this->session->set_flashdata('error', 'Create Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate', array('candidate_ktp' => $param2))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'update') {
            $education = $this->candidate_model->education_edit($param2);
            if($education == true){
                $this->session->set_flashdata('success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('error', 'Update Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'delete') {
            $education = $this->candidate_model->education_delete($param2);
            if($education == true){
                $this->session->set_flashdata('success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('error', 'Delete Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
    }


    // ------- CERTIFICATION ------- //

    function certification($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }
        if($param1 == 'create') {
            $certification = $this->candidate_model->certification_add($param2);
            if($certification == true){
                $this->session->set_flashdata('success', 'Data Created Successfully');
            } else {
                $this->session->set_flashdata('error', 'Create Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate', array('candidate_ktp' => $param2))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'update') {
            $certification = $this->candidate_model->certification_edit($param2);
            if($certification == true){
                $this->session->set_flashdata('success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('error', 'Update Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'delete') {
            $certification = $this->candidate_model->certification_delete($param2);
            if($certification == true){
                $this->session->set_flashdata('success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('error', 'Delete Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
    }


    // ------- ORGANIZATION ------- //

    function organization($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }
        if($param1 == 'create') {
            $organization = $this->candidate_model->organization_add();
            if($organization == true){
                $this->session->set_flashdata('success', 'Data Created Successfully');
            } else {
                $this->session->set_flashdata('error', 'Create Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate', array('candidate_ktp' => $param2))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'update') {
            $organization = $this->candidate_model->organization_edit($param2);
            if($organization == true){
                $this->session->set_flashdata('success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('error', 'Update Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'delete') {
            $organization = $this->candidate_model->organization_delete($param2);
            if($organization == true){
                $this->session->set_flashdata('success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('error', 'Delete Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
    }


    // ------- COMPANY ------- //

    function company($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }
        if($param1 == 'create') {
            $company = $this->candidate_model->company_add();
            if($company == true){
                $this->session->set_flashdata('success', 'Data Created Successfully');
            } else {
                $this->session->set_flashdata('error', 'Create Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate', array('candidate_ktp' => $param2))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'update') {
            $company = $this->candidate_model->company_edit($param2);
            if($company == true){
                $this->session->set_flashdata('success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('error', 'Update Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
        if($param1 == 'delete') {
            $company = $this->candidate_model->company_delete($param2);
            if($company == true){
                $this->session->set_flashdata('success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('error', 'Delete Data Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/cv/edit/'. $candidate_ktp),'refresh');
        }
    }


    // ------- FILE ------- //

    function file($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }
        if($param1 == 'upload'){
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
                redirect(site_url('candidate/cv/edit/'.$param2));
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
                redirect(site_url('candidate/cv/edit/'.$param2));
            }
        }
    }


    // ------- VACANCY ------- //

    function vacancy() {
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }

        $page_data['page_name']     = 'vacancy';
        $page_data['page_title']    = 'Job Vacancy';
        $this->load->view('backend/index', $page_data);
        
    }


    // ------- APPLICATION ------- //

    function application($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('candidate_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'),'refresh');
        }

        if ($param1 == 'list') {
            $page_data['page_name']     = 'application';
            $page_data['page_title']    = 'My Application';
            $this->load->view('backend/index', $page_data);
        }

        if($param1 == 'apply') {
            $application = $this->candidate_model->application_apply($param2);
            if($application == true){
                $this->session->set_flashdata('success', 'Job Applied Successfully');
            } else {
                $this->session->set_flashdata('error', 'Applying Job Failed');
            }
            $candidate_ktp = $this->db->get_where('candidate',array('candidate_ktp' => $param3))->row()->candidate_ktp;
            redirect(site_url('candidate/vacancy/list/'. $candidate_ktp),'refresh');
        }
    }


    // ------------- EXAM ------------- //

    function exam($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {
        if ($this->session->userdata('candidate_login') != 1) {
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
                    redirect(site_url('candidate/exam/question/'.$exam_id.'/1'),'refresh');
                } elseif($validate->row()->exam_random == 'Y') {
                    redirect(site_url('candidate/exam/question_rand/'.$exam_id),'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid Token');
                redirect(site_url('candidate/exam/take/'.$exam_id), 'refresh');
            }
        }
        if ($param1 == 'question') {
            if ($this->session->userdata('exam_login') != 1) {
                redirect(site_url('candidate/exam/take/'.$param2),'refresh');
            } else {
                $data['model'] = $this->candidate_model->view($param2);
    
                $this->load->view('backend/candidate/cbt_question2', $data);
            }
        }
        if($param1 == 'answer2') {
            $exam = $this->candidate_model->exam_answer2($param2, $param4, $param5);
            redirect(site_url('candidate/exam/question/'. $param2 . '/' . $param3));
        }
        if($param1 == 'answeressay') {
            $exam = $this->candidate_model->exam_answeressay($param2, $param4);
            redirect(site_url('candidate/exam/question/'. $param2 . '/' . $param3));
        }
        if($param1 == 'finish') {
            $this->session->set_userdata('exam_login' , '0');

            $exam = $this->candidate_model->exam_finish($param2);
            if ($exam == true) {
                $this->session->set_flashdata('success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('error', 'Update Data Failed');
            }
            redirect(site_url('candidate/exam/list'));
        }
    }


    // ------- PASSWORD ------- //

    function change_password($param1 = '', $param2 = '')
    {
        if ($param1 == 'change') {
            $data['user_password']        = md5($this->input->post('user_password'));
            $data['new_password']         = md5($this->input->post('new_password'));
            $data['confirm_new_password'] = md5($this->input->post('confirm_new_password'));
            
            $current_password = $this->db->get_where('candidate', array('candidate_ktp' => $this->session->userdata('login_nik')))->row()->candidate_password;
            
            if ($current_password == $data['user_password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('candidate_ktp', $this->session->userdata('login_nik'));
                $this->db->update('candidate', array('candidate_password' => $data['new_password']));
                
                $this->session->set_flashdata('success', 'Password Updated');
            } else {
                $this->session->set_flashdata('error', 'Password Mismatch');
            }
            redirect(site_url('candidate/change_password'), 'refresh');
        }
        
        $page_data['page_name']     = 'change_password';
        $page_data['page_title']    = 'Change Password';
        $this->load->view('backend/index', $page_data);
    }
}

?>